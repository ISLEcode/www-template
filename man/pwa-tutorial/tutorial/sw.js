// https://vaadin.com/learn/tutorials/learn-pwa/turn-website-into-a-pwa
const cacheName = 'pwa-conf-v1';
const staticAssets = [
  './',
  './index.html',
  './app.js',
  './styles.css'
];

self .addEventListener ('install', async event => {
    const cache = await caches .open (cacheName);
    await cache .addAll(staticAssets);
    console .log ('install event')
});

self .addEventListener ('fetch', event => {
    const req = event .request;
    event .respondWith (/.*(json)$/.test(req.url) ? networkFirst (req) : cacheFirst(req));
});

async function cacheFirst(req) {
    const cache = await caches .open (cacheName);
    const response = await cache .match (req);
    return response || networkFirst(req);
}

async function networkFirst(req) {
    const cache = await caches.open(cacheName);
    try { const fresh = await fetch (req); cache .put (req, fresh .clone()); return fresh; }
    catch (e) { (2) const response = await cache .match (req); return response; }
}
