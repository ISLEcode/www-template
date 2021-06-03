---
revision  : 2020-11-16 (Mon) 14:56:23
title     : Swiss QR-bill QR-code database
---

4
4.1 4.2
4.2.1
4.2.2 4.2.3
4.2.4

Swiss QR Code database
In general

The database of the Swiss QR Code is oriented upon the Swiss Implementation Guidelines for Credit Transfers for the ISO 20022
« Customer Credit Transfer Initiation » message (pain.001).

### Technical specifications

Character set
:   According to the Swiss standard, in the Swiss QR Code, for reasons of compatibility with the Swiss Implementation Guidelines
    for Credit Transfers for the ISO 20022 « Customer Credit Transfer Initiation » message (pain.001), only the Latin character
    set is permitted. UTF-8 should be used for encoding. For certain fields, additional restrictions apply regarding characters
    e.g. only alphanumerical values are possible for the IBAN.

Field lengths
:   The field lengths specified represent maximum lengths for the individual elements. It is not permitted to fill in the elements
    with blanks up to the maximum length.

Separator element
:   The individual elements in the Swiss QR Code according to the Swiss standard are separated from one another with a carriage
    return (CR + LF). The carriage return is eliminated after the final element. Note: Instead of the characters CR + LF, the LF
    character can be used alone (see also this [FAQ](www.paymentstandards.ch/FAQ)).

Delivery of the data elements
:   All data elements must be present. If there is no content for a data element, then at least one carriage return (CR + LF or
    LF) must take place. The sole exceptions to this are additional data elements marked with «A» (alternative scheme). These may
    be omitted if they are not being used. The last data element delivered may not be completed with a concluding carriage return
    (CR + LF or LF).

Data groups
:   The data groups highlighted in light blue in Table 5 «Status of the elements» serve solely for depiction of the technical
    context and the definition of common rules. Such data groups may not be delivered in the Swiss QR Code. If a data group is
    used, in those marked with «optional», all sub-elements marked as «dependent» must be filled.

Data structure
Table 7 «Swiss QR Code data elements» specifies all elements relevant for the Swiss QR Code.

Depiction conventions
The following depiction conventions apply for this document. Table 7 «Swiss QR Code data elements» about the data structure contains the following columns and information: 1. Data structure
 Logical data structure, defined data groups (name of the data group always in the blue fields) which logically belong to one another
2. Element name  Technical element name
3. St.  Status
4. General definition  Technical definitions and terms
5. Field definition  Technical field definitions

Status
The following status values (information about usage) are possible for the individual elements:

Status (St.) Designation

M

Mandatory

D

Dependent

O

Optional

Description
Field must mandatorily be delivered filled.
Field must mandatorily be filled if the superordinate optional data group is filled.
Field must mandatorily be delivered, but not necessarily filled (can be empty).

Version 2.1 ­ 30.09.2019

Page 23 of 57

Swiss QR Code database

Swiss Implementation Guidelines QR-bill

4.3.2

Status (St.) Designation

A

Additional

X

Do not fill in

Description
Field does not necessarily have to be delivered.
Field must not be filled in but must be sent (intended «for future use», so the field separator needs to be sent).

Table 5:

Status of the elements

Coloring in the tables
Data elements that contain at least one sub-element represent so-called data groups and are colored light blue.
Depiction of the logical structure in the tables
To be able to recognize where in the logical structure of the Swiss QR Code an element is positioned, the nesting depth is indicated with a «+» sign placed in front of the «Data structure» column. For example, the IBAN in the «Creditor information» is shown as follows: QRCH +CdtrInf ++IBAN
Depiction of deviations in naming in the payment part/receipt
A name is listed in the table for individual data groups that differ from the field names, which is to be used as a designation in the payment part/receipt. This designation is listed in the tables in italics and in blue beneath the designation of the data group:

Ultimate Creditor Payable by

Figure 10:

Data group with technical element name and technical name for the payment part

Permitted characters in the field definitions

Details about the «Field definitions» column in Table 7:

Characters general numeric alphanumeric decimal

