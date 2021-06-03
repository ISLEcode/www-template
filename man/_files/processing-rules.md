---
revision: 2020-06-04 (Thu) 21:59:28
title:    Swiss Payment Standards 2020
brief:    Processing rules for QR-bills Rules for producing and processing the payment part with Swiss QR Code and receipt
date:     Version 1.1, with effect from 29 February 2020
---

### General Note

Comments and questions about this document can be directed to the respective financial institution or to SIX at the following
address support.billing-payments\@six-group.com.

### Change control

All changes made to this document and changed or new specifications are listed in the document history with version details,
change date and a brief description of the changes made.

### Patent notice

SIX and the responsible project sponsors for the new QR-bill for the Swiss financial center have together carefully reviewed the
technical and legal framework conditions for the territory of Switzerland in consultation with specialists and are providing
corresponding specifications for a standardized QR-bill («standardization»). The usage possibilities for billing and paying a
QR-bill listed below were used as a basis:

-   Payer captures QR code using a reader or camera in e-/m-banking
-   Payer captures QR code using a reader or scanner in their own infrastructure and transmits the payment instruction
    electronically (e.g. as pain message)
-   Cash inpayment at post office counter (branches and branches with a partner company)
-   Credit transfer instruction form

Further uses of the QR-bill that are not listed, such as payment via an ATM, are also not a component of the standardization. For
the commercial technological implementation of the standardization, accepted industry solutions and measures are to be planned by
the commercial users.

### Important Notices

Third-party specifications and company-specific functionality do not form part of the standardization process. Individual
providers are responsible for finding appropriate solutions. This applies particularly to the option of embedding structural
information or content in the «Alternative procedures» fields. The «Billing information» element can be used for sending
structured information between the biller and bill recipient. The layout of the QR-bill includes a data field for this purpose.
Containers for alternative procedures are also provided in the «Alternative procedures» elements. The content and use of such data
are the responsibility of the providers of those procedures. In order for the content of the «Billing information» and
«Alternative procedures» fields to be identifiable, SIX is prescribing certain coding. This, and use of the fields at all, must be
agreed with SIX before they are published or used (for the process cf. Implementation Guidelines for the QR-bill, Annex E).

### Specifications for the QR-bill

If all the processes involved in producing and processing QR-bills are to work smoothly, the Guidelines for the QR-bill must be
observed. The Guidelines for the QR-bill are addressed primarily to the issuers of invoices, but they also apply to financial
institutions and their service providers offering their customers payments services based on the QR-bill, the developers of
software for invoice issuers and recipients and banks, and all other associated participants in the market.

In particular, the following three documents are relevant to the Guidelines for the QR-bill:

-   Technical and functional specifications for the payment section with Swiss QR Code and receipt (this document).
-   Style Guide QR-bill (summary of layout rules from this document)
-   Processing rules for QR-bills
-   Technical information about the QR-IID and QR-IBAN
-   Bank Master (list of IIDs and QR-IIDs of banks)
-   Swiss Payment Standards (Implementation Guidelines on exchanging of data between customers and banks)
-   Implementation Guidelines for Interbank Messages

Failure to comply with the Guidelines for the QR-bill may result, for example, in

-   it not being possible for the debtor and their financial institution to enter the payment.
-   it not being possible for payments to be executed by the debtor and their financial institution.
-   credits to the biller and their financial institution being booked incorrectly or not at all.
-   laws being violated (e.g. data protection).

SIX Interbank Clearing Ltd assumes no responsibility or liability for the correctness and completeness of the information
provided. Likewise, SIX Interbank Clearing Ltd does not offer advice for the specific scope of functionality for systems for using
the QR-bill, provides no control mechanisms for technical procedures and offers no guarantee and accepts no liability for the
actual mechanical or procedural implementation of the standardization process or of solutions for using and processing QR-bills.

### Support and resources

SIX makes various help resources and other support materials available without liability. Find out more at
www.PaymentStandards.CH.

### Document history

Change description

