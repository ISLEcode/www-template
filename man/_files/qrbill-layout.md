---
revision  : 2020-11-16 (Mon) 14:46:08
title     : Swiss QR-bill layout
---

Layout rules for the payment part with Swiss

QR Code and receipt

3.1

The basics

The following layout rules apply to the payment part on a QR-bill with receipt which can be used in the following ways: 1. integrated in a QR-bill in paper form 2. as an enclosure to a QR-bill in paper form
 The QR-bill can also be produced as a PDF file (see paragraph 3.7 «Notes about the QR-bill in PDF format»).
 The layout rules for the payment part apply regardless of whether it is incorporated in a bill or enclosed with it.
 The payment part with receipt must be positioned at the lower edge of the QR-bill.
 The receipt must be positioned to the left of the payment part. It is of the same height as the payment part. The payment part and receipt together come to the same length as the shorter side of DIN-A4 format.
 If the payment part with receipt is integrated in a QR-bill in paper form, there must be a perforation between the bill details and the payment part and receipt.
 There should be a perforation between the payment part and the receipt, if the QR-bill is generated on paper.
 A perforation between the payment part and the receipt is also required if the payment part and the receipt are enclosed separately with a bill.
 If information about the amount and debtor (payable by (name/address)) are not imprinted during the billing process, then corresponding fields are to be provided both in the payment part and on the receipt, for filling in by hand (see also Figure 5, Figure 6, Figure 9). Other handwritten supplementations are not permitted.
 Only the defined headings and information or values may be imprinted (see part 3.5 «Sections of the payment part») for the individual sections (see part 3.5.4 «Information section»).
 Use of payment part and receipt as an advertising platform or advertising is not permitted. The reverse side may not be imprinted.
 A Style Guide [4] giving detailed layout information and examples of the payment part and receipt ­ whether integrated or separate ­ is available from the Download Center at www.PaymentStandards.CH.

3.2

Correspondence language

The QR-bill can be produced in the correspondence languages German, French, Italian and English. The biller is free to choose the correspondence language used. The terms to be used in the respective correspondence languages are listed in multiple languages in Annex D.

Version 2.1 ­ 30.09.2019

Page 13 of 57

Layout rules

Swiss Implementation Guidelines QR-bill

3.3

Paper format and quality

The payment part with receipt must be printed on white paper with a weight of at least 80 to max. 100 g/m². The use of certified recycled, FSC and TCF papers is permitted. Neither coated nor reflecting standard paper may be used.
The payment part is in DIN-A6 landscape format (148 mm x 105 mm). The receipt to the left of the payment part measures 62 mm x 105 mm, so that the two together measure 210 mm x 105 mm (DIN long).

3.4

Fonts and font sizes

Only the sans-serif fonts Arial, Frutiger, Helvetica and Liberation Sans are permitted in black. Type may not be in italic nor underlined.
The font size for headings and their associated values on the payment part must be at least 6 pt, and maximum 10 pt. Headings in the «Amount» and «Details» sections must always be the same size. They should be printed in bold and 2 pt smaller than the font size for their associated values. The recommended font size for headings is 8 pt and for the associated values 10 pt. The exception, in font size 11 pt (bold), is the title «Payment part».
When filling in the «Alternative procedures» element, the font size is 7 pt, with the name of the alternative procedure printed in bold.
The «Ultimate creditor» element is intended for use in the future but will not be used when QR-bill is introduced and should therefore not be filled in. If approval is given for the field to be filled in, the font size is expected to be 7 pt with the designation in bold.
The font sizes for the receipt are 6 pt for the headings (bold) and 8 pt for the associated values. The exception, in font size 11 pt (bold), is the title «Receipt».
If, during scanning, in addition to the content of the Swiss QR Code, the information in the visible section of the payment part is also read, the best results will be achieved if the headings are in font size 8 pt. and the text information is in 10 pt. However, it must be ensured that all the required information can be shown in the visible section.

Swiss Implementation Guidelines QR-bill

Layout rules

3.5

Sections of the payment part

The following illustration depicts the five sections of the payment part. The contents are described in the following chapters.

3.5.1 3.5.2 3.5.3

Figure 4:

Schematic illustration of the payment part of a QR-bill

The spaces between the sections ­ darker in color in Figure 4 ­ are mandatory, must be at least 5 mm in height and width, and may not be printed.