Field definitions Character set as stipulated in part 4.2.1 0­9 A­Z a-z 0­9 0­9 plus decimal separator «.»

Table 6:

Characters permitted

Swiss Implementation Guidelines QR-bill

4.3.3

Data elements in the QR-bill

QR Elements
Data Structure
QRCH +Header
QRCH +Header ++QRType QRCH +Header ++Version

Element Name Header QRType Version

QRCH +Header ++Coding QRCH +CdtrInf QRCH +CdtrInf ++IBAN QRCH +CdtrInf ++Cdtr QRCH +CdtrInf ++Cdtr +++AdrTp
QRCH +CdtrInf ++Cdtr +++Name
Version 2.1 ­ 30.09.2019

Coding CdtrInf IBAN Cdtr AdrTp
Name

Swiss QR Code database

Swiss QR Definition St. General Definition

Field Definition

Header

Mandatory data group

Header Data. Contains basic information about the Swiss QR

Code

M QRType

Fixed length: three-digit, alphanumeric

Unambiguous indicator for the Swiss QR Code. Fixed value

"SPC" (Swiss Payments Code)

M Version

Fixed length: four-digit, numeric

Contains version of the specifications (Implementation

Guidelines) in use on the date on which the Swiss QR Code

was created. The first two positions indicate the main

version, the following two positions the sub-version. Fixed

value of "0200" for Version 2.0

M Coding Type

Fixed length: one-digit, numeric

Character set code. Fixed value 1 (indicates UTF-8 restricted

to the Latin character set)

Creditor information Account / Payable to

Mandatory data group

M IBAN IBAN or QR-IBAN of the creditor.

Fixed length: 21 alphanumeric characters, only IBANs with CH or LI country code permitted.

Creditor

Mandatory data group

M Address type The address type is specified using a code. The following

Fixed length: one-digit, alphanumeric

codes are defined:

"S" - structured address

"K" - combined address elements (2 lines)

M Name

Maximum 70 characters permitted

The creditor's name or company according to the account First name (optional, sending is recommended, if

name.

available) + last name or company name

Comment: always matches the account holder

Page 25 of 57

Swiss Implementation Guidelines QR-bill

QR Elements
Data Structure
QRCH +CdtrInf ++Cdtr +++StrtNmOrAdrLine1
QRCH +CdtrInf ++Cdtr +++BldgNbOrAdrLine2
QRCH +CdtrInf ++Cdtr +++PstCd
QRCH +CdtrInf ++Cdtr +++TwnNm QRCH +CdtrInf ++Cdtr +++Ctry QRCH +UltmtCdtr

Element Name StrtNmOrAdrLine1 BldgNbOrAdrLine2 PstCd TwnNm Ctry UltmtCdtr

QRCH +UltmtCdtr ++AdrTp

AdrTp

QRCH +UltmtCdtr ++Name
Version 2.1 ­ 30.09.2019

Name

Swiss QR Code database

Swiss QR Definition St. General Definition

Field Definition

O Street or address line 1 Structured Address: Street/P.O. Box from the creditor's

Maximum 70 characters permitted

address

Combined address elements: Address line 1 including street

and building number or P.O. Box

O Building number or address line 2

Structured Address: max. 16 characters allowed

Structured Address: Building number from creditor's

Combined address elements: maximum 70 characters

address

permitted

Combined address elements: Address line 2 including postal Must be provided for address type "K".

code and town from creditor's address

D Postal code Postal code from creditor's address

Maximum 16 characters permitted The postal code is must be provided without a country

code prefix.

D Town Town from creditor's address

Combined address elements: must not be provided Maximum 35 characters permitted
Combined address elements: must not be provided

M Country Country from creditor's address

Two-digit country code according to ISO 3166-1

Ultimate Creditor In favour of Information about the ultimate creditor

X

Address type

The address type is specified using a code. The following

codes are defined:

"S" - structured address

"K" - combined address elements (2 lines)

X

Name

The ultimate creditor's name or company

