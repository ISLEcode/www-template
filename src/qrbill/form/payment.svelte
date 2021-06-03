<script lang="ts">
import { Icon, Col, Container, Row } from 'sveltestrap5';
import { Button, Form, FormGroup, FormText, Input, Label } from 'sveltestrap5';
import { Card, CardBody, CardFooter, CardHeader, CardSubtitle, CardText, CardTitle } from 'sveltestrap5';
import { qrbill } from '../store/qrbills';
import VATRates from './options/vatrates.svelte';
import Suppliers from './options/suppliers.svelte';
import Orders    from './options/orders.svelte';

let input_ok = '';
</script>

<Card class="mb-3">
  <CardHeader>
    <CardTitle>
      <Icon name="receipt" /> En résumé
    </CardTitle>
  </CardHeader>
  <CardBody>

    <Row>

      <Col class="col-12">
        <FormGroup class="form-floating">
          <Input id="payment-supplier" class="{input_ok}" type="select" bind:value={$qrbill.payment.supplier}>
            <Suppliers />
          </Input>
          <Label for="payment-supplier">Fournisseur</Label>
          <div class="invalid-feedback">
          </div>
        </FormGroup>
      </Col>

      <Col class="col-12 col-md-6">
        <FormGroup class="form-floating">
          <Input id="payment-id" class="{input_ok}" type="text" bind:value={$qrbill.payment.billid}
            placeholder="0123456789" />
          <Label for="payment-id">Référence facture</Label>
          <div class="invalid-feedback">
          </div>
        </FormGroup>
      </Col>

      <Col class="col-12 col-md-4">
        <FormGroup class="form-floating">
          <Input id="payment-amount" readonly class="{input_ok}" type="text" bind:value={$qrbill.payment.amount}
            placeholder="1949.75" />
          <Label class="form-control-plaintext" for="payment-amount">Montant</Label>
          <div class="invalid-feedback">
            Montant du paiement — L'élément est à indiquer sans zéros de tête y compris séparateur décimal et deux décimales.
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
    <Row>

      <Col class="col-12 col-md-3">
        <FormGroup class="form-floating">
          <Input id="payment-date" class="{input_ok}" type="date" bind:value={$qrbill.payment.date}
            placeholder="Today" />
          <Label for="payment-date">Date du BV</Label>
          <div class="invalid-feedback">
          </div>
        </FormGroup>
      </Col>

      <Col class="col-12 col-md-3">
        <FormGroup class="form-floating">
          <Input id="payment-delay" class="{input_ok}" type="number" bind:value={$qrbill.payment.delay}
            placeholder="Today" />
          <Label for="payment-delay">Délai</Label>
          <div class="invalid-feedback">
          </div>
        </FormGroup>
      </Col>

      <Col class="col-12 col-md-3">
        <FormGroup class="form-floating">
          <Input id="payment-duedate" class="{input_ok}" type="date" bind:value={$qrbill.payment.duedate}
            placeholder="Today" />
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
    <Row>

      <Col class="col-12 col-md-6">

        <FormGroup class="form-floating">
          <Input id="payment-multiple-accounts" type="checkbox" bind:checked={$qrbill.payment.splitaccounts}
            label="Ventiler par comptes"/>
        </FormGroup>

        {#if !$qrbill.payment.splitaccounts}
        <FormGroup class="form-floating">
          <Input id="payment-account" class="{input_ok}" type="select" bind:value={$qrbill.payment.account}>
            <option>Compte #1</option>
            <option>Compte #2</option>
          </Input>
          <Label for="payment-account">Compte</Label>
          <div class="invalid-feedback">
          </div>
        </FormGroup>
        {/if}

      </Col>

      <Col class="col-12 col-md-6">

        <FormGroup class="form-floating">
          <Input id="payment-multiple-orders" type="checkbox" bind:checked={$qrbill.payment.splitorders}
            label="Ventiler par mandats"/>
        </FormGroup>

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
          <Input id="payment-reftype" class="{input_ok}" type="select" bind:value={$qrbill.payment.reftype}
            placeholder="Type de référence">
            <option value="QRR">Référence QR</option>
            <option value="SCOR">Référence bénéficiaire</option>
            <option value="NON">Sans référence</option>
          </Input>
          <Label for="payment-reftype">Type de référence</Label>
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
                placeholder="" />
          <Label for="payment-reference">Numéro de référence</Label>
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
        placeholder="Instructions du 03.04.2021" />
      <Label for="payment-moreinfo">Informations supplémentaires</Label>
      <div class="invalid-feedback">
        Les informations non structurées peuvent être utilisées pour l'indication d'un motif de paiement ou pour des informations
        textuelles complémentaires au sujet de paiements avec référence structurée. — 140 caractères au maximum
      </div>
    </FormGroup>

    <FormGroup class="form-floating">
      <Input id="payment-billinfo" class="{input_ok}" type="textarea" bind:value={$qrbill.payment.billinfo}
        placeholder="//S1/10/10201409/11/190512/20/1400.000-53/30/106017086/31/180508/32/7.7/40/2:10;0:30" />
      <Label for="payment-billinfo">Donées normalisées de facturation</Label>
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
        placeholder="Name AV1: UV;UltraPay005;12345" />
      <Label for="payment-extra1">Complément #1</Label>
      <div class="invalid-feedback">
        Informations complémentaire — 100 caractères au maximum.
      </div>
    </FormGroup>

    <FormGroup class="form-floating">
      <Input id="payment-extra2" class="{input_ok}" type="text" bind:value={$qrbill.payment.extra2}
        placeholder="Name AV2: XY;XYService;54321" />
      <Label for="payment-extra2">Complément #2</Label>
      <div class="invalid-feedback">
        Informations complémentaire — 100 caractères au maximum.
      </div>
    </FormGroup>

  </CardBody>
</Card>