Title section The term «Payment part» must be printed in the title section in 11 pt type bold.

Swiss QR Code section
In the Swiss QR Code section, the maintaining of the 5 mm wide border ensures that the Swiss QR Code can be read without problems.

Amount section
The amount section includes the currency and the amount, which are used as headings. The currencies Swiss francs and euros are supported. The currency codes «CHF» or «EUR» must be printed to the left in front of the amount or the amount field.
If the amount is included in the Swiss QR Code, then it must be printed after the currency code. A blank (space) should be used as the thousands separator and a full stop «.» as the decimal separator. The amount must always include two decimal places.
If no amount is contained in the Swiss QR Code, a blank field measuring 40 x 15 mm and with black edges (line thickness 0.75 pt) must be provided in which the debtor

Version 2.1 ­ 30.09.2019

Page 15 of 57

Layout rules

Swiss Implementation Guidelines QR-bill

(«Payable by») can add the amount by hand, preferably in black. A file for creating the corner marks is available from the Download Center at www.PaymentStandards.CH.

Figure 5:

Schematic depiction of the amount section

3.5.4

Information section

All values relevant for a payment from the Swiss QR Code must be printed in the information section. While doing so each bit of information must be marked with a heading. The values must, if they are contained in the Swiss QR Code, be positioned in the following correct order. If the Swiss QR Code contains no values, the relevant headings should not be shown.

Heading Account / Payable to Reference
Additional information

Comments
IBAN/QR-IBAN from the Swiss QR Code. Printed in blocks of 4 characters (5x4-character groups, the last character separate).
Holder of the listed account
QR reference or Creditor Reference (ISO 11649). The QR reference is printed in blocks of 5 characters (beginning with 2 characters, then 5x5-character groups). The Creditor Reference is printed in blocks of 4 characters, the last block being able to contain less than 4 characters).
Additional information for the bill recipient.
This is where the content from the data elements «Ustrd» (Unstructured message) and «StrdBkginf» (Billing information) is shown. Both fields together can only contain a maximum of 140 characters. If both elements are filled in, then a line break can be introduced after the information in the first element «Ustrd» (Unstructured message). If there is insufficient space, the line break can be omitted (but this makes it more difficult to read). If not all the

Swiss Implementation Guidelines QR-bill

Layout rules

Heading

Payable by or Payable by (name/address)

Payable by

Table 3:

Comments details contained in the QR code can be displayed, the shortened content must be marked with «...» at the end. It must be ensured that all personal data is displayed.
If the debtor is not included in the Swiss QR Code, then instead of «Payable by» the heading «Payable by (name/address)» must be used and a blank field with black edges (line thickness 0.75 pt) printed out (see Figure 5). The field must measure at least 65 x 25 mm. A file for this purpose is available from the Download Center at www.PaymentStandards.CH.
Corresponds to the due date proposed by the biller
Headings of the payment part in the information section

Comments
Use of the above-listed headings (see Annex D) is mandatory and they may not be changed, if they are contained in the Swiss QR Code.

3.5.5

Figure 6:

Schematic depiction of the information section

Further information section

This area contains the two data elements «Ultimate Creditor» and «Alternative procedures ».
1. Ultimate Creditor
Note: The following information about the «Ultimate Creditor» field is only for advance information, in the event of it being used in the future.
This section is where the «Ultimate creditor» field, if available and approved for use, is displayed. Instead of the designation «Ultimate creditor», the relevant values in the Swiss QR Code are preceded by the words «In favour of» (bold). Just one line is available, so it is possible that not all the information in the QR-bill can be printed

Version 2.1 ­ 30.09.2019

Page 17 of 57

Layout rules

Swiss Implementation Guidelines QR-bill

there. If that is the case, the shortened entry must be marked by «...» at the end. The data is printed in font size 7 pt, in the same order as in the Swiss QR Code.
2. Alternative procedures
The bottom area of the payment part or of the area «Further information section» may be used to indicate an alternative procedure. There are a maximum of two elements, each consisting of one line in font size 7 pt. The element includes at the start the (abbreviated) name of the alternative procedure (e.g. eBill as currently the only user of the element). This must be followed by the personal data, so that this is certain to be displayed.
In the Swiss QR Code, there are always 100 alphanumerical characters available for the «Alternative procedures». A maximum of approx. 90 characters can be printed on one line, so it is possible that not all the data included in the QR code can be displayed. If that is the case, the shortened entry must be marked by «...» at the end. It must be ensured that all personal data is displayed.

