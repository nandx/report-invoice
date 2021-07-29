CREATE OR ALTER
    TRIGGER dbo.TR_Member_OnChangedUpdateIndividuStatus
    ON MEMBER
    AFTER
        INSERT,
    UPDATE,
    DELETE AS
BEGIN
    SET NOCOUNT ON
    --Determine if this is an INSERT,UPDATE, or DELETE Action or a "failed delete".
    DECLARE @Action as char(1)
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
        )

    IF @Action IS NOT NULL
        BEGIN
            IF @Action = 'D'
                BEGIN
                    UPDATE t
                    SET t.STATUS = (CASE WHEN m.ACTIVEF = 4 THEN 1 ELSE 0 END),
                    t.IDSUB = m.IDSUB,
                    t.IDDIVISION = m.IDDIVISION
                    FROM dbo.tl_individu_standard t
                             INNER JOIN DELETED d on t.MEMBERNO = d.MEMBERNO
                             INNER JOIN dbo.MEMBER m ON d.MEMBERNO = m.MEMBERNO
                    WHERE m.ACTIVEF != 4
                END
            ELSE
                BEGIN
                    IF @Action = 'U'
                        BEGIN
                            UPDATE t
                            SET t.status = (CASE WHEN m.ACTIVEF = 4 THEN 1 ELSE 0 END),
                            t.IDSUB = m.IDSUB,
                            t.IDDIVISION = m.IDDIVISION
                            FROM dbo.tl_individu_standard t
                                     INNER JOIN INSERTED i on t.memberno = i.memberno
                                     INNER JOIN DELETED d on i.memberno = d.memberno
                                     INNER JOIN dbo.MEMBER m ON i.memberno = m.memberno
                        END
                    ELSE
                        BEGIN
                            UPDATE t
                            SET status = (CASE WHEN m.ACTIVEF = 4 THEN 1 ELSE 0 END),
                            t.IDSUB = m.IDSUB,
                             t.IDDIVISION = m.IDDIVISION
                            FROM dbo.tl_individu_standard t
                                     INNER JOIN INSERTED i on t.memberno = i.memberno
                                     INNER JOIN dbo.MEMBER m ON i.memberno = m.memberno
                        END
                END
        END
END
go
