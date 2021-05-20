<script lang="ts">
import '../node_modules/bootstrap5/dist/css/bootstrap.min.css';
import { Styles, Button, Col, Row } from 'sveltestrap5';
export let name: string;
</script>

<style lang="scss">
h1 { color: $primary-colour; }
</style>


<Row>
  <Col>
    <h1>Hello {name}!</h1>
    <ul>
    <li><a href="https://svelte-recipes.netlify.app/">Svelte Recipes</a></li>
    <li><a href="https://mzl.la/3hIOGI2">MDN: Svelte tutorials</a></li>
    </ul>
  </Col>
</Row>