3.6

Sections of the receipt

The following illustration shows the four sections of the receipt. The content of the different sections is described in the paragraphs below. The QR code and further «Information sections» from the payment part are omitted.
The blank areas ­ shaded dark in Figure 7­ are mandatory, must measure at least 5 mm in height or width and must not be printed in.

Figure 7:

Schematic depiction of the receipt for the payment part of a QR-bill

3.6.1

Title section The term «Receipt» must be printed in the title section in 11 pt bold type.

Swiss Implementation Guidelines QR-bill

Layout rules

3.6.2

Information section

In the information section, the values used must be printed, just as they are in the payment part, exactly matching those in the Swiss QR Code. Each piece of information must be labelled with a heading. The following values must be shown, in the order indicated below, provided they are contained in the Swiss QR Code:

Heading Account / Payable to
Reference
Payable by or Payable by (name/address)

Comments
IBAN/QR-IBAN from the Swiss QR Code. Printed in blocks of 4 characters (5x4-character groups, the last character separate).
Holder of the listed account
QR reference or Creditor Reference (ISO 11649). The QR reference is printed in blocks of 5 characters (beginning with 2 characters, then 5x5-character groups). Der Aufdruck der Creditor Reference erfolgt in blocks of 4 characters, the last block being able to contain less than 4 characters).
If the debtor is not included in the Swiss QR Code, then instead of «Payable by» the heading «Payable by (name/address)» must be used and a blank field with black edges (line thickness 0.75 pt) printed out (see Figure 9). The field must measure at least 52 x 20 mm. A file for this purpose is available from the Download Center at www.PaymentStandards.CH.

Table 4:

Headings of the payment part in the information section

Comments
Use of the above-listed headings (see Annex D) is mandatory and they may not be changed, if they are contained in the Swiss QR Code.

Figure 8:

Schematic depiction of the information section on the receipt of a QR-bill

Because of the limited space, it is permitted to
 enter information in smaller or different font sizes from in the payment part. The minimum font size is 6 pt.
 omit the street name and building number from the addresses of the creditor (Payable to) and the debtor (Payable by).

Version 2.1 ­ 30.09.2019

Page 19 of 57

Layout rules

Swiss Implementation Guidelines QR-bill

3.6.3 3.6.4

Amount section
The amount section includes the currency and the amount, which are printed as headings. The currencies Swiss francs and euros are supported. The currency codes «CHF» or «EUR» must be printed to the left in front of the amount or the amount field. If the amount is included in the Swiss QR Code, then it must be printed after the currency code. A blank (space) should be used as the thousands separator and a full stop «.» as the decimal separator. The amount must always include two decimal places (e.g. CHF 1 590.00). If no amount is contained in the Swiss QR Code, a blank field measuring 30 x 10 mm and with black edges (line thickness 0.75 pt) must be provided in which the debtor can add the amount by hand. A file for this purpose is available from the Download Center at www.PaymentStandards.CH.
Acceptance point section
The acceptance point section contains the word «Acceptance point», which should be printed right-aligned in the language of correspondence.

Figure 9:

Schematic depiction of the receipt of a QR-bill

Swiss Implementation Guidelines QR-bill

Layout rules

3.7

Notes about the QR-bill in PDF format

QR-bills (or separate payment parts with receipts) in PDF format are only suitable for payments in e-banking or mobile banking, but not for paper payment traffic. When printing out PDF files, it must be ensured that the format specifications given above are complied with.
If the QR-bill with payment part and receipt or the separate payment part with receipt are generated as a PDF document and sent electronically, the A6 format of the payment part and the receipt on the left must be indicated by lines. Each of these lines must bear the scissors symbol «» or alternatively the instruction «Separate before paying in» above the line (outside the payment part). This indicates to the debtor that he or she must neatly separate the payment part and receipt if they want to forward the QR-bill to their financial institution by post for payment, or settle it at the post office counter (branches or branches of partner organisations).

Version 2.1 ­ 30.09.2019

Page 21 of 57

Swiss QR Code database

Swiss Implementation Guidelines QR-bill

<!-- vim: set nospell :-->
