<script lang="ts">
import  { qrbill    } from '../../store/qrbills'
import rc from '../../prefs'

// {#if supplier.iban == $qrbill.creditor.iban}
</script>

<option value="" data-delay=1 selected></option>
<option value="+" data-delay=10>Nouveau fournisseur</option>
{#each $rc.suppliers as supplier (supplier.id)}
  <option value="{supplier.id}">{supplier.name}{#if supplier.keyword}&nbsp;- ({supplier.keyword}){/if}</option>
{/each}

