---
revision  : 2020-11-16 (Mon) 14:48:59
title     : TITLE_GOES_HERE
---
Swiss Payment Standards 2019
Swiss Implementation Guidelines QR-bill Technical and professional specifications of the payment part with Swiss QR Code and of the receipt Version 2.1, with effect from 30 September 2019
Version 2.1 ­ 30.09.2019

General note
Comments and questions about this document can be directed to the respective financial institution or to SIX at the following address: billing-payments.pm@six-group.com.
For ease of legibility, this document uses the masculine form to refer to both genders.
Change control
This document «Swiss Implementation Guidelines QR-bill», Version 2.1 dated 30 September 2019, entirely replaces the previous Version 2.0 dated 15 November 2018. Compared to the previous version, no changes have been made to the content of technical specifications. The changes are limited to corrections and clarifications.
All changes that have been made compared with Version 1.0 are listed in the Documentation of Changes. This can be found in the archive under www.PaymentStandards.CH/archives.
Patent notice
SIX and the responsible project sponsors for the new QR-bill for the Swiss financial center have together carefully reviewed the technical and legal framework conditions for the territory of Switzerland in consultation with specialists and are providing corresponding specifications for a standardized QR-bill («standardization»). The usage possibilities for billing and paying a QR-bill listed below were used as a basis:  Payer captures QR code using a reader or camera in e-/m-banking  Payer captures QR code using a reader or scanner in their own infrastructure and transmits the
payment instruction electronically (e.g. as pain message)  Cash inpayment at post office counter (branches and branches with a partner company)  Credit transfer instruction form
Further uses of the QR-bill that are not listed, such as payment via an ATM, are also not a component of the standardization.
For the commercial technological implementation of the standardization, accepted industry solutions and measures are to be planned by the commercial users.
Important notices
Third-party specifications and company-specific functionality do not form part of the standardisation process. Individual providers are responsible for finding appropriate solutions. This applies particularly to the option of embedding «Billing information» or content in the «Alternative procedures» fields.
The «Billing information» element can be used for sending structured information between the bill issuer and bill recipient. The layout of the QR-bill includes a data field for this purpose.
Containers for alternative payment procedures are also provided in the «Alternative procedures» elements. The content and use of such data are the responsibility of the providers of those procedures.
In order for the content of the «Billing information» and «Alternative procedures» fields to be identifiable, SIX is prescribing certain parameters for coding syntax. This, and use of the fields at all, must be agreed with SIX before they are published or used (see Annex E).

Specification for the QR-bill
If all the processes involved in producing and processing QR-bills are to work smoothly, the Guidelines for the QR-bill must be observed.
The specifications for the QR-bill are addressed primarily to the issuers of invoices, but they also apply to financial institutions and their service providers who offer their customers payment traffic services based on the QR-bill, the developers of software for invoice issuers and recipients and banks, and all other associated participants in the market.
The following documents contain technical and layout-related specifications for the QR-bill and payments made on the basis of a QR-bill:  Swiss Implementation Guidelines QR-bill: Technical and specialist specifications for the payment
section with Swiss QR Code and receipt (this document).  Style Guide QR-bill (summary of layout rules from this document)  Processing rules for QR-bills (Business Rules)  Technical information about the QR-IID and QR-IBAN  Bank Master (list of IIDs and QR IIDs of banks)  Swiss Payment Standards (Implementation Guidelines on exchanging of data between customers
and banks)  Implementation Guidelines for Interbank Messages
Failure to comply with the Guidelines for the QR-bill may result, for example, in  it not being possible for the debtor and their financial institution to enter the payment.  it not being possible for payments to be executed by the debtor and their financial institution.  credits to the bill issuer and their financial institution being booked incorrectly or not at all.  laws ebing violated (e.g. data protection).
SIX Interbank Clearing Ltd assumes no responsibility or liability for the correctness and completeness of the information provided. Likewise, SIX Interbank Clearing Ltd does not offer advice for the specific scope of functionality for systems for using the QR-bill, provides no control mechanisms for technical procedures and offers no guarantee and accepts no liability for the actual mechanical or procedural implementation of the standardisation process or of solutions for using and processing QR-bills.
Support and resources
SIX makes various help resources and other support materials available without liability. Find out more at www.PaymentStandards.CH.

© Copyright 2018 SIX Interbank Clearing Ltd, CH-8021 Zurich Version 2.1 ­ 30.09.2019

Seite 3 von 57

Table of contents

Swiss Implementation Guidelines QR-bill

Table of contents

1 1.1 1.2 1.3 1.4
2 2.1 2.2 2.3 2.4 2.5 2.6 2.7 2.8 2.9 2.10 2.11 2.12 2.12.1 2.12.2 3 3.1 3.2 3.3 3.4 3.5 3.5.1 3.5.2 3.5.3 3.5.4 3.5.5 3.6 3.6.1 3.6.2 3.6.3 3.6.4 3.7
4 4.1 4.2 4.2.1 4.2.2 4.2.3 4.2.4

