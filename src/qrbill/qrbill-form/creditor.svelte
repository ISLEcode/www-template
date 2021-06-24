<script lang="ts">
import { Icon, Col, Container, Row                                                 } from 'sveltestrap5';
import { Button, Form, FormGroup, FormText, Input, Label                           } from 'sveltestrap5';
import { Card, CardBody, CardFooter, CardHeader, CardSubtitle, CardText, CardTitle } from 'sveltestrap5';
import { qrbill                                                                    } from '../store/qrbills';
import rc from '../prefs';
import Countries from './options/countries.svelte';

let input_ok = '';

// Determine how the address should be layed out
let addrtype = ($qrbill.creditor.addrtype === 'S');
$:  $qrbill.creditor.addrtype = addrtype ? 'S' : 'K';
</script>

<Card class="mb-3">
  <CardHeader>
    <CardTitle>
      <Icon name="person-lines-fill" /> Bénéficiaire
    </CardTitle>
  </CardHeader>
  <CardBody>

    <Row>
      <Col class="col-12 col-md-6">
        <FormGroup class="form-floating">
          <Input id="creditor-iban" readonly class="{input_ok}" type="text" bind:value={$qrbill.creditor.iban}
            placeholder="CH4431999123000889012" />
          <Label class="form-control-plaintext" for="creditor-iban">Compte</Label>
          <div class="invalid-feedback">IBAN ou QR-IBAN du bénéficiare Longueur. — Fixe: 21 caractères alphanumériques.
          — IBAN seulement admis avec code de pays CH ou LI."</div>
        </FormGroup>
      </Col>
      <Col class="col-12 col-md-6">
        <FormGroup class="form-floating">
          <Input id="creditor-name" class="{input_ok}" type="text" bind:value={$qrbill.creditor.name}
            placeholder="Robert Schneider AG" readonly={!$rc.prefs.editable} />
          <Label class={$rc.prefs.editable ? '' : 'form-control-plaintext'} for="creditor-name">Nom</Label>
          <div class="invalid-feedback">Nom ou entreprise du bénéficiaire selon la désignation de compte.
          — Remarque: correspond toujours au titulaire du compte. — 70 caractères au maximum
          — Prénom (optionnel, si disponible) et nom ou raison sociale</div>
        </FormGroup>
      </Col>
    </Row>

    <FormGroup class="form-floating">
      <Input id="creditor-addrtype" type="checkbox" bind:checked={addrtype} label="Adresse compacte"/>
    </FormGroup>

    <Row>
      {#if $qrbill.creditor.addrtype === 'S'}
        <Col class="col-12 col-md-9">
          <FormGroup class="form-floating">
            <Input id="creditor-addr1" class="{input_ok}" type="text" bind:value={$qrbill.creditor.addr1}
              placeholder="Rue du Lac" readonly={!$rc.prefs.editable} />
            <Label class={$rc.prefs.editable ? '' : 'form-control-plaintext'} for="creditor-addr1">Rue</Label>
            <div class="invalid-feedback">Rue/Case postale du bénéficiaire — 70 caractères au maximum admis
            — Ne peut pas contenir un numéro de maison ou de bâtiment.</div>
          </FormGroup>
        </Col>
        <Col class="col-12 col-md-3">
          <FormGroup class="form-floating">
            <Input id="creditor-addr2" class="{input_ok}" type="text" bind:value={$qrbill.creditor.addr2}
              placeholder="1268" readonly={!$rc.prefs.editable} />
            <Label class={$rc.prefs.editable ? '' : 'form-control-plaintext'} for="creditor-addr1">Numéro</Label>
            <div class="invalid-feedback">Numéro de maison du bénéficiaire — 16 caractères au maximum admis</div>
          </FormGroup>
        </Col>
      {:else}
        <Col class="col-12">
          <FormGroup class="form-floating">
            <Input id="creditor-addr1" class="{input_ok}" type="text" bind:value={$qrbill.creditor.addr1}
              placeholder="Rue du Lac" readonly={!$rc.prefs.editable} />
            <Label class={$rc.prefs.editable ? '' : 'form-control-plaintext'} for="creditor-addr1">Adresse #1</Label>
            <div class="invalid-feedback">Rue/Case postale du bénéficiaire — 70 caractères au maximum admis
            — Ne peut pas contenir un numéro de maison ou de bâtiment.</div>
          </FormGroup>
        </Col>
        <Col class="col-12">
          <FormGroup class="form-floating">
            <Input id="creditor-addr2" class="{input_ok}" type="text" bind:value={$qrbill.creditor.addr2}
              placeholder="1268" readonly={!$rc.prefs.editable} />
            <Label class={$rc.prefs.editable ? '' : 'form-control-plaintext'} for="creditor-addr1">Adresse #2</Label>
            <div class="invalid-feedback">Numéro de maison du bénéficiaire — 16 caractères au maximum admis</div>
          </FormGroup>
        </Col>
      {/if}
    </Row>

    <Row>
      <Col class="col-12 col-md-2">
        <FormGroup class="form-floating">
          <Input id="creditor-postcode" class="{input_ok}" type="text" bind:value={$qrbill.creditor.postcode}
            placeholder="2501" readonly={!$rc.prefs.editable} />
          <Label class={$rc.prefs.editable ? '' : 'form-control-plaintext'} for="creditor-postcode">NPA</Label>
          <div class="invalid-feedback">NPA du bénéficiaire — 16 caractères au maximum admis
          — Ne jamais préfixer le code du pays</div>
        </FormGroup>
      </Col>
      <Col class="col-12 col-md-6">
        <FormGroup class="form-floating">
          <Input id="creditor-location" class="{input_ok}" type="text" bind:value={$qrbill.creditor.location}
            placeholder="Bienne" readonly={!$rc.prefs.editable} />
          <Label class={$rc.prefs.editable ? '' : 'form-control-plaintext'} for="creditor-location">Lieu</Label>
          <div class="invalid-feedback">Lieu du bénéficiaire — 35 caractères au maximum admis</div>
        </FormGroup>
      </Col>
      <Col class="col-12 col-md-4">
        <FormGroup class="form-floating">
          <Input id="creditor-country" class="{input_ok}" type="select" bind:value={$qrbill.creditor.country}
            placeholder="CH" disabled={!$rc.prefs.editable}><Countries selected={$qrbill.creditor.country}/></Input>
          <Label class={$rc.prefs.editable ? '' : 'form-control-plaintext'} for="creditor-country">Pays</Label>
          <div class="invalid-feedback">Pays du bénéficiaire — Code <i>Alpha 2</i> du pays selon ISO 3166-1</div>
        </FormGroup>
      </Col>
    </Row>

  </CardBody>
</Card>

