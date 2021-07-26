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

	public function listparams()
	{
		$data = $this->db->query("SELECT * from tbl_params");
		return $data->result();
	}
	public function modedparams($id)
	{
		$data = $this->db->query("SELECT * from tbl_params where id = " . $id);
		return $data->result();
	}
	public function doupdate($id)
	{
		$data = array(
			"param1" => $this->input->post('param1'),
			"params2" => $this->input->post('params2'),
			"params3" => $this->input->post('params3'),
			"params4" => $this->input->post('params4')
		);

		$this->db->where('id', $id);
		$this->db->update('tbl_params', $data); // Untuk mengeksekusi perintah update data
	}
	// non aspurjab
	public function mlookup()
	{
		$cari = $this->input->GET('cari', TRUE);
		$year = $this->input->GET('year', TRUE);

		if ($cari == "all") {
			$data = $this->db->query("
			SELECT (
					SELECT COUNT(st.TAHUN) AS JMLPST
					FROM tl_individu_standard st
					WHERE st.POLICYNO = tl.POLICYNO
					AND st.BULAN = tl.TEMP_BULAN
					AND st.TAHUN = tl.TEMP_TAHUN
					AND st.ID_CHILD = tl.ID_CHILD
					AND st.IDDIVISION = tl.IDDIVISION
					AND st.IDSUB = tl.IDSUB
					AND st.STATUS = 1)        AS JMLPESERTA_PERDIVISI,
				(
					SELECT COUNT(non.TAHUN) AS COUNTED
					FROM tl_individu_standard non
					WHERE non.POLICYNO = tl.POLICYNO
					AND non.BULAN = tl.TEMP_BULAN
					AND non.TAHUN = tl.TEMP_TAHUN
					AND non.ID_CHILD = tl.ID_CHILD
					AND non.STATUS = 1) AS JMLPESERTA_PUSAT,
				tl.ID,
				tl.IDDIVISION,
				tl.IDSUB,
				tl.CREATEDATE,
				tl.DUEDATE,
				tl.PAYMENTDATE,
				tl.PRINTDATE,
				tl.ID_CHILD,
				tl.TAHUN,
				tl.TEMP_TAHUN,
				tl.BULAN,
				tl.TEMP_BULAN,
				tl.PARTNERNAME,
				tl.NMDIVISION,
				tl.NMSUB,
				tl.ALAMAT,
				tl.KOTA,
				tl.NOINVOICE,
				tl.POLICYNO,
				tl.JMLPST,
				tl.JMLPREMI,
				tl.TERBILANG,
				tl.CURRENCY,
				tl.PRODUCTCODE,
				tl.PRODUCTNAME,
				tl.BANKNAME,
				tl.ACCOUNTNAME,
				tl.ACCOUNTNUMBER,
				tl.STATUS,
				tl.REV
			FROM tl_invoice_standard tl
			WHERE tl.ID_CHILD != 27
			AND YEAR(DUEDATE) = '$year'
			AND tl.IDDIVISION IS NOT NULL
			AND tl.IDSUB IS NOT NULL
			ORDER BY tl.DUEDATE DESC
		");
		} elseif ($year == 'all') {
			$data = $this->db->query("
			SELECT (
					SELECT COUNT(st.TAHUN) AS JMLPST
					FROM tl_individu_standard st
					WHERE st.POLICYNO = tl.POLICYNO
					AND st.BULAN = tl.TEMP_BULAN
					AND st.TAHUN = tl.TEMP_TAHUN
					AND st.ID_CHILD = tl.ID_CHILD
					AND st.IDDIVISION = tl.IDDIVISION
					AND st.IDSUB = tl.IDSUB
					AND st.STATUS = 1)        AS JMLPESERTA_PERDIVISI,
				(
					SELECT COUNT(non.TAHUN) AS COUNTED
					FROM tl_individu_standard non
					WHERE non.POLICYNO = tl.POLICYNO
					AND non.BULAN = tl.TEMP_BULAN
					AND non.TAHUN = tl.TEMP_TAHUN
					AND non.ID_CHILD = tl.ID_CHILD
					AND non.STATUS = 1) AS JMLPESERTA_PUSAT,
				tl.ID,
				tl.IDDIVISION,
				tl.IDSUB,
				tl.CREATEDATE,
				tl.DUEDATE,
				tl.PAYMENTDATE,
				tl.PRINTDATE,
				tl.ID_CHILD,
				tl.TAHUN,
				tl.TEMP_TAHUN,
				tl.BULAN,
				tl.TEMP_BULAN,
				tl.PARTNERNAME,
				tl.NMDIVISION,
				tl.NMSUB,
				tl.ALAMAT,
				tl.KOTA,
				tl.NOINVOICE,
				tl.POLICYNO,
				tl.JMLPST,
				tl.JMLPREMI,
				tl.TERBILANG,
				tl.CURRENCY,
				tl.PRODUCTCODE,
				tl.PRODUCTNAME,
				tl.BANKNAME,
				tl.ACCOUNTNAME,
				tl.ACCOUNTNUMBER,
				tl.STATUS,
				tl.REV
			FROM tl_invoice_standard tl
			WHERE tl.ID_CHILD != 27
			AND MONTH(DUEDATE) = '$cari'
			AND tl.IDDIVISION IS NOT NULL
			AND tl.IDSUB IS NOT NULL
			ORDER BY tl.DUEDATE DESC
		");
		} else {
			$data = $this->db->query("
			SELECT (
					SELECT COUNT(st.TAHUN) AS JMLPST
					FROM tl_individu_standard st
					WHERE st.POLICYNO = tl.POLICYNO
					AND st.BULAN = tl.TEMP_BULAN
					AND st.TAHUN = tl.TEMP_TAHUN
					AND st.ID_CHILD = tl.ID_CHILD
					AND st.IDDIVISION = tl.IDDIVISION
					AND st.IDSUB = tl.IDSUB
					AND st.STATUS = 1)        AS JMLPESERTA_PERDIVISI,
				(
					SELECT COUNT(non.TAHUN) AS COUNTED
					FROM tl_individu_standard non
					WHERE non.POLICYNO = tl.POLICYNO
					AND non.BULAN = tl.TEMP_BULAN
					AND non.TAHUN = tl.TEMP_TAHUN
					AND non.ID_CHILD = tl.ID_CHILD
					AND non.STATUS = 1) AS JMLPESERTA_PUSAT,
				tl.ID,
				tl.IDDIVISION,
				tl.IDSUB,
				tl.CREATEDATE,
				tl.DUEDATE,
				tl.PAYMENTDATE,
				tl.PRINTDATE,
				tl.ID_CHILD,
				tl.TAHUN,
				tl.TEMP_TAHUN,
				tl.BULAN,
				tl.TEMP_BULAN,
				tl.PARTNERNAME,
				tl.NMDIVISION,
				tl.NMSUB,
				tl.ALAMAT,
				tl.KOTA,
				tl.NOINVOICE,
				tl.POLICYNO,
				tl.JMLPST,
				tl.JMLPREMI,
				tl.TERBILANG,
				tl.CURRENCY,
				tl.PRODUCTCODE,
				tl.PRODUCTNAME,
				tl.BANKNAME,
				tl.ACCOUNTNAME,
				tl.ACCOUNTNUMBER,
				tl.STATUS,
				tl.REV
			FROM tl_invoice_standard tl
			WHERE tl.ID_CHILD != 27
			AND MONTH(DUEDATE) = '$cari'
			AND YEAR(DUEDATE) = '$year'
			AND tl.IDDIVISION IS NOT NULL
			AND tl.IDSUB IS NOT NULL
			ORDER BY tl.DUEDATE DESC
		");
		}
		return $data->result();
	}

	//buat filter all bulan
	// public function mlookupfilterall()
	// {
	// 	$cari = $this->input->GET('cari', TRUE);
	// 	$year = $this->input->GET('year', TRUE);

	// 	if ($cari == 'all') {
	// 		$data = $this->db->query("
	// 		SELECT TOP 1000 * from tl_invoice_standard where  ID_CHILD != 27 AND IDDIVISION IS NOT NULL AND IDSUB IS NOT NULL AND IDSUB > 0 order by DUEDATE DESC");
	// 	}
	// 	return $data->result();

	// 	/*
	// 	else {
	// 		$data = $this->db->query("SELECT * from tl_invoice_standardy where ID_CHILD != 27 AND IDDIVISION IS NOT NULL AND IDSUB IS NOT NULL AND IDSUB > 0 order by DUEDATE ASC");
	// 	}
	// 	*/
	// }

	public function mlookupfilterall()
	{
		$cari = $this->input->GET('cari', TRUE);
		$year = $this->input->GET('year', TRUE);

		$data = $this->db->query("
				SELECT (
						SELECT COUNT(st.TAHUN) AS JMLPST
						FROM tl_individu_standard st
						WHERE st.POLICYNO = tl.POLICYNO
						AND st.BULAN = tl.TEMP_BULAN
						AND st.TAHUN = tl.TEMP_TAHUN
						AND st.ID_CHILD = tl.ID_CHILD
						AND st.IDDIVISION = tl.IDDIVISION
						AND st.IDSUB = tl.IDSUB
						AND st.STATUS = 1)        AS JMLPESERTA_PERDIVISI,
					(
						SELECT COUNT(non.TAHUN) AS COUNTED
						FROM tl_individu_standard non
						WHERE non.POLICYNO = tl.POLICYNO
						AND non.BULAN = tl.TEMP_BULAN
						AND non.TAHUN = tl.TEMP_TAHUN
						AND non.ID_CHILD = tl.ID_CHILD
						AND non.STATUS = 1) AS JMLPESERTA_PUSAT,
					tl.ID,
					tl.IDDIVISION,
					tl.IDSUB,
					tl.CREATEDATE,
					tl.DUEDATE,
					tl.PAYMENTDATE,
					tl.PRINTDATE,
					tl.ID_CHILD,
					tl.TAHUN,
					tl.TEMP_TAHUN,
					tl.BULAN,
					tl.TEMP_BULAN,
					tl.PARTNERNAME,
					tl.NMDIVISION,
					tl.NMSUB,
					tl.ALAMAT,
					tl.KOTA,
					tl.NOINVOICE,
					tl.POLICYNO,
					tl.JMLPST,
					tl.JMLPREMI,
					tl.TERBILANG,
					tl.CURRENCY,
					tl.PRODUCTCODE,
					tl.PRODUCTNAME,
					tl.BANKNAME,
					tl.ACCOUNTNAME,
					tl.ACCOUNTNUMBER,
					tl.STATUS,
					tl.REV
				FROM tl_invoice_standard tl
				WHERE tl.ID_CHILD != 27
				AND tl.IDDIVISION IS NOT NULL
				AND tl.IDSUB IS NOT NULL
				AND tl.IDSUB > 0
				ORDER BY tl.DUEDATE DESC
			");

		return $data->result();
	}

	public function get_standard_invoice()
	{
		$cari = $this->input->GET('cari', TRUE);
		$year = $this->input->GET('year', TRUE);

		if (!empty($cari) and !empty($year)) {
			$data = $this->db->query("SELECT 
			DISTINCT INV.* FROM tl_invoice_standard INV 
			INNER JOIN tl_individu_standard INP 
				ON INP.POLICYNO = INV.POLICYNO 
				AND INP.ID_CHILD = INV.ID_CHILD 
				AND INP.TAHUN=INV.TEMP_TAHUN 
				AND INP.BULAN=INV.TEMP_BULAN 
				AND INP.IDDIVISION = INV.IDDIVISION 
				AND INP.IDSUB = INV.IDSUB 
			WHERE INV.BULAN = '$cari' 
				AND INV.TAHUN = '$year'
				AND INV.ID_CHILD != 27 
			ORDER BY INV.DUEDATE DESC");
		} else {
			$data = $this->db->query("SELECT 
			DISTINCT INV.* FROM tl_invoice_standard INV 
			INNER JOIN tl_individu_standard INP 
				ON INP.POLICYNO = INV.POLICYNO 
				AND INP.ID_CHILD = INV.ID_CHILD 
				AND INP.TAHUN=INV.TEMP_TAHUN 
				AND INP.BULAN=INV.TEMP_BULAN 
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
					WHEN (LEN(MONTH(DUEDATE)) < 2)
 					THEN CONCAT(0,MONTH(DUEDATE))
 					ELSE MONTH(DUEDATE)
				END AS DUEDATEMONTH 
			FROM tl_invoice_standard where id = '$id' AND ID_CHILD !=27  order by DUEDATE DESC");
		return $data->result();
	}
	public function sumjmlpremi($id)
	{
		$data = $this->db->query("SELECT sum(jmlpremi) as  jml from tl_invoice_standard where id = '$id' AND ID_CHILD !=27");
		return $data->result();
	}
	public function updatenonasporcetakpdf($id)
	{
		$status = $this->db->query("SELECT STATUS, DUEDATE FROM tl_invoice_standard where id='$id'")->first_row();
		$this->db->set('PRINTDATE', 'GETDATE()', FALSE);
		if ($status->STATUS == 0) {
			$this->db->set('DUEDATE', "CASE 
			WHEN(DAY(DUEDATE) > 28) 
				THEN DATEADD(month, 1, DATEADD(day, 3, DATEFROMPARTS(YEAR(GETDATE()), MONTH(GETDATE()), DAY(DUEDATE) - 3)))
			ELSE DATEADD(month, 1, DATEFROMPARTS(YEAR(GETDATE()), MONTH(GETDATE()), DAY(DUEDATE)))
			END", FALSE);


			$this->db->set('BULAN', "CASE
			WHEN(LEN(MONTH(GETDATE()) + 1) < 2)
				THEN CONCAT(0,MONTH(GETDATE())+1)
				ELSE MONTH(GETDATE()) + 1
			END", FALSE);

			$this->db->set('TAHUN', "YEAR(GETDATE())", FALSE);
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
			$this->db->set('PAYMENTDATE', 'GETDATE()', FALSE);
			$this->db->where_in('id', $id);
		} else {
			$this->db->set('STATUS', '1', FALSE);
			$this->db->set('PAYMENTDATE', 'GETDATE()', FALSE);
			$this->db->where('ID', $id);
		}

		$duedate = $this->db->query("SELECT DUEDATE FROM tl_invoice_standard where id='$id'")->first_row();

		if (empty($duedate->DUEDATE)) {
			$this->db->set('DUEDATE', 'DATE_ADD(GETDATE(), INTERVAL 30 DAY)', FALSE);
		}

		$updated = $this->db->update('tl_invoice_standard');
		return $updated ? true : false;
	}

	// start aspurjab
	public function listaspurjab()
	{
		//$cari = $this->input->GET('cari', TRUE);
		$data = $this->db->query("SELECT * from tl_invoice_standard where ID_CHILD = 27 order by DUEDATE DESC");
		return $data->result();
	}

	public function mlookupaspur()
	{
		$cari = $this->input->GET('cari', TRUE);
		$year = $this->input->GET('year', TRUE);

		if ($cari == 'all') {
			$data = $this->db->query("
			SELECT (
				SELECT COUNT(st.TAHUN) AS JMLPST
				FROM tl_individu_standard st
				WHERE st.POLICYNO = tl.POLICYNO
				AND st.BULAN = tl.TEMP_BULAN
				AND st.TAHUN = tl.TEMP_TAHUN
				AND st.ID_CHILD = tl.ID_CHILD
				AND st.IDDIVISION = tl.IDDIVISION
				AND st.IDSUB = tl.IDSUB
				AND st.STATUS = 1)        AS JMLPESERTA_PERDIVISI,
			(
				SELECT COUNT(non.TAHUN) AS COUNTED
				FROM tl_individu_standard non
				WHERE non.POLICYNO = tl.POLICYNO
				AND non.BULAN = tl.TEMP_BULAN
				AND non.TAHUN = tl.TEMP_TAHUN
				AND non.ID_CHILD = tl.ID_CHILD
				AND non.STATUS = 1) AS JMLPESERTA_PUSAT
			,tl.* from tl_invoice_standard tl WHERE YEAR(DUEDATE) ='$year' AND ID_CHILD = 27 AND NOINVOICE IS NOT NULL and KOTA IS NOT NULL order by DUEDATE  DESC");
		} elseif ($year == 'all') {
			$data = $this->db->query("
			SELECT (
				SELECT COUNT(st.TAHUN) AS JMLPST
				FROM tl_individu_standard st
				WHERE st.POLICYNO = tl.POLICYNO
				AND st.BULAN = tl.TEMP_BULAN
				AND st.TAHUN = tl.TEMP_TAHUN
				AND st.ID_CHILD = tl.ID_CHILD
				AND st.IDDIVISION = tl.IDDIVISION
				AND st.IDSUB = tl.IDSUB
				AND st.STATUS = 1)        AS JMLPESERTA_PERDIVISI,
			(
				SELECT COUNT(non.TAHUN) AS COUNTED
				FROM tl_individu_standard non
				WHERE non.POLICYNO = tl.POLICYNO
				AND non.BULAN = tl.TEMP_BULAN
				AND non.TAHUN = tl.TEMP_TAHUN
				AND non.ID_CHILD = tl.ID_CHILD
				AND non.STATUS = 1) AS JMLPESERTA_PUSAT
			,tl.* from tl_invoice_standard tl WHERE MONTH(DUEDATE) ='$cari' AND ID_CHILD = 27 AND NOINVOICE IS NOT NULL and KOTA IS NOT NULL order by DUEDATE  DESC");
		} else {
			$data = $this->db->query("
			SELECT (
				SELECT COUNT(st.TAHUN) AS JMLPST
				FROM tl_individu_standard st
				WHERE st.POLICYNO = tl.POLICYNO
				AND st.BULAN = tl.TEMP_BULAN
				AND st.TAHUN = tl.TEMP_TAHUN
				AND st.ID_CHILD = tl.ID_CHILD
				AND st.IDDIVISION = tl.IDDIVISION
				AND st.IDSUB = tl.IDSUB
				AND st.STATUS = 1)        AS JMLPESERTA_PERDIVISI,
			(
				SELECT COUNT(non.TAHUN) AS COUNTED
				FROM tl_individu_standard non
				WHERE non.POLICYNO = tl.POLICYNO
				AND non.BULAN = tl.TEMP_BULAN
				AND non.TAHUN = tl.TEMP_TAHUN
				AND non.ID_CHILD = tl.ID_CHILD
				AND non.STATUS = 1) AS JMLPESERTA_PUSAT
			,tl.* from tl_invoice_standard tl WHERE MONTH(DUEDATE) = '$cari' AND YEAR(DUEDATE) = '$year' AND ID_CHILD = 27 AND NOINVOICE IS NOT NULL and KOTA IS NOT NULL order by DUEDATE  DESC");
		}
		return $data->result();
	}

	//buat filter all bulan
	public function mlookupfilterallaspur()
	{
		$cari = $this->input->GET('cari', TRUE);
		$year = $this->input->GET('year', TRUE);

		if ($cari == 'all') {

			$data = $this->db->query("
			SELECT
			(
				SELECT COUNT(st.TAHUN) AS JMLPST
				FROM tl_individu_standard st
				WHERE st.POLICYNO = tl.POLICYNO
				AND st.BULAN = tl.TEMP_BULAN
				AND st.TAHUN = tl.TEMP_TAHUN
				AND st.ID_CHILD = tl.ID_CHILD
				AND st.IDDIVISION = tl.IDDIVISION
				AND st.IDSUB = tl.IDSUB
				AND st.STATUS = 1)        AS JMLPESERTA_PERDIVISI,
			(
				SELECT COUNT(non.TAHUN) AS COUNTED
				FROM tl_individu_standard non
				WHERE non.POLICYNO = tl.POLICYNO
				AND non.BULAN = tl.TEMP_BULAN
				AND non.TAHUN = tl.TEMP_TAHUN
				AND non.ID_CHILD = tl.ID_CHILD
				AND non.STATUS = 1) AS JMLPESERTA_PUSAT,
			* from tl_invoice_standard tl where  ID_CHILD = 27 AND NOINVOICE IS NOT NULL AND CURRENCY IS NOT NULL AND PRODUCTNAME IS NOT NULL AND KOTA IS NOT NULL order by DUEDATE DESC");
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
		$data = $this->db->query("
		SELECT
		(
			SELECT COUNT(st.TAHUN) AS JMLPST
			FROM tl_individu_standard st
			WHERE st.POLICYNO = tl.POLICYNO
			AND st.BULAN = tl.TEMP_BULAN
			AND st.TAHUN = tl.TEMP_TAHUN
			AND st.ID_CHILD = tl.ID_CHILD
			AND st.IDDIVISION = tl.IDDIVISION
			AND st.IDSUB = tl.IDSUB
			AND st.STATUS = 1)        AS JMLPESERTA_PERDIVISI,
		(
			SELECT COUNT(non.TAHUN) AS COUNTED
			FROM tl_individu_standard non
			WHERE non.POLICYNO = tl.POLICYNO
			AND non.BULAN = tl.TEMP_BULAN
			AND non.TAHUN = tl.TEMP_TAHUN
			AND non.ID_CHILD = tl.ID_CHILD
			AND non.STATUS = 1) AS JMLPESERTA_PUSAT,
			 * FROM tl_invoice_standard where ID_CHILD = 27 AND CURRENCY IS NOT NULL AND PRODUCTNAME IS NOT NULL AND KOTA IS NOT NULL order by DUEDATE DESC");
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
		$data = $this->db->query("SELECT CREATEDATE, DUEDATE, PAYMENTDATE, TAHUN, BULAN, PARTNERNAME, NMDIVISION, NMSUB, ALAMAT, KOTA, NOINVOICE, POLICYNO, JMLPREMI, JMLPST, TERBILANG, NAME, PREMI, CURRENCY, PRODUCTCODE, PRODUCTNAME, BANKNAME, ACCOUNTNAME, ACCOUNTNUMBER, STATUS, REV FROM aspurjabnew where  BULAN='$bulan' and TAHUN='$tahun' AND id = '$id' GROUP BY NOINVOICE");
		return $data->result();
	}

	public function sumjmlpremias($id, $bulan, $tahun)
	{
		$data = $this->db->query("SELECT sum(premi) as  jml from aspurjabnewx where id = '$id' ");
		return $data->result();
	}

	public function premias($id, $bulan, $tahun)
	{
		$data = $this->db->query("SELECT productname , jmlpst, premi from aspurjabnew where BULAN='$bulan' and TAHUN='$tahun' AND id = '$id'");
		return $data->result();
	}

	public function querywhereasloop($id, $bulan, $tahun)
	{
		$data = $this->db->query("SELECT DISTINCT CREATEDATE, DUEDATE, PAYMENTDATE, TAHUN, BULAN, PARTNERNAME, NMDIVISION, NMSUB, ALAMAT, KOTA, NOINVOICE, POLICYNO, JMLPREMI, JMLPST, TERBILANG, NAME, PREMI, CURRENCY, PRODUCTCODE, PRODUCTNAME, BANKNAME, ACCOUNTNAME, ACCOUNTNUMBER, STATUS, REV FROM aspurjabnewx where BULAN='$bulan' and TAHUN='$tahun' AND id = '$id'  order by DUEDATE ASC");
		return $data->result();
	}

	//	public function get_aspurjab_invoice($id, $bulan, $tahun)
	public function get_aspurjab_invoice($id)
	{
		$data = $this->db->query("SELECT *,
				CASE 
					WHEN (LEN(BULAN) < 2)
 					THEN CONCAT(0,BULAN)
 					ELSE BULAN
				END AS DUEDATEMONTH 
 				FROM tl_invoice_standard where id = '$id' order by DUEDATE DESC");
		return $data->result();
	}

	public function sumpremias($id, $id_child, $id_division, $id_sub, $policyno, $bulan, $tahun)
	{

		if (!is_null($id_division) && !is_null($id_sub)) {
			$data = $this->db->query("SELECT sum(INV.PREMI) as jml 
	        FROM (SELECT DISTINCT NAMA_PESERTA, PREMI FROM tl_individu_standard 
			WHERE
				POLICYNO = '$policyno'
				AND BULAN = '$bulan'
				AND TAHUN = '$tahun'
				AND ID_CHILD = '$id_child'
				AND IDDIVISION = '$id_division'
				AND IDSUB = '$id_sub'
				AND STATUS = 1) INV
			");
		} else {
			$data = $this->db->query("SELECT sum(INV.PREMI) as jml
	        FROM (SELECT DISTINCT NAMA_PESERTA, PREMI FROM tl_individu_standard 
			WHERE
				POLICYNO = '$policyno'
				AND BULAN = '$bulan'
				AND TAHUN = '$tahun'
				AND ID_CHILD = '$id_child'
				AND STATUS = 1) INV
			");
		}

		// nggak bisa di sum jadi bulan sama year nya di remove
		//$data = $this->db->query("SELECT sum(premi) as  jml from aspurjabnew where  id = '$id'  order by `DUEDATE` DESC");
		return $data->result();
	}

	public function terbilongaspur($id, $bulan, $tahun)
	{
		$data = $this->db->query("SELECT sum(premi) as JML, CURRENCY from aspurjabnew where BULAN='$bulan' and TAHUN='$tahun' AND id = '$id' group by CURRENCY");
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
			$this->db->set('PAYMENTDATE', 'GETDATE()', FALSE);
			$this->db->where_in('id', $id);
		} else {
			$this->db->set('STATUS', '1', FALSE);
			$this->db->set('PAYMENTDATE', 'GETDATE()', FALSE);
			$this->db->where('ID', $id);
		}
		$updated = $this->db->update('aspurjabnew');
		return $updated ? true : false;
	}

	public function multiupdatedaspur2($id)
	{
		$dated = date("Y-m-d");
		$duedate = $this->db->query("SELECT DUEDATE FROM tl_invoice_standard where id='$id'")->first_row();

		if (is_array($id)) {
			$this->db->set('STATUS', '1', FALSE);
			$this->db->set('PAYMENTDATE', 'GETDATE()', FALSE);
			$this->db->where_in('id', $id);
		} else {
			$this->db->set('STATUS', '1', FALSE);
			$this->db->set('PAYMENTDATE', 'GETDATE()', FALSE);
			$this->db->where('ID', $id);
		}

		if (empty($duedate->DUEDATE)) {
			$this->db->set('DUEDATE', 'DATE_ADD(GETDATE(), INTERVAL 30 DAY)', FALSE);
		}
		$updated = $this->db->update('tl_invoice_standard');
		return $updated ? true : false;
	}

	public function updateasporcetakpdf($id)
	{
		$status = $this->db->query("SELECT STATUS FROM aspurjabnew where id='$id'")->first_row();

		$this->db->set('PRINTDATE', 'GETDATE()', FALSE);
		if ($status->STATUS == 0) {
			$this->db->set('DUEDATE', "CASE 
			WHEN(DAY(DUEDATE) > 28) 
				THEN DATEADD(month, 1, DATEADD(day, 3, DATEFROMPARTS(YEAR(GETDATE()), MONTH(GETDATE()), DAY(DUEDATE) - 3)))
			ELSE DATEADD(month, 1, DATEFROMPARTS(YEAR(GETDATE()), MONTH(GETDATE()), DAY(DUEDATE)))
			END", FALSE);

			$this->db->set('BULAN', "CASE
			WHEN(LEN(MONTH(GETDATE()) + 1) < 2)
				THEN CONCAT(0,MONTH(GETDATE())+1)
				ELSE MONTH(GETDATE()) + 1
			END", FALSE);

			$this->db->set('TAHUN', "YEAR(GETDATE())", FALSE);
		}
		$this->db->where('ID', $id);
		$updated = $this->db->update('aspurjabnew');
		return $updated ? true : false;
	}

	public function updateasporcetakpdf2($id)
	{
		$status = $this->db->query("SELECT STATUS FROM tl_invoice_standard where id='$id'")->first_row();

		$this->db->set('PRINTDATE', 'GETDATE()', FALSE);
		if ($status->STATUS == 0) {
			$this->db->set('DUEDATE', "CASE 
			WHEN(DAY(DUEDATE) > 28) 
				THEN DATEADD(month, 1, DATEADD(day, 3, DATEFROMPARTS(YEAR(GETDATE()), MONTH(GETDATE()), DAY(DUEDATE) - 3)))
			ELSE DATEADD(month, 1, DATEFROMPARTS(YEAR(GETDATE()), MONTH(GETDATE()), DAY(DUEDATE)))
			END", FALSE);

			$this->db->set('BULAN', "CASE
			WHEN(LEN(MONTH(GETDATE()) + 1) < 2)
				THEN CONCAT(0,MONTH(GETDATE())+1)
				ELSE MONTH(GETDATE()) + 1
			END", FALSE);

			$this->db->set('TAHUN', "YEAR(GETDATE())", FALSE);
		}
		$this->db->where('ID', $id);
		$updated = $this->db->update('tl_invoice_standard');
		return $updated ? true : false;
	}

	// end aspurjab


	// Generate Excel untuk Invoice Standard

	public function get_individu_premi_standard($id_division, $id_sub, $id_child, $policyno, $bulan, $tahun)
	{
		// old
		// $data = $this->db->query(
		// 	"SELECT TAHUN, BULAN, POLICYNO, NOTAS, NAMA_PESERTA, PREMI 
		// 	FROM tl_individu_standard 
		// 	WHERE 
		// 		POLICYNO = '$policyno'
		// 		AND BULAN = '$bulan'
		// 		AND TAHUN = '$tahun'
		// 		AND IDDIVISION = '$id_division'
		// 		AND IDSUB = '$id_sub'
		// 		AND ID_CHILD = '$id_child'
		// 	"
		// );

		$data = $this->db->query(
			"
			SELECT DISTINCT ind.TAHUN,
					ind.BULAN,
					inv.PRODUCTNAME,
					inv.NMDIVISION,
					0 as SAP_NO,
					ind.STATUS,
					inv.NOINVOICE,
					ind.NOTAS,
					ind.NAMA_PESERTA,
					ind.PREMI,
					m.TOTALPREMIUM,
					inv.STATUS,
					ind.MEMBERNO,
					IIF(DA.IDINSTANSI != '' AND DA.IDINSTANSI != 'Tidak ada di Antara', DA.IDINSTANSI,
           M.MEMBERINSTANCYID) AS NIP,
					p.IDCARDNUMBER,
					CAST(M.TMT_MEMBER AS DATE) TMT_MEMBER,
					CAST(M.POLICYENDDATE AS DATE) POLICYENDDATE,
					''                  AS GOLONGAN,
					p.BASICSALARY,
					SUBSTRING(CAST(p.KODEJIWA AS VARCHAR(4)), 2, 1) AS PASANGAN,
					SUBSTRING(CAST(p.KODEJIWA AS VARCHAR(4)), 4, 1) AS ANAK,
					m.SUMASSURED,
					m.PREMIUMRATE,
					m.UPM,
					m.TERM             AS TERM_MONTH,
					m.TERM / 12        AS TERM_YEAR
			FROM tl_individu_standard ind
			INNER JOIN tl_invoice_standard inv
				ON ind.POLICYNO = inv.POLICYNO
					   AND ind.TAHUN = inv.TEMP_TAHUN
					   AND ind.BULAN = inv.TEMP_BULAN
					   AND ind.ID_CHILD = inv.ID_CHILD
					   AND ind.IDDIVISION = inv.IDDIVISION
			           AND ind.IDSUB = inv.IDSUB
			INNER JOIN MEMBER m
				ON m.MEMBERNO = ind.MEMBERNO
			INNER JOIN PERSONAL p
				ON p.PERSONALID = m.PERSONALID
			INNER JOIN DATA_ANTARA DA
				ON DA.MEMBERNO = ind.MEMBERNO
			WHERE
				ind.POLICYNO = '$policyno'
				AND ind.BULAN = '$bulan'
				AND ind.TAHUN = '$tahun'
				AND ind.IDDIVISION = '$id_division'
				AND ind.IDSUB = '$id_sub'
				AND ind.ID_CHILD = '$id_child'
				AND ind.STATUS = 1		   
		  "
		);

		return $data->result();
	}


	public function count_individu_premi_standard($id_division, $id_sub, $id_child, $policyno, $bulan, $tahun)
	{
		$data = $this->db->query(
			"
			SELECT COUNT(TAHUN) AS COUNTED
			FROM tl_individu_standard 
			WHERE 
				POLICYNO = '$policyno'
				AND BULAN = '$bulan'
				AND TAHUN = '$tahun'
				AND IDDIVISION = '$id_division'
				AND IDSUB = '$id_sub'
				AND ID_CHILD = '$id_child'
			"
		);

		return $data->first_row();
	}

	public function count_individu_premi_pusat($id_child, $policyno, $bulan, $tahun)
	{
		$data = $this->db->query(
			"
			SELECT COUNT(TAHUN) AS COUNTED
			FROM tl_individu_standard 
			WHERE
				POLICYNO = '$policyno'
				AND BULAN = '$bulan'
				AND TAHUN = '$tahun'
				AND ID_CHILD = '$id_child'
			"
		);

		return $data->first_row();
	}


	public function get_individu_premi_pusat($id_child, $policyno, $bulan, $tahun)
	{
		$data = $this->db->query(
			"
			SELECT DISTINCT ind.TAHUN,
					ind.BULAN,
					inv.PRODUCTNAME,
					inv.NMDIVISION,
					0 as SAP_NO,
					ind.STATUS,
					inv.NOINVOICE,
					ind.NOTAS,
					ind.NAMA_PESERTA,
					m.TOTALPREMIUM,
					inv.STATUS,
					ind.MEMBERNO,
					IIF(DA.IDINSTANSI != '' AND DA.IDINSTANSI != 'Tidak ada di Antara', DA.IDINSTANSI,
					M.MEMBERINSTANCYID) AS NIP,
					p.IDCARDNUMBER,
					CAST(M.TMT_MEMBER AS DATE) TMT_MEMBER,
					CAST(M.POLICYENDDATE AS DATE) POLICYENDDATE,
					''                  AS GOLONGAN,
					p.BASICSALARY,
					SUBSTRING(CAST(p.KODEJIWA AS VARCHAR(4)), 2, 1) AS PASANGAN,
					SUBSTRING(CAST(p.KODEJIWA AS VARCHAR(4)), 4, 1) AS ANAK,
					m.SUMASSURED,
					m.PREMIUMRATE,
					m.UPM,
					m.TERM             AS TERM_MONTH,
					m.TERM / 12        AS TERM_YEAR
			FROM tl_individu_standard ind
			INNER JOIN tl_invoice_standard inv
				ON ind.POLICYNO = inv.POLICYNO
					   AND ind.TAHUN = inv.TEMP_TAHUN
					   AND ind.BULAN = inv.TEMP_BULAN
					   AND ind.ID_CHILD = inv.ID_CHILD
			INNER JOIN MEMBER m
				ON m.MEMBERNO = ind.MEMBERNO
			INNER JOIN PERSONAL p
				ON p.PERSONALID = m.PERSONALID
			INNER JOIN DATA_ANTARA DA
				ON DA.MEMBERNO = ind.MEMBERNO
			WHERE
				ind.POLICYNO = '$policyno'
				AND ind.BULAN = '$bulan'
				AND ind.TAHUN = '$tahun'
				AND ind.ID_CHILD = '$id_child'
				AND ind.STATUS = 1
				"
		);

		return $data->result();
	}
}
