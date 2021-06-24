<script lang="ts">
import {
    Card, CardBody, CardFooter, CardHeader, CardSubtitle, CardText, CardTitle,
    Container, Col, Row,
    Icon,
    Form
}   from 'sveltestrap5';

import rc from './prefs'
import { qrbill } from './store/qrbills'
import InputUserName from './login-form/username.svelte'
import InputPassword from './login-form/password.svelte'
import InputDatabase from './login-form/database.svelte'
import LoginButton   from './login-form/login-btn.svelte'

function login (e) {

    // We don't want the form submission to reload the page
    e.preventDefault()
    validity = null

    let body, href; if (false) {
        console .log ('Using GET authentication')
        let uid = encodeURIComponent ($rc.user.name);
        let upw = encodeURIComponent ($rc.user.password);
        href = `${$rc.backend}/login?uid=${uid}&upw=${upw}`
        body = { method: 'get', headers: { 'Content-Type': 'application/json' }, cache: 'no-cache' }
    }
    else {
        console .log ('Using POST authentication')
        href = `${$rc.backend}/login`
        body = { uid: $rc.user.name, upw: $rc.user.password }
        body = { method: 'post', cache: 'no-cache', body: JSON .stringify (body) }
    }


    // We want to distinguish network/protocol level errors from application errors
    fetch  (href, body)
    .then (response => { return (response.ok) ? response .json () : response .json() .then (json => { throw json }) })

    // Handle application-level success or failure
    .then (response => {
        console .log ('Response', response)
        if (response.status != 'ok') { validity = 'is-invalid'; return }

        $rc.user.fullname  = response.body.data.username
        $rc.user.superuser = response.body.data.superuser == 1
        validity = 'is-valid'
        rc.sync()

// TODO Not sure this leaves sufficient leeway if server/client clocks are too different
// const delay = ms => new Promise(res => setTimeout(res, ms))
// const pause = async () => { await delay (5000) }
// pause

        // We update the token last because this triggers page rehydration
        $rc.user.token = response.body.token

    })

    .catch (json => {
        validity = 'is-invalid'
        console .log ('FAILED', json)
    })

    return false;

}

let validity = ''
</script>

<Container class="mt-5">
  <Row class="mt-5">
    <Col sm="12" md={{ size: 6, offset: 3 }}>
      <Card class="mt-5 mb-3">
        <CardHeader>
          <CardTitle class="text-center">SAMinfo</CardTitle>
        </CardHeader>
        <CardBody>
          <CardSubtitle class="text-center fs-1">
            <Icon name="shield-lock" style="font-size: 6rem; padding-bottom: 4em" /><br>
          </CardSubtitle>
          <form class="mt-5" on:submit|preventDefault={login}>
            <InputUserName tabindex=1 bind:validity={validity} />
            <InputPassword tabindex=2 bind:validity={validity} />
            <!--
            <InputDatabase tabindex=3 readonly                 />
            -->
            <LoginButton   tabindex=4                          />
          </form>
        </CardBody>
        <CardFooter>
          <div id="messages"></div>
          <!-- <a class="forgot" href="#">Mot de passe oublié ?</a> -->
        </CardFooter>
      </Card>
    </Col>
  </Row>
</Container>

