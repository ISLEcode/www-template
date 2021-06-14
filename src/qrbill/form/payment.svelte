<script lang="ts">
import { Icon, Col, Container, Row } from 'sveltestrap5';
import { Button, Form, FormGroup, FormText, Input, InputGroupText, Label } from 'sveltestrap5';
import { Modal, ModalBody, ModalFooter, ModalHeader } from 'sveltestrap5';
import { Card, CardBody, CardFooter, CardHeader, CardSubtitle, CardText, CardTitle } from 'sveltestrap5';

import { qrbill } from '../store/qrbills';
import { qrdata2array, qrbill2ary  } from '../../lib/stdlib/qrbill';
import rc from '../prefs';
import VATRates from './options/vatrates.svelte';
import LedgerAccount from './options/ledger-accounts.svelte';
import Suppliers from './options/suppliers.svelte';
import Orders    from './options/orders.svelte';
    //import Tags      from '../widget/Tags.svelte';

let input_ok = '';

let can_submit = true;
// $: can_submit = $qrbill.payment.vatcode
//    && ($qrbill.creditor.id && $qrbill.creditor.id != '+' || $qrbill.creditor.label)
// && $qrbill.payment.account
// && $qrbill.payment.order

function validate () { reset (); }
function reset () {
    $qrbill.data = null
    if (!$rc.prefs.use_samples) return
    $rc.prefs.use_samples = false
    location.reload()
}

function edit_supplier () { }

    // let delay, suffix, label, refid, vatcode
    // $: if (delay) $qrbill .payment .delay = delay
    // $: if (suffix) $qrbill .payment .delay = delay
    // $: if (vatcode) $qrbill .supplier .suffix = vatcode

function upload_qrbill () {
    const api_url = 'https://dusaasp1.isle.plus/qrcode/api/index.php'
    const body =  qrbill2ary ($qrbill, $rc.prefs)

    fetch  (`${api_url}/qrbill`, { method: 'post', cache: 'no-cache', body: JSON .stringify (body) })
    .then  ((response) => { return response .ok ? response .json() : Promise .reject (response) })
    .then  ((data)     => { console .log ('DATA', data) })
    .catch ((error)    => { })

}

function update_delay () {
    const a = new Date ($qrbill .payment. date)
    const b = new Date ($qrbill .payment. duedate)
    const c = 1000 * 60 * 60 * 24;

    const utc1 = Date .UTC (a .getFullYear(), a .getMonth(), a .getDate());
    const utc2 = Date .UTC (b .getFullYear(), b .getMonth(), b .getDate());

    $qrbill .payment .delay = Math .floor ((utc2 - utc1) / c);
}

function update_duedate () {
    let date = new Date ($qrbill .payment. date)
    let duedate = new Date ();
    duedate .setDate (date .getDate() + $qrbill .payment .delay)
    console.log ('From:', date.toString(), 'To:', duedate .toString())
    // $qrbill .payment .duedate = duedate .getFullYear() + '-' + (duedate .getMonth() + 1) + '-' + duedate .getDate()
    $qrbill .payment .duedate = duedate .toLocaleDateString ('fr-CA', {year: 'numeric', month: '2-digit', day: '2-digit'});

}

function assign_creditor (e) {

    let id = $qrbill .creditor .id

    if (id == '+' || id == 'none') {
        $qrbill .payment .delay   = 1
        $qrbill .payment .vatcoce = '0'
        $qrbill .payment .account = ''
        return
    }

    let creditor = $rc.suppliers.find (supplier => supplier .id == id)
    $qrbill .payment .delay   = creditor .delay
    $qrbill .payment .vatcode = creditor .vat_id
    $qrbill .payment .account = creditor .account_id

    update_duedate ();

}

// Modal on validation
let open = false;
const toggle = () => (open = !open);

</script>

