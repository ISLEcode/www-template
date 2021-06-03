---
revision  : 2020-11-16 (Mon) 14:48:53
title     : Parameters for generating Swiss QR-bill QR-codes
---


The following points are binding for generating the Swiss QR Code.

5.1

Error correction level

The code generation must take place with error correction level «M», which means a redundancy or assurance of around 15%.

5.2

Maximum data range and QR code version

The maximum Swiss QR Code data content permitted is 997 characters (including the element separators). The version of the QR Code resulting with error correction level «M» and binary coding is version 25 with 117 x 117 modules.

5.3

Minimum module size

To guarantee the secure scanning of the Swiss QR Code, a minimum module size of 0.4 mm is recommended for printing.

5.4

Measurements of the Swiss QR Code for printing

The measurements of the Swiss QR Code for printing must always be 46 x 46 mm (without surrounding quiet space) regardless of the Swiss QR Code version. Depending on the printer resolution, the Swiss QR Code produced must be enlarged or reduced accordingly. This must occur on the basis of a vector graphic in order to maintain the quality of the Swiss QR Code.

5.4.1

Figure 11: Scaling of the Swiss QR Code to fixed sizes
Ruhezone gemäss ISO 18004
To ensure the readability of the Swiss QR Code, an unprinted border must be provided around the Swiss QR Code corresponding to the width of four modules (corresponds to >= 1.6 mm). In the design recommendations, this border was expanded to five mm to improve user-friendliness (see 3.5.2 «Swiss QR Code section»).

Swiss Implementation Guidelines QR-bill

Parameters for generating the Swiss QR Code

5.4.2

Recognition characters
To increase the recognizability and differentiation for users, the Swiss QR Code created for printout is to be overlaid with a Swiss cross logo measuring 7 x 7 mm. A corresponding file with the logo can be downloaded from the website's download section at www.PaymentStandards.CH.

5.4.3

Figure 12: Swiss QR Code with Swiss cross as recognition feature (not true to scale)
The payment amount
The «Amount» element is to be entered without leading zeroes, including decimal separators and with two decimal places. The «.» symbol is to be used as a decimal separator. The «Amount» element need not be filled in the Swiss QR Code.

Version 2.1 ­ 30.09.2019

Page 35 of 57

Field contents and meta data

Swiss Implementation Guidelines QR-bill

<!-- vim: set nospell :-->