Introduction ...............................................................................................................................6 Introduction to the QR-bill .................................................................................................................... 6 Change ownership.................................................................................................................................. 7 Versioning of the Swiss Implementation Guidelines QR-bill ............................................................ 8 Reference documents ............................................................................................................................ 8
Definition of terms ....................................................................................................................9 QR-bill ....................................................................................................................................................... 9 Payment part with Swiss QR code and receipt ................................................................................... 9 QR Code according to ISO 18004........................................................................................................10 The term «module» according to ISO 18004.....................................................................................10 The term «error correction level» according to ISO 18004 ............................................................. 10 Swiss QR Code ....................................................................................................................................... 10 DPI........................................................................................................................................................... 11 IID............................................................................................................................................................ 11 QR-IID ..................................................................................................................................................... 11 IBAN ........................................................................................................................................................ 11 QR-IBAN ................................................................................................................................................. 11 Customer references............................................................................................................................ 12 QR reference..........................................................................................................................................12 Creditor Reference................................................................................................................................ 12
Layout rules for the payment part with Swiss QR Code and receipt ..................................13 The basics............................................................................................................................................... 13 Correspondence language .................................................................................................................. 13 Paper format and quality.....................................................................................................................14 Fonts and font sizes.............................................................................................................................. 14 Sections of the payment part .............................................................................................................. 15 Title section............................................................................................................................................15 Swiss QR Code section ......................................................................................................................... 15 Amount section ..................................................................................................................................... 15 Information section .............................................................................................................................. 16 Further information section ................................................................................................................ 17 Sections of the receipt.......................................................................................................................... 18 Title section............................................................................................................................................18 Information section .............................................................................................................................. 19 Amount section ..................................................................................................................................... 20 Acceptance point section ..................................................................................................................... 20 Notes about the QR-bill in PDF format .............................................................................................. 21
Swiss QR Code database..........................................................................................................22 In general...............................................................................................................................................22 Technical specifications ....................................................................................................................... 22 Character set ......................................................................................................................................... 22 Field lengths .......................................................................................................................................... 22 Separator element ................................................................................................................................ 22 Delivery of the data elements ............................................................................................................. 22

Swiss Implementation Guidelines QR-bill

Table of contents

4.2.5

Data groups ...........................................................................................................................................23

4.3 4.3.1 4.3.2 4.3.3

Data structure .......................................................................................................................................23 Depiction conventions..........................................................................................................................23 Permitted characters in the field definitions ....................................................................................24 Data elements in the QR-bill................................................................................................................25

4.4 4.4.1 4.4.2 4.4.3 4.4.4

Technical specifications........................................................................................................................31 Use of address information.................................................................................................................31 Customer references............................................................................................................................32 Additional information .........................................................................................................................32 Alternative schemes .............................................................................................................................33

5

Parameters for generating the Swiss QR Code .................................................................... 34

5.1

Error correction level............................................................................................................................34

5.2

Maximum data range and QR code version .....................................................................................34

5.3

Minimum module size..........................................................................................................................34

5.4 5.4.1 5.4.2 5.4.3

Measurements of the Swiss QR Code for printing ...........................................................................34 Ruhezone gemäss ISO 18004 ..............................................................................................................34 Recognition characters ........................................................................................................................35 The payment amount ...........................................................................................................................35

6

Field contents and meta data ................................................................................................ 36

6.1

Checking of field contents ...................................................................................................................36

6.2

Meta data ...............................................................................................................................................36

Annex A: Examples .................................................................................................................................. 37

Annex B: Check digit generation by Modulo 10 recursive ................................................................... 44

Annex C: Depiction of the customer reference in the ISO 20022 pain.001 payment message ......... 46

Annex D: Multilingual glossary .............................................................................................................. 49

Annex E: Guidelines for syntax definitions in the «Billing information» and «Alternative procedures» fields in the QR-bill............................................................................................ 50

Annex F: Index of tables and figures..................................................................................................... 56

Version 2.1 ­ 30.09.2019

Seite 5 von 57




1.1

Introduction to the QR-bill

The payment slips used in Switzerland go back over a hundred years and are used 100 million times a year.
The increasing regulatory requirements for payment traffic make some system modifications necessary, in particular a review of data management. Payment traffic must also take account of digital structural changes in business and society, without forgetting those groups of the population who make payments over the post office counter or by post.
The QR-bill is replacing the existing multiplicity of payment slips in Switzerland and so is helping to increase efficiency and simplify payment traffic, at the same time offering a way of dealing with the challenges presented by digitalisation and regulation.
The following illustration shows a schematic basic process in the Swiss payment traffic based on a QR-bill. Its purpose is to outline synchronized scopes of application of various Implementation Guidelines and business rules:

Figure 1:

Basic process

