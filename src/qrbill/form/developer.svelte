<script lang="ts">
import { Icon, Col, Container, Row } from 'sveltestrap5';
import { Button, Form, FormGroup, FormText, Input, Label } from 'sveltestrap5';
import { Card, CardBody, CardFooter, CardHeader, CardSubtitle, CardText, CardTitle } from 'sveltestrap5';
import { qrbill } from '../store/qrbills';
</script>

<Card class="mb-3">
  <CardHeader>
    <CardTitle>
      <Icon name="file-code" /> Options
    </CardTitle>
  </CardHeader>
  <CardBody>
    <Row>
      <Col>
        <FormGroup class="form-floating">
          <Input type="checkbox" bind:checked={$qrbill.ux.editable}
            label="Autoriser la modification des données QR code (excepté le montant, la devise et l'IBAN du bénéficiaire)"/>
          <Input type="checkbox" bind:checked={$qrbill.ux.use_ucreditor}
            label="Autoriser la saisie du bénéficiaire final"/>
          {#if $qrbill.ux.use_ucreditor}
            <Input type="checkbox" bind:checked={$qrbill.ux.use_ucrediban}
              label="Autoriser la saisie d'un IBAN pour le bénéficiaire final"/>
          {/if}
          <Input type="checkbox" bind:checked={$qrbill.ux.show_debtor}
            label="Afficher les données relatives au débiteur"/>
          <Input type="checkbox" bind:checked={$qrbill.ux.show_qrdata}
            label="Afficher les données brutes du QR code"/>
          {#if $qrbill.ux.show_qrdata}
            <Input type="checkbox" bind:checked={$qrbill.ux.edit_qrdata}
              label="Autoriser la modification des données brutes"/>
          {/if}
        </FormGroup>
      </Col>
    </Row>
  </CardBody>

  <CardHeader>
    <CardTitle>
      <Icon name="file-code" /> Données saisies
    </CardTitle>
  </CardHeader>
  <CardBody>
    <Row>
      <Col class="col-12 col-md-4">
        <p class="lead">Paiement</p>
        <pre>{JSON.stringify($qrbill.payment, null, 2)}</pre>
      </Col>
      <Col class="col-12 col-md-4">
        <p class="lead">Bénéficiaire</p>
        <pre>{JSON.stringify($qrbill.creditor, null, 2)}</pre>
      </Col>
      {#if $qrbill.ux.use_ucreditor}
        <Col class="col-12 col-md-4">
          <p class="lead">Bénéficiaire final</p>
          <pre>{JSON.stringify($qrbill.ucreditor, null, 2)}</pre>
        </Col>
      {/if}
      {#if $qrbill.ux.show_debtor}
        <Col class="col-12 col-md-4">
          <p class="lead">Débiteur</p>
          <pre>{JSON.stringify($qrbill.debtor, null, 2)}</pre>
        </Col>
      {/if}
      {#if $qrbill.payment.splitaccounts}
        <Col class="col-12 col-md-4">
          <p class="lead">Ventilation par compte</p>
          <pre>{JSON.stringify($qrbill.accounts, null, 2)}</pre>
        </Col>
      {/if}
      {#if $qrbill.payment.splitorders}
        <Col class="col-12 col-md-4">
          <p class="lead">Ventilation par mandats</p>
          <pre>{JSON.stringify($qrbill.orders, null, 2)}</pre>
        </Col>
      {/if}
    </Row>
  </CardBody>

  {#if $qrbill.ux.show_qrdata}
    <CardHeader>
      <CardTitle>
        <Icon name="file-code" /> Données saisies
      </CardTitle>
    </CardHeader>
    <CardBody>
      <Row>
        <Col class="col-12">
          <FormGroup class="form-floating">
             <Input id="qrdata" type="text" bind:value={$qrbill.data}
               placeholder="Données brutes du dernier QR code scanée" readonly={!$qrbill.ux.edit_qrdata} />
             <Label class={$qrbill.ux.edit_qrdata ? '' : 'form-control-plaintext'} for="qrdata">QRCode data</Label>
           </FormGroup>
        </Col>
      </Row>
    </CardBody>
  {/if}

</Card>