15.11.2018 First edition

15.02.2020 Corrections and clarifications, in particular:

-   Adjustment of the process for the implementation of syntax definitions for billing information and alternative procedures (no
    obligation to conclude a contract)

-   Removing Chapter 1.5 "Benefits"

-   Removing Chapter 4 "Information about the launch" and Chapter 5 "Migration" - the information on the launch or migration can
    be found in the introduction scripts on PaymentStandards.CH

-   Streamlining Chapter 7 "Processing rules" (as Chapters 4 and 5 have been deleted, it is now Chapter 5); integrating the
    Business Rules from annex

-   Correcting Business Rules No. 13 and 22 in Chapter 5.6 (Ultimate debtor: address line 1 is not mandatory) and supplementing
    Business Rule No. 5 in Chapter 5.8 (different IBAN or QR-IBAN in the Swiss QR Code compared with the visible part)

## Introduction

Target group

:   This document is intended primarily for financial institutions and their service providers offering their customers payments
    services based on the QR-bill, and for developers of software for billers and recipients and banks.

Purpose

:   The «Processing rules for QR-bills» describe the technical banking rules and associated processes for creating a QR-bill and
    processing a payment part with Swiss QR Code (referred to below as the «payment part») and receipt, including the associated
    business processes. The document specifically describes the procedures for QR-bills with QR-IBAN and QR-bills with IBAN.

### Change ownership

The document «Processing rules for QR-bills» can only be changed by

SIX Interbank Clearing Ltd Hardturmstrasse 201 P.O. Box CH-8021 Zurich

and contains the recommendations of the Swiss financial institutions. Future changes and updates will be made by SIX Interbank
Clearing Ltd.

The latest version of this document is available from the Download Center at www.PaymentStandards.CH.

### Versioning

Swiss financial institutions guarantee to support the current versions of the Pro- cessing Rules and the Implementation Guidelines
as published by SIX Interbank Clearing plus the preceding version (this does not apply to the Implementation Guidelines QRbill,
Version 1.0), i.e. always the two most recent versions in parallel. It may not always be possible to adhere to this principle for
regulatory reasons.

The published definitions will be supported by all the financial institutions as of the previously announced cut-off date.

### Reference documents

  : Table 1. Reference documents.

  --------------------------------------------------------------------------------------------------------------
   # Document                   Title                                                                   Origin
  -- -------------------------- ----------------------------------------------------------------------- --------
   1 IG QR-bill                 Swiss Implementation Guidelines QR-bill                                 SIX

   2 IG customer-bank messages  Swiss Implementation Guidelines for Customer-Bank Messages Credit       SIX
     credit transfers           Transfer (pain.001)

   3 IG customer-bank messages  Swiss Implementation Guidelines for Customer-Bank Messages (Reports)    SIX
     report                     (camt.052/.053/.054)

   4 Business Rules             Swiss Business Rules for Payments and Cash Management for Customer-Bank SIX
     customer-bank messages     Messages

   5 Syntax of Billing          “Billing information” of the invoice issuer in the “Additional          Swico
     Information                information” field of the QR-bill

   6 QR-IID; QR-IBAN            Technical information on the QR-IID and QR-IBAN for financial           SIX
                                institutions

   7 Payments Rulebook          Swiss Payments Rulebook                                                 SIX

   8 Guidance for migration     - Introduction scripts for invoice issuers and recipients\
                                - Introduction scripts for financial institutions and testing\
                                - Sample documents
  --------------------------------------------------------------------------------------------------------------


  : Table 2. Links to the relevant Internet pages.

  --------------------------------- ---------------------------------------------------------------------------
  ISO                               https://www.iso.org

  SIX Interbank Clearing            https://www.iso-payments.ch\
                                    www.six-interbank-clearing.com\
                                    https://qr-validation.iso-payments.ch

  Harmonization of Swiss payments   www.PaymentStandards.ch

  Swico                             https://www.swico.ch/fr/connaissances/normes-et-standards/factures-qr
  --------------------------------- ---------------------------------------------------------------------------

