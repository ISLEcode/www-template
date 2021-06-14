SELECT
  NoDonneesBancaire,
  NoEntreprise,
  NoContact,
  DBA_NoCompteCCP as NoCompte,
  DBA_NoIban as NoIban,
  DBA_NoCompte as NoCompteCompta,
  DBA_CodeCategorieTVA as CodeCategorieTVA,
  DBA_DelaiPaiement as DelaiPaiement,
  ifnulL(DBA_NoReference,'') as NoReference,
  CASE WHEN ifnull(ENT_RaisonSociale,'') = ''
    THEN
      CASE WHEN ifnull(CNT_Prenom,'') = ''
          THEN CNT_Nom
          ELSE
        CASE WHEN ifnull(CNT_Nom,'') = ''
                THEN CNT_Prenom
                ELSE CONCAT(CONCAT(CNT_Prenom, ' '), CNT_Nom)
                END
          END
        ELSE
      ENT_RaisonSociale
    END as NomFournisseur,
    (SELECT CASE WHEN COUNT(*)
 > 0 THEN 1 ELSE 0 END FROM donneesbancairecompte WHERE NoDonneesBancaire = DBC_NoDonneesBancaire) as HasManyAccounts,
    CASE WHEN length(DBA_NoCompteCCP) > 9 THEN 1 ELSE 0 END as HasDataBeforeQR
FROM donneesbancaire
     INNER JOIN entreprise ON NoEntreprise = DBA_NoEntreprise
     INNER JOIN contact ON NoContact = DBA_NoContact
     INNER JOIN gestionentreprise ON GEN_NoEntreprise = NoEntreprise AND GEN_NoContact = NoContact
#WHERE NoEntreprise = 34 AND NoContact = 40
ORDER BY DBA_NoCompteCCP
