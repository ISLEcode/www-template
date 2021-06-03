<script lang="ts">
const get_suppliers = async () => {
    const response = await fetch('http://localhost/sandbox/sam/mobile/tmp/rest-2/docs/api/index.php/suppliers');
    const data = await response.json();

    if (response.ok) return data;
    throw new Error(data);
}

let promise = get_suppliers ();
</script>

{#await promise}
  <p>Loading...</p>
{:then data}
  {#each data as supplier (supplier.id)}
    <option value="{supplier.id}">{supplier.name}</option>
  {/each}
  <option value="+">Nouveau fournisseur</option>
{:catch error}
  <p>{error}</p>
{/await}

