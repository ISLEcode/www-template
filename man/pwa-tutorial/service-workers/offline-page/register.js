//! @revision 2021-01-13 (Wed) 09:38:54
//! @brief    Service worker registration
//!
//! We use the pwa-update web component (https://github.com/pwa-builder/pwa-update) to register our service worker(s), and to
//! notify users of available updates, or to let them know that the PWA is ready to use offline.
//!
//! Append the following to the main page.
//!
//! ``` {.html}
//! <script type="module" src="zip/shared/sw-register.js"></script>
//! ```

import 'https://cdn.jsdelivr.net/npm/@pwabuilder/pwaupdate';

const el = document .createElement ('pwa-update');
document .body .appendChild(el);

// __END__
