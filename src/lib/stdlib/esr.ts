// TODO Finalise write-up, check against SAMinfo's Java code

// helper object for BVR
// note ref number are always input and output as strings since they can begin with zero and to avoid bad rounding etc..

//! length of of reference number (without checksum)
export const refNrLength = 27
export const generate = (index: number, template?: string): string => {
    if (!template) { }

    const s: string = template || Array(refNrLength).fill(0).join("")

    return generateFromTemplate(s, index)
}

export const generateFromTemplate = (template: string, index: number): string => {
    const sIndex = String(index)

    const is = template.slice(0, refNrLength - 1 - sIndex.length) + sIndex
    const m = modulo10CheckSum(is)

    return is + m
}

//! @fn       create list of integers from string, remove all non digits (hence flatMap)
//! @param    s input string
//! @returns list of int (between 0 and 9)

export const stringToInt = (s: string): number[] =>
    s .split("") .map((x) => {
        // get int to from string (by default get the ASCII code, need to remove 48 to get proper int)
        const i = x.charCodeAt(0) - 48
        // make sure resulting if between 0 and 9, otherwise exclude
        if (i >= 0 && i <= 9) return i
        return -1
    }) .filter((x) => x >= 0)

//! @fn       calculates last number if bvr (checksum)
//! @param    s input string (always a  number but can begin with zeros)
//! @see https://gist.github.com/christianmeichtry/9348451

export const modulo10CheckSum = (s: string): number => {
    // ref table
    const table = [0, 9, 4, 6, 8, 2, 7, 1, 3, 5]

    // create list of integers from string; prefix the list with zero
    const intList: number[] = [0, ...stringToInt(s)]

    // go trhough the list and return 10- table(idx)
    const rResult = intList.reduce((a, b) => { const idx = (a + b) % 10; return table[idx] })

    return (10 - rResult) % 10; // % 10 required here, in order not to return > 9 !
}

//! @fn       format reference number
//! @param    s ref number as array of int
//! @returns string properly formatted

export const formatRefNr = (s: number[]): String =>
    s .map((x, i) => { if ((i - 2) % 5 === 0) return " " + x; return String(x) }) .reduce((a, b) => a + b)

//! @fn       check if given ref number is valid
//! @param    s ref number
//! @returns true or false

export const isRefNumberValid = (s: string): boolean => {
    try {
        const t = stringToInt(s)
        return ( modulo10CheckSum(s.slice(0, -1)) == t[t.length - 1] && isRefNumberWithCorrectLength(s))
    }
    catch (err) { return false }
}

//! @fn       checks if ref number has correct length
//! @param    s ref number
//! @returns true or false

export const isRefNumberWithCorrectLength = (s: string): boolean => {
    try {
        const t = stringToInt(s)
        return t.length == refNrLength
    }
    catch (err) { return false }
}

//! checks if input string is a valid post account (this will be replaced with IBAN soon)

const isAccountRightFormat = (s: string): boolean => { const pattern = /^0[12]-[0-9]{6}-[0-9]$/; return !!s.match(pattern) }

const isAccountCheck = (s: string): boolean => {
    try { const last = Number(s[s.length - 1]); const r = modulo10CheckSum(s.slice(0, -1)); return r == last }
    catch (err) { return false }
}

export const isAccount = (s: string): boolean => isAccountRightFormat (s) && isAccountCheck (s)

//! @fn       is participant number
//! @param    s participant number
//! @returns boolean

const isParticipantNumber = (s: string): boolean => {
    const t = formatParticipantNumber(s);
    return t.length <= 9 && !!t.match(/\d+/) && !!t.slice(0, 2).match(/0[12]/)
}

//! @fn       format participant number
//! @param    s participant number
//! @returns formatted paerticipatn number

const formatParticipantNumber = (s: string): string => {
    const f = s.replace(/-/g, "")
    const t1 = f.slice(0, 2)
    const tn = f[f.length - 1]; //.takeRight(1)
    const t2 = f; // f.drop(1).dropRight(1)

    return t1 + t2 + tn
}


