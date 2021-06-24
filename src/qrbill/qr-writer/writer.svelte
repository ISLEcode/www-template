<script lang="ts">
import Writer from '../../../qrcode/qrcodegen';
import SwissCross from './swiss-cross.svelte'

document.documentElement.style.setProperty( '--qrb-10pt', ( ( document.body.offsetWidth * 25.4) / ( 21 * 72)) + 'px');
window.addEventListener( 'resize', function() { document.documentElement.style.setProperty( '--qrb-10pt', ( ( document.body.offsetWidth * 25.4) / ( 21 * 72)) + 'px'); });

// BEGIN INIT
// Your bank account must be specified */
var account = 'CH1234567890123456789,Name Name,Street,12,3456,City';

/* You may want to pass the parameters with the URL */
let params = new URLSearchParams( document.location.search);
var ref    = params .get ('ref');
var info   = params .get ('info');
var dbtr   = params .get ('dbtr');
var ccy    = params .get ('ccy');
var amt    = params .get ('amt');

// You may want to define default values
if ( null === dbtr) dbtr = 'Default Name,Street,12,3456,City';
if ( null === info) info = 'Standard payment';

// END INIT

var info_account = '';
var split = account.split( ',');
if ( 6 === split.length) {
  split[ 0 ] = split[ 0 ].replace( / /g, '');
  for ( var pos = 0; pos < 21; pos += 4) {
    info_account += split[ 0 ].substr( pos, 4) + ' ';
  }
  info_account = info_account.trim();
  info_account += "<br />" + split[ 1 ] + "<br />" + split[ 2 ] + " " + split[ 3 ] + "<br />" + split[ 4 ] + " " + split[ 5 ];
  split[ 0 ] += "\r\nS";
  account = split.join( "\r\n") + "\r\nCH";
} else account = '';

var info_dbtr = '';
if ( null === dbtr) dbtr = '';
if ( '' !== dbtr) {
  split = dbtr.split( ',');
  if ( 5 === split.length) {
    info_dbtr = split[ 0 ] + "<br />" + split[ 1 ] + " " + split[ 2 ] + "<br />" + split[ 3 ] + " " + split[ 4 ];
    dbtr = "S\r\n" + split.join( "\r\n") + "\r\nCH";
  } else {
    dbtr = '';
  }
}
if ( '' === dbtr) dbtr = "\r\n\r\n\r\n\r\n\r\n\r\n";

var tp = 'NON';
var info_ref = '';
if ( null === ref) ref = '';
ref = ref.replace( / /g, '');
if ( '' !== ref) {
  if ( /^\d{27}$/.test( ref)) {
    tp = 'QRR';
    info_ref += ref.substr( 0, 2) + ' ';
    for ( var pos = 2; pos < 27; pos += 5) {
      info_ref += ref.substr( pos, 5) + ' ';
    }
    info_ref = info_ref.trim();
  }
    else if ( /^RF\d{2}[A-Za-z0-9]{0,21}$/.test( ref)) {
    tp = 'SCOR';
    for ( var pos = 0; pos < 25; pos += 4) info_ref += ref.substr( pos, 4) + ' ';
    info_ref = info_ref.trim();
  }
    else ref = '';
}

if ( null === info) info = '';

ccy = (null !== ccy && 'EUR' === ccy.toUpperCase()) ? 'EUR' : 'CHF';

var info_amt = '';
if ( Number.isNaN( parseFloat( amt))) {
  amt = '';
} else {
  amt = parseFloat( amt).toFixed(2);

  let f = parseFloat( amt);

  if ( 999 < f) {
    let t = Math.floor( f / 1000);
    let h = f - ( 1000 * t);

    t = t.toString();
    t = ' '.repeat( 4 - ( t.length % 4)) + t;

    for ( var pos = 0; pos < t.length; pos += 4) info_amt += t.substr( pos, 4) + ' ';
    info_amt = info_amt .trim();

    if      (  10 > h) info_amt += ' 00' + h .toFixed (2);
    else if ( 100 > h) info_amt +=  ' 0' + h .toFixed (2);
    else               info_amt +=   ' ' + h .toFixed (2);

  }
  else info_amt = amt;
}