### Delimitation

The «Processing rules for QR-bills» describe the technical rules and associated processes for creating a QR-bill and processing a
payment part with Swiss QR Code and receipt as shown in Figure 1: The key parties involved and their activities in relation to
QR-bill. Consequently, this document should be read together with the «Swiss Implementation Guidelines QR-bill» document, which
defines the technical and functional specifications for the payment part with Swiss QR Code, and also with the document «Technical
information about the QR-IID and QR-IBAN for financial institutions» which contains all the technical information that banks and
software companies need in order to introduce and use the QR-IBAN based on the QR-IID, a special bank IID. In the case of any
discrepancies or contradictions between these processing rules and the specifications in the Swiss Implementation Guidelines
QR-bill, the latter take precedence. The technical and functional requirements for transfers and cash management and for interbank
messages do not form part of this document. Nor does this document describe individual services (e.g. counter payments, credit
orders, forms or notifications).

### Definition of terms

The «QR-bill» is understood to mean

-   a bill with a payment part and receipt integrated in the form (where only the for mat and quality of the paper and the
    obligation to perforate the receipt apply to the bill),

-   a bill with a separately enclosed payment part and receipt (where the Implementation Guidelines and processing rules for
    QR-bills apply only to the payment part and receipt).

The following terms and abbreviations that are used in this document are defined in the «Swiss Implementation Guidelines QR-bill»
in Section 2:

-   Payment part with Swiss QR Code and receipt
-   QR code according to ISO 18004
-   Swiss QR Code
-   QR-IID
-   IBAN
-   QR-IBAN
-   QR reference
-   Creditor Reference

## Parties Involved and Payment Process

The procedure for using QR-bills is described in the «Swiss Implementation Guidelines QR-bill».

Based on that, the following Figure 1 shows the main parties involved in the process (with the addition of Swiss Post and form
providers) and also the main activities (circled numbers) associated with the production of a QR-bill and the processing of the
payment part. For each activity it also shows the document in which the relevant rules are defined.

QR-bill and the activities involved

Figure 1: The key parties involved and their activities in relation to QR-bill

The following paragraphs describe all the parties depicted in Figure 1 and their activities.

### Form providers

Party involved
:   Providers of forms (e.g. financial institution, printers, paper suppliers).

Activity No. 1
:   Service provided to the biller for the provision of the forms.

### Biller/creditor

Party involved
:   The party issuing an invoice or making an appeal for donations.

Activity No. 2
:   Prepares and issues an invoice or an appeal for donations (either on paper or electronically, for example using eBill) based
    on the Swiss Implementation Guidelines QR-bill.

### Bill recipient/debtor

Party involved
:   The party receiving either an invoice or an appeal for donations. The party making the payment (ultimate debtor) is normally
    also the debtor.

Activity No. 3
:   The bill recipient reads the QR-bill using the scanning infra- structure and saves the data in their own infrastructure
    (e.g. the ERP system).

Activity No. 4
:   As an alternative to (3), the payment data can also be entered manually in the debtor's own infrastructure.

Activity No. 5a
:   Payments are sent from the debtor's own infrastructure in pain.001 via an electronic channel (e-banking or file transfer) to
    the debtor institution.

Activity No. 5b
:   The debtor submits a physical payment instruction to the debtor institution or their service provider.

Activity No. 5c
:   The debtor enters the payment in the debtor institution's e- or mbanking system.

### Swiss Post

Party involved
:   Swiss Post fulfils its legal public service mandate to provide payment traffic services (e.g. at the post office counter). The
    payments are processed by PostFinance.

Activity No. 5d
:   The debtor settles the invoice e.g. at the post office counter.

Activity No. 6
:   The payment part and receipt are checked.

Activity No. 8c
:   The debtor receives confirmation (a receipt or an entry in the receipts book).

### Debtor agent (DEB-FI)

Party involved
:   Manages the debtor's payment account and offers its customers payment transaction services.

