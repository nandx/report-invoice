CREATE TABLE tl_invoice_standard
(
    ID            bigint IDENTITY (1,1) primary key,
    ID_CHILD      int,
    IDDIVISION    int,
    IDSUB         int,
    SPANO         varchar(255),
    CREATEDATE    date,
    DUEDATE       date,
    PAYMENTDATE   date,
    PRINTDATE     date,
    TAHUN         varchar(5),
    TEMP_TAHUN    varchar(5),
    TEMP_BULAN    varchar(2),
    BULAN         varchar(2),
    PARTNERNAME   varchar(255),
    NMDIVISION    varchar(255),
    NMSUB         varchar(255),
    ALAMAT        varchar(255),
    KOTA          varchar(255),
    NOINVOICE     varchar(255),
    POLICYNO      varchar(255),
    JMLPST        int,
    JMLPREMI      bigint,
    TERBILANG     varchar(255),
    CURRENCY      varchar(20),
    PRODUCTCODE   varchar(20),
    PRODUCTNAME   varchar(255),
    BANKNAME      varchar(50),
    ACCOUNTNAME   varchar(50),
    ACCOUNTNUMBER varchar(50),
    STATUS        bit default 0,
    REV           int default 0
);

INSERT INTO tl_invoice_standard (id_child, iddivision, idsub, spano, createdate, duedate, paymentdate, printdate, tahun,
                                 temp_tahun, temp_bulan, bulan, partnername, nmdivision, nmsub, alamat, kota, noinvoice,
                                 policyno, jmlpst, jmlpremi, terbilang, currency, productcode, productname, bankname,
                                 accountname, accountnumber)
SELECT DISTINCT INV.ID_CHILD,
                INV.IDDIVISION,
                INV.IDSUB,
                INV.SPANO,
                CAST(INV.CREATE_AT AS DATE) AS CREATEDATE,
                CASE
                    WHEN (DAY(PM.SPABEGDATE) > 28) THEN
                        DATEADD(month, 1, DATEADD(day, 3, DATEFROMPARTS(INV.TAHUN, INV.BULAN, DAY(PM.SPABEGDATE) - 3)))
                    ELSE DATEADD(month, 1, DATEFROMPARTS(INV.TAHUN, INV.BULAN, DAY(PM.SPABEGDATE)))
                    END                     AS DUEDATE,
                NULL                        AS PAYMENTDATE,
                NULL                        AS PRINTDATE,
                INV.TAHUN,
                INV.TAHUN,
                INV.BULAN,
                INV.BULAN,
                PART.PARTNERNAME,
                INV.NMDIVISION,
                INV.NMSUB,
                INV.ALAMAT,
                INV.KOTA,
                INV.NOINVOICE,
                INV.POLICYNO,
                INV.JMLPST,
                INV.JMLPREMI,
                INV.TERBILANG,
                PM.CURRENCY,
                PG.PRODUCTCODE,
                PG.PRODUCTNAME,
                BM.BANKNAME,
                BM.ACCOUNTNAME,
                BM.ACCOUNTNUMBER
FROM INVOICE INV
         INNER JOIN POLICYMASTER PM ON PM.SPANO = INV.SPANO
         INNER JOIN PARTNER PART ON PM.IDPARTNER = PART.ID
         INNER JOIN BANKMASTER BM ON BM.BANKID = PM.BANKID
         INNER JOIN PRODUCTGROUPS PG ON PG.IDPRODUCT = INV.ID_CHILD
WHERE PM.SPABEGDATE IS NOT NULL;