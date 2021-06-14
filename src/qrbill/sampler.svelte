<script lang="ts">
import '../../node_modules/bootstrap5/dist/css/bootstrap.min.css';
import '../../node_modules/bootstrap-icons/font/bootstrap-icons.css';
import { onMount }                from 'svelte';
import { Icon, Col, Container, Row } from 'sveltestrap5';
import { Alert, TabContent, TabPane }       from 'sveltestrap5';
import Camera                        from './form/camera.svelte';
import Creditor                      from './form/creditor.svelte';
import UCreditor                     from './form/ucreditor.svelte';
import Debtor                        from './form/debtor.svelte';
import Payment                       from './form/payment.svelte';
import SplitAccounts                 from './form/split-accounts.svelte';
import SplitOrders                   from './form/split-orders.svelte';
import DeveloperInfo                 from './form/developer.svelte';
import BrandBar                      from './layout/brandbar.svelte';
import Footer                        from './layout/footer.svelte';
import { qrdata2array } from '../lib/stdlib/qrbill';
import { qrbill }                    from './store/qrbills';
import Tags                          from './widget/Tags.svelte';
import { get }                       from 'svelte/store';
import rc from './prefs'

rc .sync()

/*
onMount (() => $rc.prefs.maintenance = `
<h4 class="alert-heading text-capitalize">Avertissement</h4>
L\'applicatiion SAMinfo QRcode est actuellement en maintenance.
Elle devrait être très prochainement réactivée.`)
*/

$qrbill .data = null;
    // $qrbill .data = 'SPC\n0200\n1\nCH9300762011623852957\nS\nThomas LeClaire\nRue examplaire\n22a\n1000\nLausanne\nCH\n\n\n\n\n\n\n\n25.90\nCHF\n\n\n\n\n\n\n\nNON\n\n\nEPD\n\n'
    // qrdata2array ($qrbill.data, $qrbill, $rc.prefs)

// setContext ('qrbill', qrbill);

</script>

<Container>
  <BrandBar />

  <!-- Mode 1: Maintenance
  -->

  {#if $rc.prefs.maintenance }
    <Row>
      <Col>
        <Alert color="warning">
          {@html $rc.prefs.maintenance}
        </Alert>
      </Col>
    </Row>

  <!-- Mode 2: QRcode scanner
  -->

  {:else if !$qrbill.data && !$rc.prefs.use_samples}
    <Row>
      <Col><Camera/></Col>
    </Row>

  <!-- Mode 3: QRcode data validation
  -->

  {:else}

    <TabContent pills>

      <TabPane tabId="payment-tab" tab="Paiement" class="mt-2" active>
        <Row>
          <Col><Payment /></Col>
        </Row>
      </TabPane>

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
  {/if}

</Container>
