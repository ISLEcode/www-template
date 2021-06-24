<script lang="ts">
import { Button, Card, CardBody, CardFooter, CardHeader, CardSubtitle, CardText, CardTitle, Col, Container,
         Form, FormGroup, FormText, Icon, Input, Label, Row } from 'sveltestrap5';
import { qrbill } from '../store/qrbills';
import VATRates from './options/vatrates.svelte';
import LedgerAccount from './options/ledger-accounts.svelte';

let input_ok = '';

const sum_amounts = (items, prop) => items.reduce((a, b) => a + b[prop], 0);

let remainder;
$: remainder = Math .round ($qrbill.payment.amount - sum_amounts ($qrbill.accounts, 'amount'), 2);

let add_account = () => {
    const new_account = {
        id:         $qrbill.accounts.length + 1,
        amount:     0,                              // Amount                   (aka `montant TTC`)
        amountx:    0,                              // Amount excluding taxes   (aka `montant HT`)
        name:       null,                           // Name of the account
        vat:        null                            // VAT category
    };
    $qrbill .accounts = $qrbill.accounts .concat (new_account);
};

let del_account = id => { $qrbill.accounts = $qrbill.accounts .filter (account => account.id !== id) };
console .log ($qrbill);

// if ($qrbill.accounts.length == 0) add_account ();
</script>

<Card class="mb-3">

  <CardHeader>
    <CardTitle>
      <Icon name="piggy-bank" /> Comptes multiples
    </CardTitle>
  </CardHeader>

  <CardBody>

    {#if $qrbill.accounts.length == 0}
      <Button color="success" on:click={add_account}>Ajouter un compte</Button>
    {:else}

      {#each $qrbill.accounts as account}

        <Row>
          <Col class="col-12 col-md-4">
            <FormGroup class="form-floating">
              <Input id="account-name" class="{input_ok}" type="select" bind:value={account.name}>
              <LedgerAccount />
              </Input>
              <Label for="account-name">Compte</Label>
              <div class="invalid-feedback"></div>
            </FormGroup>
          </Col>

          <Col class="col-12 col-md-2">
            <FormGroup class="form-floating">
              <Input id="account-vat" class="{input_ok}" type="select" bind:value={account.vat}><VATRates /></Input>
              <Label for="account-vat">TVA</Label>
              <div class="invalid-feedback"></div>
            </FormGroup>
          </Col>

          <Col class="col-12 col-md-2">
            <FormGroup class="form-floating">
              <Input id="account-amountx" readonly class="{input_ok}" type="number" bind:value={account.amountx}
                placeholder="123.22" />
              <Label class="form-control-plaintext" for="account-amountx">Montant HT</Label>
              <div class="invalid-feedback"></div>
            </FormGroup>
          </Col>

          <Col class="col-12 col-md-2">
            <FormGroup class="form-floating">
              <Input id="account-amount" class="{input_ok}" type="number" bind:value={account.amount}
                on:change={account.amountx = (account.amount * 0.077) .toFixed (2)}
                placeholder="1024.36" />
              <Label for="account-amount">Montant TTC</Label>
              <div class="invalid-feedback"></div>
            </FormGroup>
          </Col>

          <Col class="col-12 col-md-1">
            <FormGroup class="form-floating">
              <Button color="danger"  on:click={del_account (account.id)}>-</Button>
              <Button color="success" on:click={add_account}>+</Button>
            </FormGroup>
          </Col>

        </Row>

      {/each}

      {#if remainder != 0}
        <p class="text-right lead">Reste à ventiler: {remainder .toFixed (2)}</p>
      {/if}

    {/if}

  </CardBody>
</Card>
