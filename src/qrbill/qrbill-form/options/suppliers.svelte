<script lang="ts">
import  { qrbill    } from '../../store/qrbills'
import rc from '../../prefs'

let disabled = false

function known_reference (preset) {

    switch ($rc .payment. reftype) {

        case 'QRR':
            let input = $rc .payment .reference .replace (/^0/g, '')
            if (input.length >= preset.length && input. substr (0, preset.length) == preset) disabled = true
            return true

        case 'SCOR':
            let input = $rc .payment .reference .replace (/^RF\d\d/, '')
            if (input.length >= preset.length && input. substr (0, preset.length) == preset) disabled = true
            return true

    }

    return false

}

// {#if supplier.iban == $qrbill.creditor.iban}
</script>

<option value=""  selected></option>
<option value="+">Nouveau fournisseur</option>

{#each $rc.suppliers as supplier (supplier.id)}
  {#if $rc.creditor.iban == supplier.iban}
    <option
      {#if !known_reference (supplier.reference_id)}{disabled}{/if}
      iban1={$rc.creditor.iban} iban2={supplier.iban} value="{supplier.id}">
        {supplier.iban}
      {supplier.name}{#if supplier.keyword}&nbsp;- ({supplier.keyword}){/if}
    </option>
  {/if}
{/each}