const ch_cross // Swiss cross to be placed in the middle of the QR code
= '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="-55.15715 -55.15715 130.114285714 130.114285714">'
+   '<rect x="0" y="0" width="19.8" height="19.8" style="fill:#ffffff;stroke:none;"/>'
+   '<rect x="1.41785" y="1.41785" class="st0" width="16.9643" height="16.9643" style="fill:#000000;stroke:none;"/>'
+   '<rect x="8.25" y="4.4" class="st0" width="3.3" height="11" style="fill:#ffffff;stroke:none;"/>'
+   '<rect x="4.4" y="8.25" class="st0" width="11" height="3.3" style="fill:#ffffff;stroke:none;"/>'
+ '</svg>';

const qr_data // Construct the raw data that will be embedded in the QR code
= "SPC\r\n0200\r\n1\r\n" + account + "\r\n" + "\r\n\r\n\r\n\r\n\r\n\r\n\r\n" + amt + "\r\n" + ccy + "\r\n" + dbtr + "\r\n"
+ tp + "\r\n" + ref + "\r\n" + info + "\r\n" + "EPD\r\n\r\n\r\n";

const mkqrcode = qrcodegen .QrCode, qr_code = mkqrcode .encodeText (qr_data, mkqrcode .Ecc .MEDIUM);
document .getElementById ('qrb-p-qrcode') .innerHTML = qr_code .toSvgString (0) + ch_cross;

Array .from (document .getElementById ('qrb') .getElementsByClassName ('the_cdtr')) .forEach (( el) => { el.innerHTML = info_account; });

if ( '' === info_dbtr) {
    Array .from (document .getElementById ('qrb') .getElementsByClassName ('qr-address'))
        .forEach (( el) => { el.style.display = 'inline'; });
    Array .from (document .getElementById ('qrb-r-info') .getElementsByClassName ('qrb-v-debtor')) .forEach (( el) => { el.outerHTML = '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="-1 -1 54 22" id="qrb-r-debtor" class="qrb-v-debtor"><symbol id="cornermark" width="3" height="3" viewBox="0 0 3 3"><polygon points="0,0 0,3 0.264583333,3 0.264583333,0.264583333 3,0.264583333 3,0" style="fill:#000000;stroke:none;" /></symbol><use href="#cornermark" x="0" y="0" /><use href="#cornermark" x="52" y="0" transform="rotate(90 52 0)" /><use href="#cornermark" x="0" y="20" transform="rotate(270 0 20)" /><use href="#cornermark" x="52" y="20" transform="rotate(180 52 20)" /></svg>'; });
    Array .from (document .getElementById ('qrb-p-info') .getElementsByClassName ('qrb-v-debtor')) .forEach (( el) => { el.outerHTML = '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="-1 -1 67 27" id="qrb-p-debtor" class="qrb-v-debtor"><symbol id="cornermark" width="3" height="3" viewBox="0 0 3 3"><polygon points="0,0 0,3 0.264583333,3 0.264583333,0.264583333 3,0.264583333 3,0" style="fill:#000000;stroke:none;" /></symbol><use href="#cornermark" x="0" y="0" /><use href="#cornermark" x="65" y="0" transform="rotate(90 65 0)" /><use href="#cornermark" x="0" y="25" transform="rotate(270 0 25)" /><use href="#cornermark" x="65" y="25" transform="rotate(180 65 25)" /></svg>'; });
}
else
    Array .from (document .getElementById ('qrb') .getElementsByClassName ('qrb-v-debtor')) .forEach (( el) => { el.innerHTML = info_dbtr; });

