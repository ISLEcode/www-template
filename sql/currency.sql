SELECT NoMonnaie as id, MON_LibelleCourt as alpha3, MON_LibelleLong as label FROM monnaie
WHERE MON_LibelleCourt = 'CHF' OR MON_LibelleCourt = 'EUR';
