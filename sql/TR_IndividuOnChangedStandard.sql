CREATE
    OR ALTER TRIGGER dbo.TR_Individu_OnChangedUpdateInvoice
    ON tl_individu_standard
    AFTER
        INSERT,
    UPDATE,
    DELETE AS
BEGIN
    SET NOCOUNT ON;
    --Determine if this is an INSERT,UPDATE, or DELETE Action or a "failed delete".
    DECLARE @Action as char(1);
    SET @Action = (
        CASE
            WHEN EXISTS(
                         SELECT *
                         FROM INSERTED
                     )
                AND EXISTS(
                         SELECT *
                         FROM DELETED
                     ) THEN 'U' -- Set Action to Updated.
            WHEN EXISTS(
                    SELECT *
                    FROM INSERTED
                ) THEN 'I' -- Set Action to Insert.
            WHEN EXISTS(
                    SELECT *
                    FROM DELETED
                ) THEN 'D' -- Set Action to Deleted.
            ELSE NULL -- Skip. It may have been a "failed delete".
            END
        );

    DECLARE @ID_CHILD_D as int, @ID_CHILD_I as int;
    SET @ID_CHILD_D = (SELECT TOP 1 ID_CHILD FROM DELETED);
    SET @ID_CHILD_I = (SELECT TOP 1 ID_CHILD FROM INSERTED);

    IF @Action IS NOT NULL
        BEGIN
            IF @Action = 'D' AND @ID_CHILD_D != 27
                BEGIN
                    UPDATE inv
                    SET inv.REV       = inv.REV + 1,
                        inv.JMLPST    = (SELECT COUNT(ind.TAHUN)
                                         FROM tl_individu_standard ind
                                         WHERE ind.POLICYNO = inv.POLICYNO
                                           AND ind.TAHUN = inv.TEMP_TAHUN
                                           AND ind.BULAN = inv.TEMP_BULAN
                                           AND ind.ID_CHILD = inv.ID_CHILD
                                           AND ind.IDDIVISION = inv.IDDIVISION
                                           AND ind.IDSUB = inv.IDSUB
                                           AND ind.STATUS = 1),
                        inv.JMLPREMI  = (SELECT SUM(ind.PREMI)
                                         FROM tl_individu_standard ind
                                         WHERE ind.POLICYNO = inv.POLICYNO
                                           AND ind.TAHUN = inv.TEMP_TAHUN
                                           AND ind.BULAN = inv.TEMP_BULAN
                                           AND ind.ID_CHILD = inv.ID_CHILD
                                           AND ind.IDDIVISION = inv.IDDIVISION
                                           AND ind.IDSUB = inv.IDSUB
                                           AND ind.STATUS = 1),
                        inv.terbilang = (SELECT dbo.terbilang(SUM(ind.PREMI))
                                         FROM tl_individu_standard ind
                                         WHERE ind.POLICYNO = inv.POLICYNO
                                           AND ind.TAHUN = inv.TEMP_TAHUN
                                           AND ind.BULAN = inv.TEMP_BULAN
                                           AND ind.ID_CHILD = inv.ID_CHILD
                                           AND ind.IDDIVISION = inv.IDDIVISION
                                           AND ind.IDSUB = inv.IDSUB
                                           AND ind.STATUS = 1)
                    FROM dbo.tl_invoice_standard inv
                             INNER JOIN DELETED d
                                        ON inv.POLICYNO = d.POLICYNO
                                            AND inv.TEMP_TAHUN = d.TAHUN
                                            AND inv.TEMP_BULAN = d.BULAN
                                            AND inv.ID_CHILD = d.ID_CHILD
                                            AND inv.IDDIVISION = d.IDDIVISION
                                            AND inv.IDSUB = d.IDSUB
                END;
            ELSE
                BEGIN
                    IF @Action = 'U' AND @ID_CHILD_D != 27
                        BEGIN
                            UPDATE inv
                            SET inv.REV       = inv.REV + 1,
                                inv.JMLPST    = (SELECT COUNT(ind.TAHUN)
                                                 FROM tl_individu_standard ind
                                                 WHERE ind.POLICYNO = inv.POLICYNO
                                                   AND ind.TAHUN = inv.TEMP_TAHUN
                                                   AND ind.BULAN = inv.TEMP_BULAN
                                                   AND ind.ID_CHILD = inv.ID_CHILD
                                                   AND ind.IDDIVISION = inv.IDDIVISION
                                                   AND ind.IDSUB = inv.IDSUB
                                                   AND ind.STATUS = 1),
                                inv.JMLPREMI  = (SELECT SUM(ind.PREMI)
                                                 FROM tl_individu_standard ind
                                                 WHERE ind.POLICYNO = inv.POLICYNO
                                                   AND ind.TAHUN = inv.TEMP_TAHUN
                                                   AND ind.BULAN = inv.TEMP_BULAN
                                                   AND ind.ID_CHILD = inv.ID_CHILD
                                                   AND ind.IDDIVISION = inv.IDDIVISION
                                                   AND ind.IDSUB = inv.IDSUB
                                                   AND ind.STATUS = 1),
                                inv.terbilang = (SELECT dbo.terbilang(SUM(ind.PREMI))
                                                 FROM tl_individu_standard ind
                                                 WHERE ind.POLICYNO = inv.POLICYNO
                                                   AND ind.TAHUN = inv.TEMP_TAHUN
                                                   AND ind.BULAN = inv.TEMP_BULAN
                                                   AND ind.ID_CHILD = inv.ID_CHILD
                                                   AND ind.IDDIVISION = inv.IDDIVISION
                                                   AND ind.IDSUB = inv.IDSUB
                                                   AND ind.STATUS = 1)
                            FROM dbo.tl_invoice_standard inv
                                     INNER JOIN DELETED d
                                                ON inv.POLICYNO = d.POLICYNO
                                                    AND inv.TEMP_TAHUN = d.TAHUN
                                                    AND inv.TEMP_BULAN = d.BULAN
                                                    AND inv.ID_CHILD = d.ID_CHILD
                                                    AND inv.IDDIVISION = d.IDDIVISION
                                                    AND inv.IDSUB = d.IDSUB
                                     JOIN tl_individu_standard ind ON ind.POLICYNO = d.POLICYNO
                                AND ind.TAHUN = d.TAHUN
                                AND ind.BULAN = d.BULAN
                                AND ind.ID_CHILD = d.ID_CHILD
                                AND ind.IDDIVISION = d.IDDIVISION
                                AND ind.IDSUB = d.IDSUB;

                            UPDATE inv
                            SET inv.REV       = inv.REV + 1,
                                inv.JMLPST    = (SELECT COUNT(ind.TAHUN)
                                                 FROM tl_individu_standard ind
                                                 WHERE ind.POLICYNO = inv.POLICYNO
                                                   AND ind.TAHUN = inv.TEMP_TAHUN
                                                   AND ind.BULAN = inv.TEMP_BULAN
                                                   AND ind.ID_CHILD = inv.ID_CHILD
                                                   AND ind.IDDIVISION = inv.IDDIVISION
                                                   AND ind.IDSUB = inv.IDSUB
                                                   AND ind.STATUS = 1),
                                inv.JMLPREMI  = (SELECT SUM(ind.PREMI)
                                                 FROM tl_individu_standard ind
                                                 WHERE ind.POLICYNO = inv.POLICYNO
                                                   AND ind.TAHUN = inv.TEMP_TAHUN
                                                   AND ind.BULAN = inv.TEMP_BULAN
                                                   AND ind.ID_CHILD = inv.ID_CHILD
                                                   AND ind.IDDIVISION = inv.IDDIVISION
                                                   AND ind.IDSUB = inv.IDSUB
                                                   AND ind.STATUS = 1),
                                inv.terbilang = (SELECT dbo.terbilang(SUM(ind.PREMI))
                                                 FROM tl_individu_standard ind
                                                 WHERE ind.POLICYNO = inv.POLICYNO
                                                   AND ind.TAHUN = inv.TEMP_TAHUN
                                                   AND ind.BULAN = inv.TEMP_BULAN
                                                   AND ind.ID_CHILD = inv.ID_CHILD
                                                   AND ind.IDDIVISION = inv.IDDIVISION
                                                   AND ind.IDSUB = inv.IDSUB
                                                   AND ind.STATUS = 1)
                            FROM dbo.tl_invoice_standard inv
                                     INNER JOIN INSERTED i
                                                ON inv.POLICYNO = i.POLICYNO
                                                    AND inv.TEMP_TAHUN = i.TAHUN
                                                    AND inv.TEMP_BULAN = i.BULAN
                                                    AND inv.ID_CHILD = i.ID_CHILD
                                                    AND inv.IDDIVISION = i.IDDIVISION
                                                    AND inv.IDSUB = i.IDSUB
                                     JOIN tl_individu_standard ind ON ind.POLICYNO = i.POLICYNO
                                AND ind.TAHUN = i.TAHUN
                                AND ind.BULAN = i.BULAN
                                AND ind.ID_CHILD = i.ID_CHILD
                                AND ind.IDDIVISION = i.IDDIVISION
                                AND ind.IDSUB = i.IDSUB;
                        END;
                    ELSE
                        BEGIN
                            IF @ID_CHILD_D != 27
                                BEGIN
                                    UPDATE inv
                                    SET inv.REV       = inv.REV + 1,
                                        inv.JMLPST    = (SELECT COUNT(ind.TAHUN)
                                                         FROM tl_individu_standard ind
                                                         WHERE ind.POLICYNO = inv.POLICYNO
                                                           AND ind.TAHUN = inv.TEMP_TAHUN
                                                           AND ind.BULAN = inv.TEMP_BULAN
                                                           AND ind.ID_CHILD = inv.ID_CHILD
                                                           AND ind.IDDIVISION = inv.IDDIVISION
                                                           AND ind.IDSUB = inv.IDSUB
                                                           AND ind.STATUS = 1),
                                        inv.JMLPREMI  = (SELECT SUM(ind.PREMI)
                                                         FROM tl_individu_standard ind
                                                         WHERE ind.POLICYNO = inv.POLICYNO
                                                           AND ind.TAHUN = inv.TEMP_TAHUN
                                                           AND ind.BULAN = inv.TEMP_BULAN
                                                           AND ind.ID_CHILD = inv.ID_CHILD
                                                           AND ind.IDDIVISION = inv.IDDIVISION
                                                           AND ind.IDSUB = inv.IDSUB
                                                           AND ind.STATUS = 1),
                                        inv.terbilang = (SELECT dbo.terbilang(SUM(ind.PREMI))
                                                         FROM tl_individu_standard ind
                                                         WHERE ind.POLICYNO = inv.POLICYNO
                                                           AND ind.TAHUN = inv.TEMP_TAHUN
                                                           AND ind.BULAN = inv.TEMP_BULAN
                                                           AND ind.ID_CHILD = inv.ID_CHILD
                                                           AND ind.IDDIVISION = inv.IDDIVISION
                                                           AND ind.IDSUB = inv.IDSUB
                                                           AND ind.STATUS = 1)
                                    FROM dbo.tl_invoice_standard inv
                                             INNER JOIN INSERTED d
                                                        ON inv.POLICYNO = d.POLICYNO
                                                            AND inv.TEMP_TAHUN = d.TAHUN
                                                            AND inv.TEMP_BULAN = d.BULAN
                                                            AND inv.ID_CHILD = d.ID_CHILD
                                                            AND inv.IDDIVISION = d.IDDIVISION
                                                            AND inv.IDSUB = d.IDSUB
                                             JOIN tl_individu_standard ind ON ind.POLICYNO = d.POLICYNO
                                        AND ind.TAHUN = d.TAHUN
                                        AND ind.BULAN = d.BULAN
                                        AND ind.ID_CHILD = d.ID_CHILD
                                        AND ind.IDDIVISION = d.IDDIVISION
                                        AND ind.IDSUB = d.IDSUB;
                                END
                        END
                END
        END
END;