import * as IBAN from './iban';

test ('canonicalIBAN', () => {

  const iban  = "CH84 0022 8228 5516 5140U";
  const ciban = "CH840022822855165140U";
  const s     = IBAN.canonicalIBAN(iban);
  expect (s) .toEqual (ciban);
});

test ('isIBAN', () => {
  const iban1 = "HU04 1160 0006 0000 0000 5028 3396";
  const iban2 = "CH38 0022 8228 1133 9301 G";
  const iban3 = "CH38 0022 8228 1133 9301 ";

  expect (IBAN .isIBAN (iban1)) .toEqual (true);
  expect (IBAN .isIBAN (iban2)) .toEqual (true);
  expect (IBAN .isIBAN (iban3)) .toEqual (false);
});
