//! @file iban.ts
//!
//! | `IBANcountry`   | Return the country to which an IBAN string is bound                                          |
//! | `IBANmap`       | Hash mapping allowed country ISO 3166 alpha 2 names to the IBAN's string length              |
//! | `IBANmod`       | Assert that an IBAN is valid by calculating it's modulo 97 remainder                         |
//! | `IBANrex`       | Regular expression to validate characters in an IBAN string                                  |
//! | `canonicalIBAN` | Returns the canonical form of an IBAN after having validating that it is syntaxtically valid |
//! | `isIBAN`        | Assert an IBAN's validity                                                                    |
//! | `niceIBAN`      | Pretty print an IBAN string (i.e. with spaces)                                               |
//! | `trimIBAN`      | Trim all whitespace from an IBAN string                                                      |

//! @fn      canonicalIBAN
//! @brief   Returns the canonical form of an IBAN after having validating that it is syntaxtically valid
//! @param   iban The IBAN string to process
//! @returns The canonical IBAN string

export const canonicalIBAN = (iban: string): string => {

    const ciban  = trimIBAN (iban)              // Trim any whitespace
    const alpha2 = ciban .slice (0, 2)          // Collect the IBAN's country prefix...
    const chars  = IBANmap .get (alpha2)        // ... and determine count of expected characters
    const regex  = ciban .match (IBANrex)       // Make sure IBAN contains valid characters in appropriate locations
    const mod97  = IBANmod (ciban)              // Perform modulo 97 verification of IBAN string

    if (!chars)                 throw Error (`${ciban}: le préfix de cet IBAN inconnu ou absent.`)
    if (chars !== ciban.length) throw Error (`${ciban}: la longueur de cet IBAN (${ciban.length}) est invalide!`)
    if (!regex)                 throw Error (`${ciban}: cet IBAN contient des caractères interdits ou mal positionnés.`)
    if (!mod97)                 throw Error (`${ciban}: la vérification de cette IBAN à échoué.`)

    return ciban;

}

//! @fn      IBANcountry
//! @brief   Return the country to which an IBAN string is bound
//! @param   iban The IBAN string to process
//! @returns The ISO 3166 alpha2 country code

export const IBANcountry = (iban: string) => iban .slice (0, 2)

//! @var     IBANmap
//! @brief   Hash mapping allowed country ISO 3166 alpha 2 names to the IBAN's string length for that country
//! @note    For ISO 20022 (QRbill), only `CH` and `LI` are currently allowed (handled separately)
//! @see     IBAN2007 taken from line 615 of camt054.1.2.xsc

const IBANmap = new Map ([
    ['NO', 15], ['BE', 16], ['DK', 18], ['FI', 18], ['FO', 18], ['GL', 18], ['NL', 18], ['MK', 19], ['SI', 19], ['AT', 20],
    ['BA', 20], ['EE', 20], ['KZ', 20], ['LT', 20], ['LU', 20], ['CR', 21], ['CH', 21], ['HR', 21], ['LI', 21], ['LV', 21],
    ['BG', 22], ['BH', 22], ['DE', 22], ['GB', 22], ['GE', 22], ['IE', 22], ['ME', 22], ['RS', 22], ['AE', 23], ['GI', 23],
    ['IL', 23], ['AD', 24], ['CZ', 24], ['ES', 24], ['MD', 24], ['PK', 24], ['RO', 24], ['SA', 24], ['SE', 24], ['SK', 24],
    ['VG', 24], ['TN', 24], ['PT', 25], ['IS', 26], ['TR', 26], ['FR', 27], ['GR', 27], ['IT', 27], ['MC', 27], ['MR', 27],
    ['SM', 27], ['AL', 28], ['AZ', 28], ['CY', 28], ['DO', 28], ['GT', 28], ['HU', 28], ['LB', 28], ['PL', 28], ['BR', 29],
    ['PS', 29], ['KW', 30], ['MU', 30], ['MT', 31],
])

//! @fn      IBANmod
//! @brief   Assert that an IBAN is valid by calculating it's modulo 97 remainder
//! @param   iban The IBAN string to process
//! @returns Boolean indicating whether the IBAN string's verification was successful or not.

const IBANmod = (s: string): boolean => {
    const input   = s .substring (4, s .length) + s .substring (0, 4)
    const number  = Array .from(input) .map ((c) => (isNaN (parseInt (c)) ? (c .charCodeAt (0) - 55) .toString () : c)) .join('')
    const remains = Array .from (number) .map ((c) => parseInt (c)) .reduce ((remains, value) => (remains * 10 + value) % 97, 0)
    return remains === 1
}

//! @var     IBANrex
//! @brief   Regular expression to validate characters in an IBAN string

const IBANrex: RegExp = /[A-Z]{2,2}[0-9]{2,2}[a-zA-Z0-9]{1,30}/

//! @fn       isIBAN
//! @brief    Assert an IBAN's validity
//! @param    iban input IBAN
//! @returns  Boolean indicating whether the IBAN string is valid or not.
//! @see      https://rosettacode.org/wiki/IBAN#Scala
//! @see      https://en.wikipedia.org/wiki/International_Bank_Account_Number#Validating_the_IBAN

export const isIBAN = (iban: string): boolean => {
    try { canonicalIBAN (iban); return true }
    catch (err) { console.warn(err.message); return false }
}

//! @fn      niceIBAN
//! @brief   Pretty print an IBAN string (i.e. with spaces)
//! @param   iban The IBAN string to process
//! @returns The formated IBAN string

export const niceIBAN = (iban:string):string => iban

//! @fn      trimIBAN
//! @brief   Trim all whitespace from an IBAN string
//! @param   iban The IBAN string to process
//! @returns The trimmed IBAN string

export const trimIBAN = (iban: string) => iban .replace (/\s/g, '')

