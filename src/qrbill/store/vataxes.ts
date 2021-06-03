import { lstore } from './lstore'

const default_vataxes = [{ id: 'CH', label: 'Suisse' }];

function new_vatax (id) { return { id: id, label: '' }}

export const vataxes = lstore ('vataxes', default_vataxes);

export function add_vatax (id) { vataxes .update ((ary) => [new_vatax (id), ...ary]) }

export function del_vatax (id) { vataxes .update ((all) => all .filter ((vatax) => vatax.id !== id)) }

export function set_vatax (id, label) {
   vataxes .update ((all) => all .map ((vatax) => vatax .id === id ? { ...vatax, label: label } : { ...vatax }))
}