Activity No. 6
:   Das ZP-FI prüft den Zahlteil.

Activity No. 7
:   The DEB-FI forwards the payment to the CR-FI.

Activity No. 8a
:   The debtor's IT system receives an electronic debit advice/ account statement from the DEB-FI in the form of a camt.05x
    message.

Activity No. 8b
:   The debtor receives a debit advice/account statement from the DEBFI (hard copy, in PDF format)

### Clearing & Settlement system provider

Party involved
:   The party offering clearing and settlement services for payments between the DEB-FI and the CR-FI.

Activity No. 9
:   The clearing and settlement system provider forwards the payment to the CR-FI.

### Creditor agent (CR-FI)

Party involved
:   Manages the creditor's payment account and offers its customers payment transaction services.

Activity No. 10
:   The CR-FI sends the creditor an electronic credit advice/account statement in the form of a camt.05x message.

Activity No. 11
:   The CR-FI sends the creditor a credit advice/account statement (hard copy, in PDF format).

### Creditor (= biller)

Party involved
:   The party being credited.

Activity No. 12
:   The creditor reconciles the credits with their unpaid items in their debtor accounts.

## Aids and tools

### Introduction scripts

The introduction scripts for invoice issuers and recipients as well as for financial institutions contain all information relevant
for a successful introduction of the QR-bill by the target groups mentioned:

-   migration of red and orange payment slips (IS/ISR) to the QR-bill,
-   checklists for project planning,
-   test cases,
-   sample payment parts.

### Validation portal for the Swiss QR Code

