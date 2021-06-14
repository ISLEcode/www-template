<?php namespace SAM\API\ERP;

use \SAM\API\Entity;

class QRBill extends \SAM\API\Entity {

    public function __construct ($db, $verb = null) {

        parent::__construct ($db, $verb);

        $this->map = [
            'create' =>
            // Creation variable v_comptepostal_id
            'SELECT CONCAT(CONCAT(LPAD(LEFT(Postal_Account, LOCATE(\'-\', Postal_Account) - 1), 2, \'0\'),
                LPAD(SUBSTRING(RIGHT(Postal_Account, LOCATE(\'-\', Postal_Account) - 1), 2,
                LOCATE(\'-\', RIGHT(Postal_Account, LOCATE(\'-\', Postal_Account) - 1))), 6, \'0\')),
                RIGHT(RIGHT(Postal_Account, LOCATE(\'-\', Postal_Account)), LOCATE(\'-\', RIGHT(Postal_Account,
                LOCATE(\'-\', Postal_Account) + 1)))) INTO v_comptepostal_id
            FROM (SELECT @rn:=@rn+1 AS rowid, No_CB, Succ_ID,
                CASE WHEN LEFT(Postal_Account,1) = \'*\' THEN SUBSTRING(Postal_Account,2) ELSE Postal_Account
                END as Postal_Account, Bank_Id
            FROM gp_config._bank, (SELECT @rn:=0) rn
            WHERE No_CB = IFNULL(TRIM(LEADING \'0\' FROM SUBSTR(\'\'{$qrbill.creditor.iban}\'\', 6, 4)), 0)
            ORDER BY No_CB, CASE WHEN LEFT(Postal_Account,1) = \'*\' THEN 1 ELSE 0 END, Succ_ID, Bank_Id) tmp
            WHERE rowid = 1;'

            // Creation variable v_reference_id
            .'SELECT CASE WHEN SUBSTRING(TRIM(LEADING \'0\' FROM v_qrr_reference), 7, 1) = \'0\'
                THEN LEFT(TRIM(LEADING \'0\' FROM v_qrr_reference), 6) ELSE
                CASE WHEN SUBSTRING(TRIM(LEADING \'0\' FROM v_qrr_reference), 8, 1) = \'0\'
                THEN LEFT(TRIM(LEADING \'0\' FROM v_qrr_reference), 7)
                ELSE LEFT(TRIM(LEADING \'0\' FROM v_qrr_reference), 10)
                END
            END INTO v_reference_id
            FROM DUAL;'

            // Creation/mise à jour de GestionEntrepriße
            .'IF ISNULL (v_fournisseur_id, 0) = 0 THEN
                SELECT MAX(NoEntreprise) + 1 INTO v_organisation_id FROM entreprise;
                INSERT INTO entreprise
                       ( NoEntreprise,      ENT_RaisonSociale, ENT_Adresse,         ENT_Npa,           ENT_Localite)
                VALUES ( v_organisation_id, v_fournisseur_nom, v_fournisseur_addr1, v_fournisseur_npa, v_fournisseur_lieu);
                SELECT MAX(NoContact) + 1 INTO v_contact_id FROM contact;
                INSERT INTO contact (NoContact) VALUES (v_contact_id);
                SELECT MAX(NoGestionEntreprise) + 1 INTO v_gestionentreprise_id FROM contact;
                INSERT INTO gestionentreprise
                       ( NoGestionEntreprise,    GEN_NoEntreprise,  GEN_NoContact, GEN_BFournisseur)
                VALUES ( v_gestionentreprise_id, v_organisation_id, v_contact_id,  1);
            END IF;'

            // Recherche donnees bancaires
            .'SELECT COUNT(*) INTO v_count_supplier_id
            FROM donneesbancaire
            WHERE DBA_NoEntreprise          = IFNULL(v_fournisseur_id, v_organisation_id)
                AND DBA_NoContact           = IFNULL(v_fournisseurcontactid,v_contact_id)
                AND ifnull(DBA_MotCle,\'\') = v_fournisseur_motcle
            AND DBA_BVRType                 = v_qrr_typeqrcode;'

            // Mise à jour de DonneesBanquaire
            .'IF ifnull(v_count_supplier_id,0) = 0 THEN
                SELECT MAX(NoDonneesBancaire) + 1 INTO v_supplier_id FROM donneesbanquaire;
                INSERT INTO donneesbanquaire (NoDonneesBancaire, DBA_BVRType, DBA_NoEntreprise, DBA_NoContact, DBA_NoCompteCCP,
                    DBA_NoCompte, DBA_CodeCategorieTVA, DBA_DelaiPaiement, DBA_NoIBAN, DBA_NoCompteBanque, DBA_NoClearing,
                    DBA_NoReference, DBA_MotCle)
                VALUES (v_supplier_id, v_qrr_typeqrcode, IFNULL(v_fournisseur_id, v_organisation_id),
                    IFNULL(v_fournisseurcontactid,v_contact_id), v_comptepostal_id, v_qrr_nocompte, v_qrr_nocategorietva,
                    v_qrr_delai, v_fournisseur_iban, RIGHT(v_fournisseur_iban, 10),
                    TRIM(LEADING \'0\' FROM SUBSTR(v_fournisseur_iban, 6, 4)), v_qrr_reference, v_fournisseur_motcle);
            ELSE
                IF v_fournisseur_maj = 1 THEN
                    UPDATE donneesbancaire SET
                        DBA_NoCompte         = v_qrr_nocompte,
                        DBA_CodeCategorieTVA = v_qrr_nocategorietva,
                        DBA_DelaiPaiement    = v_qrr_delai
                    WHERE NoDonneesBancaire  = v_supplier_id;
                END IF;
            END IF;'

            // Creation variable v_count_bvrenfaveurde
            .'SELECT COUNT(*) INTO v_count_bvrenfaveurde
            FROM bvrenfaveurde
            WHERE BFD_NoCompteCCP  = v_comptepostal_id
            AND BFD_Champ1         = RIGHT(v_fournisseur_iban, 10)
            AND BFD_NoReference    = v_reference_id
            AND BFD_NoEntreprise   = IFNULL(v_fournisseur_id, v_organisation_id)
            AND BFD_NoContact      = IFNULL(v_fournisseurcontactid,v_contact_id);'

            // Mise à jour de BVREnFaveurDe
            .'IF IFNULL(v_count_bvrenfaveurde, 0) = 0 THEN
                INSERT INTO bvrenfaveurde (BFD_NoCompteCCP, BFD_Champ1, BFD_Champ2, BFD_Champ3, BFD_Champ4, BFD_Champ5,
                    BFD_Champ6, BFD_NoIBAN, BFD_NoReference, BFD_NoEntreprise, BFD_NoContact)
                VALUES (v_comptepostal_id, RIGHT(v_fournisseur_iban, 10), v_fournisseur_nom, v_fournisseur_addr1,
                    v_fournisseur_addr2, v_fournisseur_npa, v_fournisseur_lieu, v_fournisseur_iban, v_reference_id,
                    IFNULL(v_fournisseur_id, v_organisation_id),
                    IFNULL(v_fournisseurcontactid,v_contact_id));
            ELSE
                UPDATE bvrenfaveurde SET
                    BFD_Champ2 = v_fournisseur_nom,
                    BFD_Champ3 = v_fournisseur_addr1,
                    BFD_Champ4 = v_fournisseur_addr2,
                    BFD_Champ5 = v_fournisseur_npa,
                    BFD_Champ6 = v_fournisseur_lieu,
                    BFD_NoIBAN = v_fournisseur_iban
                WHERE BFD_NoCompteCCP  = v_comptepostal_id
                AND BFD_Champ1       = RIGHT(v_fournisseur_iban, 10)
                AND BFD_NoReference  = v_reference_id
                AND BFD_NoEntreprise = IFNULL(v_fournisseur_id, v_organisation_id),
                AND BFD_NoContact    = IFNULL(v_fournisseurcontactid,v_contact_id)
            END IF;'

            // Creation variable v_count_bvrversementpour
            .'SELECT COUNT(*) INTO v_count_bvrversementpour
            FROM bvrversementpour
            WHERE BVP_NoCompteCCP = v_comptepostal_id;'

            // Mise à jour de BVRVersementPour
            .'IF ifnull(v_count_bvrversementpour,0) = 0 THEN
                INSERT INTO bvrversementpour
                       ( BVP_NoCompteCCP,   BVP_Champ1,        BVP_Champ2,          BVP_Champ3,        BVP_Champ4)
                VALUES ( v_comptepostal_id, v_fournisseur_nom, v_fournisseur_addr1, v_fournisseur_npa, v_fournisseur_lieu);
            ELSE
                UPDATE bvrversementpour SET
                    BVP_Champ1 = v_fournisseur_nom,
                    BVP_Champ2 = v_fournisseur_addr1,
                    BVP_Champ3 = v_fournisseur_npa,
                    BVP_Champ4 = v_fournisseur_lieu
                WHERE BVP_NoCompteCCP = v_comptepostal_id;
            END IF;'

            // Mise à jour de BVR
            .'INSERT INTO bvr (BVR_Type, BVR_Date, BVR_DelaiPaiement, BVR_DateEcheance, BVR_MontantHT, BVR_MontantTTC,
                BVR_MontantOriginal, BVR_TVAMontant, BVR_TVATaux, BVR_CodeCategorieTVA, BVR_NoMonnaie, BVR_NoCompte,
                BV_NoCompteCCP, BVR_NoCompteBanque, BVR_NoRef, BVR_Code, BVR_Motif, BVR_NoEntreprise, BVR_NoContact,
                BVR_NoProjet, BVR_NoDocument, BVR_EnfaveurdeChamp1, BVR_EnFaveurDeChamp2, BVR_EnFaveurDeChamp3,
                BVR_EnFaveurDeChamp4, BVR_EnFaveurDeChamp5, BVR_EnFaveurDeChamp6, BVR_VersementPourChamp1,
                BVR_VersementPourChamp2, BVR_VersementPourChamp3, BVR_VersementPourChamp4, BVR_NoIBAN, BVR_NoClearing,
                BVR_QRJson)
            VALUES (v_qrr_typeqrcode, v_qrr_date, v_qrr_delai, v_qrr_dateecheance, v_qrr_montantht, v_qrr_montantttc,
                v_qrr_montantoriginal, v_qrr_tvamontant, v_qrr_tvataux, v_qrr_nocategorietva,
                (SELECT NoMonnaie WHERE MON_LibelleCourt = v_qrr_codemonnaie), v_qrr_nocompte, v_comptepostal_id,
                RIGHT(v_fournisseur_iban, 10), v_qrr_reference, v_qrr_code, v_qrr_motif,
                IFNULL(v_fournisseur_id, v_organisation_id), IFNULL(v_fournisseurcontactid,v_contact_id), v_qrr_noprojet,
                v_qrr_nodocument, v_fournisseur_iban, v_fournisseur_nom, v_fournisseur_addr1, v_fournisseur_addr2,
                v_fournisseur_npa, v_fournisseur_lieu, v_fournisseur_nom, v_fournisseur_addr1, v_fournisseur_npa,
                v_fournisseur_lieu, v_fournisseur_iban, TRIM(LEADING \'0\' FROM SUBSTRING(v_fournisseur_iban, 6, 4)),
                v_qrr_data);'
        ];
    }

    public function post_addvar ($name, $value, $type) {

        $prefix = 'SELECT ';
        $suffix = "INTO $name;";

        switch ($type) {
            case 'string' : return "$prefix \"$value\" $suffix";
            case 'integer': return "$prefix   $value   $suffix";
            case 'boolean': return "$prefix   $value   $suffix";
            case 'float'  : return "$prefix   $value   $suffix";
        }

    }

    public function post_prepare ($template, $input) {
    //! @fn     post_prepare
    //! @brief  Validate POSTed data and prepare the SQL statement to enact
    //! @param  $template   SQL template statement
    //! @param  $input      The POST data supplied by the caller
    //! @return Returns the SQL statement that shall be executed

        $sql  = '';
        $sql .= $this ->post_addvar ('v_fournisseur_addr1',      $input['creditor.addr1'],            'string');
        $sql .= $this ->post_addvar ('v_fournisseur_addr2',      $input['creditor.addr2'],            'string');
        $sql .= $this ->post_addvar ('v_fournisseur_iban',       $input['creditor.iban'],             'string');
        $sql .= $this ->post_addvar ('v_fournisseur_id',         $input['payment.supplier'],          'integer');
        $sql .= $this ->post_addvar ('v_fournisseur_lieu',       $input['creditor.location'],         'string');
        $sql .= $this ->post_addvar ('v_fournisseur_maj',        $input['payment.updatesupplier'],    'boolean');
        $sql .= $this ->post_addvar ('v_fournisseur_motcle',     $input['payment.keyword'],           'string');
        $sql .= $this ->post_addvar ('v_fournisseur_nom',        $input['creditor.name'],             'string');
        $sql .= $this ->post_addvar ('v_fournisseur_npa',        $input['creditor.postcode'],         'string');
        $sql .= $this ->post_addvar ('v_qrr_code',               '',                                  'string');
        $sql .= $this ->post_addvar ('v_qrr_codemonnaie',        $input['payment.currency'],          'string');
        $sql .= $this ->post_addvar ('v_qrr_data',               $input['data'],                      'string');
        $sql .= $this ->post_addvar ('v_qrr_date',               $input['payment.date'],              'date');
        $sql .= $this ->post_addvar ('v_qrr_dateecheance',       $input['payment.duedate'],           'date');
        $sql .= $this ->post_addvar ('v_qrr_delai',              $input['payment.delay'],             'integer');
        $sql .= $this ->post_addvar ('v_qrr_montantht',          $input['payment.amount'],            'float');
        $sql .= $this ->post_addvar ('v_qrr_montantoriginal',    $input['payment.amount'],            'float');
        $sql .= $this ->post_addvar ('v_qrr_montantttc',         $input['payment.amount'],            'float');
        $sql .= $this ->post_addvar ('v_qrr_motif',              $input['payment.moreinfo'],          'string');
        $sql .= $this ->post_addvar ('v_qrr_nocategorietva',     $input['payment.vatcode'],           'string');
        $sql .= $this ->post_addvar ('v_qrr_nocompte',           $input['payment.account'],           'integer');
        $sql .= $this ->post_addvar ('v_qrr_nodocument',         $input['payment.billid'],            'string');
        $sql .= $this ->post_addvar ('v_qrr_noprojet',           $input['payment.order'],             'string');
        $sql .= $this ->post_addvar ('v_qrr_reference',          $input['payment.reference'],         'string');
        $sql .= $this ->post_addvar ('v_qrr_tvamontant',         $input['payment.amount'],            'float');
        $sql .= $this ->post_addvar ('v_qrr_tvataux',            '7.7',                               'float');
        $sql .= $this ->post_addvar ('v_qrr_typeqrcode',         'QRR',                               'string');
        return $sql;

    }

    public function post_respond ($sql, $result) {
    //! @fn     post_respond
    //! @brief  Pre-process the MySQL engine result before sending it back to the caller
    //! @param  $result The outcome of enacting the SQL statement prepared by `post_prepare`
    //! @return Returns the raw data which should be converted to JSON and sent back to the caller

        $out = '';
        $out = $result;
        return $out;

    }

}

// __END__
