
DROP VIEW IF EXISTS vw_conciergeInteractions_base;
CREATE VIEW vw_conciergeInteractions_base AS
SELECT
    ci.interactionID,
    ci.interactionUUID,
    ci.shipCode,
    ci.operCode,
    ci.langCode,
    ci.interactionDateTime,
    DATE(ci.interactionDateTime)       AS interactionDate,
    TIME(ci.interactionDateTime)       AS interactionTime,
    ci.interactionOption,
    ci.created_at,
    ci.created_by,
    ci.updated_at,
    ci.updated_by,
    ci.deleted_at,
    ci.deleted_by,
    CASE
        WHEN HOUR(ci.interactionDateTime) BETWEEN 0 AND 5  THEN 'Madrugada'
        WHEN HOUR(ci.interactionDateTime) BETWEEN 6 AND 11 THEN 'Manhã'
        WHEN HOUR(ci.interactionDateTime) BETWEEN 12 AND 17 THEN 'Tarde'
        WHEN HOUR(ci.interactionDateTime) BETWEEN 18 AND 23 THEN 'Noite'
        ELSE 'Desconhecido'
    END AS turno
FROM conciergeInteractions ci
WHERE ci.deleted_at IS NULL;