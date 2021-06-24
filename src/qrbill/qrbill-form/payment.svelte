<script lang="ts">
import { Icon, Col, Container, Row } from 'sveltestrap5';
import { Button, Form, FormGroup, FormText, Input, InputGroupText, Label } from 'sveltestrap5';
import { Modal, ModalBody, ModalFooter, ModalHeader } from 'sveltestrap5';
import { Card, CardBody, CardFooter, CardHeader, CardSubtitle, CardText, CardTitle } from 'sveltestrap5';

import { qrbill } from '../store/qrbills';
import { qrdata2array, qrbill2ary, match_suppliers  } from '../../lib/stdlib/qrbill';
import rc from '../prefs';

import InputAccount        from './payment/account.svelte';
import InputAmount         from './payment/amount.svelte';
import InputBillInfo       from './payment/billinfo.svelte';
import InputCreditorName   from './payment/creditor-name.svelte';
import InputCreditorSuffix from './payment/creditor-suffix.svelte';
import InputCurrency       from './payment/currency.svelte';
import InputDate           from './payment/date.svelte';
import InputDelay          from './payment/delay.svelte';
import InputDueDate        from './payment/duedate.svelte';
import InputExtra1         from './payment/extra1.svelte';
import InputExtra2         from './payment/extra2.svelte';
import InputLabel          from './payment/label.svelte';
import InputMoreInfo       from './payment/moreinfo.svelte';
import InputOrder          from './payment/order.svelte';
import InputRefType        from './payment/reftype.svelte';
import InputReference      from './payment/reference.svelte';
import InputSplitAccounts  from './payment/split-accounts.svelte';
import InputSplitOrders    from './payment/split-orders.svelte';
import InputSupplier       from './payment/supplier.svelte';
import InputUpdateCreditor from './payment/update-creditor.svelte';
import InputVATCode        from './payment/vatcode.svelte';

let suffix_width; $: suffix_width = $qrbill .creditor .id == 0 ? 5 : 4
let disabled = false

let can_submit = true;
// $: can_submit = $qrbill.payment.vatcode
//    && ($qrbill.creditor.id && $qrbill.creditor.id != '+' || $qrbill.creditor.label)
// && $qrbill.payment.account
// && $qrbill.payment.order

let message = '';

function validate () { reset (); }
function reset () {
    $qrbill.data = null
    if (!$rc.prefs.use_samples) return
    $rc.prefs.use_samples = false
//    location.reload()
}

function edit_supplier () { }

function upload_qrbill () {
// const api_url = 'https://dusaasp1.isle.plus/qrcode/api/index.php'
    const body =  qrbill2ary ($qrbill, $rc.prefs)

    console .log ('submitting', body)
    console .log ('backend', $rc.backend)

//.then  (response => { return (response.ok) ? response .json () : response .json() .then (json => { throw json; }) })
    fetch  ($rc.backend + '/qrbill', { method: 'post', cache: 'no-cache', body: JSON .stringify (body) })
    .then  (response => { if (response.ok) return response .json () })
    .then  (reply => {
        message = reply .code + ': ' + reply .message
        rc. sync()
        reset ()
        console .log ('OK', reply)
    })
    .catch (reply => {
//message = reply .code + ': ' + reply .message
        message = reply
        console .log ('FAILED', reply)
    })

}

// TODO This function is replicated in several locations... consolidate that!!!
function update_duedate () {

    // Collect the bill's date and reformat it's string representation to our canonical format
    const date  = new Date ($qrbill .payment. date)
    const cdate = date .toLocaleDateString ('fr-CA', {year: 'numeric', month: '2-digit', day: '2-digit'});

    // Collect the delay to apply to the bill's date
    const delay = $qrbill .payment .delay

    // Calculate the duedate and format its string representation to our canonical format
    date .setDate (date .getDate() + delay)
    const duedate = date .toLocaleDateString ('fr-CA', {year: 'numeric', month: '2-digit', day: '2-digit'});

    // We're done... update the current bill's dates
    $qrbill .payment .date    = cdate
    $qrbill .payment .duedate = duedate

}

// main()
$: if (!$qrbill .payment. duedate) update_duedate ()

// Modal on validation
let open = false;
const toggle = () => (open = !open);

</script>

<p>{message}</p>

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
        <Button on:click={upload_qrbill} type="submit" outline size=lg color=success disabled={!can_submit}>Validation</Button>
      </Col>
    </Row>

    <Row class="mt-3">
      <Col class="col-12"><InputSupplier tabindex="1" suppliers={$rc.suppliers} /></Col>
    </Row>

    {#if !$rc.prefs.auto_hidesupplier || $qrbill .creditor .id == 0}
      <Row>
        <Col class="col-12 col-md-6"><InputCreditorName   tabindex="2" /></Col>
        <Col class="col-12 col-md-4"><InputCreditorSuffix tabindex="3" /></Col>
        <Col class="col-12 col-md-2"><InputUpdateCreditor tabindex="4" /></Col>
      </Row>
    {/if}

    <Row>
      <Col class="col-12 col-md-6"><InputLabel    tabindex="5"          /></Col>
      <Col class="col-12 col-md-4"><InputAmount   tabindex="6"          /></Col>
      <Col class="col-12 col-md-2"><InputCurrency tabindex="7" disabled /></Col>
    </Row>

    <Row>
      <Col class="col-12 col-md-3"><InputDate    tabindex="8"           /></Col>
      <Col class="col-12 col-md-3"><InputDelay   tabindex="9"           /></Col>
      <Col class="col-12 col-md-3"><InputDueDate tabindex="10" readonly /></Col>
      <Col class="col-12 col-md-3"><InputVATCode tabindex="11"          /></Col>
    </Row>

    <Row>
      <Col class="col-12 col-md-6">
        <InputSplitAccounts visible={$rc.prefs.show_splits} tabindex="12" />
        <InputAccount tabindex="13" />
      </Col>
      <Col class="col-12 col-md-6">
        <InputSplitOrders visible={$rc.prefs.show_splits} tabindex="14" />
        <InputOrder tabindex="15" />
      </Col>
    </Row>

  </CardBody>
</Card>

<Card class="mb-3">
  <CardHeader>
    <CardTitle><Icon name="tags-fill" /> Références du paiement</CardTitle>
  </CardHeader>
  <CardBody>
    <Row>
      <Col class="col-12 col-md-3"><InputRefType   disabled={!$rc.prefs.editable} tabindex="16" /></Col>
      <Col class="col-12 col-md-9"><InputReference readonly={!$rc.prefs.editable} tabindex="17" /></Col>
    </Row>
    <InputMoreInfo readonly={!$rc.prefs.editable} tabindex="18" />
    <InputBillInfo readonly={!$rc.prefs.editable} tabindex="19" />
  </CardBody>
</Card>

<Card class="mb-3">
  <CardHeader>
    <CardTitle><Icon name="list-stars" /> Informations complémentaires</CardTitle>
  </CardHeader>
  <CardBody>
    <InputExtra1 readonly={!$rc.prefs.editable} tabindex="20" />
    <InputExtra2 readonly={!$rc.prefs.editable} tabindex="21" />
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
