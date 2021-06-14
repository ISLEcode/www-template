
SELECT 
  ROUND([supplier].[amount] * 100/(100+GTV_TauxTVA),2),
  [supplier].[amount]-ROUND(107.7 * 100/(100+GTV_TauxTVA),2)
  INTO [montant-ht], [montant-tva]
FROM gestiontva
WHERE GTV_CodeCategorieTVA = 'A'
  AND [supplier].[bill-date] BETWEEN GTV_DateDebut AND CASE WHEN ifnull(GTV_DateFin,0) = 0 THEN 99991231 ELSE GTV_DateDebut END;


INSERT INTO bvr
(
BVR_Type,
BVR_Date,
BVR_DelaiPaiement,
BVR_DateEcheance,
BVR_MontantHT,
BVR_MontantTTC,
BVR_MontantOriginal,
BVR_TVAMontant,
BVR_TVATaux,
BVR_CodeCategorieTVA,
BVR_NoMonnaie,
BVR_NoCompte,
BV_NoCompteCCP,
BVR_NoCompteBanque,
BVR_NoRef,
BVR_Code,
BVR_Motif,
BVR_EnfaveurdeCahmp1,
BVR_NoEntreprise,
BVR_NoContact,
BVR_NoProjet,
BVR_NoDocument,
BVR_EnFaveurDeChamp2,
BVR_EnFaveurDeChamp3,
BVR_EnFaveurDeChamp4,
BVR_EnFaveurDeChamp5,
BVR_EnFaveurDeChamp6,
BVR_VersementPourChamp1,
BVR_VersementPourChamp2,
BVR_VersementPourChamp3,
BVR_VersementPourChamp4,
BVR_NoIBAN,
BVR_NoClearing,
BVR_QRJson
)
VALUES
(
'QR',
[supplier].[bill-date],
[supplier].[delay],
[supplier].[deadline],
[montant-ht],
[supplier].[amount],
[montant-tva],
[supplier].[amount],
7.6,
(SELECT NoMonnaie WHERE MON_LibelleCourt = [supplier].[currency]),
[supplier].[account-id],
RIGHT([supplier].[iban], 10),
[supplier].[reference],
'',
[supplier].[message],
RIGHT([supplier].[iban], 10),
[supplier].[organisation-id],
[supplier].[contact-id],
[supplier].[project-id],
[supplier].[bill-info],
[supplier].[debtor-name],
[supplier].[debtor-address1],
[supplier].[debtor-address2],
[supplier].[debtor-postcode], 
[supplier].[debtor-locality],
[supplier].[creditor-name],
[supplier].[creditor-address1],
[supplier].[creditor-postcode],
[supplier].[creditor-locality],
[supplier].[iban],
TRIM(LEADING '0' FROM SUBSTRING([supplier].[iban], 5, 9)),
[supplier].[qrcode-raw]
);




