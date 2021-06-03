<script>
import '../../node_modules/bootstrap5/dist/css/bootstrap.min.css';
import '../../node_modules/bootstrap-icons/font/bootstrap-icons.css';
import { onDestroy } from 'svelte';
import { Button    } from 'sveltestrap5';
import BrandBar      from './brandbar.svelte';
import LoginForm     from './login.svelte';
import { user }      from './store.ts';

$: isLoggedIn = $user.logged;
</script>

{#if isLoggedIn}
<BrandBar/>
{:else}
<LoginForm/>
{/if}

