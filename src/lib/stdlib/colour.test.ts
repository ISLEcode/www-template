import * as Colour from './colour';

test ('toRGBA',        () => { expect (Colour .toRGBA ('#ffffff'))        .toEqual ('rgba(255,255,255,1)') });
test ('random colour', () => { expect (Colour .getRandomColour ().length) .toEqual (7) });
