<script lang="ts">
import { Icon, Col, Container, Row } from 'sveltestrap5';
import { Button, Form, FormGroup, FormText, Input, Label } from 'sveltestrap5';
import { Card, CardBody, CardFooter, CardHeader, CardSubtitle, CardText, CardTitle } from 'sveltestrap5';
import { qrbill } from '../store/qrbills';
import Countries from './options/countries.svelte';

let input_ok = '';

// Determine how the address should be layed out
let addrtype = ($qrbill.ucreditor.addrtype === 'S');

// Allow dynamic adjustment of address layout
$:  $qrbill.ucreditor.addrtype = addrtype ? 'S' : 'K';
</script>

<Card class="mb-3">
  <CardHeader>
    <CardTitle>
      <Icon name="person-lines-fill" /> Bénéficiaire final
    </CardTitle>
  </CardHeader>
  <CardBody>

    {#if !$qrbill.ucreditor.iscreditor}
      <Row>
        {#if $qrbill.ux.use_ucrediban}
          <Col class="col-12 col-md-6">
            <FormGroup class="form-floating">
              <Input id="ucreditor-iban" class="{input_ok}" type="text" bind:value={$qrbill.ucreditor.iban}
                placeholder="CH4431999123000889012" />
              <Label for="ucreditor-iban">Compte</Label>
              <div class="invalid-feedback">IBAN ou QR-IBAN du bénéficiare Longueur. — Fixe: 21 caractères alphanumériques.
              — IBAN seulement admis avec code de pays CH ou LI."</div>
            </FormGroup>
          </Col>
          <Col class="col-12 col-md-6">
            <FormGroup class="form-floating">
              <Input id="ucreditor-name" class="{input_ok}" type="text" bind:value={$qrbill.ucreditor.name}
                placeholder="Robert Schneider AG" readonly={!$qrbill.ux.editable} />
              <Label class={$qrbill.ux.editable ? '' : 'form-control-plaintext'} for="ucreditor-name">Nom</Label>
              <div class="invalid-feedback">Nom ou entreprise du bénéficiaire final selon la désignation de compte.
              — Remarque: correspond toujours au titulaire du compte. — 70 caractères au maximum
              — Prénom (optionnel, si disponible) et nom ou raison sociale</div>
            </FormGroup>
          </Col>
        {:else}
          <Col class="col-12">
            <FormGroup class="form-floating">
              <Input id="ucreditor-name" class="{input_ok}" type="text" bind:value={$qrbill.ucreditor.name}
                placeholder="Robert Schneider AG" readonly={!$qrbill.ux.editable} />
              <Label class={$qrbill.ux.editable ? '' : 'form-control-plaintext'} for="ucreditor-name">Nom</Label>
              <div class="invalid-feedback">Nom ou entreprise du bénéficiaire final selon la désignation de compte.
              — Remarque: correspond toujours au titulaire du compte. — 70 caractères au maximum
              — Prénom (optionnel, si disponible) et nom ou raison sociale</div>
            </FormGroup>
          </Col>
        {/if}
      </Row>

    <FormGroup class="form-floating">
      <Input id="ucreditor-addrtype" type="checkbox" bind:checked={addrtype} label="Adresse compacte"/>
    </FormGroup>

      <Row>
        {#if $qrbill.ucreditor.addrtype === 'S'}
          <Col class="col-12 col-md-9">
            <FormGroup class="form-floating">
              <Input id="ucreditor-addr1" class="{input_ok}" type="text" bind:value={$qrbill.ucreditor.addr1}
                placeholder="Rue du Lac" readonly={!$qrbill.ux.editable} />
              <Label class={$qrbill.ux.editable ? '' : 'form-control-plaintext'} for="ucreditor-addr1">Rue</Label>
              <div class="invalid-feedback">Rue/Case postale du bénéficiaire final — 70 caractères au maximum admis
              — Ne peut pas contenir un numéro de maison ou de bâtiment.</div>
            </FormGroup>
          </Col>
          <Col class="col-12 col-md-3">
            <FormGroup class="form-floating">
              <Input id="ucreditor-addr2" class="{input_ok}" type="text" bind:value={$qrbill.ucreditor.addr2}
                placeholder="1268" readonly={!$qrbill.ux.editable} />
              <Label class={$qrbill.ux.editable ? '' : 'form-control-plaintext'} for="ucreditor-addr2">Numéro</Label>
              <div class="invalid-feedback">Numéro de maison du bénéficiaire final — 16 caractères au maximum admis</div>
            </FormGroup>
          </Col>
        {:else}
          <Col class="col-12">
            <FormGroup class="form-floating">
              <Input id="ucreditor-addr1" class="{input_ok}" type="text" bind:value={$qrbill.ucreditor.addr1}
                placeholder="Rue du Lac" readonly={!$qrbill.ux.editable} />
              <Label class={$qrbill.ux.editable ? '' : 'form-control-plaintext'} for="ucreditor-addr1">Adresse #1</Label>
              <div class="invalid-feedback">Rue/Case postale du bénéficiaire final — 70 caractères au maximum admis
              — Ne peut pas contenir un numéro de maison ou de bâtiment.</div>
            </FormGroup>
          </Col>
          <Col class="col-12">
            <FormGroup class="form-floating">
              <Input id="ucreditor-addr2" class="{input_ok}" type="text" bind:value={$qrbill.ucreditor.addr2}
                placeholder="1268" readonly={!$qrbill.ux.editable} />
              <Label class={$qrbill.ux.editable ? '' : 'form-control-plaintext'} for="ucreditor-addr2">Adresse #1</Label>
              <div class="invalid-feedback">Numéro de maison du bénéficiaire final — 16 caractères au maximum admis</div>
            </FormGroup>
          </Col>
        {/if}
      </Row>

      <Row>
        <Col class="col-12 col-md-2">
          <FormGroup class="form-floating">
            <Input id="ucreditor-postcode" class="{input_ok}" type="text" bind:value={$qrbill.ucreditor.postcode}
              placeholder="2501" readonly={!$qrbill.ux.editable} />
            <Label class={$qrbill.ux.editable ? '' : 'form-control-plaintext'} for="ucreditor-postcode">NPA</Label>
            <div class="invalid-feedback">NPA du bénéficiaire final — 16 caractères au maximum admis
            — Ne jamais préfixer le code du pays</div>
          </FormGroup>
        </Col>
        <Col class="col-12 col-md-6">
          <FormGroup class="form-floating">
            <Input id="ucreditor-location" class="{input_ok}" type="text" bind:value={$qrbill.ucreditor.location}
              placeholder="Bienne" readonly={!$qrbill.ux.editable} />
            <Label class={$qrbill.ux.editable ? '' : 'form-control-plaintext'} for="ucreditor-location">Lieu</Label>
            <div class="invalid-feedback">Lieu du bénéficiaire final — 35 caractères au maximum admis</div>
          </FormGroup>
        </Col>
        <Col class="col-12 col-md-4">
          <FormGroup class="form-floating">
            <Input id="ucreditor-country" class="{input_ok}" type="select" bind:value={$qrbill.ucreditor.country}
              placeholder="CH" disabled={!$qrbill.ux.editable}><Countries selected={$qrbill.ucreditor.country}/></Input>
            <Label class={$qrbill.ux.editable ? '' : 'form-control-plaintext'} for="ucreditor-country">Pays</Label>
            <div class="invalid-feedback">Pays du bénéficiaire final — Code <i>Alpha 2</i> du pays selon ISO 3166-1</div>
          </FormGroup>
        </Col>
      </Row>
    {/if}

    <FormGroup class="form-floating">
      <Input id="ucreditor-enabled" type="checkbox" bind:checked={$qrbill.ucreditor.iscreditor} label="Identique au bénéficiaire"/>
    </FormGroup>

  </CardBody>
</Card>

