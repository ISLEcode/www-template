import { lstore } from './lstore'

const default_orders = [{ id: 'CH', label: 'Suisse' }];

function new_order (id) { return { id: id, label: '' }}

export const orders = lstore ('orders', default_orders);

export function add_order (id) { orders .update ((ary) => [new_order (id), ...ary]) }

export function del_order (id) { orders .update ((all) => all .filter ((order) => order.id !== id)) }

export function set_order (id, label) {
   orders .update ((all) => all .map ((order) => order .id === id ? { ...order, label: label } : { ...order }))
}
