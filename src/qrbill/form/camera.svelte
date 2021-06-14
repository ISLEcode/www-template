<script lang="ts">
import adapter from 'webrtc-adapter';
import { onMount } from 'svelte';
import { Icon, Col, Container, Row } from 'sveltestrap5';
import { Button, ButtonGroup, Form, FormGroup, FormText, Input, Label } from 'sveltestrap5';
import { Card, CardBody, CardFooter, CardHeader, CardSubtitle, CardText, CardTitle } from 'sveltestrap5';
import { qrbill } from '../store/qrbills';
import rc from '../prefs';
import { qrdata2array  } from '../../lib/stdlib/qrbill';
import jsQR from 'jsQR';

// Use facingMode: environment to attempt to get the front camera on phones
const constraints = { audio: false, video: { facingMode: 'environment' }};

let ctx;
let hide_canvas    = true;
let hide_container = true;
let hide_data      = true;
let hide_message   = true;
let hide_prompt    = true;
let hide_video     = true;

let canvas;
let video;
let video_height;
let video_width;
let prompt = 'Impossibel d\'accèder à un flux vidéo (assurez vous que votre caméra est activée)';

function tick () {

    prompt = '⌛ Loading video...'

    if (video.readyState === video.HAVE_ENOUGH_DATA) {

        hide_prompt    = true;
        hide_canvas    = false;
        hide_container = false;
        video_height   = video.videoHeight;
        video_width    = video.videoWidth;

        // Capture video in canvas
        // https://developer.mozilla.org/en-US/docs/Web/API/CanvasRenderingContext2D/drawImage
        ctx .drawImage (video, 0, 0, video_width, video_height);

        // Collect pixel data for entire canvas
        // https://developer.mozilla.org/en-US/docs/Web/API/CanvasRenderingContext2D/getImageData
        var imageData = ctx .getImageData (0, 0, video_width, video_height);

        // Scan for a QR code
        var code = jsQR (imageData.data, imageData.width, imageData.height, { inversionAttempts: 'dontInvert' });

        if (code) {

            drawline (code .location .topLeftCorner,     code .location .topRightCorner,    '#FF3B58');
            drawline (code .location .topRightCorner,    code .location .bottomRightCorner, '#FF3B58');
            drawline (code .location .bottomRightCorner, code .location .bottomLeftCorner,  '#FF3B58');
            drawline (code .location .bottomLeftCorner,  code .location .topLeftCorner,     '#FF3B58');

            hide_message = true;
            hide_data    = false;
            $qrbill.data = code.data;
            stop_camera ();

            qrdata2array (code.data, $qrbill, $rc.prefs);

            return;

        }

        else {
            hide_message = false;
            hide_data     = true;
        }

    }

    requestAnimationFrame (tick);

}

function drawline (begin, end, color) {
    ctx .beginPath ();
    ctx .moveTo (begin.x, begin.y);
    ctx .lineTo (end.x, end.y);
    ctx .lineWidth = 4;
    ctx .strokeStyle = color;
    ctx .stroke ();
}

function onsuccess (stream) {
    window.stream    = stream;
    video .srcObject = stream;
    start_camera ();
}

function onerror (error) { console .log ('navigator.getUserMedia: ', error) }

function start_camera () {

    if (!window.stream) return;
    if (ctx) window .stream .getTracks() .forEach (track => track.enabled = true)
    ctx = canvas .getContext('2d')
    video .srcObject = window .stream;
    video .setAttribute ('playsinline', true); // required to tell iOS Safari we don't want fullscreen
    video .play();
    requestAnimationFrame (tick);
}

function stop_camera () {
    if (!window.stream) return;
    window .stream .getTracks() .forEach (track => track.enabled = false)
    video .srcObject = null;
}

onMount (() => { navigator .mediaDevices .getUserMedia (constraints) .then (onsuccess) .catch (onerror) })

</script>

<Card class="mb-3">
  <CardHeader>
    <CardTitle>
      <Icon name="camera-video-fill" /> Scannez votre QR code maintenant
    </CardTitle>
  </CardHeader>
  <CardBody>
    <Row>
      <Col>
        <div id="qr-prompt" hidden="{hide_prompt}">{prompt}</div>
        <video bind:this={video} hidden></video>
        <canvas bind:this={canvas} hidden="{hide_canvas}" width="{video_width}" height="{video_height}"></canvas>
      </Col>
    </Row>
    <Row>
      <Col>
        <div id="qr-container" hidden="{hide_container}">
          <div id="qr-message" hidden="{hide_message}">Pas de QR code détecté. Tenez votre facture à moins de 50 cm; évitez
            les reflets ou autres pertubations lumineuses.</div>
          <div hidden="{hide_data}"><b>Data:</b> {$qrbill.data}</div>
        </div>
      </Col>
    </Row>
    <Row>
      <Col>
        <ButtonGroup>
          <Button on:click={start_camera} active><Icon name="play-fill" /></Button>
          <Button on:click={stop_camera}><Icon name="pause-fill" /></Button>
        </ButtonGroup>
      </Col>
    </Row>
  </CardBody>
</Card>


