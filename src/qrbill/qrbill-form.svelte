<script lang="ts">
import { Icon, Col, Container, Row, TabContent, TabPane } from 'sveltestrap5'

import { qrbill }    from './store/qrbills';
import rc            from './prefs'

import Creditor      from './qrbill-form/creditor.svelte';
import UCreditor     from './qrbill-form/ucreditor.svelte';
import Debtor        from './qrbill-form/debtor.svelte';
import Payment       from './qrbill-form/payment.svelte';
import SplitAccounts from './qrbill-form/split-accounts.svelte';
import SplitOrders   from './qrbill-form/split-orders.svelte';
import DeveloperInfo from './qrbill-form/developer.svelte';

import { get }                       from 'svelte/store';

// $qrbill .data = null;
// $qrbill .data = 'SPC\n0200\n1\nCH9300762011623852957\nS\nThomas LeClaire\nRue examplaire\n22a\n1000\nLausanne\nCH\n\n\n\n\n\n\n\n25.90\nCHF\n\n\n\n\n\n\n\nNON\n\n\nEPD\n\n'
// qrdata2array ($qrbill.data, $qrbill, $rc.prefs)

</script>

<TabContent pills>

  <TabPane tabId="payment-tab" tab="Paiement" class="mt-2" active>
    <Row>
      <Col><Payment /></Col>
    </Row>
  </TabPane>

  {#if $rc.prefs.show_creditor}
    <TabPane tabId="creditor-tab" tab="Bénéficiaire" class="mt-2">
      <Row>
        {#if $rc.prefs.use_ucreditor}
          <Col class="col-12 col-md-6"><Creditor  /></Col>
          <Col class="col-12 col-md-6"><UCreditor /></Col>
        {:else}
          <Col><Creditor /></Col>
        {/if}
      </Row>
    </TabPane>
  {/if}

  {#if $rc.prefs.show_debtor}
    <TabPane tabId="debtor-tab" tab="Débiteur" class="mt-2">
      <Row>
        <Col><Debtor/></Col>
      </Row>
    </TabPane>
  {/if}

  {#if $qrbill.payment.splitaccounts == true}
    <TabPane tabId="split-acconts-tab" tab="Comptes" class="mt-2">
      <Row>
        <Col><SplitAccounts/></Col>
      </Row>
    </TabPane>
  {/if}

  {#if $qrbill.payment.splitorders == true}
    <TabPane tabId="split-orders-tab" tab="Mandats" class="mt-2">
      <Row>
        <Col><SplitOrders/></Col>
      </Row>
    </TabPane>
  {/if}

  {#if $rc.prefs.show_devtab}
    <TabPane tabId="developer-tab" tab="Dévelopeur" class="mt-2">
      <Row>
        <Col><DeveloperInfo/></Col>
      </Row>
    </TabPane>
  {/if}

</TabContent>
