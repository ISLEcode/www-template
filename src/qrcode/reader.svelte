<script lang="ts">
import * from './qrcodegen';
"use strict";

namespace app {

function initialize(): void {
    getElem("loading").style.display = "none";
    getElem("loaded").style.removeProperty("display");
    let elems = document.querySelectorAll("input[type=number], textarea");
    for (let el of elems) {
        if (el.id.indexOf("version-") != 0)
            (el as any).oninput = redrawQrCode;
    }
    elems = document.querySelectorAll("input[type=radio], input[type=checkbox]");
    for (let el of elems)
        (el as HTMLInputElement).onchange = redrawQrCode;
    redrawQrCode();
}

function redrawQrCode(): void {
    // Show/hide rows based on bitmap/vector image output
    const bitmapOutput: boolean = getInput("output-format-bitmap").checked;
    const scaleRow : HTMLElement = getElem("scale-row");
    const svgXmlRow: HTMLElement = getElem("svg-xml-row");
    if (bitmapOutput) {
        scaleRow.style.removeProperty("display");
        svgXmlRow.style.display = "none";
    } else {
        scaleRow.style.display = "none";
        svgXmlRow.style.removeProperty("display");
    }
    const svgXml = getElem("svg-xml-output") as HTMLTextAreaElement;
    svgXml.value = "";

    // Reset output images in case of early termination
    const canvas = getElem("qrcode-canvas") as HTMLCanvasElement;
    const svg = (document.getElementById("qrcode-svg") as Element) as SVGElement;
    canvas.style.display = "none";
    svg.style.display = "none";

    // Returns a QrCode.Ecc object based on the radio buttons in the HTML form.
    function getInputErrorCorrectionLevel(): qrcodegen.QrCode.Ecc {
        if (getInput("errcorlvl-medium").checked)
            return qrcodegen.QrCode.Ecc.MEDIUM;
        else if (getInput("errcorlvl-quartile").checked)
            return qrcodegen.QrCode.Ecc.QUARTILE;
        else if (getInput("errcorlvl-high").checked)
            return qrcodegen.QrCode.Ecc.HIGH;
        else  // In case no radio button is depressed
            return qrcodegen.QrCode.Ecc.LOW;
    }

    // Get form inputs and compute QR Code
    const ecl: qrcodegen.QrCode.Ecc = getInputErrorCorrectionLevel();
    const text: string = (getElem("text-input") as HTMLTextAreaElement).value;
    const segs: Array<qrcodegen.QrSegment> = qrcodegen.QrSegment.makeSegments(text);
    const minVer: number = parseInt(getInput("version-min-input").value, 10);
    const maxVer: number = parseInt(getInput("version-max-input").value, 10);
    const mask: number = parseInt(getInput("mask-input").value, 10);
    const boostEcc: boolean = getInput("boost-ecc-input").checked;
    const qr: qrcodegen.QrCode = qrcodegen.QrCode.encodeSegments(segs, ecl, minVer, maxVer, mask, boostEcc);

    // Draw image output
    const border: number = parseInt(getInput("border-input").value, 10);
    if (border < 0 || border > 100)
        return;
    if (bitmapOutput) {
        const scale: number = parseInt(getInput("scale-input").value, 10);
        if (scale <= 0 || scale > 30)
            return;
        qr.drawCanvas(scale, border, canvas);
        canvas.style.removeProperty("display");
    } else {
        const code: string = qr.toSvgString(border);
        const viewBox: string = (/ viewBox="([^"]*)"/.exec(code) as RegExpExecArray)[1];
        const pathD: string = (/ d="([^"]*)"/.exec(code) as RegExpExecArray)[1];
        svg.setAttribute("viewBox", viewBox);
        (svg.querySelector("path") as Element).setAttribute("d", pathD);
        svg.style.removeProperty("display");
        svgXml.value = qr.toSvgString(border);
    }

    // Returns a string to describe the given list of segments.
    function describeSegments(segs: Array<qrcodegen.QrSegment>): string {
        if (segs.length == 0)
            return "none";
        else if (segs.length == 1) {
            const mode: qrcodegen.QrSegment.Mode = segs[0].mode;
            const Mode = qrcodegen.QrSegment.Mode;
            if (mode == Mode.NUMERIC     )  return "numeric";
            if (mode == Mode.ALPHANUMERIC)  return "alphanumeric";
            if (mode == Mode.BYTE        )  return "byte";
            if (mode == Mode.KANJI       )  return "kanji";
            return "unknown";
        } else
            return "multiple";
    }

    // Returns the number of Unicode code points in the given UTF-16 string.
    function countUnicodeChars(str: string): number {
        let result: number = 0;
        for (let i = 0; i < str.length; i++, result++) {
            const c: number = str.charCodeAt(i);
            if (c < 0xD800 || c >= 0xE000)
                continue;
            else if (0xD800 <= c && c < 0xDC00 && i + 1 < str.length) {  // High surrogate
                i++;
                const d: number = str.charCodeAt(i);
                if (0xDC00 <= d && d < 0xE000)  // Low surrogate
                    continue;
            }
            throw "Invalid UTF-16 string";
        }
        return result;
    }

    // Show the QR Code symbol's statistics as a string
    getElem("statistics-output").textContent = `QR Code version = ${qr.version}, ` +
        `mask pattern = ${qr.mask}, ` +
        `character count = ${countUnicodeChars(text)},\n` +
        `encoding mode = ${describeSegments(segs)}, ` +
        `error correction = level ${"LMQH".charAt(qr.errorCorrectionLevel.ordinal)}, ` +
        `data bits = ${qrcodegen.QrSegment.getTotalBits(segs, qr.version) as number}.`;
}

