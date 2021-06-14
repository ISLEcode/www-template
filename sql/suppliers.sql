NoEntreprise
ENT_RaisonSociale
ENT_LibelleCourt
ENT_Adresse
ENT_NoImmeuble
ENT_CasePostale
ENT_Npa
ENT_Localite
ENT_NoTel
ENT_NoFax
ENT_Email
ENT_Site
ENT_FacNoEntreprise
ENT_FacNoContact
ENT_NoConditionPaiement
ENT_Deleted
ENT_ClientDepuis
ENT_FinMandat
ENT_NoTVA
ENT_NoEmployeResponsable
ENT_BCarteVoeux
ENT_Autre
ENT_NoPays
ENT_NoCanton
ENT_Remarques
TYPE

SELECT NoEntreprise AS id, TYPE AS type, ENT_RaisonSociale AS name, ENT_Adresse AS street, ENT_NoImmeuble AS building,
  ENT_Npa AS zipcode, ENT_Localite AS location, ENT_NoCanton as region_id, ENT_NoPays as country_id,
  ENT_NoTel AS phone, ENT_NoFax AS fax, ENT_Email AS email, ENT_Site as website
FROM entreprise
WHERE ENT_RaisonSociale <> '' AND ENT_Deleted = 0;
