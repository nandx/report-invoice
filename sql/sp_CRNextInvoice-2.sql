CREATE OR
ALTER
    PROCEDURE sp_CRNextInvoice
AS
BEGIN

    DECLARE @THN INT, @BLN INT, @NOURUT INT, @GENERATEDATE DATE;

    SET @GENERATEDATE = GETDATE();
    --SET @GENERATEDATE = DATEFROMPARTS(2021, 6, 1);
    SET @THN = YEAR(@GENERATEDATE);
    SET @BLN = MONTH(@GENERATEDATE) + 1;
    SET @NOURUT = (SELECT noinvoice FROM tbl_params);

    INSERT INTO tl_individu_standard (iddivision, idsub, id_child, tahun, bulan, policyno, notas, memberno,
                                      nama_peserta, premi)
    SELECT DISTINCT IDDIVISION,
                    IDSUB,
                    ID_CHILD,
                    TAHUN,
                    BULAN,
                    POLICYNO,
                    NOTAS,
                    MEMBERNO,
                    NAMA_PESERTA,
                    PREMI
    FROM (
             SELECT DISTINCT IIF(((@BLN - MONTH(SPABEGDATE)) > 0), ((@BLN - MONTH(SPABEGDATE)) % PAYMODE.MODE),
                                 ((@BLN + 12 - MONTH(SPABEGDATE)) % PAYMODE.MODE)) AS PAYMENT_VALIDATOR,
                             @THN                                                  AS TAHUN,
                             @BLN                                                  AS BULAN,
                             PM.SPANO,
                             PTX.ID_CHILD,
                             M.MEMBERNO,
                             PER.PERSONALID,
                             M.KDPANGKAT,
                             PER.BASICSALARY                                       AS GAPOK,
                             PER.KODEJIWA,
                             PER.NAME                                              AS NAMA_PESERTA,
                             RIGHT(LEFT(PER.KODEJIWA, 2), 1) AS JISTRI,
                             RIGHT(PER.KODEJIWA, 1)          AS JANAK,
                             M.TOTALPREMIUM                  AS THP,
                             M.TOTALPREMIUM                  AS PREMI,
                             m.IDSUB                         AS IDSUB,
                             M.IDDIVISION                    AS IDDIVISION,
                             per.IDSUB                       AS PERSUB,
                             GETDATE()                       AS TGLCREATE,
                             PAYMODE.MODE,
                             PM.POLICYNO,
                             M.MEMBERINSTANCYID              AS NOTAS
             FROM MEMBER M
                      INNER JOIN POLICYMASTER PM ON PM.SPANO = M.SPANO
                      INNER JOIN PERSONAL PER ON PER.PERSONALID = M.PERSONALID
                      LEFT JOIN PROPOSITION_TRX PTX ON PTX.ID_PARENT = PM.IDPACKET
                      INNER JOIN FORMULAPREMI FP ON FP.SPANO = M.SPANO and FP.ID_CHILD = PTX.ID_CHILD
                      INNER JOIN PARTNER PART ON PART.ID = FP.IDPARTNER
                      INNER JOIN PAYMENTMODE PAYMODE ON PAYMODE.IDPAYMENTMODE = PM.PAYMENTMETHOD
                      LEFT JOIN tl_individu_standard tis ON
                     tis.MEMBERNO = M.MEMBERNO
                     AND tis.BULAN = @BLN
                     AND tis.TAHUN = @THN
                     AND tis.ID_CHILD = PTX.ID_CHILD

             WHERE M.ACTIVEF = 4
               AND PAYMODE.MODE <> 0
               AND tis.ID IS NULL
         ) NEXT_INDIVIDU
    WHERE NEXT_INDIVIDU.PAYMENT_VALIDATOR = 0;

    INSERT INTO tl_invoice_standard (id_child,
                                     iddivision,
                                     idsub,
                                     spano,
                                     createdate,
                                     duedate,
                                     paymentdate,
                                     printdate,
                                     tahun,
                                     temp_tahun,
                                     temp_bulan,
                                     bulan,
                                     partnername,
                                     nmdivision,
                                     nmsub,
                                     alamat,
                                     kota,
                                     noinvoice,
                                     policyno,
                                     jmlpst,
                                     jmlpremi,
                                     terbilang,
                                     currency,
                                     productcode,
                                     productname,
                                     bankname,
                                     accountname,
                                     accountnumber)
    SELECT ID_CHILD,
           IDDIVISION,
           IDSUB,
           SPANO,
           CREATEDATE,
           DUEDATE,
           PAYMENTDATE,
           PRINTDATE,
           TAHUN,
           TAHUN,
           BULAN,
           BULAN,
           PARTNERNAME,
           NMDIVISION,
           NMSUB,
           ALAMAT,
           KOTA,
           NOINVOICE,
           POLICYNO,
           JMLPST,
           JMLPREMI,
           TERBILANG,
           CURRENCY,
           PRODUCTCODE,
           PRODUCTNAME,
           BANKNAME,
           ACCOUNTNAME,
           ACCOUNTNUMBER
    FROM (
             SELECT IIF(((month(@GENERATEDATE) - MONTH(SPABEGDATE)) > 0),
                        ((MONTH(@GENERATEDATE) - MONTH(SPABEGDATE)) % PAYMODE.MODE),
                        ((MONTH(@GENERATEDATE) + 12 - MONTH(SPABEGDATE)) % PAYMODE.MODE)) AS PAYMENT_VALIDATOR,
                    IIF(PTX.ID_CHILD = 7, DATEFROMPARTS(@THN, @BLN, 15),
                        IIF((DAY(PM.SPABEGDATE) > 28),
                            (DATEADD(day, 3, DATEFROMPARTS(@THN, @BLN, DAY(PM.SPABEGDATE) - 3))),
                            (DATEFROMPARTS(@THN, @BLN, DAY(PM.SPABEGDATE)))))             AS DUEDATE,
                    GETDATE()                                                             AS CREATEDATE,
                    @THN                                                                  AS TAHUN,
                    @BLN                                                                  AS BULAN,
                    PM.SPANO,
                    NULL                                                                  AS PAYMENTDATE,
                    NULL                                                                  AS PRINTDATE,
                    PTX.ID_CHILD,
                    count(M.MEMBERNO)                                         AS JMLPST,
                    SUM(M.TOTALPREMIUM)                                       AS JMLPREMI,
                    PAYMODE.MODE,
                    dbo.terbilang(SUM(M.TOTALPREMIUM))                        as terbilang,
                    PART.PARTNERNAME                                          AS PARTNERNAME,
                    GU.NMDIVISION                                             AS NMDIVISION,
                    GU.NMSUB                                                  AS NMSUB,
                    GU.ALAMAT,
                    GU.KOTA                                                   AS KOTA,
                    PM.POLICYNO,
                    NULL                                                      AS NOINVOICE,
                    GU.ID                                                     AS IDSUB,
                    GU.IDDIVISION                                             AS IDDIVISION,
                    PG.PRODUCTNAME,
                    PM.CURRENCY,
                    PG.PRODUCTCODE,
                    BM.BANKNAME,
                    BM.ACCOUNTNAME,
                    BM.ACCOUNTNUMBER
             FROM MEMBER M
                      INNER JOIN POLICYMASTER PM
                                 ON PM.SPANO = M.SPANO
                      INNER JOIN PROPOSITION_TRX PTX ON PTX.ID_PARENT = PM.IDPACKET
                      INNER JOIN FORMULAPREMI FP ON FP.SPANO = M.SPANO and FP.ID_CHILD = PTX.ID_CHILD
                      INNER JOIN PARTNER PART ON PART.ID = FP.IDPARTNER
                      INNER JOIN GROUPUNIT GU ON GU.ID = M.IDSUB
                      INNER JOIN PAYMENTMODE PAYMODE ON PAYMODE.IDPAYMENTMODE = PM.PAYMENTMETHOD
                      INNER JOIN PRODUCTGROUPS PG ON PG.IDPRODUCT = PTX.ID_CHILD
                      INNER JOIN BANKMASTER BM ON BM.BANKID = PM.BANKID
                      LEFT JOIN tl_invoice_standard tis ON
                     tis.POLICYNO = PM.POLICYNO
                     AND tis.BULAN = @BLN
                     AND tis.TAHUN = @THN
                     AND tis.PARTNERNAME = PART.PARTNERNAME
                     AND tis.NMDIVISION = GU.NMDIVISION
                     AND tis.NMSUB = GU.NMSUB

             WHERE M.ACTIVEF = 4
               AND PAYMODE.MODE <> 0
               AND tis.ID IS NULL
             GROUP BY PM.SPABEGDATE, PAYMODE.MODE, PM.SPANO, PTX.ID_CHILD,
                      PART.PARTNERNAME, GU.NMDIVISION, GU.NMSUB, GU.ALAMAT,
                      GU.KOTA, PM.POLICYNO, GU.ID, GU.IDDIVISION,
                      PG.PRODUCTNAME, PM.CURRENCY, PG.PRODUCTCODE, BM.BANKNAME,
                      BM.ACCOUNTNAME, BM.ACCOUNTNUMBER) NEXT_INVOICE
    WHERE NEXT_INVOICE.PAYMENT_VALIDATOR = 0
      AND JMLPREMI > 0;

    UPDATE tl_invoice_standard
    SET NOINVOICE = IIF(LEN(BULAN) < 2, CONCAT(@NOURUT + ID, '/', PRODUCTCODE, '/', CONCAT(0, BULAN), '/',
                                               TAHUN), CONCAT(@NOURUT + ID, '/', PRODUCTCODE, '/', BULAN, '/', TAHUN))
    WHERE NOINVOICE IS NULL;
END;
go

-- Cara Execute
-- EXEC sp_CRNextInvoice