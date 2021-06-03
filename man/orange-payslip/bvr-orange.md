# Swiss Orange ISR Payment Slip {#swiss-orange-isr-payment-slip .dm-contentHero__title}

One of  Swiss legal banking requirement is to print ISR
Payment Slip from sales Invoice.

ISR Payment Slip: In-payment Slip with Reference Number (ISR) Payment Slip is a service which facilitates customer to pay Invoice
in Swiss Franc or in Euro in simple manner.

This pre-printed Orange slip requires data to be printed following swiss Postfinance norm so data can be read without any error.

During working for thiis requirement, I found there are very few documents available on this local requirement. Another problem
which I faced that many of these documents are not in English language.

In this document, I will try to share some information which I learned during my interaction. Hope this will be helpful for
community.

In this document  main intention is to concentrate on business part specific to Switzerland Payment slip rather than discussing
configuration.

Discussion of Standard output configuration is not in scope of this write-up.

This document will not cover FI configuration.

Main goal of this write-up is to provide all available information related to ISR Slip at one place.

*If you find this document helpful then please do not forget to LIKE this document . Please give your rating.*

\* *

**Lay out of Swiss Pre-printed Payment Slip**:

Data layout of ISR Payment slip change depend upon business process for example Invoice having Cash Discount requires different
data layout than normal one.

Please validate requirement from business before implementing any solution. For example in our business only ISR & ISR+ scenario
related to swiss currency was relevant.

Data needs to be printed in OCR-B1 character set

Please check attached URL in this write-up for further details.

Swiss Orange Slip Template :

*[![Capture.JPG]]*

[![Capture.JPG][7]]

Interesting part of Payment slip is ISR code. ISR code is combination of Invoice value, Bank account, customer number & check
digit in certain order.

Check Digit:

Check Digit is a functionality used in ISR Code  to prevent reading error due to Interference factors such as soiling, excessive
stamping or handwritten changes to the printed characters. As Incomplete or illegible digits can lead to rejection or incorrect
reading of slips.

Hence to identify these mistakes and prevent eventual errors from being processed, check digits are added to the code line.

The digit is calculated using recursive module 10. Please check link attached to get more details on Check Digit.

Modulo 10 computing method:

[![Capture.JPG][8]]

We created z code to determine check digit in our business process, This code may be reuse in case if your business requirement
support. (Consultant discretion require as per their business process).

[![Capture.JPG][9]]

Further Reading:

Manual ISR :

<https://www.postfinance.ch/binp/postfinance/public/dam.M26m_i6_6ceYcN2XtAN4w8OHMynQG7FKxJVK8TtQzr0.spool/content/dam/pf/de/doc/consult/manual/dlserv/inpayslip_isr_man_en.pdf>

Check Digit (Modulo 10)

