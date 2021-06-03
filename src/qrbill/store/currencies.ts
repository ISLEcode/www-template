import { lstore } from './lstore'

const default_currencies = [{ id: 'CHF', label: 'CHF' }, { id: 'EUR', label: 'EUR' }];

function new_currency (id) { return { id: id, label: '' }}

export const currencies = lstore ('currencies', default_currencies);

export function add_currency (id) { currencies .update ((ary) => [new_currency (id), ...ary]) }

export function del_currency (id) { currencies .update ((all) => all .filter ((currency) => currency.id !== id)) }

export function set_currency (id, label) {
   currencies .update ((all) => all .map ((currency) => currency .id === id ? { ...currency, label: label } : { ...currency }))
}