This basic process is intended for basic understanding and does not represent any complete presentation of all possible constellations. There are also other use cases which vary slightly from it (e.g. where the payer and the debtor are different; the

Swiss Implementation Guidelines QR-bill

Introduction

payment part with receipt is used for a donation; debtor is unknown when the payment is set up). We will not go into those any further here.
The basic process comprises the following steps: the biller generates a QR-bill with a payment part and receipt and sends it to the bill recipient. It is usually sent on paper or digitally as a PDF document. The bill recipient (who in this case is also the debtor) can now trigger the payment using various payment channels, for example:  M-banking  E-banking  Paper payment instruction sent to their bank  Cash inpayment at post office counter (branches and branches with a partner
company)  Entering a payment order in their institution's own infrastructure (e.g. ERP
software) The data contained in the QR-code serves as an aid in filling in the data so that no manual entries are required. Alternatively, data can be entered manually based on the textual information.
Complying with the requirements stated in this document will ensure that payments sent via any payment channel can be executed reliably.
In addition to various Swiss Implementation Guidelines governing customer-bank data exchange based on the ISO 20022 standard (e.g. for credit transfers, cash management), the following documents are also relevant to QR-bills:  Style Guide QR-bill (summary of layout rules from this document)  Processing rules for QR-bills (Business Rules)  Technical information about the QR-IID and QR-IBAN  Bank Master (list of IIDs and QR IIDs of banks)
The «Processing rules for QR-bills» describe the relevant technical processing stages. The «Technical information on the QR-IID and QR-IBAN» provides detailed information about the use of the QR-IBAN based on a QR-IID.

1.2

Change ownership


Introduction

Swiss Implementation Guidelines QR-bill

1.3

Versioning of the Swiss Implementation Guidelines QR-bill

The main versions place the versioning counter in the first position. (Version 1.0; Version 2.0). Main versions can either have an impact on the data structure, the content or on the design recommendations, and generally require technical adaptations.
Subversions (Version 1.1; Version 1.11) generally do not require any technical adaptations.
The version must be depicted in the data structure (for details see 4.3 «Data structure», «Version» element).

1.4

Reference documents

Ref Document/schema [1] ISO 18004
[2] pain.001.001.03 [3] pain.001.001.03.ch.02
[4] Style Guide [5] Processing rules [6] QR-IID; QR-IBAN [7] Bank Master
Table 1:

Title ISO 18004 Third Edition of 2015-02-01 (Information technology ­ Automatic identification and data capture techniques ­ QR Code bar code symbology specification) XML Schema Customer Credit Transfer Initiation V03 Swiss Implementation Guidelines for customer-bank messages for credit transfers in payment traffic Layout rules and recommendations for QR-bills Processing rules for QR-bills (Business Rules)
Technical information about the QR-IID and QR-IBAN List of IIDs and QR IIDs of banks
Reference documents

Source ISO
ISO SIX
SIX SIX SIX SIX

Organisation ISO SIX
Harmonization of Swiss payments
Table 2:

Link www.iso20022.org www.iso-payments.ch www.sepa.ch www.six-group.com/interbank-clearing www.PaymentStandards.CH
Links to the relevant Internet pages

6

Field contents and meta data

The following rules apply for payment instructions to financial institutions as well as to payments at post office counters (branches and branches with partner organisations). They relate to their solutions for reading from the Swiss QR Code and further processing. This especially applies for scanning solutions (physical payment instructions) as well as for mobile end devices (M-banking). Producers of software solutions must adhere to these rules in order to enable smooth processing.

6.1

Checking of field contents

Before the further processing of the values read from the Swiss QR Code, individual field contents that are listed in the Implementation Guidelines must be checked. This means that:
 The content must match a valid value; this applies for QRType, the version, the coding type and the currency.
 The general specifications according to part 4.2 «Technical specifications» must be adhered to.
 The value must be syntactically correct; this applies for the amount (if entered).
 The permitted combinations of account with reference type (IBAN only with «SCOR» [Creditor Reference] or «NON» [optional free text information]; QR-IBAN with «QRR» [QR reference]) must be used.

6.2

Meta data

The following elements from the Swiss QR Code (data group header) will never be forwarded with the payment:  QRType  Version  Coding Type

Swiss Implementation Guidelines QR-bill

Annex A

Annex A: Examples

The QR-bills shown in the following examples are schematic and not drawn to scale. The exact depictions are published in the Style Guide [4].
The following abbreviations and symbols are used in the examples below:

¶

= CR + LF

CR = UCR =

Creditor Ultimate creditor

UD = APn =

Ultimate debtor Alternative scheme n

Note: Instead of the character string CR + LF, the character LF can be used alone.
This group must not be filled in at present, because it is intended for future use.

Table 9:

Abbreviations used in the examples

Figure 13: Example of a QR-bill (schematic, not true to scale)

Version 2.1 ­ 30.09.2019

Page 37 of 57

Annex A

Swiss Implementation Guidelines QR-bill

Data example for the QR code with two additional schemes and Billing information

