type HTTPMethod  = 'GET' | 'POST';
type HTTPHeaders = { [k: string]: string };

export interface Options {
    url:      string;
    method?:  HTTPMethod;
    headers?: HTTPHeaders;
    file?:    string;
}

const getFile    = (f?: string                       ): string => { return (!f) ? '' : `--data @${f} ` };
const getMethod  = (m?: HTTPMethod                   ): string => { return (!m || m === 'GET') ? '' : '-X POST ' }
const getHeaders = (h?: HTTPHeaders, sep: string = ''): string => { return (!h) ? '' : Object .keys (h)
.map ((k) => { return `-H "${k}: ${h[k]}" ` }) .join (sep); }

export const curl = (options: Options, sep: string = '') => {
    const s: string = [ getHeaders (options .headers, sep), getMethod (options .method), getFile (options .file), options .url ]
    .join (sep); return `curl ${s}`
};