Optional data group; may only be used in agreement with the creditor's financial institution This whole data group must not be filled in for the time being (for Future Use) Fixed length: one-digit, alphanumeric
Maximum 70 characters permitted First name (optional, sending is recommended, if available) + last name or company name

Page 26 of 57

Swiss Implementation Guidelines QR-bill

QR Elements Data Structure
QRCH +UltmtCdtr ++StrtNmOrAdrLine1

Element Name StrtNmOrAdrLine1

QRCH +UltmtCdtr ++BldgNbOrAdrLine2

BldgNbOrAdrLine2

QRCH +UltmtCdtr ++PstCd

PstCd

QRCH +UltmtCdtr ++TwnNm
QRCH +UltmtCdtr ++Ctry
QRCH +CcyAmt
QRCH +CcyAmt ++Amt

TwnNm Ctry CcyAmt Amt

QRCH +CcyAmt ++Ccy QRCH +UltmtDbtr
Version 2.1 ­ 30.09.2019

Ccy UltmtDbtr

Swiss QR Code database

Swiss QR Definition St. General Definition

Field Definition

X

Street or address line 1

Maximum 70 characters permitted

Structured Address: Street/P.O. Box from ultimate creditor's

address

Combined address elements: Address line 1 including street

and building number or P.O. Box

X

Building number or address line 2

Structured Address: max. 16 characters allowed

Structured Address: Building number from ultimate

Combined address elements: maximum 70 characters

creditor's address

permitted

Combined address elements: Address line 2 including postal Must be provided for address type "K".

code and town from ultimate creditor's address

X

Postal code

Postal code from ultimate creditor's address

Maximum 16 characters permitted The postal code is must be provided without a country

code prefix.

X

Town

Town from ultimate creditor's address

X

Country

Country of the ultimate creditor's address

Combined address elements: must not be provided Maximum 35 characters permitted
Combined address elements: must not be provided Two-digit country code according to ISO 3166-1

Payment amount information

Mandatory data group

O Amount The payment amount

The amount element is to be entered without leading zeroes, including decimal separators and two decimal places. Decimal, maximum 12-digits permitted, including decimal separators. Only decimal points (".") are permitted as decimal separators.

M Currency

Only CHF and EUR are permitted.

The payment currency, 3-digit alphanumeric currency code

according to ISO 4217

Ultimate Debtor Payable by

Optional data group

Page 27 of 57

Swiss Implementation Guidelines QR-bill

QR Elements Data Structure
QRCH +UltmtDbtr ++AdrTp

Element Name AdrTp

QRCH +UltmtDbtr ++Name
QRCH +UltmtDbtr ++StrtNmOrAdrLine1

Name StrtNmOrAdrLine1

QRCH +UltmtDbtr ++BldgNbOrAdrLine2

BldgNbOrAdrLine2

QRCH +UltmtDbtr ++PstCd

PstCd

QRCH +UltmtDbtr ++TwnNm
QRCH +UltmtDbtr ++Ctry
QRCH +RmtInf

TwnNm Ctry RmtInf

Swiss QR Code database

Swiss QR Definition St. General Definition

Field Definition

D Address type The address type is specified using a code. The following

Fixed length: one-digit, alphanumeric

codes are defined:

"S" - structured address

"K" - combined address elements (2 lines)

D Name The ultimate debtor's name or company

Maximum 70 characters permitted First name (optional, sending is recommended, if

available) + last name or company name

O Street or address line 1

Maximum 70 characters permitted

Structured Address: Street/P.O. Box from ultimate debtor's

address

Combined address elements: Address line 1 including street

and building number or P.O. Box

O Building number or address line 2

Structured Address: max. 16 characters allowed

Structured Address: Building number from ultimate debtor's Combined address elements: maximum 70 characters

address

permitted

Combined address elements: Address line 2 including postal Must be provided for address type "K".

code and town from ultimate debtor's address

D Postal code Postal code from ultimate debtor's address

Maximum 16 characters permitted The postal code is must be provided without a country

code prefix.

D Town Town from ultimate debtor's address
D Country Country from ultimate debtor's address