Element as described in part 4.3 Data structure (partially shortened) QRType Version Coding Type Account CR ­ AdressTyp CR ­ Name CR ­ Street or address line 1 CR ­ Building number or address line 2 CR ­ Postal code CR ­ City CR ­ Country UCR ­ AdressTyp UCR ­ Name UCR - Street or address line 1 UCR ­ Building number or address line 2 UCR ­ Postal code UCR ­ City UCR ­ Country Amount Currency UD­ AdressTyp UD­ Name UD­ Street or address line 1 UD­ Building number or address line 2 UD­ Postal code UD­ City UD­ Country Reference type Reference Unstructured message Trailer

Filling
SPC¶ 0200¶ 1¶ CH4431999123000889012¶ S¶ Robert Schneider AG¶ Rue du Lac¶ 1268¶
2501¶ Biel¶ CH¶ ¶ ¶ ¶ ¶
¶ ¶ ¶ 1949.75¶ CHF¶ S¶ Pia-Maria Rutschmann-Schnyder¶ Grosse Marktgasse¶ 28¶
9400¶ Rorschach¶ CH¶ QRR¶ 210000000003139471430009017¶ Order of 15 June 2020¶ EPD¶

Swiss Implementation Guidelines QR-bill

Annex A

Element as described in part 4.3 Data structure (partially shortened) Billing information
AV1 ­ Parameters AV2 ­ Parameters

Filling
//S1/10/10201409/11/200701/20/140.00053/30/102673831/31/200615/32/7.7/33/7.7:139.40/ 40/0:30¶ Name AV1: UV;UltraPay005;12345¶ Name AV2: XY;XYService;54321

Table 10:

Data for QR code, example 1

Figure 14: Payment part, example 1 (schematic, not true to scale)

Version 2.1 ­ 30.09.2019

Page 39 of 57

Annex A

Swiss Implementation Guidelines QR-bill

Data example for QR code without amount (e.g. donation) and without debtor

Element as described in part 4.3 Data structure (partially shortened) QRType Version Coding Type Account CR ­ AdressTyp CR ­ Name CR ­ Street or address line 1 CR ­ Building number or address line 2 CR ­ Postal code CR ­ City CR ­ Country UCR ­ AdressTyp UCR ­ Name UCR - Street or address line 1 UCR ­ Building number or address line 2 UCR ­ Postal code UCR ­ City UCR ­ Country Amount Currency UD­ AdressTyp UD­ Name UD­ Street or address line 1 UD­ Building number or address line 2 UD­ Postal code UD­ City UD­ Country Reference type Reference Unstructured message Trailer

Filling
SPC¶ 0200¶ 1¶ CH5204835012345671000¶ S Better World Trust¶ P.O. Box¶
¶
3001¶ Bern¶ CH¶ ¶ ¶ ¶
¶
¶ ¶ ¶ ¶ CHF¶ ¶ ¶ ¶
¶
¶ ¶ ¶ NON¶ ¶ ¶ EPD

Swiss Implementation Guidelines QR-bill

Element as described in part 4.3 Data structure (partially shortened)
Billing information
AV1 ­ Parameters
AV2 ­ Parameters

Filling ¶

Table 11:

Data for QR code, example 2

Annex A

Figure 15: Payment part, example 2 (schematic, not true to scale)

Version 2.1 ­ 30.09.2019

Page 41 of 57

Annex A

Swiss Implementation Guidelines QR-bill

Data example for QR code with structured reference without additional information and without alternative scheme

Element as described in part 4.3 Data structure (partially shortened) QRType Version Coding Type Account CR ­ AdressTyp CR ­ Name CR ­ Street or address line 1 CR ­ Building number or address line 2 CR ­ Postal code CR ­ City CR ­ Country UCR ­ AdressTyp UCR ­ Name UCR - Street or address line 1 UCR ­ Building number or address line 2 UCR ­ Postal code UCR ­ City UCR ­ Country Amount Currency UD­ AdressTyp UD­ Name UD­ Street or address line 1 UD­ Building number or address line 2 UD­ Postal code UD­ City UD­ Country Reference type Reference Unstructured message Trailer

Filling
SPC¶ 0200¶ 1¶ CH5800791123000889012¶ S¶ Robert Schneider AG¶ Rue du Lac¶
1268¶
2501¶ Biel¶ CH¶ ¶ ¶ ¶
¶
¶ ¶ CH¶ 199.95¶ CHF¶ K¶ Pia-Maria Rutschmann-Schnyder¶ Grosse Marktgasse 28¶
9400 Rorschach ¶
¶ ¶ CH¶ SCOR¶ RF18539007547034¶
EPD

Swiss Implementation Guidelines QR-bill

Element as described in part 4.3 Data structure (partially shortened)
Billing information
AV1 ­ Parameters
AV2 ­ Parameters

Filling ¶

Table 12:

Data for QR code, example 3

Annex A

Figure 16: Payment part, example 3 (schematic, not true to scale)

Version 2.1 ­ 30.09.2019

Page 43 of 57

Annex B

Swiss Implementation Guidelines QR-bill

