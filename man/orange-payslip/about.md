# Orange payment slip (ISR)

ISR stands for _inpayment slip with a reference number_ (aka _orange payment slip_). Payments with a reference number are
processed automatically and therefore more quickly. ISR is a cheap and very widely used payment methods among merchants in
Switzerland as the reference makes invoicing and sales ledger accounting easier.

ISR inpayment slips can be processed directly via the Post (ESR) or via your bank (BESR). There are slight differences in the
processing of the slips and the generation of the reference number but otherwise they are identical.

Unique order reference with checksum
:   Every invoice contains a unique payment reference number and normally also contains the amount to be paid, the identification,
    a checksum and the details of the debited person. Whenever a person pays the invoice with the account number on the inpayment
    slip he will be asked to fill in the details including the reference number. Due to the checksum in the reference number,
    misspelling of the number is not possible.

Payment advice from the bank (.V11 / camt053 / camt054)
:   Once the invoice is paid and the money has arrived the merchant will be informed in his e-banking account about the payment -
    also known as **.v11** file. The bank will provide you a file to download. This file can be imported into SAMinfo. The file
    contains all the information to identify the invoice including the amount and - if applicable transaction costs in case the
    slip was processed manually at the bank counter. Based on this the payment can automatically be matched and the invoice can be
    closed. In case the is not paid on time then you can automatically trigger the [dunning process].

Cost optimization
:   More information about the look and feel can be found at your local Swiss bank. Alternatively we linked two brochures from
    major banks in Switzerland that explain the process in more details:

    -   [PostFinance]
    -   [UBS]

#### Plugins {#plugins .margin-bottom-20}

We provide plugins for an easy one-click integration without any development knowledge for the most used **Shopping Carts
(Shopify, Magento, Magento 2, PrestaShop, WooCommerce, and many more)**. The integration is very simple just download the plugins
from our Integration Marketplace and Configure the Connector.

View Plugins!

![][9]

Requirements
:   Accepting payments with inpayment slips is quite easy. All you need to have as precondition is a _bank account_ and an _ISR
    Participant Number_ Your bank will be able to help you with the registration.

    The payment information should be printed onto special paper that already contain the slip preprinted. You can purchase this
    paper with your local bank. Due to the automated processing of the slips it is essential that the printing guidelines are
    followed. We help you to position the information on the PDF so that it matches your print settings. However there are also
    alternative [delivery methods].

Invoice payment with QR code
:   Print a [QR code] on your invoice documents or reminders using the [instant invoice payment][QR code] feature and allow your
    customers to pay their invoice instantly using another payment method such as credit card in order to receive the goods
    quicker.

    This will also help you reduce the amount of outstanding invoices.

Deliver the ISR Slips to your customer
:   SAMinfo lets you send the ISR invoices to your customers via E-Mail by using our E-Mail infrastructure or automatically print
    it via our [Cloud Print Service Service].

    ISR inpayment slips are either added at the end of the invoice on a new page or just on the last page. In case you want to use
    the pre-printed ISR paper that you get from your bank you can select to print the last page from a different tray.

    You have the option to print the invoices on your local printer via[Google Cloud Print] or you automatically send the invoice
    via post to your clients using our [Pingen] Integration. The same delivery methods also apply to [dunning documents][dunning
    process].

Reconciliation and Dunning
:   Based on the payment report from your bank we are able to automatically close paid invoice and start to remind your customers
    based on open invoices. Depending on your bank we are able to import the ISR-payment reports automatically. Otherwise you can
    upload them manually on a regular basis in the backend.

[See ISR Processor Documentation]

    Part of the [reconciliation] is the dunning feature that lets you configure dunning flows and reminder templates based on your
    needs.

    More about the topic of dunning flows can be found in our [use cases] or if you prefer to get down to the technical details in
    our detailed dunning documentation.

    [Dunning Documentation]

Migration to ISO 20022
:   With the migration to ISO 20022 your bank will start to provide the new report files. Detailed information about the
    migration timelines can be asked from your bank. wallee is able to process the new **XML based files camt053 including detail
    records** as the existing **v11-files**.

    [More Information about the migration in our Blog]

![][10]

## Demo and Tutorial {#video}

To see how the integration of the ISR payment slips could look like, you can have a look at our [tutorial]. More information about
the migration to wallee you can find in the [documentation][11] or within the [blogpost.]

![][12]

×

## Plugins and SDKs

With the integration of the ISR feature into the wallee gateway you are able to create ISR Payment Slips including all related
workflows like dunning very easily. All you need to do is to connect your business to the wallee gateway. In order to do this have
a look at our pre-existing plugins (Magento, WooCommerce, Shopware, etc) or simply use an existing SDK.

[Have a look at our existing Integrations and SDK]

[Check our Documentation]

## Ready to get started?

### Get in touch or create an account!

[Create account][] [Contact us]

#### Features

-   [EC Terminal]
-   [ISR Invoices]
-   [Payment by Invoice]
-   [Payment Processing]
-   [Document Handling]
-   [Cloud Printing][Cloud Print Service Service]
-   [Subscriptions][4]
-   [Reconciliation]
-   [Slack]
-   [Debt Collection]

#### About

