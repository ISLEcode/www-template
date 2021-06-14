SELECT NoProjet          AS id,
 PRO_LibelleCourt        AS label,
 PRO_DateDebut           AS start_date,
 PRO_DateFin             AS end_date,
 PRO_BForfait            AS fixed_price,
 PRO_BTVAIncluse         AS vatincluded,
 PRO_BDecompteCalendrier AS countdown,
 PRO_NoDelaiLivraison    AS schedule,
 PRO_NoConditionPaiement AS payment,
 PRO_GestionComptable    AS accounting,
 PRO_Compte              AS account,
 PRO_Commentaire         AS comment
FROM projet
WHERE PRO_Deleted = 1 AND PRO_LibelleCourt <> '' AND PRO_NonFacturable = 0
AND CURDATE() BETWEEN PRO_DateDebut AND CASE WHEN IFNULL(PRO_DateFin,0) = 0 THEN 99991231 ELSE PRO_DateDebut END
