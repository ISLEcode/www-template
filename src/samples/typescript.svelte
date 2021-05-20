<script lang="ts">
import '../../node_modules/bootstrap5/dist/css/bootstrap.min.css';
import { Styles, Button, Col, Container, Row } from 'sveltestrap5';
import Users from '../components/github/users.svelte';
</script>

<Container>
  <Row>
    <Col>
      <Users/>
    </Col>
  </Row>
</Container>