( 'NON' === tp)
? Array .from (document .getElementById ('qrb') .getElementsByClassName ('reference' )) .forEach (( el) => { el.style.display = 'none'; })
: Array .from (document .getElementById ('qrb') .getElementsByClassName ('the_rmtinf')) .forEach (( el) => { el.innerHTML = info_ref; });

('' === info)
? Array .from (document .getElementById ('qrb') .getElementsByClassName ('addinf'   )) .forEach ((el) => { el.style.display = 'none'; })
: Array .from (document .getElementById ('qrb') .getElementsByClassName ('the_addinf')) .forEach ((el) => { el.innerHTML = info; });

Array .from (document .getElementById ('qrb') .getElementsByClassName ('the_ccyamt_ccy')) .forEach (( el) => { el.innerHTML = ccy; });

// ( '' === amt)
// ? Array .from (document .getElementById ('qrb-ch') .getElementsByClassName ('blankamt')) .forEach (( el) => { el.style.display = 'initial'; })
// : Array .from (document .getElementById ('qrb') .getElementsByClassName ('the_ccyamt_amt')) .forEach (( el) => { el.innerHTML = info_amt; });
</script>

<style>
.fr,.de,.it { display: none; }
html { background-color: grey; }
body { background-color: white; margin: 0 auto; padding-top: 10%; padding: 0; width: 90%; }

/* --- */

#qrb                          { font-family: 'Liberation Sans'; }
#qrb *                        { margin: 0; padding: 0; }
#qrb-p-qrcode svg             { display: block; }
#qrb-r-amount div:first-child { float: left; width: 22%; }
#qrb-p-amount div:first-child { float: left; width: 30%; }
#qrb-r-accept                 { text-align: right; }
#qrb .qr-address              { display: none; }
#qrb h2, #qrb h3              { font-weight: bold; }
#qrb h2                       { font-size: 1.1em; }
#qrb-r h3                     { font-size: .6em; line-height: calc( .9em / .6 ); }
#qrb-r p                      { font-size: .8em; line-height: calc( .9em / .8 ); padding-bottom: calc( .9em / .8 ); }
#qrb-r-amount p               { line-height: calc( 1.1em / .8 ); }
#qrb-r-accept h3              { line-height: calc( .8em / .6 ); }
#qrb-p h3                     { font-size: .8em; line-height: calc( 1.1em / .8 ); }
#qrb-p p                      { font-size: 1em; line-height: 1.1em; padding-bottom: 1.1em; }
#qrb-p-amount p               { line-height: 1.3em; }
#qrb-p-extra *                { font-size: .7em; line-height: calc( .8em / .7 ); }
#qrb                          { display: grid; grid-template-columns: 5fr 52fr 10fr 138fr 5fr; }
#qrb-r                        { display: grid; grid-column-start: 2; grid-column-end: 3;
                                grid-template-rows: 5fr 7fr 56fr 14fr 18fr 5fr; }
#qrb-r-title                  { grid-row-start: 2; grid-row-end: 3; }
#qrb-r-info                   { grid-row-start: 3; grid-row-end: 4; }
#qrb-r-amount                 { grid-row-start: 4; grid-row-end: 5; }
#qrb-r-accept                 { grid-row-start: 5; grid-row-end: 6; }
#qrb-p                        { display: grid; grid-column-start: 4; grid-column-end: 5; grid-template-columns: 51fr 87fr;
                                grid-template-rows: 5fr 7fr 56fr 22fr 10fr 5fr; }
#qrb-p-title                  { grid-column-start: 1; grid-column-end: 2; grid-row-start: 2; grid-row-end: 3; }
#qrb-p-qrcode                 { grid-column-start: 1; grid-column-end: 2; grid-row-start: 3; grid-row-end: 4; }
#qrb-p-amount                 { grid-column-start: 1; grid-column-end: 2; grid-row-start: 4; grid-row-end: 5; }
#qrb-p-info                   { grid-column-start: 2; grid-column-end: 3; grid-row-start: 2; grid-row-end: 5; }
#qrb-p-extra                  { grid-column-start: 1; grid-column-end: 3; grid-row-start: 5; grid-row-end: 6; }
#qrb div                      { overflow: visible; }

