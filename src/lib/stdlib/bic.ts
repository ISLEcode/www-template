//! @fn      canonicalBIC
//! @brief   Returns the canonical form of an BIC as per ISO 9362
//! @param   bic The BIC string to process
//! @returns The canonical BIC string

export const canonicalBIC = (bic: string): string => bic .replace (/[^0-9A-Z]/g, '') .toUpperCase ();

//! @var     BICrex
//! @brief   Regular expression to validate characters in an BIC string

const BICrex = new RegExp ([ '^',
'[A-Z]{4}',         // 4 letters: institution code or bank code.
'[A-Z]{2}',         // 2 letters: ISO 3166-1 alpha-2 country code
'[0-9A-Z]{2}',      // 2 letters or digits: location code
'([0-9A-Z]{3})?',   // 3 letters or digits: branch code, optional ('XXX' for primary office)
'$', ] .join(''));

//! @fn       isBIC
//! @brief    Assert an BIC's validity
//! @param    bic input BIC
//! @returns  Boolean indicating whether the BIC string is valid or not.

export const isBIC = (bic: string): boolean => { const r = bic .match (BICrex); return !!r };
