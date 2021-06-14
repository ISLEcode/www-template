SELECT
  NoPlanComptable AS id,
  PCO_NoCompte AS account,
  PCO_CompteLibelle AS label,
  PCO_CompteType  AS kind
FROM plancomptable
WHERE PCO_NoCompte > 999;