@media screen {

  :root                       { --qrb-10pt: calc( 960px / 72 ); --qrb-10mm: calc( 72 * var( --qrb-10pt ) / 25.4 ); }
  #qrb-ch                     { position: absolute; width: calc( 21 * var( --qrb-10mm ) );
                                height: calc( 11 * var( --qrb-10mm ) ); background-color: #ffffff; }
  #qrb                        { position: absolute; width: calc( 21 * var( --qrb-10mm ) );
                                height: calc( 10.5 * var( --qrb-10mm ) ); margin-top: calc( .5 * var( --qrb-10mm ) ); }
  #qrb-p-qrcode svg           { width: calc( 4.6 * var( --qrb-10mm ) ); height: calc( 4.6 * var( --qrb-10mm ) ); margin-top:
                                calc( .5 * var( --qrb-10mm ) ); }
  #qrb-p-qrcode svg + svg     { margin-top: calc( -4.6 * var( --qrb-10mm ) ); }
  #qrb-r-debtor               { width: calc( 5.4 * var( --qrb-10mm ) ); height: calc( 2.2 * var( --qrb-10mm ) );
                                margin-top: calc( -.1 * var( --qrb-10mm ) ); margin-left: calc( -.1 * var( --qrb-10mm ) ); }
  #qrb-p-debtor               { width: calc( 6.7 * var( --qrb-10mm ) ); height: calc( 2.7 * var( --qrb-10mm ) );
                                margin-top: calc( -.1 * var( --qrb-10mm ) ); margin-left: calc( -.1 * var( --qrb-10mm ) ); }
  #qrb, #qrb div              { font-size: var( --qrb-10pt ); }

}

@media print     {

  @page                       { size: 21cm 29.7cm; margin: 0; }
  #qrb-ch                     { position: absolute; top: 18.7cm; left: 0; width: 21cm; height: 11cm; }
  #qrb                        { page-break-inside: avoid; position: absolute; top: 19.2cm; left: 0; width: 21cm; height: 10.5cm; }
  #qrb-p-qrcode svg           { width: 4.6cm; height: 4.6cm; margin-top: .5cm; }
  #qrb-p-qrcode svg + svg     { margin-top: -4.6cm; }
  #qrb-r-debtor               { width: 5.4cm; height: 2.2cm; margin-top: -.1cm; margin-left: -.1cm; }
  #qrb-p-debtor               { width: 6.7cm; height: 2.7cm; margin-top: -.1cm; margin-left: -.1cm; }
  #qrb, #qrb div              { font-size: 10pt; }

}
</style>

