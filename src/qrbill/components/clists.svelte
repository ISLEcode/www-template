<script>
import { onDestroy } from 'svelte';
import { initialValue, makeUserStore } from './store/clists';

let someProp = 'something';
let store = makeUserStore(someProp);
let unsubscribe;
let mystore = initialValue();

// Empty store exists - but fetches don't happen until subscription and we are not using auto-subscription here.
onDestroy (() => { if (unsubscribe) { unsubscribe(); unsubscribe = null }});
function update_mystore (data) { mystore = data } // trigger component reactivity
function on_update_mystore() { if (!unsubscribe) unsubscribe = store .subscribe (update_mystore ) }

$: userProfiles = [...mystore.datum.values()]
// {#each [...mystore.datum.entries()] as [login, profile] (login) }
</script>

<!-- Stop hitting GitHub on every source edit -->
<button on:click={on_update_mystore} disabled={!!unsubscribe}>Load Users</button>

{#if !mystore.error}
  {#each userProfiles as profile (profile.login) }
    <h3>{profile.login}</h3>
    <img height="100" src={ profile.avatar }    alt={ profile.login } />
  {/each}
{:else}
  <p style="color: red">{ mystore.error.message }</p>
{/if}
