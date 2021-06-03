<script lang="ts">
// vim: syn=
import { Icon, Col, Container, Row } from 'sveltestrap5';
import { Button, Form, FormGroup, FormText, Input, Label } from 'sveltestrap5';
import { Card, CardBody, CardFooter, CardHeader, CardSubtitle, CardText, CardTitle } from 'sveltestrap5';
import { user } from './store.ts';

user.logged = false; // TODO Cleanup local files if changing account
user.login  = true;

let baseurl     = 'https://dusaasp1.isle.plus/qrcode';
let response    = null;
let welcome     = '';
let error       = '';
let css_userok  = '';

function login () {

    let data = { uid: user.uid, upw: user.upw, udb: user.udb };
    let mime = { 'Content-Type': 'application/json' };
    console.log ('Prologue:', data);
    fetch  (baseurl + '/login/login.php', { method: 'POST', headers: mime, body: JSON .stringify (data) })
    .then  (response => response .json())

    // Upon successful login we want to collect the user's authentication token, its period of validity, and we want to toggle
    // the `user.logged` boolean to enable subsequent processing.
    .then  (response => {
        switch (response.type) {
        case 'success':
            css_userok  = 'is-valid';
            user.logged = true;
            welcome     = response.message;
            console.log ('Success:', welcome)
            break;

        case 'error':
            error = response.message;

        default:
            css_userok  = 'is-invalid';
            error = response.message || 'Erreur inconnue';
            console.error ('Error:', error)

        }
    })

    // If the authentication failed we shall display an error message and zap the form's input fields.
    .catch ((error)  => {
        user.uid = null;
        user.upw = null;
        user.udb = null;
        console.error ('Error:', error)
    });

}

</script>

<Container>
  <Row>
    <Col sm="12" md={{ size: 6, offset: 3 }}>
      <Card class="mb-3">
        <CardHeader>
          <CardTitle class="text-center">SAMinfo</CardTitle>
        </CardHeader>
        <CardBody>
          <CardSubtitle class="text-center fs-1">
            <Icon name="shield-lock" style="font-size: 6rem;" /><br>
          </CardSubtitle>
          <Form>
            <FormGroup class="form-floating mt-5">
              <Input id="uid" class="{css_userok}" type="text" bind:value={user.uid} placeholder="Votre nom d'utilisateur" required/>
              <Label for="uid">Nom</Label>
            </FormGroup>
            <FormGroup class="form-floating">
              <Input id="upw" class="{css_userok}" type="password" bind:value={user.upw}
                placeholder="Votre mot de passe" required/>
              <Label for="upw">Mot de passe</Label>
            </FormGroup>
            <FormGroup class="form-floating">
              <Input id="udb" type="text" bind:value={user.udb}
                placeholder="Votre compte SAMinfo" required/>
              <Label for="udb">Compte</Label>
            </FormGroup>
            <FormGroup class="form-floating">
              <Input id="persist" type="checkbox" bind:value={user.persist}
                label="Se souvenir de moi"/>
            </FormGroup>
            <FormGroup class="form-floating">
              <button type="submit" on:click={login} class="btn btn-block btn-primary">Connexion</button>
            </FormGroup>
          </Form>
        </CardBody>
        <CardFooter>
          <div id="messages">{user.uid} / {user.upw} / {user.udb}</div>
          <!-- <a class="forgot" href="#">Mot de passe oublié ?</a> -->
        </CardFooter>
      </Card>
    </Col>
  </Row>
</Container>

