import { writable, derived } from "svelte/store";

export const qrbill = writable ({ subscribe: null });

export const user   = writable ({
    subscribe: null,
    errors: [],         // Last error message(s)
    jwt:    null,       // Authentication token
    logged: false,      // Is user logged in?
    login:  false,      // Is login form displayed?
    udb:    null,       // SAMinfo account name
    uid:    null,       // User's login name 
    upw:    null,       // User's login password
});

