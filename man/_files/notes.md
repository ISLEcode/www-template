---
revision  : 2021-01-06 (Wed) 16:02:41
title     : On QR-bill submit
---

1.  Create payment slip (BVR)

      Legend:
      ? = User validation required (y/n)

      : Table `bvr`

      DB name              DB type              ? Pseudocode
      -------------------- -------------------- - ---
      BVR_Type             varchar(3)           n := (ReferenceType == @(QRR|SCOR)) ? 'BVR' : 'BV'
      BVR_Date             int                  y := (BillInformation == //*) ? GetDate(BillInformation) : Today
      BVR_DelaiPaiement    int                  y := (BillInformation == //*) ? GetXXX(BillInformation) : Today
      BVR_DateEcheance     int                  y := BVR_Date + BVR_Delaipaiement
      BVR_MontantHT        decimal(10,2)        n := (BVR_MontantTTC / (100 + BVR_TVATaux)) * 100    [CHF]
      BVR_MontantTTC       decimal(10,2)        n := BVR_MontantOriginal * CurrencyRate              [CHF]
      BVR_MontantOriginal  decimal(10,2)        n := PaymentAmountInformation                        [Foreign currency]
      BVR_TVAMontant       decimal(10,2)        n := …
      BVR_TVATaux          float                n :=
      BVR_CodeCategorieTVA varchar(5)           y := SELECT … FROM categorietva ⇒ needs further querying to get rate
      BVR_NoMonnaie        bigint               n := ConvertISOtoSAMInt from table ('monnaie')
      BVR_NoCompte         int                  y := Supplier's ID from SAMinfo (Lookup creditor in SAMinfo or user input)
      BVR_NoCompteCCP      varchar(15)          n := extract bank ID from QR-bill QR-IBAN
      BVR_NoCompteBanque   varchar(50)          n := extract account ID from QR-bill QR-IBAN
      BVR_NoRef            varchar(100)         n := LeftTrimZeros (QR-bill PaymentReference)
      BVR_Code             varchar(100)         n := Null for now
      BVR_Motif            varchar(50)          y := Prefill with QR-bill AdditionalInformation (skip ^// line)
      BVR_EnFaveurDeChamp1 varchar(100)         n := BVR_NoCompteBanque
      BVR_Paye             tinyint(1)           n := (ignore)
      BVR_NoEntreprise     bigint               y := GetCreditorID (QR-Bill Creditor, Table entreprise)
      BVR_NoContact        bigint               y := GetCreditorID (QR-Bill Creditor, Table contact)
      BVR_NoProjet         bigint               y := SELECT … FROM projet
      BVR_NoDocument       varchar(100)         y := (free user input)

      : Table `bvrenfaveurde`

      -------------------- -------------------- ---
      BFD_NoCompteCCP      varchar(15)          n := BVR_NoCompteCCP (aka bank ID)
      BFD_Champ1           varchar(100)         n := BVR_EnFaveurDeChamp1
      BFD_Champ2           varchar(100)         n := BVR_NoCompteCCP (aka bank ID)
      BFD_Champ3           varchar(100)         n := QR-bill Creditor
      BFD_Champ4           varchar(100)         n := QR-bill Creditor address (address + building)
      BFD_Champ5           varchar(100)         n := QR-bill Creditor address (NPA - postcode)
      BFD_Champ6           varchar(100)         n := QR-bill Creditor address (city)
      BFD_NoIBAN           varchar(50)          n := QR-IBAN
      BFD_NoSWIFT          varchar(50)          m := (ignore)
      BFD_NoReference      varchar(6)           n := LeftTrimZeros (substr (0, 11, QR-bill PaymentReference))
      BFD_NoEntreprise     bigint               n := BVR_NoEntreprise
      BFD_NoContact        bigint               n := BVR_NoContact

      : Table `bvrversementpour` (needs to be populated from SAMinfo or have a local copy of banks)

      -------------------- -------------------- ---
      BVP_NoCompteCCP      varchar(15)          n := BVR_NoCompteCCP (aka bank ID)
      BVP_Champ1           varchar(100)         n := Creditor bank name
      BVP_Champ2           varchar(100)         n := Creditor bank address
      BVP_Champ3           varchar(10)          n := Creditor bank postcode
      BVP_Champ4           varchar(100)         n := Creditor bank city

2.  Create or update creditor


% SAMinfo schema
%
% 1.    Creditor - structured data (address1, building, address2, postcode, city, country)
%       Note: if QRcode unstructured convert to structured by matching organisation name
%
% 2.    Debitor  - unstructured (4 lines in database)
%
% 3.    IBAN    - Split fіeld to obtain bank account ID (skip first 4 chars, collect next 5, remainder is account id)
%       Return (bvrenfaveurde.BFD_NoIBAN, Bank_ID, Bank_Account)
%       Rule: Refuse if not CH or LI
%
% 4.    ReferenceId - return as is
%



SUNrise
a) facture Monsieur
b) Facture Madame

11 premiers chiffres du BVR est un identifiant unique
Discriminant



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
    (SELECT CASE WHEN COUNT(*) > 0 THEN 1 ELSE 0 END FROM donneesbancairecompte WHERE NoDonneesBancaire = DBC_NoDonneesBancaire) as HasManyAccounts,
    CASE WHEN length(DBA_NoCompteCCP) > 9 THEN 1 ELSE 0 END as HasDataBeforeQR
FROM donneesbancaire
     INNER JOIN entreprise ON NoEntreprise = DBA_NoEntreprise
     INNER JOIN contact ON NoContact = DBA_NoContact
     INNER JOIN gestionentreprise ON GEN_NoEntreprise = NoEntreprise AND GEN_NoContact = NoContact
#WHERE NoEntreprise = 34 AND NoContact = 40
ORDER BY DBA_NoCompteCCP

<!-- vim: set nospell :-->