Annex B: Check digit generation by Modulo 10 recursive
The QR reference consists of 27 positions and is numerical. The last position (on the right) is occupied by a check digit (P).
The use of check digit generation in the reference prevents errors in the order entry by the debtor.
Modulo 10 recursive must be used to generate the check digit. The recursive schema for calculating the QR reference consists of using Modulo10 to keep separating off the next digit of the 26 digit reference until the number only consists of one digit.
The sequence of numbers to be checked is processed from left to right. For the first digit the carry-forward = 0.
The number to be checked corresponds to the column number, and the carryforward to the line number in the table. The combined value of both produces the carry-forward for the next digit in the sequence.

Figure 17: Check digit matrix

Swiss Implementation Guidelines QR-bill

Annex B

Example
Input: Sequence of digits 21000000000313947143000901 (positions 1 to 26 of the 27-digit QR reference)
Rules  Commence with carry-over 0
and combine with 1st digit of row 2, resulting in a value or carry-over of 4  Carry-over 4 combined with 2nd digit of row 1 results in a combination or carry-over of 2
etc.
 Carry-over 7 combined with last digit of row 1 results in a combination or carry-over of 3
 The value in the last column in the extension of carry-over 3 is the check digit = 7

Figure 18: Check digit calculation example
Output: Sequence of digits 21 00000 00003 13947 14300 09017 (positions 1 to 27 of the 27-digit QR reference)

Version 2.1 ­ 30.09.2019

Page 45 of 57

Annex C

Swiss Implementation Guidelines QR-bill

Annex C: Depiction of the customer reference in the ISO 20022 pain.001 payment message
The above-listed options for the provision of a customer reference are to be delivered when generating a pain.001 payment message as follows:
Scheme with structured reference without additional information

Figure 19:

pain.001 ­ Scheme with structured reference without additional information

QR element/Content
Reference
QR reference (presupposes the use of the QR-IBAN) or Creditor Reference (ISO 11649; presupposes the use of an IBAN)

pain.001 element RmtInf/Strd/CdtrRefInf/Ref

pain.001 element content
Structured reference (QRR, SCOR)

Table 13:

Structured reference in pain.001

Swiss Implementation Guidelines QR-bill

Annex C

Scheme with structured reference with additional information

Figure 20: pain.001 ­ Scheme with structured reference with additional information

QR element/Content
Reference
QR reference (presupposes the use of the QR-IBAN) or Creditor Reference (ISO 11649; presupposes the use of an IBAN)
Unstructured message

pain.001 element RmtInf/Strd/CdtrRefInf/Ref
RmtInf/Strd/AddtlRmtInf

pain.001 element content Structured reference (QRR, SCOR)
Messages

Table 14:

Structured reference with additional information in pain.001

Version 2.1 ­ 30.09.2019

Page 47 of 57

Annex C

Scheme with message

Swiss Implementation Guidelines QR-bill

Figure 21: pain.001 ­ Scheme with message

QR element/Content Unstructured message

pain.001 element RmtInf/Ustrd

pain.001 element content Messages

Table 15:

Biller's additional information in pain.001

Swiss Implementation Guidelines QR-bill

Annex D

Annex D: Multilingual glossary

Terms for use in the payment part of a QR-bill

German

French

Heading

Zahlteil

Section paiement

Empfangsschein

Récépissé

Name of field

Konto / Zahlbar an

Compte / Payable à

Referenz

Référence

Zusätzliche Informationen

Informations supplémentaires

Zahlbar durch

Payable par

Zahlbar durch (Name/Adresse)

Payable par (nom/adresse)

Währung

Monnaie

Betrag

Montant

Annahmestelle

Point de dépôt

Hints

Vor der Einzahlung abzutrennen

A détacher avant le versement

Ultimate Creditor (Future Use)

Zugunsten

En faveur de

Italian
Sezione pagamento Ricevuta
Conto / Pagabile a Riferimento Informazioni supplementari Pagabile da Pagabile da (nome/indirizzo) Valuta Importo Punto di accettazione
Da staccare prima del versamento
A favore di

Table 16:

Multilingual headings in the payment part

General terms of the QR-bill

English
Payment part Receipt
Account / Payable to Reference Additional information
Payable by Payable by (name/address) Currency Amount Acceptance point
Separate before paying in
In favour of

German QR-Rechnung QR-Referenz QR-IID QR-IBAN Rechnungsinformationen Alternative Verfahren
Table 17:

French QR-facture Référence QR QR-IID QR-IBAN Informations de facture Procédures alternatives
General terms

English QR-bill QR reference QR-IID QR-IBAN Billing information Alternative procedures

Version 2.1 ­ 30.09.2019

Page 49 of 57

Annex E

Swiss Implementation Guidelines QR-bill

Annex E: Guidelines for syntax definitions in the «Billing information» and «Alternative procedures» fields in the QR-bill