<Card class="mb-3">
  <CardHeader>
    <CardTitle>
      <Icon name="receipt" /> En résumé
    </CardTitle>
  </CardHeader>
  <CardBody>

    <Row>
      <Col class="text-end">
        <Button on:click={reset}  outline size=lg color=secondary>Annulation</Button>
        <Button on:click={upload_qrbill} outline size=lg color=success disabled={!can_submit}>Validation</Button>
      </Col>
    </Row>

    <!-- Row #1: Select the creditor (aka the supplier)

    We provide here an autocomplete select tag which allows to select the creditor (aka the supplier in SAMinfo vocable) for this
    QRbill. Amongst the select options is one whose value is `+`; this is a placeholder to enable the input of a new creditor
    (cf. the subsequent row). Upon selection of an existing creditor, the payment delay, the VAT category code, and the ledger
    account are automatically updated to reflect those associated to this creditor.

    The select tag is contained withing a form group alongside a checkbox. This checkbox is enabled whenever the inputs bound to
    this creditor are changed (with respect to the associated values in the creditor's record.

    Design notes: rather than having a second row to input a new creditor's name and optional suffix, we could have extended
    the input group of this row with the appropriate complementary inputs. On laptops and desktop displays, this would be a
    practical layout; this would not be the case on tablets, even more so on smaller devices where possibly one input could
    entirely disapear. Hence the decision take here to have a separate row for such complementary inputs. -->

    <Row class="mt-3">
      <Col class="col-12 col-md-12">
        <FormGroup class="form-floating input-group">
          <Input id="payment-supplier" class="{input_ok}" type="select" bind:value={$qrbill.creditor.id}
            on:change={assign_creditor} >
            <Suppliers />
          </Input>
          <Label for="payment-supplier">Fournisseur</Label>
          <InputGroupText class="form-floating">
            <Input addon type="checkbox" aria-label="Checkbox for following text input" />
          </InputGroupText>
          <div class="invalid-feedback"></div>
        </FormGroup>
      </Col>
    </Row>

    <!-- Row #2: New creditor's name and optional suffix
    -->

    {#if $qrbill.creditor.id == '+'}
      <Row>
        <Col class="col-12 col-md-8">
          <FormGroup class="form-floating">
            <Input id="creditor-id" class="{input_ok}" type="text" on:click={this.value = $qrbill.creditor.id}
              placeholder="Libellé" />
            <Label for="creditor-id">Libellé fournisseur</Label>
            <div class="invalid-feedback"></div>
          </FormGroup>
        </Col>
        <Col class="col-12 col-md-4">
          <FormGroup class="form-floating">
            <Input id="creditor-suffix" class="{input_ok}" type="text" on:click={this.value = $qrbill.creditor.suffix}
              placeholder="Libellé" />
            <Label for="creditor-suffix">Mot(s) clé</Label>
            <div class="invalid-feedback"></div>
          </FormGroup>
        </Col>
      </Row>
    {/if}

    <!-- Row #3: Bill's reference, amount and currency
    -->

    <Row>

      <Col class="col-12 col-md-6">
        <FormGroup class="form-floating">
          <Input id="payment-id" class="{input_ok}" type="text" bind:value={$qrbill.payment.billid}
            placeholder="0123456789" />
          <Label for="payment-id">Référence facture</Label>
          <div class="invalid-feedback"></div>
        </FormGroup>
      </Col>

      <Col class="col-12 col-md-4">
        <FormGroup class="form-floating">
          <Input id="payment-amount" readonly class="{input_ok}" type="text" bind:value={$qrbill.payment.amount}
            placeholder="1949.75" />
          <Label class="form-control-plaintext" for="payment-amount">Montant</Label>
          <div class="invalid-feedback"><em>Montant du paiement</em> —
              L'élément est à indiquer sans zéros de tête y compris séparateur décimal et deux décimales.
            — Décimal, 12 positions au maximum admises, y compris séparateur décimal.
            — Seul le point («.») est admis comme séparateur décimal.
          </div>
        </FormGroup>
      </Col>

      <Col class="col-12 col-md-2">
        <FormGroup class="form-floating">
          <Input id="payment-currency" disabled class="{input_ok}" type="select" bind:value={$qrbill.payment.currency}
            placeholder="Devise">
            <option>CHF</option>
            <option>EUR</option>
          </Input>
          <Label class="form-control-plaintext" for="payment-currency">Devise</Label>
          <div class="invalid-feedback">
            Monnaie du paiement, code monétaire alphabétique à trois positions selon ISO 4217 — Seuls CHF et EUR sont admis.
          </div>
        </FormGroup>
      </Col>

    </Row>

    <!-- Row #4: Payment criteria (bill date, delay, due date, and VAT category)

    NOTE: https://developer.mozilla.org/en-US/docs/Web/HTML/Element/Input/date#examples
    -->

    <Row>

      <Col class="col-12 col-md-3">
        <FormGroup class="form-floating">
          <Input id="payment-date" class="{input_ok}" type="date" bind:value={$qrbill.payment.date}
            pattern="\d{4}-\d{2}-\d{2}" on:change={update_duedate} placeholder="Date du BV" />
          <Label for="payment-date">Date du BV</Label>
          <div class="invalid-feedback">
          </div>
        </FormGroup>
      </Col>

      <Col class="col-12 col-md-3">
        <FormGroup class="form-floating">
          <Input id="payment-delay" class="{input_ok}" type="number" bind:value={$qrbill.payment.delay}
            on:input={update_duedate} placeholder="Délai en jours pour le paiment de ce BV" />
          <Label for="payment-delay">Délai</Label>
          <div class="invalid-feedback">
          </div>
        </FormGroup>
      </Col>

      <Col class="col-12 col-md-3">
        <FormGroup class="form-floating">
          <Input id="payment-duedate" class="{input_ok}" type="date" bind:value={$qrbill.payment.duedate}
            pattern="\d{4}-\d{2}-\d{2}" on:change={update_delay} placeholder="Echéance pour le paiment de ce BV" />
          <Label for="payment-duedate">Echéance</Label>
          <div class="invalid-feedback">
          </div>
        </FormGroup>
      </Col>

      <Col class="col-12 col-md-3">
        <FormGroup class="form-floating">
          <Input id="payment-vatcode" class="{input_ok}" type="select" bind:value={$qrbill.payment.vatcode}><VATRates /></Input>
          <Label for="payment-vatcode">TVA</Label>
          <div class="invalid-feedback">
          </div>
        </FormGroup>
      </Col>

    </Row>

    <!-- Row #5: Payment criteria (ledger account and associated order)
    -->

    <Row>

      <Col class="col-12 col-md-6">

        {#if $rc.prefs.show_splits}
          <FormGroup class="form-floating">
            <Input id="payment-multiple-accounts" type="checkbox" bind:checked={$qrbill.payment.splitaccounts}
              label="Ventiler par comptes"/>
          </FormGroup>
        {/if}

        {#if !$qrbill.payment.splitaccounts}
          <FormGroup class="form-floating">
            <Input id="payment-account" class="{input_ok}" type="select" bind:value={$qrbill.payment.account}>
              <LedgerAccount />
            </Input>
            <Label for="payment-account">Compte</Label>
            <div class="invalid-feedback">
            </div>
          </FormGroup>
        {/if}

      </Col>

      <Col class="col-12 col-md-6">

        {#if $rc.prefs.show_splits}
          <FormGroup class="form-floating">
            <Input id="payment-multiple-orders" type="checkbox" bind:checked={$qrbill.payment.splitorders}
              label="Ventiler par mandats"/>
          </FormGroup>
        {/if}

        {#if !$qrbill.payment.splitorders}
          <FormGroup class="form-floating">
            <Input id="payment-order" class="{input_ok}" type="select" bind:value={$qrbill.payment.order}>
              <Orders />
            </Input>
            <Label for="payment-order">Mandat</Label>
            <div class="invalid-feedback">
            </div>
        </FormGroup>
        {/if}

      </Col>

    </Row>
  </CardBody>
</Card>

<Card class="mb-3">
  <CardHeader>
    <CardTitle>
      <Icon name="tags-fill" /> Références du paiement
    </CardTitle>
  </CardHeader>
  <CardBody>

    <Row>

      <Col class="col-12 col-md-3">
        <FormGroup class="form-floating">
          <Input id="payment-reftype" disabled={!$rc.prefs.editable} class="{input_ok}" type="select" bind:value={$qrbill.payment.reftype}
            placeholder="Type de référence">
            <option value="QRR">Référence QR</option>
            <option value="SCOR">Référence bénéficiaire</option>
            <option value="NON">Sans référence</option>
          </Input>
          <Label class={$rc.prefs.editable ? '' : 'form-control-plaintext'} for="payment-reftype">Type de référence</Label>
          <div class="invalid-feedback">
            Les codes suivants sont admis: QRR (référence QR),  SCOR (référence bénéficiaire, ISO 11649), et NON (sans référence).
            — Quatre caractères au maximum
            — En cas d'utilisation d'un QR-IBAN, doit contenir le code QRR
            — En cas d'utilisation de l'IBAN, il est possible d'indiquer soit le code SCOR, soit le code NON.
          </div>
        </FormGroup>
      </Col>

      <Col class="col-12 col-md-9">
        <FormGroup class="form-floating">
          <Input id="payment-reference" class="{input_ok}" type="text" bind:value={$qrbill.payment.reference}
                placeholder="" readonly={!$rc.prefs.editable} />
          <Label class={$rc.prefs.editable ? '' : 'form-control-plaintext'} for="payment-reference">Numéro de référence</Label>
          <div class="invalid-feedback">
            Référence de paiement structurée — La référence est soit une référence QR, soit une référence bénéficiaire (ISO 11649)
            — 27 caractères alphanumériques au maximum
            — Doit être rempli en cas d'utilisation d'un QR-IBAN
            — Référence QR: calcul du chiffre de contrôle selon modulo 10 récursif (27e position de la référence).
            — Référence bénéficiaire (ISO 11649): jusqu'à 25 caractères alphanumériques.
            — L'élément ne doit pas être rempli pour le type de référence NON."
          </div>
        </FormGroup>
      </Col>

    </Row>

    <FormGroup class="form-floating">
      <Input id="payment-moreinfo" class="{input_ok}" type="textarea" bind:value={$qrbill.payment.moreinfo}
        placeholder="Instructions du 03.04.2021" readonly={!$rc.prefs.editable} />
      <Label class={$rc.prefs.editable ? '' : 'form-control-plaintext'} for="payment-moreinfo">Informations supplémentaires</Label>
      <div class="invalid-feedback">
        Les informations non structurées peuvent être utilisées pour l'indication d'un motif de paiement ou pour des informations
        textuelles complémentaires au sujet de paiements avec référence structurée. — 140 caractères au maximum
      </div>
    </FormGroup>

    <FormGroup class="form-floating">
      <Input id="payment-billinfo" class="{input_ok}" type="textarea" bind:value={$qrbill.payment.billinfo}
        placeholder="//S1/10/10201409/11/190512/20/1400.000-53/30/106017086/31/180508/32/7.7/40/2:10;0:30"
readonly={!$rc.prefs.editable} />
      <Label class={$rc.prefs.editable ? '' : 'form-control-plaintext'} for="payment-billinfo">Donées normalisées de facturation</Label>
      <div class="invalid-feedback">
        Les informations structurelles de l'émetteur de factures contiennent des informations codées pour la comptabilisation
        automatisée du paiement. Les données ne sont pas transmises avec le paiement. — 140 caractères au maximum.
      </div>
    </FormGroup>

  </CardBody>
</Card>

<Card class="mb-3">
  <CardHeader>
    <CardTitle>
      <Icon name="list-stars" /> Informations complémentaires
    </CardTitle>
  </CardHeader>
  <CardBody>

    <FormGroup class="form-floating">
      <Input id="payment-extra1" class="{input_ok}" type="text" bind:value={$qrbill.payment.extra1}
        placeholder="Name AV1: UV;UltraPay005;12345" readonly={!$rc.prefs.editable} />
      <Label class={$rc.prefs.editable ? '' : 'form-control-plaintext'} for="payment-extra1">Complément #1</Label>
      <div class="invalid-feedback">
        Informations complémentaire — 100 caractères au maximum.
      </div>
    </FormGroup>

    <FormGroup class="form-floating">
      <Input id="payment-extra2" class="{input_ok}" type="text" bind:value={$qrbill.payment.extra2}
        placeholder="Name AV2: XY;XYService;54321" readonly={!$rc.prefs.editable} />
      <Label class={$rc.prefs.editable ? '' : 'form-control-plaintext'} for="payment-extra2">Complément #2</Label>
      <div class="invalid-feedback">
        Informations complémentaire — 100 caractères au maximum.
      </div>
    </FormGroup>

  </CardBody>
</Card>

<div>
  <Modal isOpen={open} {toggle}>
    <ModalHeader {toggle}>Mise à jour de SAMinfo</ModalHeader>
    <ModalBody>
        Une erreur est survenue dans la mise à jour de SAMinfo. Aucune modification n'a été faite à vos données sur le serveur.
        Veuillez vérifier vos données et relancer la validation. Si le problème persiste merci de contacter le support.
    </ModalBody>
    <ModalFooter>
      <Button color="secondary" on:click={toggle}>Annuler</Button>
    </ModalFooter>
  </Modal>
</div>
