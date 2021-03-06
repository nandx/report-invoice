<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class RdsTaspen extends CI_Model
{

	public function taspenlist()
	{
		$data = $this->db->query("SELECT * from tlsampledata");
		return $data->result();
	}

	public function listdropdown()
	{
		$data = $this->db->query("SELECT distinct(bulan) as bulan from tlsampledata");
		return $data->result();
	}
	// non aspurjab
	public function mlookup()
	{
		$cari = $this->input->GET('cari', TRUE);
		$year = $this->input->GET('year', TRUE);

		if (!empty($cari) and !empty($year)) {

			$data = $this->db->query("SELECT * from tl_invoice_standard HAVING MONTH(DUEDATE) = '$cari' AND YEAR(DUEDATE) = '$year' AND ID_CHILD != 27 AND IDDIVISION IS NOT NULL AND IDSUB IS NOT NULL AND IDSUB > 0 order by DUEDATE DESC");
		} else {
			$data = $this->db->query("SELECT * from tl_invoice_standardy where ID_CHILD != 27 AND IDDIVISION IS NOT NULL AND IDSUB IS NOT NULL AND IDSUB > 0 order by DUEDATE DESC");
		}
		return $data->result();
	}

	//buat filter all bulan
	public function mlookupfilterall()
	{
		$cari = $this->input->GET('cari', TRUE);
		$year = $this->input->GET('year', TRUE);

		if ($cari == 'all') {

			$data = $this->db->query("SELECT * from tl_invoice_standard where  ID_CHILD != 27 AND IDDIVISION IS NOT NULL AND IDSUB IS NOT NULL AND IDSUB > 0 order by DUEDATE DESC");
		}
		return $data->result();

		/*
		else {
			$data = $this->db->query("SELECT * from tl_invoice_standardy where ID_CHILD != 27 AND IDDIVISION IS NOT NULL AND IDSUB IS NOT NULL AND IDSUB > 0 order by DUEDATE ASC");
		}
		*/
	}

	public function get_standard_invoice()
	{
		$cari = $this->input->GET('cari', TRUE);
		$year = $this->input->GET('year', TRUE);

		if (!empty($cari) and !empty($year)) {
			$data = $this->db->query("SELECT 
			DISTINCT INV.* FROM `tl_invoice_standard` INV 
			INNER JOIN `tl_individu_standard` INP 
				ON INP.POLICYNO = INV.POLICYNO 
				AND INP.ID_CHILD = INV.ID_CHILD 
				AND INP.TAHUN=INV.TAHUN 
				AND INP.BULAN=INV.BULAN 
				AND INP.IDDIVISION = INV.IDDIVISION 
				AND INP.IDSUB = INV.IDSUB 
			WHERE INV.BULAN = '$cari' 
				AND INV.TAHUN = '$year'
				AND INV.ID_CHILD != 27 
			ORDER BY INV.DUEDATE DESC");
		} else {
			$data = $this->db->query("SELECT 
			DISTINCT INV.* FROM `tl_invoice_standard` INV 
			INNER JOIN `tl_individu_standard` INP 
				ON INP.POLICYNO = INV.POLICYNO 
				AND INP.ID_CHILD = INV.ID_CHILD 
				AND INP.TAHUN=INV.TAHUN 
				AND INP.BULAN=INV.BULAN 
				AND INP.IDDIVISION = INV.IDDIVISION 
				AND INP.IDSUB = INV.IDSUB 
			WHERE INV.ID_CHILD != 27 
			ORDER BY INV.DUEDATE DESC");
		}
		return $data->result();
	}
	//Non Aspurjab ID_CHILD != 27
	public function allmlookup()
	{
		$data = $this->db->query("SELECT * from tl_invoice_standard where ID_CHILD != 27 AND IDDIVISION IS NOT NULL  AND IDSUB > 0 order by DUEDATE DESC");
		return $data->result();
	}

	public function querywhere($id)
	{
		$data = $this->db->query("SELECT *,
				CASE 
					WHEN (LENGTH(MONTH(DUEDATE)) < 2)
 					THEN CONCAT(0,MONTH(DUEDATE))
 					ELSE MONTH(DUEDATE)
				END AS DUEDATEMONTH 
			FROM tl_invoice_standard where id = '$id' AND ID_CHILD !=27  order by `DUEDATE` DESC");
		return $data->result();
	}
	public function sumjmlpremi($id)
	{
		$data = $this->db->query("SELECT sum(jmlpremi) as  jml from tl_invoice_standard where id = '$id' AND ID_CHILD !=27 order by `DUEDATE` DESC");
		return $data->result();
	}
	public function updatenonasporcetakpdf($id)
	{
		$status = $this->db->query("SELECT STATUS, DUEDATE FROM tl_invoice_standard where id='$id'")->first_row();
		$this->db->set('PRINTDATE', 'NOW()', FALSE);
		if ($status->STATUS == 0) {
			$this->db->set('DUEDATE', "CASE 
			WHEN(DAY(DUEDATE) > 28) 
				THEN DATE_ADD(DATE_ADD(STR_TO_DATE(CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-',DAY(DUEDATE) - 3), '%Y-%m-%d'), INTERVAL 3 DAY), INTERVAL 1 MONTH)
				ELSE DATE_ADD(STR_TO_DATE(CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-',DAY(DUEDATE)),'%Y-%m-%d'), INTERVAL 1 MONTH)
			END", FALSE);

			$this->db->set('BULAN', "CASE
			WHEN(LENGTH(MONTH(NOW()) + 1) < 2)
				THEN CONCAT(0,MONTH(NOW())+1)
				ELSE MONTH(NOW()) + 1
			END", FALSE);
		}
		$this->db->where('ID', $id);
		$updated = $this->db->update('tl_invoice_standard');
		return $updated ? true : false;
	}

	public function multiupdated($id)
	{
		/*
   
      if(is_array($id)){
            $this->db->where_in('ID', $id);
        }else{
            $this->db->where('ID', $id);
        }
        $delete = $this->db->delete('tl_invoice_standard');
        return $delete?true:false;
        */
		$dated = date("Y-m-d");

		if (is_array($id)) {
			$this->db->set('STATUS', '1', FALSE);
			$this->db->set('PAYMENTDATE', 'NOW()', FALSE);
			$this->db->where_in('id', $id);
		} else {
			$this->db->set('STATUS', '1', FALSE);
			$this->db->set('PAYMENTDATE', 'NOW()', FALSE);
			$this->db->where('ID', $id);
		}

		$duedate = $this->db->query("SELECT DUEDATE FROM tl_invoice_standard where id='$id'")->first_row();

		if (empty($duedate->DUEDATE)) {
			$this->db->set('DUEDATE', 'DATE_ADD(NOW(), INTERVAL 30 DAY)', FALSE);
		}

		$updated = $this->db->update('tl_invoice_standard');
		return $updated ? true : false;
	}

	// start aspurjab
	public function listaspurjab()
	{
		//$cari = $this->input->GET('cari', TRUE);
		$data = $this->db->query("SELECT * from tl_invoice_standard where ID_CHILD = 27 order by `DUEDATE` DESC");
		return $data->result();
	}

	public function mlookupaspur()
	{
		$cari = $this->input->GET('cari', TRUE);
		$year = $this->input->GET('year', TRUE);

		if (!empty($cari) and !empty($year)) {
			$data = $this->db->query("SELECT * from tl_invoice_standard HAVING MONTH(DUEDATE) =  '$cari' AND YEAR(DUEDATE) ='$year' AND ID_CHILD = 27 AND NOINVOICE IS NOT NULL and KOTA IS NOT NULL order by `DUEDATE`  DESC");
		} else {
			$data = $this->db->query("SELECT * from tl_invoice_standard where ID_CHILD = 27 AND NOINVOICE IS NOT NULL and KOTA IS NOT NULL order by `DUEDATE` DESC");
		}
		return $data->result();
	}

	//buat filter all bulan
	public function mlookupfilterallaspur()
	{
		$cari = $this->input->GET('cari', TRUE);
		$year = $this->input->GET('year', TRUE);

		if ($cari == 'all') {

			$data = $this->db->query("SELECT * from tl_invoice_standard where  ID_CHILD = 27 AND NOINVOICE IS NOT NULL and KOTA IS NOT NULL order by DUEDATE DESC");
		}
		return $data->result();

		/*
		else {
			$data = $this->db->query("SELECT * from tl_invoice_standardy where ID_CHILD != 27 AND IDDIVISION IS NOT NULL AND IDSUB IS NOT NULL AND IDSUB > 0 order by DUEDATE ASC");
		}
		*/
	}

	public function allmlookupaspur()
	{
		$data = $this->db->query("SELECT * FROM tl_invoice_standard where ID_CHILD = 27  order by DUEDATE DESC");
		return $data->result();
	}
	public function mdatakotoraspurjab()
	{
		//$data = $this->db->query("SELECT * FROM tl_invoice_standard WHERE IDDIVISION IS NULL OR IDSUB IS NULL");
		$data = $this->db->query("SELECT * FROM tl_invoice_standard WHERE ID_CHILD = 27 AND IDDIVISION IS NULL OR IDSUB IS NULL");
		return $data->result();
	}

	public function querywhereas($id, $bulan, $tahun)
	{
		$data = $this->db->query("SELECT CREATEDATE, DUEDATE, PAYMENTDATE, TAHUN, BULAN, PARTNERNAME, NMDIVISION, NMSUB, ALAMAT, KOTA, NOINVOICE, POLICYNO, JMLPREMI, JMLPST, TERBILANG, NAME, PREMI, CURRENCY, PRODUCTCODE, PRODUCTNAME, BANKNAME, ACCOUNTNAME, ACCOUNTNUMBER, STATUS, REV FROM tl_invoice_standard where  BULAN='$bulan' and TAHUN='$tahun' AND id = '$id' GROUP BY NOINVOICE");
		return $data->result();
	}

	public function sumjmlpremias($id, $bulan, $tahun)
	{
		$data = $this->db->query("SELECT sum(premi) as  jml from tl_invoice_standardx where id = '$id'  order by `DUEDATE` DESC ");
		return $data->result();
	}

	public function premias($id, $bulan, $tahun)
	{
		$data = $this->db->query("SELECT productname , jmlpst, premi from tl_invoice_standard where BULAN='$bulan' and TAHUN='$tahun' AND id = '$id'  order by `DUEDATE` DESC");
		return $data->result();
	}

	public function querywhereasloop($id, $bulan, $tahun)
	{
		$data = $this->db->query("SELECT DISTINCT CREATEDATE, DUEDATE, PAYMENTDATE, TAHUN, BULAN, PARTNERNAME, NMDIVISION, NMSUB, ALAMAT, KOTA, NOINVOICE, POLICYNO, JMLPREMI, JMLPST, TERBILANG, NAME, PREMI, CURRENCY, PRODUCTCODE, PRODUCTNAME, BANKNAME, ACCOUNTNAME, ACCOUNTNUMBER, STATUS, REV FROM tl_invoice_standardx where BULAN='$bulan' and TAHUN='$tahun' AND id = '$id'  order by `DUEDATE` ASC");
		return $data->result();
	}

//	public function get_aspurjab_invoice($id, $bulan, $tahun)
	public function get_aspurjab_invoice($id, $id_child, $policyno, $bulan, $tahun)
	{
		$data = $this->db->query("SELECT *,
				CASE 
					WHEN (LENGTH(MONTH(DUEDATE)) < 2)
 					THEN CONCAT(0,MONTH(DUEDATE))
 					ELSE MONTH(DUEDATE)
				END AS DUEDATEMONTH 
 				FROM tl_invoice_standard where  BULAN='$bulan' and TAHUN='$tahun' AND id = '$id' and POLICYNO = '$policyno' order by `DUEDATE` DESC");
		return $data->result();
	}

	public function sumpremias($id, $id_child, $policyno, $bulan, $tahun)
	{
		$data = $this->db->query("SELECT sum(premi) as  jml from tl_invoice_standard where BULAN='$bulan' and TAHUN='$tahun' AND id = '$id' and POLICYNO = '$policyno'"); 
		// nggak bisa di sum jadi bulan sama year nya di remove
		//$data = $this->db->query("SELECT sum(premi) as  jml from tl_invoice_standard where  id = '$id'  order by `DUEDATE` DESC");
		return $data->result();
	}

	public function terbilongaspur($id, $bulan, $tahun)
	{
		$data = $this->db->query("SELECT sum(premi) as JML, CURRENCY from tl_invoice_standard where BULAN='$bulan' and TAHUN='$tahun' AND id = '$id' group by CURRENCY");
		return $data->result();
	}

	public function multiupdatedaspur($id)
	{
		/*
   
      if(is_array($id)){
            $this->db->where_in('ID', $id);
        }else{
            $this->db->where('ID', $id);
        }
        $delete = $this->db->delete('tl_invoice_standard');
        return $delete?true:false;
        */
		$dated = date("Y-m-d");

		if (is_array($id)) {
			$this->db->set('STATUS', '1', FALSE);
			$this->db->set('PAYMENTDATE', 'NOW()', FALSE);
			$this->db->where_in('id', $id);
		} else {
			$this->db->set('STATUS', '1', FALSE);
			$this->db->set('PAYMENTDATE', 'NOW()', FALSE);
			$this->db->where('ID', $id);
		}
		$updated = $this->db->update('tl_invoice_standard');
		return $updated ? true : false;
	}

	public function multiupdatedaspur2($id)
	{
		$dated = date("Y-m-d");
		$duedate = $this->db->query("SELECT DUEDATE FROM tl_invoice_standard where id='$id'")->first_row();

		if (is_array($id)) {
			$this->db->set('STATUS', '1', FALSE);
			$this->db->set('PAYMENTDATE', 'NOW()', FALSE);
			$this->db->where_in('id', $id);
		} else {
			$this->db->set('STATUS', '1', FALSE);
			$this->db->set('PAYMENTDATE', 'NOW()', FALSE);
			$this->db->where('ID', $id);
		}

		if (empty($duedate->DUEDATE)) {
			$this->db->set('DUEDATE', 'DATE_ADD(NOW(), INTERVAL 30 DAY)', FALSE);
		}
		$updated = $this->db->update('tl_invoice_standard');
		return $updated ? true : false;
	}

	public function updateasporcetakpdf($id)
	{
		$status = $this->db->query("SELECT STATUS FROM tl_invoice_standard where id='$id'")->first_row();

		$this->db->set('PRINTDATE', 'NOW()', FALSE);
		if ($status->STATUS == 0) {
			$this->db->set('DUEDATE', "CASE 
			WHEN(DAY(DUEDATE) > 28) 
				THEN DATE_ADD(DATE_ADD(STR_TO_DATE(CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-',DAY(DUEDATE) - 3), '%Y-%m-%d'), INTERVAL 3 DAY), INTERVAL 1 MONTH)
				ELSE DATE_ADD(STR_TO_DATE(CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-',DAY(DUEDATE)),'%Y-%m-%d'), INTERVAL 1 MONTH)
			END", FALSE);

			$this->db->set('BULAN', "CASE
			WHEN(LENGTH(MONTH(NOW()) + 1) < 2)
				THEN CONCAT(0,MONTH(NOW())+1)
				ELSE MONTH(NOW()) + 1
			END", FALSE);
		}
		$this->db->where('ID', $id);
		$updated = $this->db->update('tl_invoice_standard');
		return $updated ? true : false;
	}

	public function updateasporcetakpdf2($id)
	{
		$status = $this->db->query("SELECT STATUS FROM tl_invoice_standard where id='$id'")->first_row();

		$this->db->set('PRINTDATE', 'NOW()', FALSE);
		if ($status->STATUS == 0) {
			$this->db->set('DUEDATE', "CASE 
			WHEN(DAY(DUEDATE) > 28) 
				THEN DATE_ADD(DATE_ADD(STR_TO_DATE(CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-',DAY(DUEDATE) - 3), '%Y-%m-%d'), INTERVAL 3 DAY), INTERVAL 1 MONTH)
				ELSE DATE_ADD(STR_TO_DATE(CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-',DAY(DUEDATE)),'%Y-%m-%d'), INTERVAL 1 MONTH)
			END", FALSE);

			$this->db->set('BULAN', "CASE
			WHEN(LENGTH(MONTH(NOW()) + 1) < 2)
				THEN CONCAT(0,MONTH(NOW())+1)
				ELSE MONTH(NOW()) + 1
			END", FALSE);
		}
		$this->db->where('ID', $id);
		$updated = $this->db->update('tl_invoice_standard');
		return $updated ? true : false;
	}

	// end aspurjab


	// Generate Excel untuk Invoice Standard

	public function get_individu_premi_standard($id_division, $id_sub, $id_child, $policyno, $bulan, $tahun)
	{
		$data = $this->db->query(
			"SELECT TAHUN, BULAN, POLICYNO, NOTAS, NAMA_PESERTA, PREMI 
			FROM tl_individu_standard 
			WHERE 
				POLICYNO = '$policyno'
				AND BULAN = '$bulan'
				AND TAHUN = '$tahun'
				AND IDDIVISION = '$id_division'
				AND IDSUB = '$id_sub'
				AND ID_CHILD = '$id_child'
			ORDER BY POLICYNO ASC"
		);

		return $data->result();
	}


	public function count_individu_premi_standard($id_division, $id_sub, $id_child, $policyno, $bulan, $tahun)
	{
		$data = $this->db->query(
			"SELECT COUNT(TAHUN) AS COUNTED
			FROM tl_individu_standard 
			WHERE 
				POLICYNO = '$policyno'
				AND BULAN = '$bulan'
				AND TAHUN = '$tahun'
				AND IDDIVISION = '$id_division'
				AND IDSUB = '$id_sub'
				AND ID_CHILD = '$id_child'
			ORDER BY POLICYNO ASC"
		);

		return $data->first_row();
	}

	public function count_individu_premi_pusat($id_division, $id_sub, $id_child, $policyno, $bulan, $tahun)
	{
		$data = $this->db->query(
			"SELECT COUNT(TAHUN) AS COUNTED
			FROM tl_individu_standard 
			WHERE
				POLICYNO = '$policyno'
				AND BULAN = '$bulan'
				AND TAHUN = '$tahun'
				AND ID_CHILD = '$id_child'
			ORDER BY POLICYNO ASC"
		);

		return $data->first_row();
	}


	public function get_individu_premi_pusat($id_child, $policyno, $bulan, $tahun)
	{
		$data = $this->db->query(
			"SELECT DISTINCT TAHUN, BULAN, POLICYNO, NOTAS, NAMA_PESERTA, PREMI 
			FROM tl_individu_standard 
			WHERE
				POLICYNO = '$policyno'
				AND BULAN = '$bulan'
				AND TAHUN = '$tahun'
				AND ID_CHILD = '$id_child'
			ORDER BY POLICYNO ASC"
		);

		return $data->result();
	}
}
