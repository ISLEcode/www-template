import * as BIC from './bic';

const bic1 = 'POFICHBEXXX';
const bic2 = 'UBSWCHZHXXX';
const bic3 = 'GIBAHUHB';
const bic4 = 'GIBA-HU HB';

test('canonicalBIC', () => { const s = BIC .canonicalBIC (bic4); expect(s).toEqual(bic3); });

test('isBIC', () => {
  expect (BIC .isBIC (bic1)) .toEqual (true);
  expect (BIC .isBIC (bic2)) .toEqual (true);
  expect (BIC .isBIC (bic3)) .toEqual (true);
  expect (BIC .isBIC (bic4)) .toEqual (false);
});
