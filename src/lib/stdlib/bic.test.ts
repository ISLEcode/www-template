import * as BIC from './bic';

const bic1 = 'POFICHBEXXX';
const bic2 = 'UBSWCHZHXXX';
const bic3 = 'GIBAHUHB';
const bic4 = 'GIBA-HU HB';

test('sanitize', () => { const s = BIC .sanitize (bic4); expect(s).toEqual(bic3); });

test('isValid', () => {
  expect (BIC .isValid (bic1)) .toEqual (true);
  expect (BIC .isValid (bic2)) .toEqual (true);
  expect (BIC .isValid (bic3)) .toEqual (true);
  expect (BIC .isValid (bic4)) .toEqual (false);
});
