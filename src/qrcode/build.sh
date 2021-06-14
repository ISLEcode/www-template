tsc --strict --lib DOM,DOM.Iterable,ES6 --target ES6 qrcodegen.ts qrcodegen-input-demo.ts
tsc --strict --lib DOM,DOM.Iterable,ES6 --target ES6 qrcodegen.ts qrcodegen-output-demo.ts

[[ -d node_modules ]] || then npm install @types/node
tsc --strict --target ES2017 --outFile qrcodegen-worker.js qrcodegen.ts qrcodegen-worker.ts