Combined address elements: must not be provided Maximum 35 characters permitted
Combined address elements: must not be provided Two-digit country code according to ISO 3166-1

Payment reference

Mandatory data group

Version 2.1 ­ 30.09.2019

Page 28 of 57

Swiss Implementation Guidelines QR-bill

QR Elements Data Structure
QRCH +RmtInf ++Tp

Element Name Tp

QRCH

Ref

+RmtInf

++Ref

QRCH +RmtInf ++AddInf QRCH +RmtInf ++AddInf +++Ustrd QRCH +RmtInf ++AddInf +++Trailer QRCH +RmtInf ++AddInf +++StrdBkgInf
Version 2.1 ­ 30.09.2019

AddInf Ustrd Trailer StrdBkgInf

Swiss QR Code database

Swiss QR Definition St. General Definition

Field Definition

M Reference type Reference type (QR, ISO) The following codes are permitted: QRR ­ QR reference SCOR ­ Creditor Reference (ISO 11649) NON ­ without reference

Maximum four characters, alphanumeric Must contain the code QRR where a QR-IBAN is used; where the IBAN is used, either the SCOR or NON code can be entered

D Reference

Maximum 27 characters, alphanumeric; must be filled if a

Note: The structured reference is either a QR reference or QR-IBAN is used.

an ISO 11649 Creditor Reference

QR reference: 27 characters, numeric, check sum

calculation according to Modulo 10 recursive (27th

position of the reference)

Creditor Reference (ISO 11649): max 25 characters,

alphanumeric

The element may not be filled for the NON reference

type.

Banks do not distinguish between upper and lower case

capitalization.

Additional information Additional information can be used for the scheme with message and for the scheme with structured reference.

Unstructured message and Booking instructions may contain a common total of up to 140 characters

O Unstructured message Unstructured information can be used to indicate the

Maximum 140 characters permitted

payment purpose or for additional textual information

about payments with a structured reference.

M Trailer

Fixed length: three-digit, alphanumeric

Unambiguous indicator for the end of payment data. Fixed

value "EPD" (End Payment Data).

O Bill information

Maximum 140 characters permitted

Bill information contain coded information for automated Use of the information is not part of the standardization.

