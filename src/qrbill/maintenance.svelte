<script lang="ts">
import { Alert, Col, Container, Row } from 'sveltestrap5'
import BrandBar from './brandbar.svelte'
import rc from './prefs'
</script>
<Container>
  <BrandBar />
  <Row>
    <Col>
      <Alert color="warning">
        {@html $rc.prefs.maintenance}
      </Alert>
    </Col>
  </Row>
</Container>
