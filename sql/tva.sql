SELECT NoGestionTVA as id, GTV_CodeTVA as name, GTV_TauxTVA as rate, GTV_TauxTVAForfait as flat_rate, GTV_DateDebut as since
FROM gestiontva WHERE
CURDATE() BETWEEN GTV_DateDebut AND CASE WHEN ifnull(GTV_DateFin,0) = 0 THEN 99991231 ELSE GTV_DateDebut END
