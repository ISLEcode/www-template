import { readable, writable, derived } from 'svelte/store'
import default_locations from '../data/locations.json';
export const locations = writable (default_locations);
