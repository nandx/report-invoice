CREATE TABLE tl_individu_standard
(
    ID           bigint IDENTITY (1,1) primary key,
    IDDIVISION   int,
    IDSUB        int,
    ID_CHILD     int,
    TAHUN        varchar(255),
    BULAN        varchar(255),
    POLICYNO     varchar(255),
    NOTAS        varchar(255),
    SPANO        varchar(255),
    MEMBERNO     bigint,
    NAMA_PESERTA varchar(255),
    PREMI        bigint,
    STATUS       bit default 1
);

insert into tl_individu_standard (iddivision, idsub, id_child, tahun, bulan, policyno, notas, spano, memberno,
                                  nama_peserta,
                                  premi)
SELECT IP.IDDIVISION,
       IP.IDSUB,
       IP.ID_CHILD,
       IP.TAHUN,
       IP.BULAN,
       PM.POLICYNO,
       M.MEMBERINSTANCYID AS NOTAS,
       M.SPANO,
       M.MEMBERNO,
       PER.NAME           AS NAMA_PESERTA,
       IP.PREMI
FROM INDIVIDU_PREMI IP
         INNER JOIN PERSONAL PER ON PER.PERSONALID = IP.PERSONALID
         INNER JOIN MEMBER M ON M.PERSONALID = IP.PERSONALID
         INNER JOIN POLICYMASTER PM ON PM.SPANO = IP.SPANO