[https://www.postfinance.ch/binp/postfinance/public/dam.kDeM1NfdktHxsoPgqxBgbWOwXjqUmZZMUW52ZpIhfU0.spool/content/dam/pf/...]

Check digit computation module 97--10:

<http://www.pruefziffernberechnung.de/Originaldokumente/IBAN/Prufziffer_07.00.pdf>

[Printing Invoices with ISR Procedure -- Switzerland -- SAP Library]

[ISR Procedure (Switzerland) -- Switzerland -- SAP Library]

SAP Note:

506723 -- Support of Swiss ISR Procedure in EBP

956920 -- Switzerland: Maintaining ISR data for mandates

\* *

\* *

\* *

-   [][10]
-   [][11]
-   [][12]

-   [Alert Moderator]

### Assigned tags {#assigned-tags .dm-widget__heading--small}

### Related Blog Posts {#related-blog-posts .dm-widget__heading--small}

### Related Questions {#related-questions .dm-widget__heading--small}

2 Comments

You must be [Logged on] to comment or reply to a post.

-   ![Author\'s profile photo Neeraj Lal][13]

    [Former Member]

    [January 22, 2015 at 10:40 am]

    Really useful document

    -   Like(0)

-   ![Author\'s profile photo Neeraj Lal][13]

    [Former Member]

    [February 27, 2017 at 1:17 pm]

    Thanks a lot for sharing this.

    -   Like(0)

##### Find us on {#hl-sharefollow .dm-socialmedia__headline}

-   [][14]
-   [][15]
-   [][16]
-   [][17]
-   [][18]
-   [][19]
-   [][20]

-   [Privacy]
-   [Terms of Use]
-   [Legal Disclosure]
-   [Copyright]
-   [Trademark]
-   

-   [Newsletter]
-   [Support]

# Insert/edit link {#link-modal-title}

Close

Enter the destination URL

URL

Link Text

Open link in a new tab

Or link to existing content

Search

*No search term specified. Showing recent items.* *Search or use up and down arrow keys to select an item.*

Cancel

  [Skip to Content]: #main
  [1]: http://www.sap.com/ "SAP" {.dm-logo--header}
  [Community]: https://community.sap.com/community {.dm-header__homeItem-link}
  [Topics]: https://community.sap.com/topics {.dm-mainNav__menuItem-link}
  [Answers]: https://answers.sap.com/index.html {.dm-mainNav__menuItem-link}
  [Blogs]: https://blogs.sap.com {.dm-mainNav__menuItem-link}
  [Events]: https://community.sap.com/events {.dm-mainNav__menuItem-link}
  [Programs]: https://community.sap.com/programs {.dm-mainNav__menuItem-link}
  [Resources]: https://community.sap.com/resources {.dm-mainNav__menuItem-link}
  [What\'s New]: https://community.sap.com/resources/what-is-new {.dm-mainNav__menuItem-link}
  [2]: # "Search the SAP Community" {.dm-search-action .dm-icon-encoded--search .dm-header__search-icon}
  [3]: # {#comm-hdr-SignIn .dm-user__login-button--wrapper}
  [4]:  {.dm-header__avatar-image .dm-hidden width="24px" height="24px"}
  [My profile]: # {.dm-header__actionsSubMenu-title-link}
  [5]: 
  [![][5]]:  {#comm-hdr-MenuAvatar .dm-profileMenu__avatar__image}
  [Logout]: # {#comm-hdr-LogOut .dm-profileMenu__link}
  [Home]: https://www.sap.com "Home" {#comm-shdr-breadcrumb-home}
  [6]: https://www.sap.com/community.html "Community" {#comm-shdr-breadcrumb-community}
  [Ask a Question]: https://answers.sap.com/questions/ask.html "Ask a Question" {#comm-shdr-AskQuestion}
  [Write a Blog Post]: https://blogs.sap.com/wp-admin/post-new.php "Write a Blog Post" {#comm-shdr-WriteBlogPost}
  [Author\'s profile photo Neeraj Lal]: https://avatars.services.sap.com/images/neeraj.lal_small.png {.avatar .avatar-48 .photo
  .avatar-default .dm-author__image width="48" height="48"}
  [![Author\'s profile photo Neeraj Lal]]: https://people.sap.com/neeraj.lal "Neeraj Lal" {.dm-author__image}
  [Neeraj Lal]: https://people.sap.com/neeraj.lal {.dm-author__name}
  [Follow]: https://blogs.sap.com/wp-login.php?redirect_to=https%3A%2F%2Fblogs.sap.com%2F2015%2F01%2F07%2Fswiss-orange-isr-payment-slip%2F%3Fs_action%3Dss_change_follow_status%26nonce%3D238f3bf7be
    "Please log into the system to use follow/unfollow functionality." {#sap-button-follow-hdr-id .dm-button-small
  .dm-button--callToAction .sap-button-follow}
  [RSS feed]: https://blogs.sap.com/2015/01/07/swiss-orange-isr-payment-slip/feed/ {.dm-button-small .dm-button--secondary}
  [Like]: https://blogs.sap.com/wp-login.php?redirect_to=https%3A%2F%2Fblogs.sap.com%2F2015%2F01%2F07%2Fswiss-orange-isr-payment-slip%2F%3Fs_action%3Dss_change_like_status%26nonce%3Dee6bdefd40
    "Like" {.dm-button-small .dm-button--secondary .likes-post-link .dolike}
  [Capture.JPG]: /wp-content/uploads/2015/01/capture_626137.jpg {.jive-image .jive-image-thumbnail .jiveImage width="496"
  height="352"}
  [![Capture.JPG]]: /wp-content/uploads/2015/01/capture_626137.jpg
  [7]: /wp-content/uploads/2015/01/capture_626147.jpg {.jive-image .jive-image-thumbnail width="620"}
  [![Capture.JPG][7]]: /wp-content/uploads/2015/01/capture_626147.jpg
  [8]: /wp-content/uploads/2015/01/capture_626321.jpg {.jive-image}
  [![Capture.JPG][8]]: /wp-content/uploads/2015/01/capture_626321.jpg
  [9]: /wp-content/uploads/2015/01/capture_626350.jpg {.jive-image}
  [![Capture.JPG][9]]: /wp-content/uploads/2015/01/capture_626350.jpg
  [https://www.postfinance.ch/binp/postfinance/public/dam.kDeM1NfdktHxsoPgqxBgbWOwXjqUmZZMUW52ZpIhfU0.spool/content/dam/pf/...]: https://www.postfinance.ch/binp/postfinance/public/dam.kDeM1NfdktHxsoPgqxBgbWOwXjqUmZZMUW52ZpIhfU0.spool/content/dam/pf/de/doc/consult/manual/dldata/efin_recdescr_man_en.pdf
  {.jive-link-external-small}
  [Printing Invoices with ISR Procedure -- Switzerland -- SAP Library]: http://help.sap.com/erp2005_ehp_07/helpdata/en/46/82d0531d8b4208e10000000a174cb4/content.htm
  {.jive-link-external-small}
  [ISR Procedure (Switzerland) -- Switzerland -- SAP Library]: http://help.sap.com/erp2005_ehp_07/helpdata/en/48/dd0752ce009b60e10000000a44176d/content.htm?frameset=/en/46/82d0531d8b4208e10000000a174cb4/frameset.htm&current_toc=/en/4e/82d0531d8b4208e10000000a174cb4/plain.htm&node_id=4
  {.jive-link-external-small}
  [10]: https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fblogs.sap.com%2F2015%2F01%2F07%2Fswiss-orange-isr-payment-slip%2F
    "Share on Facebook"
  [11]: https://twitter.com/share?url=https%3A%2F%2Fblogs.sap.com%2F2015%2F01%2F07%2Fswiss-orange-isr-payment-slip%2F&text=Swiss+Orange+ISR+Payment+Slip
    "Share on Twitter"
  [12]: https://www.linkedin.com/shareArticle?mini=true&url=https%3A%2F%2Fblogs.sap.com%2F2015%2F01%2F07%2Fswiss-orange-isr-payment-slip%2F&title=Swiss+Orange+ISR+Payment+Slip
    "Share on LinkedIn"
  [Alert Moderator]: javascript:void(0); {.dm-actionbar__link .dm-button--disabled}
  [Logged on]: https://blogs.sap.com/wp-login.php?redirect_to=2015/01/07/swiss-orange-isr-payment-slip "Log On" {.opener
  .js-idspopup}
  [13]: https://avatars.services.sap.com/images/former.member_small.png {.avatar .avatar-48 .photo .avatar-default width="48"
  height="48"}
  [Former Member]: https://people.sap.com/former.member {.url .disabled}
  [January 22, 2015 at 10:40 am]: https://blogs.sap.com/2015/01/07/swiss-orange-isr-payment-slip/#comment-226682
  [February 27, 2017 at 1:17 pm]: https://blogs.sap.com/2015/01/07/swiss-orange-isr-payment-slip/#comment-364982
  [14]: https://www.facebook.com/sapcommunity "Facebook"
  [15]: https://twitter.com/SAPCommunity "Twitter"
  [16]: https://www.youtube.com/c/SAPCommunities "YouTube"
  [17]: https://www.linkedin.com/company/sap "LinkedIn"
  [18]: https://instagram.com/sap/ "Instagram"
  [19]: http://www.slideshare.net/SAP "Slideshare"
  [20]: mailto:?subject='SAP%20Community' "Email Share"
  [Privacy]: http://sap.com/about/legal/privacy.html
  [Terms of Use]: http://sap.com/corporate/en/legal/terms-of-use.html
  [Legal Disclosure]: http://sap.com/about/legal/impressum.html
  [Copyright]: http://sap.com/about/legal/copyright.html
  [Trademark]: http://sap.com/about/legal/trademark.html
  [Newsletter]: https://www.sap.com/cmp/nl/sap-community-voice/index.html
  [Support]: mailto:sapnetwork@sap.com
