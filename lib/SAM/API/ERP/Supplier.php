<?php namespace SAM\API\ERP;

use \SAM\API\Entity;

class Supplier extends \SAM\API\Entity {

    public function __construct ($db, $verb = null) {

        parent::__construct ($db, $verb);

        $this->map = [ 'getall' => "
        SELECT
            NoDonneesBancaire as id,
            NoEntreprise as organisation_id,
            NoContact as contact_id,
            CASE
            WHEN ifnull(ENT_RaisonSociale,'') = ''
            THEN CASE
                 WHEN ifnull(CNT_Prenom,'') = ''
                 THEN CASE
                      WHEN ifnull(DBA_MotCle,'') = ''
                      THEN CNT_Nom
                      ELSE CONCAT(CONCAT(CNT_Nom, ' '), DBA_MotCle)
                      END
                 ELSE CASE
                      WHEN ifnull(CNT_Nom,'') = ''
                      THEN CASE
                           WHEN ifnull(DBA_MotCle,'') = ''
                           THEN CNT_Prenom ELSE CONCAT(CONCAT(CNT_Prenom, ' '), DBA_MotCle)
                           END
                      ELSE CASE
                           WHEN ifnull(DBA_MotCle,'') = ''
                           THEN CONCAT(CONCAT(CNT_Prenom, ' '), CNT_Nom)
                           ELSE CONCAT(CONCAT(CONCAT(CONCAT(CNT_Prenom, ' '), CNT_Nom), ' '), DBA_MotCle)
                           END
                      END
                 END
            ELSE CASE
                 WHEN ifnull(DBA_MotCle,'') = ''
                 THEN ENT_RaisonSociale
                 ELSE CONCAT(CONCAT(ENT_RaisonSociale, ' '), DBA_MotCle)
                 END
            END as supplier_label,
            CASE
            WHEN ifnull(ENT_RaisonSociale,'') = ''
            THEN CASE
                 WHEN ifnull(CNT_Prenom,'') = ''
                 THEN CNT_Nom
                 ELSE CASE
                      WHEN ifnull(CNT_Nom,'') = ''
                      THEN CNT_Prenom
                      ELSE CONCAT(CONCAT(CNT_Prenom, ' '), CNT_Nom)
                      END
                 END
            ELSE ENT_RaisonSociale
            END as supplier_name,
            DBA_MotCle as supplier_suffix,
            ifnull(DBA_MotCle,'') as keyword,
            DBA_NoCompte as account_id,
            DBA_CodeCategorieTVA as vat_id,
            DBA_DelaiPaiement as delay,
            DBA_NoIban as iban,
            ifnulL(DBA_NoReference,'') as reference_id,
            (SELECT CASE
                    WHEN COUNT(*) > 0
                    THEN 1
                    ELSE 0
                    END
            FROM donneesbancairecompte
            WHERE NoDonneesBancaire = DBC_NoDonneesBancaire) as hasmanyaccounts
            FROM donneesbancaire
            LEFT OUTER JOIN (exercicecomptable
            INNER JOIN plancomptable
                ON PCO_NoExercice = ECO_NoExercice
                AND CONVERT(DATE_FORMAT(SYSDATE(), '%Y%m%d'), DECIMAL)
                    BETWEEN ECO_DateDebut
                    AND ECO_DateFin)
                ON PCO_NoCompte = DBA_NoCompte
            INNER JOIN entreprise ON NoEntreprise = DBA_NoEntreprise
            INNER JOIN contact ON NoContact = DBA_NoContact
            INNER JOIN gestionentreprise ON GEN_NoEntreprise = NoEntreprise AND GEN_NoContact = NoContact
            WHERE ENT_Deleted = 0
            AND CNT_Deleted = 0
            AND DBA_BVRType = 'QRR';"];


    }

}

// __END__
