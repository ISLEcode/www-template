"use strict";

async function main(): Promise<void> {
	while (true) {
		// Read data or exit
		const length: number = await input.readInt();
		if (length == -1)
			break;
		let data: Array<number> = [];
		for (let i = 0; i < length; i++)
			data.push(await input.readInt());
		
		// Read encoding parameters
		const errCorLvl : number = await input.readInt();
		const minVersion: number = await input.readInt();
		const maxVersion: number = await input.readInt();
		const mask      : number = await input.readInt();
		const boostEcl  : number = await input.readInt();
		
		// Make segments for encoding
		let segs: Array<qrcodegen.QrSegment>;
		if (data.every(b => b < 128)) {  // Is ASCII
			const s: string = data.map(b => String.fromCharCode(b)).join("");
			segs = qrcodegen.QrSegment.makeSegments(s);
		} else
			segs = [qrcodegen.QrSegment.makeBytes(data)];
		
		try {  // Try to make QR Code symbol
			const qr = qrcodegen.QrCode.encodeSegments(
				segs, ECC_LEVELS[errCorLvl], minVersion, maxVersion, mask, boostEcl != 0);
			// Print grid of modules
			await printLine(qr.version);
			for (let y = 0; y < qr.size; y++) {
				for (let x = 0; x < qr.size; x++)
					await printLine(qr.getModule(x, y) ? 1 : 0);
			}
			
		} catch (e) {
			if (e == "Data too long")
				await printLine(-1);
		}
	}
}

namespace input {
	
	let queue: Array<string> = [];
	let callback: ((line:string)=>void)|null = null;
	
	const readline = require("readline");
	let reader = readline.createInterface({
		input: process.stdin,
		terminal: false,
	});
	reader.on("line", (line: string) => {
		queue.push(line);
		if (callback !== null) {
			callback(queue.shift() as string);
			callback = null;
		}
	});
	
	
	async function readLine(): Promise<string> {
		return new Promise(resolve => {
			if (callback !== null)
				throw "Illegal state";
			if (queue.length > 0)
				resolve(queue.shift() as string);
			else
				callback = resolve;
		});
	}
	
	
	export async function readInt(): Promise<number> {
		let s = await readLine();
		if (!/^-?\d+$/.test(s))
			throw "Invalid number syntax";
		return parseInt(s, 10);
	}
	
}

async function printLine(x: Object): Promise<void> {
	return new Promise(resolve =>
		process.stdout.write(x + "\n", "utf-8", ()=>resolve()));
}

const ECC_LEVELS: Array<qrcodegen.QrCode.Ecc> = [
	qrcodegen.QrCode.Ecc.LOW,
	qrcodegen.QrCode.Ecc.MEDIUM,
	qrcodegen.QrCode.Ecc.QUARTILE,
	qrcodegen.QrCode.Ecc.HIGH,
];

main();
