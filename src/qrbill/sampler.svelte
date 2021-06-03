<script lang="ts">
import '../../node_modules/bootstrap5/dist/css/bootstrap.min.css';
import '../../node_modules/bootstrap-icons/font/bootstrap-icons.css';
import { setContext }                from 'svelte';
import { Icon, Col, Container, Row } from 'sveltestrap5';
import { TabContent, TabPane }       from 'sveltestrap5';
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
import { qrbill }                    from './store/qrbills';
import Tags                          from './widget/Tags.svelte';


qrbill .data = null;

// setContext ('qrbill', qrbill);

/*
const get_clists = async () => {
    const response = await fetch('http://localhost/sandbox/sam/mobile/tmp/rest-2/docs/api/index.php/clists');
    const data = await response.json();

    console.log (data);
    if (response.ok) return data;
    throw new Error(data);
}

let clists = get_clists ();
//const handleClick = () => { countries = get_clists (); }
*/

</script>

<BrandBar />
<Tags />

<Container>


  {#if !$qrbill.data }
    <Row>
      <Col><Camera/></Col>
    </Row>

  {:else}
    <TabContent pills>

      <TabPane tabId="payment-tab" tab="Paiement" class="mt-2" active>
        <Row>
          <Col><Payment /></Col>
        </Row>
      </TabPane>

      <TabPane tabId="creditor-tab" tab="Bénéficiaire" class="mt-2">
        <Row>
          {#if $qrbill.ux.use_ucreditor}
            <Col class="col-12 col-md-6"><Creditor  /></Col>
            <Col class="col-12 col-md-6"><UCreditor /></Col>
          {:else}
            <Col><Creditor /></Col>
          {/if}
        </Row>
      </TabPane>

      {#if $qrbill.ux.show_debtor}
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

      {#if $qrbill.ux.show_devtab}
        <TabPane tabId="developer-tab" tab="Dévelopeur" class="mt-2">
          <Row>
            <Col><DeveloperInfo/></Col>
          </Row>
        </TabPane>
      {/if}

    </TabContent>
  {/if}

  <Footer />
</Container>