The field «Billing information» supports automation of debtor's accounts payable. A user group interested in using the field, e.g. a business sector, may add here the information of creditor on the invoice, such as VAT number, VAT amount, date on which the service was provided, etc. The definition of structure and data content is, with few restrictions, at the discretion of the relevant user group.
The «Alternative procedures» field contains information necessary to convert a QR-bill into another procedure (e.g. eBill: Requires an e-mail address of the debtor). The definition of structure and data content is, with few restrictions, at the discretion of the relevant service provider.
Target groups
This guide is dedicated to invoice senders and recipients as well as their industry associations which want to use the «Billing information» field in the QR-bill. The description of the «Alternative procedures» field is dedicated to service providers in the Swiss payment traffic which convert the QR-bills into a form wished by their customers.

Purpose
This guide describes the process for defining, implementing and invalidating syntax definitions for the «Billing information» and «Alternative procedures» fields.

Delimitation
The specifications of relevant fields are to be found in the main section of the Implementation Guidelines for the QR-bill (cf. Chapter 4.4). This process description is limited to the presentation of the syntax definition life cycle.

Syntax definition life cycle

Tasks to be carried out by the interested users (groups).

1. Creating and implementing

# Process step 1 Start

Pertaining to the field «Billing information»
User group: Identification of needs and coordination within the user group (e.g. business sector)

Pertaining to the field «Alternative procedures» Service provider: Clarification of customer needs

Swiss Implementation Guidelines QR-bill

Annex E

2 Determination of the document owner
3 Identification of necessary information
4 Creation of syntax or guidance
5 Validation of syntax
6 Implementation and publication

To be determined by the user group (normally it is an industry association providing central services to its members)

Service provider which offers the alternative procedure

Document owner:

Determination of contents, scope and technical structure of information which are necessary in addition to the data already available in the database of the QR code.

Definition by the document owner, if need be with support of SIX.

Contact: billing-payments.pm@six-group.com

Document owner:

Making contact with SIX. Contact: billing-payments.pm@six-group.com

SIX:

Review of compliance with technical guidelines (field length, character set, etc.)

Document owner:

Implementation and providing information to the user group

SIX:

Information and link on PaymentStandards.ch

Table 18:

Process for implementing the «Billing information» and «Alternative procedures» fields

2. Version changes

# Process step 1 Creation of syntax or
guidance draft 2 Validation of syntax
3 Implementation and publication

Pertaining to the field

Pertaining to the field

«Billing information»

«Alternative procedures»

By the document owner, if need be with support of SIX.

Contact: billing-payments.pm@six-group.com

Document owner:

Making contact with SIX. Contact: billing-payments.pm@six-group.com

SIX:

Review of compliance with technical guidelines (field length, character set, etc.)

Document owner:

Implementation and providing information to the user group

SIX:

Information and link on PaymentStandards.ch

Table 19:

Process for version changes of the «Billing information» and «Alternative procedures» fields

Version 2.1 ­ 30.09.2019

Page 51 of 57

Annex E

Swiss Implementation Guidelines QR-bill

3. Invalidation

# Process step
1 Invalidation and providing information

Pertaining to the field

Pertaining to the field

«Billing information»

«Alternative procedures»

Document owner:

Invalidation and providing information to the user group

SIX:

Removing the link from PaymentStandards.ch

Table 20:

Process for invalidating the «Billing information» and «Alternative procedures» fields

Notes:
 Applicable Syntax definitions for billing information as well as for alternative procedures are available on www.PaymentStandards.CH.
 At the time of publication of these Implementation Guidelines, only Swico has published «Recommendations on the structure of information from the invoice sender for QR-bills».
Example: Syntax definition for the Billing Information of Swico (as of 30 September 2019)

Syntax definition of Swico (Version 1.2) for filling in the «Billing information» field in the Swiss QR code and QR-bill payment part. This description corresponds to the current state as of the implementation date of Implementation Guidelines in Version 2.1 and has been included only as an example. It has to be taken into account that it may not represent the most current version. The latest version can be found at www.swico.ch.

Area Separator Prefix
Voucher number Voucher date Customer reference VAT number
VAT date
VAT details

Tag What

// S1
/10/

Organisation identifier
Bill number

Examples of values // S1
/10/10201409

Comments
Fix «//» Fixed for syntax defini-tion by Swico in Version 1.x Free text

/11/ /20/

Voucher date Customer reference

/11/190512 /20/140.000-53

12.05.2019 Free text

/30/
/31/ /32/

UID number

/30/106017086

Date or start and end date of the service
Rate for calcula-tion or list of rates with

/31/180508 /31/181001190131 /32/7.7 /32/8:1000;2.5:51.8

UID CHE-106.017.086 without the CHE prefix, separator and without MWST/TVA/IVA/VAT suffix
08.05.2018 01.10.2018 bis 31.01.2019
7.7% for the total amount
8.0% on 1000.00, 2.5% on 51.80

Swiss Implementation Guidelines QR-bill

Annex E

Area

Tag

VAT import tax /33/

Conditions

/40/

What
correspond-ing net amounts Pure VAT amount or a list of pure VAT amounts and respective rates for import
Conditions or list of conditions

Examples of values
0;7.7:250

