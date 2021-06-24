<script lang="ts">
import '../../node_modules/bootstrap5/dist/css/bootstrap.min.css'
import '../../node_modules/bootstrap-icons/font/bootstrap-icons.css'

import { Icon, Col, Container, Row } from 'sveltestrap5'

import rc              from './prefs'
import { qrbill }      from './store/qrbills'
import BrandBar        from './brandbar.svelte';
import LoginForm       from './login-form.svelte'
import MaintenanceMode from './maintenance.svelte'
import QRBillForm      from './qrbill-form.svelte'
import QRScanner       from './qr-reader.svelte'

</script>

{#if $rc.prefs.maintenance}
  <MaintenanceMode />
{:else if !$rc.user.token}
  <LoginForm />
{:else}
  <Container>
    <BrandBar />
    {#if !$qrbill.data && !$rc.prefs.use_samples}
      <QRScanner />
    {:else}
      <QRBillForm />
    {/if}
  </Container>
{/if}
