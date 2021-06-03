import { readable, writable, derived } from 'svelte/store'
import default_countries from '../data/countries.json';
export const countries = writable (default_countries);
