// Inspired by https://github.com/brittneypostma/svelte-kanban
import { writable } from 'svelte/store'

export const lstore = (key, initial) => {
    // https://developer.mozilla.org/en-US/docs/Web/API/Window/localStorage
    // https://svelte.dev/docs#Store_contract
    const persist = localStorage .getItem (key);
    const data    = persist ? JSON .parse (persist) : initial;
    const store   = writable (data, () => {
        const unsubscribe = store .subscribe (value => { localStorage .setItem (key, JSON .stringify (value)) });
        return unsubscribe
    });
    return store
}

// const  { subscribe, set, update } = writable (data);
// return { subscribe, update, set: (value) => { localStorage .setItem (key, JSON .stringify (value)); return set (value) }}
