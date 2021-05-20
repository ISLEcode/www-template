import Page from './samples/typescript.svelte';

const page = new Page ({ target: document.body, props: { name: 'world' } });

export default page;
