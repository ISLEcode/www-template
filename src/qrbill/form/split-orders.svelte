<script lang="ts">
import { Button, Card, CardBody, CardFooter, CardHeader, CardSubtitle, CardText, CardTitle, Col, Container,
         Form, FormGroup, FormText, Icon, Input, Label, Row } from 'sveltestrap5';
import { qrbill } from '../store/qrbills';
import VATRates from './options/vatrates.svelte';

let input_ok = '';

const sum_amounts = (items, prop) => items.reduce((a, b) => a + b[prop], 0);

let remainder;
$: remainder = $qrbill.payment.amount - sum_amounts ($qrbill.orders, 'amount');

let add_order = () => {
    const new_order = {
        id:         $qrbill.orders.length + 1,
        amount:     0,                              // Amount                   (aka `montant TTC`)
        amountx:    0,                              // Amount excluding taxes   (aka `montant HT`)
        name:       null,                           // Name of the order
        vat:        null                            // VAT category
    };
    $qrbill .orders = $qrbill.orders .concat (new_order);
};

let del_order = id => { $qrbill.orders = $qrbill.orders .filter (order => order.id !== id) };
console .log ($qrbill);

// if ($qrbill.orders.length == 0) add_order ();
</script>

<Card class="mb-3">

  <CardHeader>
    <CardTitle>
      <Icon name="clock-history" /> Mandats multiples
    </CardTitle>
  </CardHeader>

  <CardBody>


    {#if $qrbill.orders.length == 0}
      <Button color="success" on:click={add_order}>Ajouter un mandat</Button>
    {:else}
      {#if remainder > 0}
        <p class="text-right lead">Reste à ventiler: {remainder}</p>
      {/if}
    {/if}

    {#each $qrbill.orders as order}

      <Row>
        <Col class="col-12 col-md-4">
          <FormGroup class="form-floating">
            <Input id="order-name" class="{input_ok}" type="select" bind:value={order.name}>
              <option>1000 - Caisse</option>
              <option>1010 - Poste</option>
              <option>1020 - Banque</option>
            </Input>
            <Label for="order-name">Mandat</Label>
            <div class="invalid-feedback"></div>
          </FormGroup>
        </Col>

        <Col class="col-12 col-md-2">
          <FormGroup class="form-floating">
            <Input id="order-vat" class="{input_ok}" type="select" bind:value={order.vat}><VATRates /></Input>
            <Label for="order-vat">TVA</Label>
            <div class="invalid-feedback"></div>
          </FormGroup>
        </Col>

        <Col class="col-12 col-md-2">
          <FormGroup class="form-floating">
            <Input id="order-amountx" class="{input_ok}" type="number" bind:value={order.amountx}
              placeholder="123.22" />
            <Label for="order-amountx">Montant HT</Label>
            <div class="invalid-feedback"></div>
          </FormGroup>
        </Col>

        <Col class="col-12 col-md-2">
          <FormGroup class="form-floating">
            <Input id="order-amount" class="{input_ok}" type="number" bind:value={order.amount}
              placeholder="1024.36" />
            <Label for="order-amount">Montant TTC</Label>
            <div class="invalid-feedback"></div>
          </FormGroup>
        </Col>

        <Col class="col-12 col-md-1">
          <FormGroup class="form-floating">
            <Input id="order-percent" type="checkbox" bind:value={order.ispercent} label="%"/>
          </FormGroup>
        </Col>

        <Col class="col-12 col-md-1">
          <FormGroup class="form-floating">
            <Button color="danger"  on:click={del_order (order.id)}>-</Button>
            <Button color="success" on:click={add_order}>+</Button>
          </FormGroup>
        </Col>

      </Row>

    {/each}

  </CardBody>
</Card>