Comments and 7.7% on 250.00

/33/7.7:16.15 /33/7.7:48.37;2.5:12 .4
/40/0:30 /40/2:10;0:60 /40/3:15;0.5:45;0:90

16.15 pure VAT (7.7% rate) where goods are imported 48.37 pure VAT (7.7% rate) and 12.40 pure VAT (2.5% rate) where goods are imported with many rates
0% discount for 30 days (payable within 30 days from the voucher date) 2% discount for 10 days, 0% for 60 days 3% discount for 15 days, 0.5% for 45 days, 0% for 90 days

Table 21:

Data elements in the field Billing information, example of Swico

Rules The separators // are prescribed by SIX. They are intended to identify the beginning of billing information (structured information for the invoice sender) when it is printed on the visible part. The /nn/ tags must be filled in in ascending order. Each tag may only be given once. A tag with no data can be omitted. A tag with no data is the equivalent of an omitted tag. The length of the value for any tag is not directly limited. The «Unstructured message» and «Structured information from the biller» fields must not contain more than 140 characters in total. Field content may not contain the characters «/» and «\»; these must be replaced by «\/» and «\\» (Escape). An amount or a percentage with decimal places must use the character «.» (full stop) as the separator. Numbers smaller than 1 are presented with a leading zero (e.g. «0.3»). Dates are formatted as YYMMDD (year, month, day). Fields including more than one data element in a list use the character «;» (semicolon) as a separator.

Table 22:

Rules for the field Billing information, example of Swico

Information such as amount and currency is contained in dedicated fields in the data set of the QR code, so it is not sent in the «Billing information ».
Fields /11/  The voucher date is the same as the date of the invoice; it is used as the reference date for
the terms and conditions.  Together with the field /40/0:n, a maturity date of the invoice can be calculated (payable
within n days after the voucher date). /20/  The customer reference is a reference sent by the customer and is used to identify the bill.

Version 2.1 ­ 30.09.2019

Page 53 of 57

Annex E

Swiss Implementation Guidelines QR-bill

/30/  The VAT number is the same as the numerical UID of the service provider (without the CHE prefix, separator and VAT suffix).
 The VAT number can be used by the bill recipient to identify the biller unambiguously. All billers who have a UID should enter it here, even if the other VAT fields are omitted.
 For a bill with more than one VAT number, the first should be entered.
/31/  The VAT date can either be the date on which the service was provided or the start and end date of the service (e.g. for a subscription).
 If the document refers to several services with different dates of delivery, the /31/ field must be omitted (enter manually).
/32/  The VAT details refer to the invoiced amount, excluding any discount.  VAT details contain either: ­ a single percentage that is to be applied to the whole invoiced amount or ­ a list of the VAT amounts, defined by a percentage rate and a net amount; the colon «:» is used as the separator.  The net amount is the net price (excluding VAT) on which the VAT is calculated.  If a list is given, the total of the net amounts and the VAT calculated on them must correspond to the amount in the QR Code.
/33/  Where goods are imported, the import tax can be entered in this field. The amount is the VAT amount.
 The rate serves correct recording of VAT in the accounts.  This makes it easier for the bill recipient to record the VAT in the case of an import.
/40/  The terms and conditions may refer to a discount or list of discounts.  The voucher date /11/ counts as the reference date.  Each discount is defined by a percentage and a deadline (in days); the colon «:» is used as the separator.  The indication with a percentage rate equal to zero defines the default payment date of the invoice (e.g. «0:30» for 30 days net). Attention: when this day is used, at least the default payment date of the invoice should be indicated. Without this indication, the payment software will not be able to suggest any date for the payment.

Table 23:

Description of the field Billing information, example of Swico

Examples
Example 1
//S1/10/10201409/11/190512/20/1400.000-53/30/106017086/31/180508/32/7.7/40/2:10;0:30
/10/ Invoice number 10201409 /11/ Invoice date 12.05.2019 /20/ Customer reference 1400.000-53 /30/ VAT number CHE-106.017.086 MWST /31/ VAT date on which the service was provided 08.05.2018 /32/ VAT rate on the total invoice amount 7.7% /40/ 2% discount for 10 days, payment date of 30 days

Swiss Implementation Guidelines QR-bill

Annex E

