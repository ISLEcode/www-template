import { lstore } from './lstore'

const default_suppliers = [{ id: 'CH', label: 'Suisse' }];

function new_supplier (id) { return { id: id, label: '' }}

export const suppliers = lstore ('suppliers', default_suppliers);

export function add_supplier (id) { suppliers .update ((ary) => [new_supplier (id), ...ary]) }

export function del_supplier (id) { suppliers .update ((all) => all .filter ((supplier) => supplier.id !== id)) }

export function set_supplier (id, label) {
   suppliers .update ((all) => all .map ((supplier) => supplier .id === id ? { ...supplier, label: label } : { ...supplier }))
}