<SwissCross />
<div id="qrb" class="qrb">
  <div id="qrb-r" class="qrb receipt">
    <div id="qrb-r-title" class="qrb receipt title">
      <h2 class="de">Empfangsschein</h2>
      <h2 class="fr">Récépissé</h2>
      <h2 class="it">Ricevuta</h2>
      <h2 class="en">Receipt</h2>
    </div>
    <div id="qrb-r-info" class="qrb receipt information">
      <div>
        <h3 class="de">Konto / Zahlbar an</h3>
        <h3 class="fr">Compte / Payable à</h3>
        <h3 class="it">Conto / Pagabile a</h3>
        <h3 class="en">Account / Payable to</h3>
        <p class="the_cdtr"></p>
      </div>
      <div id="qr_bill_receipt_information_reference" class="qrb receipt information reference">
        <h3 class="de">Referenz</h3>
        <h3 class="fr">Référence</h3>
        <h3 class="it">Riferimento</h3>
        <h3 class="en">Reference</h3>
        <p class="the_rmtinf"></p>
      </div>
      <div>
        <h3 class="de">Zahlbar durch<span class="qr-address"> (Name/Adresse)</span></h3>
        <h3 class="fr">Payable par<span class="qr-address"> (nom/adresse)</span></h3>
        <h3 class="it">Pagabile da<span class="qr-address"> (nome/indirizzo)</span></h3>
        <h3 class="en">Payable by<span class="qr-address"> (name/address)</span></h3>
        <p class="qrb-v-debtor"></p>
      </div>
    </div>
    <div id="qrb-r-amount" class="qrb receipt amount">
      <div>
        <h3 class="de">Währung</h3>
        <h3 class="fr">Monnaie</h3>
        <h3 class="it">Valuta</h3>
        <h3 class="en">Currency</h3>
        <p class="the_ccyamt_ccy">CHF</p>
      </div>
      <div>
        <h3 class="de">Betrag</h3>
        <h3 class="fr">Montant</h3>
        <h3 class="it">Importo</h3>
        <h3 class="en">Amount</h3>
        <p class="the_ccyamt_amt"></p>
      </div>
    </div>
    <div id="qrb-r-accept" class="qrb receipt acceptancepoint">
      <div>
        <h3 class="de">Annahmestelle</h3>
        <h3 class="fr">Point de dépôt</h3>
        <h3 class="it">Punto di accettazione</h3>
        <h3 class="en">Acceptance point</h3>
      </div>
    </div>
  </div>
  <div id="qrb-p" class="qrb paymentpart">
    <div id="qrb-p-title" class="qrb paymentpart title">
      <h2 class="de">Zahlteil</h2>
      <h2 class="fr">Section paiement</h2>
      <h2 class="it">Sezione pagamento</h2>
      <h2 class="en">Payment part</h2>
    </div>
    <div id="qrb-p-qrcode" class="qrb paymentpart qrcode">
    </div>
    <div id="qrb-p-amount" class="qrb paymentpart amount">
      <div>
        <h3 class="de">Währung</h3>
        <h3 class="fr">Monnaie</h3>
        <h3 class="it">Valuta</h3>
        <h3 class="en">Currency</h3>
        <p class="the_ccyamt_ccy">CHF</p>
      </div>
      <div>
        <h3 class="de">Betrag</h3>
        <h3 class="fr">Montant</h3>
        <h3 class="it">Importo</h3>
        <h3 class="en">Amount</h3>
        <p class="the_ccyamt_amt"></p>
      </div>
    </div>
    <div id="qrb-p-info" class="qrb paymentpart information">
      <div>
        <h3 class="de">Konto / Zahlbar an</h3>
        <h3 class="fr">Compte / Payable à</h3>
        <h3 class="it">Conto / Pagabile a</h3>
        <h3 class="en">Account / Payable to</h3>
        <p class="the_cdtr"></p>
      </div>
      <div id="qr_bill_paymentpart_information_reference" class="qrb paymentpart information reference">
        <h3 class="de">Referenz</h3>
        <h3 class="fr">Référence</h3>
        <h3 class="it">Riferimento</h3>
        <h3 class="en">Reference</h3>
        <p class="the_rmtinf"></p>
      </div>
      <div id="qr_bill_paymentpart_information_addinf" class="qrb paymentpart information addinf">
        <h3 class="de">Zusätzliche Informationen</h3>
        <h3 class="fr">Informations additionnelles</h3>
        <h3 class="it">Informazioni aggiuntive</h3>
        <h3 class="en">Additional information</h3>
        <p class="the_addinf"></p>
      </div>
      <div>
        <h3 class="de">Zahlbar durch<span class="qr-address"> (Name/Adresse)</span></h3>
        <h3 class="fr">Payable par<span class="qr-address"> (nom/adresse)</span></h3>
        <h3 class="it">Pagabile da<span class="qr-address"> (nome/indirizzo)</span></h3>
        <h3 class="en">Payable by<span class="qr-address"> (name/address)</span></h3>
        <p class="qrb-v-debtor"></p>
      </div>
    </div>
    <div id="qrb-p-extra" class="qrb paymentpart furtherinformation">
    </div>
  </div>
</div>