booking of the payment. The data is not forwarded with the In the Annex you will find the version of Swico`s

payment.

"Recommendations on the structure of information from

the biller for QR-bills" that is valid at the time of

publication of these Implementation Guidelines.

Page 29 of 57

Swiss Implementation Guidelines QR-bill

QR Elements Data Structure
QRCH +AltPmtInf QRCH +AltPmtInf ++AltPmt
Table 7:

Element Name AltPmtInf AltPmt
Swiss QR Code data elements

Swiss QR Definition St. General Definition

Alternative schemes Parameters and data of other supported schemes

A

Alternative scheme parameters

Parameter character chain of the alternative scheme

according to the syntax definition in the "Alternative

scheme" section

Swiss QR Code database
Field Definition Optional data group with a variable number of elements A maximum of two occurrences may be provided. Maximum 100 characters per occurrence permitted

Version 2.1 ­ 30.09.2019

Page 30 of 57

Swiss Implementation Guidelines QR-bill

Swiss QR Code database

4.4
4.4.1

Technical specifications
The mapping of the data in the Swiss QR Code in the ISO 20022 pain.001 message is described in the Swiss «Implementation Guidelines for Credit Transfers» (pain.001) [3].

Use of address information

The address of the parties involved ­ for example that of the creditor ­ may be sent either structured (separately) or as combined address fields (two pieces of data in each field).
Structured address fields: The elements «Street or address line 1», «Building number or address line 2», «Postal code», «Town» and «Country» should be filled in. For a P.O. Box, the «Street or address line 1» element should be used.
Combined address fields: The elements «Street or address line 1», «Building number or address line 2» and «Country» should be filled in. For a P.O. Box, the «Street or address line 1» element should be used.

Address type

Beispiel: Strukturiert
«S»

Name
Street or address line 1

Pia-Maria RutschmannSchnyder
Grosse Marktgasse

Building number or address line 2
Postal code

28 9400

Town

Rorschach

Country

CH

Beispiel: Kombiniert «K»
Pia-Maria RutschmannSchnyder Grosse Marktgasse 28
9400 Rorschach

Bemerkungen
«S» - Structured address «K» - Combined address
«S» - Street/P.O. Box «K» - Street and building number of P.O. Box «S» - Building number «K» - Postal code and town

«S» - Postal code «K» - Do not fill in «S» - Town «K» - Do not fill in CH

Table 8:

Examples of how to use address information

Version 2.1 ­ 30.09.2019

Page 31 of 57

Swiss QR Code database

Swiss Implementation Guidelines QR-bill

4.4.2

Customer references
Structured reference as «payment reference»
The two following types of structured references can be delivered in the «Reference» element:
 Use of the QR reference (QRR)
The QR reference (see paragraph 2.12.1) enables the creditor to compare their invoices and the incoming payments automatically. In its structure, it equates to the ISR reference (27 characters, numerical; check digit calculated by Modulo 10 recursive; 27th digit of the reference; see Annex B «Check digit generation by Modulo 10 recursive»).
Use of the QR reference presupposes that a QR-IBAN has been used. The QR-IBAN identifies the payment across all payment channels as one which must have a QR reference delivered with it. An IBAN must therefore not be used.
 Use of the Creditor Reference (SCOR)
The internationally used Creditor Reference (ISO 11649) also enables the creditor to compare their invoices and incoming payments automatically.
Use of the Creditor Reference (ISO 11649) presupposes that an IBAN has been used. A QR-IBAN must not be used.

4.4.3 Page 32 of 57

Additional information
The two elements «Unstructured message» and «Billing information» are available for additional information. The number of characters in the two fields together must not exceed 140 characters:  Unstructured messages can be used to give the payment purpose or for
additional textual information about payments with a structured reference. Unstructured references are printed on the payment part under the heading «Additional information».  The element «Billing information»contains coded information of the biller for the bill recipient. This information may be used for automating accounts payable processes, for instance. The data is not forwarded with the payment but it is printed on the payment part. The coding of the element always begins with «//» (slash slash) followed by the double-digit, abbreviated name of the proposed version of the «Structured information for the bill issuer» that is being used
Regarding the «Billing information» element: Swiss financial institutions do not prescribe the structure of this information, to allow for the individual needs of the different sectors. A flexible solution has therefore been defined which allows for the use in parallel of different ways of coding this information. For this purpose, the first two characters are reserved as the code for the rule defining how the remaining characters of this field should be interpreted. For more information on coding, see www.PaymentStandards.CH.
So that the relevant «Billing information» can be identified, SIX is prescribing a twodigit coding system. This and the Structural recommendations (syntax) must be agreed with SIX before it is used (process cf. Annex E). Billing data must not include any personal data.
Version 2.1 ­ 30.09.2019

Swiss Implementation Guidelines QR-bill

Swiss QR Code database

Applicable structural recommendations for Billing information are available on www.PaymentStandards.CH.

4.4.4

Alternative schemes
Since only ca. 90 caracters can be displayed on the payment part in «Alternative schemes», the following rules are to be followed in order to ensure the of data protection while filling this element:
 First the (abbreviated) name of the alternative procedure must be coded (e.g. eBill).The next character must contain the subelement separator that is used (e.g. «/»).
 Subsequently, the the data that may include personal data should be coded so that they are displayed on the payment part.
 An unlimited number of sub-elements can be delivered within the permitted field length of the element.
The data in the alternative scheme element is only interpreted and used by the corresponding scheme.
It solely serves the debtor for the easy use of this scheme.
For current information about alternative procedures, please see www.PaymentStandards.CH/alternative-schemes.

Version 2.1 ­ 30.09.2019

Page 33 of 57

Parameters for generating the Swiss QR Code

Swiss Implementation Guidelines QR-bill

<!-- vim: set nospell :-->