Example 2
//S1/10/10104/11/180228/30/395856455/31/180226180227/32/3.7:400.19;7.7:553.39;0:14/40/0:30
/10/ Invoice number 10104 /11/ Invoice date 28.02.2018 /30/ VAT number CHE-395.856.455 MWST /31/ VAT date on which the service was provided from 26.02.2018 until 27.02.2018 /32/ VAT rate 3.7% on 400.19 net (415.00 gross)
VAT rate 7.7% on 553.39 net (596.00 gross) VAT rate 0% on 14.00 net (14.00 gross) The VAT details yield a total amount for the invoice equal to (400.19+14.81) + (553.39+42.61) + (14.00+0.00) = 1025.00 /40/ payment date of 30 days Example 3
//S1/10/4031202511/11/180107/20/61257233.4/30/105493567/32/8:49.82/33/2.5:14.85/40/0:30
/10/ Invoice number 4031202511 /11/ Invoice date 07.01.2018 /20/ Customer reference 61257233.4 /30/ VAT number CHE-105.493.567 MWST /32/ VAT rate 8% on 49.82 net (53.80 gross) /33/ Pure VAT for import of 14.85, VAT rate 2.5%
The VAT details yield a total amount for the invoice equal to (49.82+3.98) + (14.85) = 68.65 /40/ payment date of 30 days Example 4
//S1/10/X.66711\/8824/11/200712/20/MW-2020-04/30/107978798/32/2.5:117.22/40/3:5;1.5:20;1:40;0:60
/10/ Invoice number X.66711/8824 /11/ Invoice date 12.07.2020 /20/ Customer reference MW-2020-04 /30/ VAT number CHE-107.978.798 MWST /32/ VAT rate 2.5% on 117.22 net (120.15 gross)
The VAT details yield a total amount for the invoice equal to (117.22+2.93) = 120.15 /40/ 3.0% discount for 5 days
1.5% discount for 20 days 1.0% discount for 40 days payment date of 60 days

Table 24:

Billing information Swico, examples

Version 2.1 ­ 30.09.2019

Page 55 of 57

Annex F

Swiss Implementation Guidelines QR-bill

Annex F: Index of tables and figures

Index of Tables

Table 1: Table 2: Table 3: Table 4: Table 5: Table 6: Table 7: Table 8: Table 9: Table 10: Table 11: Table 12: Table 13: Table 14: Table 15: Table 16: Table 17: Table 18:
Table 19:
Table 20:
Table 21: Table 22: Table 23: Table 24:

Reference documents ..................................................................................................................... 8 Links to the relevant Internet pages............................................................................................. 8 Headings of the payment part in the information section...................................................... 17 Headings of the payment part in the information section ...................................................... 19 Status of the elements .................................................................................................................. 24 Characters permitted .................................................................................................................... 24 Swiss QR Code data elements ..................................................................................................... 30 Examples of how to use address information...........................................................................31 Abbreviations used in the examples........................................................................................... 37 Data for QR code, example 1 ....................................................................................................... 39 Data for QR code, example 2 ....................................................................................................... 41 Data for QR code, example 3 ....................................................................................................... 43 Structured reference in pain.001................................................................................................. 46 Structured reference with additional information in pain.001 ............................................... 47 Biller's additional information in pain.001.................................................................................48 Multilingual headings in the payment part ............................................................................... 49 General terms ................................................................................................................................ 49 Process for implementing the «Billing information» and «Alternative procedures» fields ................................................................................................................................................ 51 Process for version changes of the «Billing information» and «Alternative procedures» fields ......................................................................................................................... 51 Process for invalidating the «Billing information» and «Alternative procedures» fields ................................................................................................................................................ 52 Data elements in the field Billing information, example of Swico ......................................... 53 Rules for the field Billing information, example of Swico ........................................................ 53 Description of the field Billing information, example of Swico...............................................54 Billing information Swico, examples........................................................................................... 55

Swiss Implementation Guidelines QR-bill

Annex F

Index of figures

Figure 1: Figure 2:
Figure 3: Figure 4: Figure 5: Figure 6: Figure 7: Figure 8: Figure 9: Figure 10: Figure 11: Figure 12: Figure 13: Figure 14: Figure 15: Figure 16: Figure 17: Figure 18: Figure 19: Figure 20: Figure 21:

Basic process ....................................................................................................................................6 Schematic depiction of a QR-bill with integrated payment part/receipt and with payment part/receipt as an enclosure ..........................................................................................................9 Swiss QR Code ................................................................................................................................10 Schematic illustration of the payment part of a QR-bill ...........................................................15 Schematic depiction of the amount section ..............................................................................16 Schematic depiction of the information section .......................................................................17 Schematic depiction of the receipt for the payment part of a QR-bill ...................................18 Schematic depiction of the information section on the receipt of a QR-bill .........................19 Schematic depiction of the receipt of a QR-bill .........................................................................20 Data group with technical element name and technical name for the payment part ........24 Scaling of the Swiss QR Code to fixed sizes ...............................................................................34 Swiss QR Code with Swiss cross as recognition feature (not true to scale) ..........................35 Example of a QR-bill (schematic, not true to scale) ..................................................................37 Payment part, example 1 (schematic, not true to scale) .........................................................39 Payment part, example 2 (schematic, not true to scale) .........................................................41 Payment part, example 3 (schematic, not true to scale) .........................................................43 Check digit matrix..........................................................................................................................44 Check digit calculation example ..................................................................................................45 pain.001 ­ Scheme with structured reference without additional information ...................46 pain.001 ­ Scheme with structured reference with additional information .........................47 pain.001 ­ Scheme with message................................................................................................48

Version 2.1 ­ 30.09.2019

Page 57 of 57



<!-- vim: set nospell :-->

