<script lang="ts">
import { Icon, Col, Container, Row } from 'sveltestrap5';
import { Button, Form, FormGroup, FormText, Input, Label } from 'sveltestrap5';
import { Card, CardBody, CardFooter, CardHeader, CardSubtitle, CardText, CardTitle } from 'sveltestrap5';
import { qrbill } from '../store/qrbills';
import rc from '../prefs';
import Countries from './options/countries.svelte';

let input_ok = '';

// Determine how the address should be layed out
let addrtype = ($qrbill.debtor.addrtype === 'S');

// Allow dynamic adjustment of address layout
$:  $qrbill.debtor.addrtype = addrtype ? 'S' : 'K';
</script>

<Card class="mb-3">
  <CardHeader>
    <CardTitle>
      <Icon name="building" /> Débiteur
    </CardTitle>
  </CardHeader>
  <CardBody>

    <Row>
      <Col class="col-12 col-md-6">
        <FormGroup class="form-floating">
          <Input id="debtor-iban" class="{input_ok}" type="text" bind:value={$qrbill.debtor.iban}
            placeholder="CH4431999123000889012" readonly={!$rc.prefs.editable} />
          <Label class={$rc.prefs.editable ? '' : 'form-control-plaintext'} for="debtor-iban">Compte</Label>
          <div class="invalid-feedback">IBAN ou QR-IBAN du débiteur final Longueur. — Fixe: 21 caractères alphanumériques.
          — IBAN seulement admis avec code de pays CH ou LI."</div>
        </FormGroup>
      </Col>
      <Col class="col-12 col-md-6">
        <FormGroup class="form-floating">
          <Input id="debtor-name" class="{input_ok}" type="text" bind:value={$qrbill.debtor.name}
            placeholder="Robert Schneider AG" readonly={!$rc.prefs.editable} />
          <Label class={$rc.prefs.editable ? '' : 'form-control-plaintext'} for="debtor-name">Nom</Label>
          <div class="invalid-feedback">Nom ou entreprise du débiteur final selon la désignation de compte.
          — Remarque: correspond toujours au titulaire du compte. — 70 caractères au maximum
          — Prénom (optionnel, si disponible) et nom ou raison sociale</div>
        </FormGroup>
      </Col>
    </Row>

    <FormGroup class="form-floating">
      <Input id="debtor-addrtype" type="checkbox" bind:checked={addrtype} label="Adresse compacte"/>
    </FormGroup>

    <Row>
      {#if $qrbill.debtor.addrtype === 'S'}
        <Col class="col-12 col-md-9">
          <FormGroup class="form-floating">
            <Input id="debtor-addr1" class="{input_ok}" type="text" bind:value={$qrbill.debtor.addr1}
              placeholder="Rue du Lac" readonly={!$rc.prefs.editable} />
            <Label class={$rc.prefs.editable ? '' : 'form-control-plaintext'} for="debtor-addr1">Rue</Label>
            <div class="invalid-feedback">Rue/Case postale du débiteur final — 70 caractères au maximum admis
            — Ne peut pas contenir un numéro de maison ou de bâtiment.</div>
          </FormGroup>
        </Col>
        <Col class="col-12 col-md-3">
          <FormGroup class="form-floating">
            <Input id="debtor-addr2" class="{input_ok}" type="text" bind:value={$qrbill.debtor.addr2}
              placeholder="1268" readonly={!$rc.prefs.editable} />
            <Label class={$rc.prefs.editable ? '' : 'form-control-plaintext'} for="debtor-addr2">Numéro</Label>
            <div class="invalid-feedback">Numéro de maison du débiteur final — 16 caractères au maximum admis</div>
          </FormGroup>
        </Col>
      {:else}
        <Col class="col-12">
          <FormGroup class="form-floating">
            <Input id="debtor-addr1" class="{input_ok}" type="text" bind:value={$qrbill.debtor.addr1}
              placeholder="Rue du Lac" readonly={!$rc.prefs.editable} />
            <Label class={$rc.prefs.editable ? '' : 'form-control-plaintext'} for="debtor-addr1">Adresse #1</Label>
            <div class="invalid-feedback">Rue/Case postale du débiteur final — 70 caractères au maximum admis
            — Ne peut pas contenir un numéro de maison ou de bâtiment.</div>
          </FormGroup>
        </Col>
        <Col class="col-12">
          <FormGroup class="form-floating">
            <Input id="debtor-addr2" class="{input_ok}" type="text" bind:value={$qrbill.debtor.addr2}
              placeholder="1268" readonly={!$rc.prefs.editable} />
            <Label class={$rc.prefs.editable ? '' : 'form-control-plaintext'} for="debtor-addr2">Adresse #1</Label>
            <div class="invalid-feedback">Numéro de maison du débiteur final — 16 caractères au maximum admis</div>
          </FormGroup>
        </Col>
      {/if}
    </Row>

    <Row>
      <Col class="col-12 col-md-2">
        <FormGroup class="form-floating">
          <Input id="debtor-postcode" class="{input_ok}" type="text" bind:value={$qrbill.debtor.postcode}
            placeholder="2501" readonly={!$rc.prefs.editable} />
          <Label class={$rc.prefs.editable ? '' : 'form-control-plaintext'} for="debtor-postcode">NPA</Label>
          <div class="invalid-feedback">NPA du débiteur final — 16 caractères au maximum admis
          — Ne jamais préfixer le code du pays</div>
        </FormGroup>
      </Col>
      <Col class="col-12 col-md-6">
        <FormGroup class="form-floating">
          <Input id="debtor-location" class="{input_ok}" type="text" bind:value={$qrbill.debtor.location}
            placeholder="Bienne" readonly={!$rc.prefs.editable} />
          <Label class={$rc.prefs.editable ? '' : 'form-control-plaintext'} for="debtor-location">Lieu</Label>
          <div class="invalid-feedback">Lieu du débiteur final — 35 caractères au maximum admis</div>
        </FormGroup>
      </Col>
      <Col class="col-12 col-md-4">

        <FormGroup class="form-floating">
          <Input id="debtor-country" class="{input_ok}" type="select" bind:value={$qrbill.debtor.country}
            placeholder="CH" disabled={!$rc.prefs.editable}><Countries selected={$qrbill.debtor.country}/></Input>
          <Label class={$rc.prefs.editable ? '' : 'form-control-plaintext'} for="debtor-country">Pays</Label>
          <div class="invalid-feedback">Pays du débiteur final — Code <i>Alpha 2</i> du pays selon ISO 3166-1</div>
        </FormGroup>
      </Col>
    </Row>

  </CardBody>
</Card>