export function handleVersionMinMax(which: "min"|"max"): void {
    const minElem: HTMLInputElement = getInput("version-min-input");
    const maxElem: HTMLInputElement = getInput("version-max-input");
    let minVal: number = parseInt(minElem.value, 10);
    let maxVal: number = parseInt(maxElem.value, 10);
    minVal = Math.max(Math.min(minVal, qrcodegen.QrCode.MAX_VERSION), qrcodegen.QrCode.MIN_VERSION);
    maxVal = Math.max(Math.min(maxVal, qrcodegen.QrCode.MAX_VERSION), qrcodegen.QrCode.MIN_VERSION);
    if (which == "min" && minVal > maxVal)
        maxVal = minVal;
    else if (which == "max" && maxVal < minVal)
        minVal = maxVal;
    minElem.value = minVal.toString();
    maxElem.value = maxVal.toString();
    redrawQrCode();
}

function getElem(id: string): HTMLElement {
    const result: HTMLElement|null = document.getElementById(id);
    if (result instanceof HTMLElement)
        return result;
    throw "Assertion error";
}

function getInput(id: string): HTMLInputElement {
    const result: HTMLElement = getElem(id);
    if (result instanceof HTMLInputElement)
        return result;
    throw "Assertion error";
}

initialize();
}
</script>

<style type="text/css">
html { font-family: sans-serif }
td { padding-bottom: 0.2em; padding-top: 0.2em; vertical-align: top }
td:first-child { padding-right: 0.5em; white-space: pre }
input[type=radio], input[type=checkbox] { margin: 0em; padding: 0em }
input[type=radio] + label, input[type=checkbox] + label { padding-left: 0.2em; margin-right: 0.8em }
</style>

<main>
  <h1>QR Code generator input demo (JavaScript)</h1>
  <form id="loaded" style="display:none" action="#" method="get" onsubmit="return false;">
    <table class="noborder" style="width:100%">
      <tbody>
        <tr>
          <td><strong>Text string:</strong></td>
          <td style="width:100%"><textarea placeholder="Enter your text to be put into the QR Code" id="text-input" style="width:100%; max-width:30em; height:5em; font-family:inherit"></textarea></td>
        </tr>
        <tr>
          <td><strong>QR Code:</strong></td>
          <td>
            <canvas id="qrcode-canvas" style="padding:1em; background-color:#E8E8E8"></canvas>
            <svg id="qrcode-svg" style="width:30em; height:30em; padding:1em; background-color:#E8E8E8">
              <rect width="100%" height="100%" fill="#FFFFFF" stroke-width="0"></rect>
              <path d="" fill="#000000" stroke-width="0"></path>
            </svg>
          </td>
        </tr>
        <tr>
          <td><strong>Error correction:</strong></td>
          <td>
            <input type="radio" name="errcorlvl" id="errcorlvl-low" checked="checked"><label for="errcorlvl-low">Low</label>
            <input type="radio" name="errcorlvl" id="errcorlvl-medium"><label for="errcorlvl-medium">Medium</label>
            <input type="radio" name="errcorlvl" id="errcorlvl-quartile"><label for="errcorlvl-quartile">Quartile</label>
            <input type="radio" name="errcorlvl" id="errcorlvl-high"><label for="errcorlvl-high">High</label>
          </td>
        </tr>
        <tr>
          <td>Output format:</td>
          <td>
            <input type="radio" name="output-format" id="output-format-bitmap" checked="checked"><label for="output-format-bitmap">Bitmap</label>
            <input type="radio" name="output-format" id="output-format-vector"><label for="output-format-vector">Vector</label>
          </td>
        </tr>
        <tr>
          <td>Border:</td>
          <td><input type="number" value="4" min="0" max="100" step="1" id="border-input" style="width:4em"> modules</td>
        </tr>
        <tr id="scale-row">
          <td>Scale:</td>
          <td><input type="number" value="8" min="1" max="30" step="1" id="scale-input" style="width:4em"> pixels per module</td>
        </tr>
        <tr>
          <td>Version range:</td>
          <td>
            Minimum = <input type="number" value="1"  min="1" max="40" step="1" id="version-min-input" style="width:4em" oninput="app.handleVersionMinMax('min');">,
            maximum = <input type="number" value="40" min="1" max="40" step="1" id="version-max-input" style="width:4em" oninput="app.handleVersionMinMax('max');">
          </td>
        </tr>
        <tr>
          <td>Mask pattern:</td>
          <td><input type="number" value="-1" min="-1" max="7" step="1" id="mask-input" style="width:4em"> (−1 for automatic, 0 to 7 for manual)</td>
        </tr>
        <tr>
          <td>Boost ECC:</td>
          <td><input type="checkbox" checked="checked" id="boost-ecc-input"><label for="boost-ecc-input">Increase <abbr title="error-correcting code">ECC</abbr> level within same version</label></td>
        </tr>
        <tr>
          <td>Statistics:</td>
          <td id="statistics-output" style="white-space:pre"></td>
        </tr>
        <tr id="svg-xml-row">
          <td>SVG XML code:</td>
          <td>
            <textarea id="svg-xml-output" readonly="readonly" style="width:100%; max-width:50em; height:15em; font-family:monospace"></textarea>
          </td>
        </tr>
      </tbody>
    </table>
  </form>
</main>