The validation portal (https://qr-validation.iso-payments.ch) can be used for uploading and validating text files and images to
check the quality of the content of the Swiss QR Code. The detailed results of the validation process will be produced immediately
for each file used.

### Grid for homologation

A grid sheet (PDF) for checking payment parts can be found in the Style Guide on page 24 which is available in the Download Center
at www.PaymentStandards.CH.

In particular, the grid sheet can be used to check the positioning of the Swiss QR Code on the payment part.

### QR-IIDs in the SIC/euroSIC test system

A Bank Master containing QR-IIDs is available ­ for test purposes only ­ from the Download Center at www.PaymentStandards.CH.

From summer 2019 the full SIC Platform Release 4.6 (taking effect on 16 November 2019) will be available in the SIC/euroSIC test
system. From that time, the QR-IIDs in the test system will also be activated.

The test Bank Master including QR-IIDs makes it possible to simulate the behaviour of the customer-bank interface in detail on a
test platform.

A test platform using the test Bank Master can check the conformity of generated customer-to-bank messages (validation) and
produce bank-to-customer messages (simulation) complying with Swiss processing rules and the Swiss Implementation Guidelines.

In this way it can be quickly and easily seen whether the ISO messages are being correctly formulated and the data exchange is
working from the point of view of ISO processing.

Thanks to these detailed test results and simulations of electronic statements, any possible failures in the banking and customer
software can be quickly identified and corrected.

### Download Center at Payment Standards

Publications and guidelines about the Swiss ISO 20022 payment standard and the harmonization of payment transactions are available
from the Download Center at www.PaymentStandards.CH.

## Transactions in QR-bill

The transactions distinguish between, on the one hand, creating, booking and sending notification and, on the other, paying,
booking and sending notification of a QRbill.

### Creating, booking and sending notification

#### QR-bill with QR-IBAN

Objective
:   In using the procedure with QR-IBAN and structured QR reference, the biller is trying to make automatic reconciliation of
    unpaid items (debtors) possible when payments come in by using the reference that is returned. The procedure can also be used
    for appeals for donations.

Alternative versions

:   The QR-IBAN is used in conjunction with the QR reference (previously the ISR reference number).

    The «Unstructured Message» element can be used in addition to the structured reference.

    *Note*: For the QR-bill with QR-IBAN procedure to be recognized, there must be a QRIBAN present. This requires a QR reference
    to be entered, and ensures that the reference will be sent back to the creditor. It can only be guaranteed that an additional
    message from the debtor will be forwarded to the creditor if the debtor enters one.

Booking and sending notification of incoming payments

:   Depending on the facilities of the CR-FI, incoming payments may be booked individually and/or in batches. Notification of
    credits is sent electronically in accordance with the definitions in the «Swiss Implementation Guidelines for customer-to-bank
    messages (reports)», on paper or as a PDF file.

    -   Notification of incoming payments from QR-bills will be sent electronically in a bank-to-customer camt.05x message
        complying with the ISO 20022 standard.

    -   Notification using the ISR credit record Type 3 is not possible for incoming payments from QR-bills with a QR-IBAN and QR
        reference.

    -   Notification of incoming payments from orange payment slips and incoming payments from payment parts with a QR-IBAN and QR
        reference can be sent using separate credit advice notes.

    -   Notification of incoming payments from QR-bills with IBAN and Creditor Reference will be delivered by financial
        institutions in accordance with their facilities to do so.

    -   Notification on paper will still be possible.

#### QR-bill with IBAN

Objective
:   By using the procedure with IBAN, the biller is trying to manage his debtors. The procedure can also be used for appeals for
    donations.

Alternative versions

:   When an IBAN is used, the following two alternatives are possible:

    -   The IBAN is used in conjunction with the Creditor Reference, with or without the «Unstructured message» element
    -   The IBAN without reference is used in conjunction with or without the "Unstructured message" element

    *Note*: It can only be guaranteed that the Creditor Reference and/or the unstructured message from the debtor will be
    forwarded to the creditor if the debtor enters them.

Booking and giving notification of incoming payments
:   Depending on the facilities of the CR-FI, incoming payments may be booked individually and/or in batches. Notification of
    credits is sent electronically in accordance with the definitions in the «Swiss Implementation Guidelines for customer-to-bank
    messages (reports)», on paper or as a PDF file.

### Recording Payment Order

Physical payment order, unstructured
:   The physical payment order, unstructured, includes those payment orders which customers place or submit perhaps by visiting
    the bank or sending a letter.

Physical payment order, structured
:   The physical payment order, structured, makes it easy to reconcile payments with payment parts.

E-banking
:   E-banking can be used to enter and authorise individual payments and standing orders. Data files can be uploaded in the
    pain.001 message (Upload).

M-banking
:   M-banking apps enable transfers to be made on the basis of a payment part.

File transfer
:   Payment Connectivity Services are integrated payment transaction solutions for corporate customers and businesses. They enable
    file transfer between accounting or cash management applications and the financial institution operating the account. Data
    files can be uploaded in the pain.001 message (Upload).

Booking and sending notification of debits
:   Depending on the facilities of the CR-FI, debits may be booked individually and/or in batches. Notification of debits is sent
    either electronically in accordance with the definitions in the «Swiss Implementation Guidelines for customer-to-bank messages
    (reports)», on paper or as a PDF file.

## Processing rules

### Procedure with QR-IBAN

The procedure with QR-IBAN may only be used by agreement with the CR-FI. Where the bill is issued with a QR reference, a QR-IBAN
must be used to indicate the account to be credited. When a payment is received from a QR-bill with QR reference, the QR-IBAN
should be used as the basis for crediting the relevant customer account. Billers who use QR-bill and want electronic notification
must be able to process camt messages. When payments are received from payment parts with a structured reference, or from orange
payment slips, notification can be sent both in the same camt message and separately in a camt message/V11 file.

#### Continued use of the BISR-ID

The customer identification in the first six positions in the reference (formerly BISR customer identification) will no longer be
key to identifying the creditor's account. This means that the reference can be entirely filled in by the biller, apart from the
check digit. The BISR-ID (usually 6-digit) can still be used when issuing bills. This means that banks' individual structuring and
use of the reference can either continue as it is or be started afresh. Billers can also use other forms of identification number
by agreement with their financial institutions.

#### ISR participation numbers

PostFinance customers (not banks) with one or more ISR participation numbers (amended as described in Section 5.3) can continue to
use these with QR-bill.

### Procedure with IBAN

An IBAN must be used if the QR-bill is to be used for invoicing in the versions "with Creditor Reference" or "without reference".

### Procedural and processing rules

The following binding procedural and processing rules relating to the QR code payment part are described as follows: Reading the
Swiss QR Code and manually entered content from the visible part Layout rules and recommendations Comparing data between the
scanned Swiss QR Code and the visible part Manual post-recording

### Data sharing

Processing obligations and the binding nature of documentation are described in the Swiss Payments Rulebook in paragraph 1.8.2.

### Inpayments at physical access points of Swiss Post

#### Fees for inpayments and processing payment parts

Current prices are listed at www.postfinance.ch.

#### Blank payment parts/substitute payment slips

As at least the creditor and other information must be precaptured in a QR-bill payment part, the banks or post may not issue
blank payment parts.

### Reading the Swiss QR Code and manually entered content from the visible part

The following table lists the processing rules that apply when scanning the Swiss QR Code and if necessary manually filling in the
content of the «Amount» and «Payable by» fields. The rules apply to the channels used by financial institutions (physical
processing and m-banking). For debtor solutions, rules/recommendations are only listed where necessary. The following table
describes and defines the standard. More liberal or more restrictive applications may also be defined.

  : Table 3. Reading the Swiss QR Code & manually entered content from the visible part.

  -----------------------------------------------------------------------------------------------------------------------------
   # Description of fault/error                                                 Physical        M-banking       Debtor's
                                                                                payment^(a)^    solutions^(b)^  infrastructure^(c)^
  -- -------------------------------------------------------------------------- --------------- --------------- ---------------
   1 Swiss QR Code is not recognized (e.g. outside the tolerance for error)     no              no              n/a

   2 Sequence within the Swiss QR Code does not comply with IG on QR-bill       no              no              n/a

   3 Maximum field lengths do not comply with IG on QR-bill                     no              no              n/a

   4 QRType is invalid (no fixed value «SPC» for the Swiss Payments Code)       no              no              n/a

   5 Version is invalid (e.g. no «0200» for Version 2.0)                        no              no              n/a

   6 Coding Type invalid (no fixed value «1» for Latin Character Set)           no              no              n/a

   7 Content of the fields in the Swiss QR Code does not comply with the        no              no              n/a
     permitted characters (see IG QR-bill paragraph. 4.3.2, Table 5)

   8 IBAN (incl. QR-IBAN) for the creditor is invalid (validation of            no              no              n/a
     structure and check digit)

   9 IBAN (incl. QR-IBAN) for the creditor is missing                           no              no              n/a

  10 IBAN (here only QR-IBAN) is missing where there is a QR reference          no              no              n/a

  11 Creditor address type is invalid (not «S» or «K»)/or missing               no              no              n/a


  12 Compulsory creditor data for address type «S»-structured address           no              no              n/a
    (name, postcode, location, country) is missing


  13 Compulsory creditor data for address type «K»-combined address             no              no              n/a
     (name, country) is missing

  14 Creditor data for address type «K»-combined address (postcode,             no              no              n/a
     location) has been filled in


  15 Field for ultimate creditor (for «future use» until authorized) has been   no              no              n/a
     filled in

  16 Amount is present in the Swiss QR Code but not in the visible part         no              yes             n/a

  17 Amount is preprinted in the visible part but not in the Swiss QR Code      yes             manual          n/a

  18 The blank field with black corner marks is missing where the Amount is     no              manual          n/a
     empty (in the Swiss QR Code)

  19 Currency invalid (not «CHF» or «EUR»/missing)                              no              no              n/a


  20 Ultimate debtor address type is invalid (not «S» or «K» or « » )           no              no              n/a

  21 Compulsory data for the ultimate debtor with address type «S»-structured   no              manual          n/a
     address (name, postcode, location, country) is missing


  22 Compulsory data for the ultimate debtor with address type «K» combined     no              manual          n/a
     address (name, country) is missing

  23 Data for the ultimate debtor with address type «K»-combined address        no              no              n/a
     (postcode, location) has been filled in

  24 Data for the ultimate debtor has been filled in and the address type for   no              manual          n/a
     the ultimate debtor (= « ») is missing

  25 The blank field with black corner marks is missing where the ultimate      no              manual          n/a
     debtor is blank (in the Swiss QR Code)

  26 Reference type invalid (not «SCOR», «QRR» or «NON »)/missing               no              no              n/a

  27 Reference missing where a QR-IBAN and reference type QRR have been used    no              no              n/a

  28 Reference missing where an IBAN is used with reference type SCOR           no              no              n/a

  29 Reference is listed where reference type is NON                            no              no              n/a

  30 Reference with invalid check digit in the QR reference                     no              no              n/a
     (reference type = QRR)

  31 Reference with invalid Creditor Reference check digit                      yes             yes             n/a
    (reference type = SCOR)

  32 If an object is used, the billing information has not been filled in       yes             yes             n/a
     in accordance with valid syntax.

  33 Parameters from alternative procedures have been used                      yes             yes             n/a

  34 Handwritten additions made after the pay- ment part was printed            yes             n/a             n/a
     (does not apply to the debtor’s amount payable)

  35 Handwritten changes made after the pay- ment part has been printed         no              n/a             n/a
  -----------------------------------------------------------------------------------------------------------------------------

_Table notes_:

^(a)^ Processing of physical payment orders by FI, service providers on behalf of an FI or by Swiss Post. Column value indicates
whether the payment should be processed or not.

^(b)^ Processing using m-banking solutions from an FI. Column value indicates whether the payment (or element) should be processed
or not. When _manual_ is indicated this means that the value can be entered manually subsequenttly.

^(c)^ Processing on the debtor's infrastructure or by a service provider on behalf of the debtor. To date no rules have been set.
The rules in the Swiss Implementation Guidelines on customerto-bank messages for transfers in payment traffic (Customer Credit
Transfer Initiation pain.001) must be complied with.


### Layout rules and regulations

The following table shows the processing rules which apply when scanning the Swiss QR Code. The rules apply to channels used by
financial institutions (physical processing and m-banking). For debtor solutions, rules/recommendations are only listed where
necessary. The following table describes and defines the standard. More liberal or more restrictive applications may be defined
by the supplier individually.

  : Table 4. Layout rules and recommendations.

  -----------------------------------------------------------------------------------------------------------------------------
   # Description of fault/error                                                 Physical        M-banking       Debtor's
                                                                                payment^(a)^    solutions^(b)^  infrastructure^(c)^
  -- -------------------------------------------------------------------------- --------------- --------------- ---------------
   1 A complete QR-bill is submitted instead of only a payment part with        no              yes             n/a
     receipt (210 x 105 mm)

   2 Rules on paper format for the payment part (DIN A6 portrait format,        no              n/a             n/a
     without receipt) are not complied with for paper-based payment
     transactions with an order form (debit)

   3 Rules on paper format with receipt are not complied with where payment is  no              n/a             n/a
     made at a post office

   4 Layout rules and recommendations for the payment part are not complied     no              yes             n/a
     with (sequence and name of headings in the details section, positioning
     of the areas of the payment part)

   5 Layout rules and recommendations for the payment part are not complied     no              yes             n/a
     with (paper quality, print colour, font and font size)

   6 Payment part is submitted with no receipt                                  no^(d)^         yes             n/a
  -----------------------------------------------------------------------------------------------------------------------------

_Table notes_:

^(a)^ Processing of physical payment orders by FI, service providers on behalf of an FI or by Swiss Post. Column value indicates
whether the payment should be processed or not.

^(b)^ Processing using m-banking solutions from an FI. Column value indicates whether the payment (or element) should be processed
or not. When _manual_ is indicated this means that the value can be entered manually subsequenttly.

^(c)^ Processing on the debtor's infrastructure or by a service provider on behalf of the debtor. To date no rules have been set.
The rules in the Swiss Implementation Guidelines on customerto-bank messages for transfers in payment traffic (Customer Credit
Transfer Initiation pain.001) must be complied with.

^(d)^ Payment is not processed at Swiss Post.

### Comparing data between the scanned Swiss QR Code and the visible part

The following table shows the processing rules that apply when scanning the Swiss QR Code. The rules apply to channels used by
financial institutions (physical processing and m-banking). For debtor solutions, rules/recommendations are only listed where
necessary. The following table (1-3) describes and defines the standard. More restrictive applications may also be defined.

  : Table 5. Comparing data between the scanned Swiss QR Code and the visible part.

  -----------------------------------------------------------------------------------------------------------------------------
   # Description of fault/error                                                 Physical        M-banking       Debtor's
                                                                                payment^(a)^    solutions^(b)^  infrastructure^(c)^
  -- -------------------------------------------------------------------------- --------------- --------------- ---------------
   1 Different creditor name^(d)^ in the Swiss QR Code compared with the        no              no              recommended
     visible part

   2 Different currency^(d)^ in the Swiss QR Code compared with the visible     no              no              recommended
     part

   3 Different amount^(d)^ (where present) in the Swiss QR Code compared with   no              no              recommended
     the visible part

   4 Different content in other fields in the visible part compared with the    FI/Swiss Post   no              risk
     Swiss QR Code                                                              rules^(e)^                      assessment^(f)^

   5 Different IBAN or QR-IBAN in the visible part compared with the Swiss QR   no              no              mandatory
     Code
  -----------------------------------------------------------------------------------------------------------------------------

_Table notes_:

^(a)^ Processing of physical payment orders by FI, service providers on behalf of an FI or by Swiss Post. Column value indicates
whether the payment should be processed or not.

^(b)^ Processing using m-banking solutions from an FI. For all rows in this table, no systematic comparison is required, however
the comparison must be done by the debtor.

^(c)^ Processing on the debtor's infrastructure or by a service provider on behalf of the debtor. The column indicates whether
the comparison is recommended or mandatory.

^(d)^ The financial sector recommends comparing the creditor (name), currency and amount. Other fields can be compared but do not
have to be.

^(e)^ According to the FI/Swiss Post rules.

^(f)^ Compared depending on the debtor‘s assessment of the risk.

### Manual post-recording

The following table lists the rules that apply to post-recording. The rules apply to channels used by financial institutions
(physical processing and m-banking). For debtor solutions, rules/recommendations are only listed where necessary. The following
table describes the standard.

  : Table 6. Manual post-recording.

  -----------------------------------------------------------------------------------------------------------------------------
   # Description of fault/error                                                 Physical        M-banking       Debtor's
                                                                                payment^(a)^    solutions^(b)^  infrastructure^(c)^
  -- -------------------------------------------------------------------------- --------------- --------------- ---------------
   1 Handwritten ultimate debtor                                                Must be entered Can be entered  n/a^(d)^
                                                                                later           later

   2 Handwritten amount                                                         Must be entered Must be entered Must be entered
                                                                                later           later           later

   3 Additions are listed after the payment part has been printed (does not     Additions are   Can be entered  Can be entered
     apply to the debtor amount payable)                                        ignored         later           later

   4 Changes made after the payment part has been printed (applies to the       Payment is not  Can be entered  Can be entered
     creditor, currency, amount)                                                processed       later           later
  -----------------------------------------------------------------------------------------------------------------------------

_Table notes_:

^(a)^ Processing of physical payment orders by FI, service providers on behalf of an FI or by Swiss Post.

^(b)^ Processing using m-banking solutions from an FI.

^(c)^ Processing on the debtor's infrastructure or by a service provider on behalf of the debtor.

^(d)^ No rules have been set. The rules in the Swiss Implementation Guidelines on customerto-bank messages for transfers in
payment traffic (Customer Credit Transfer Initiation pain.001) must be complied with.