-   [About us]
-   [Customers]
-   [What\'s New]
-   [Blog]
-   [Imprint]
-   [Contact]
-   [Partner Program]
-   [PCI DSS]
-   [Careers]

#### Support

-   [Support][Contact]
-   [Community Support]
-   [Ideas]
-   [Terms]
-   [Status]

#### Integrations

-   [Plugins & SDK][Payment Processing]
-   [Shopping Carts][5]
-   [Mobile SDKs]
-   [Processors]
-   [Payment Methods]
-   [Works with wallee][5]
-   [Shopify]
-   [Magento]
-   [Shopware]
-   [WooCommerce]
-   [PrestaShop]

#### Developers

-   [Documentation][13]
-   [API Reference]
-   [Web Service API Client]
-   [Plugins & SDK][Payment Processing]

© 2020 customweb GmbH · [Privacy Terms][Terms] · [GDPR]

Our website uses cookies. This enables us to optimize your user experience. By continuing to use our website, you agree to this.

To find out more, please see our [Privacy Policy].

I accept

![][14]

  [1]: / {.logo}
  [English]: /isr-orange-inpayment-slip-reference.html {#en .lang-select-link .selected}
  [Deutsch]: /de/esr-einzahlungsschein-mit-referenznummer.html {#de .lang-select-link}
  [Products]: /products.html {.no-margin .relative}
  [2]: /features/e-commerce.html
  [3]: /terminal_point_of_sale.html
  [4]: /features/subscriptions.html
  [5]: /integrations.html
  [6]: /features/payment-links.html
  [7]: /features/automated-accounting.html
  [Pricing]: https://app-wallee.com/en/pricing
  [Customers]: /customers.html
  [Shop]: /de/terminal-shop.html
  [8]: https://app-wallee.com/pricing
  [Documentation]: https://app-wallee.com/doc/
  [Contact]: /support.html
  [Login]: https://app-wallee.com/user/login {.button-header}
  [Register]: https://app-wallee.com/user/signup {.button-header .button-header--secondary}
  [dunning process]: #dunning
  [PostFinance]: https://www.postfinance.ch/en/biz/prod/pay/debsolution/inpayref/detail.html
  [UBS]: https://www.ubs.com/ch/en/swissbank/private/novartis-campus/expats-and-cross-border-commuters/_jcr_content/par/linklist_0/link.2115569520.file/bGluay9wYXRoPS9jb250ZW50L2RhbS91YnMvY2gvc3dpc3NiYW5rL3ByaXZhdGUvbm92YXJ0aXMvdWJzX2V4cGF0X2Jyb3NjaHVyZV9kZXouMTJfZW5fZ2NyLnBkZg==/ubs_expat_broschure_dez.12_en_gcr.pdf
  [9]: /img/bg-esr.png?1581938778418 {.img-responsive}
  [delivery methods]: #delivery
  [QR code]: https://wallee.com/blog/instant-invoice-payment.html
  [Cloud Print Service Service]: /features/cloud-printing.html
  [Google Cloud Print]: https://app-wallee.com/de-de/doc/print/google-cloud-print
  [Pingen]: https://app-wallee.com/de-de/doc/print/pingen-print
  [See ISR Processor Documentation]: https://app-wallee.com/de/processors {.read-more}
  [reconciliation]: /features/reconciliation.html
  [use cases]: /cases/dunning-debt-collection.html
  [Dunning Documentation]: https://app-wallee.com/doc/payment/dunning {.read-more}
  [More Information about the migration in our Blog]: /blog.html {.read-more}
  [10]: /img/bg-esr-02.png?1581938778418 {.img-responsive}
  [tutorial]: #video
  [11]: https://app-wallee.com/doc/api/processor/documentation/1472576377155/isr-processor
  [blogpost.]: /blog/migration_magento_esr.html
  [12]: /img/video-previews/computer.png?1581938778418
  [Have a look at our existing Integrations and SDK]: /features/payment-processing.html#plugins {.read-more}
  [Check our Documentation]: https://app-wallee.com/en/doc/ {.read-more}
  [Create account]: https://app-wallee.com/user/signup {.btn .btn-secondary .margin-right-15}
  [Contact us]: support.html {.btn .btn-light}
  [EC Terminal]: /en/terminal.html
  [ISR Invoices]: /isr-orange-inpayment-slip-reference.html
  [Payment by Invoice]: /pay-later-by-invoice.html
  [Payment Processing]: /features/payment-processing.html
  [Document Handling]: /features/document-handling.html
  [Slack]: /features/slack.html
  [Debt Collection]: /features/debt-collection.html
  [About us]: /about-us.html
  [What\'s New]: /announcements.html
  [Blog]: /blog.html
  [Imprint]: /imprint.html
  [Partner Program]: /work-with-us.html
  [PCI DSS]: /pci.html
  [Careers]: /jobs.html
  [Community Support]: https://ask.wallee.com/
  [Ideas]: https://suggest.wallee.com/
  [Terms]: /terms.html
  [Status]: https://status.wallee.com/
  [Mobile SDKs]: /features/mobile_sdk.html
  [Processors]: https://app-wallee.com/processors
  [Payment Methods]: https://app-wallee.com/payment-methods
  [Shopify]: /features/shopify.html
  [Magento]: /features/magento.html
  [Shopware]: /features/shopware.html
  [WooCommerce]: /features/woocommerce.html
  [PrestaShop]: /features/prestashop.html
  [13]: https://app-wallee.com/doc
  [API Reference]: https://app-wallee.com/en-us/doc/api/web-service
  [Web Service API Client]: https://app-wallee.com/api/client
  [GDPR]: /gdpr.html
  [Privacy Policy]: /privacy_policy.html {.active .bold}
  [14]: https://www.facebook.com/tr?id=1788817037811057&ev=PageView&noscript=1 {width="1" height="1"}
