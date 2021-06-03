// https://svelte.dev/repl/e8edc7160db740d5a8a7dd4aa230c697?version=3.38.2
// const GH_TOKEN = '34fc1513ea61a80cf3d0d769fe66ca51554afa89';
import { readable } from 'svelte/store';

export function initialValue() { return { datum: new Map() }}

// 1. Build the store and initialize it as empty and error free
export function makeUserStore (args) {
    let initial = initialValue ();
    let store = readable (initial, makeSubscribe (initial, args));
    return store;
}

function unsubscribe () { /* Nothing to do in this case */ }

function makeSubscribe (data, _args) {
    // 2. Create a closure with access to the initial data and initialization arguments
    return set => {
        // 3. This won't get executed until the store has its first subscriber. Kick off retrieval.
        fetch_data (data, set);

        // 4. We're not waiting for the response.
        // Return the unsubscribe function which doesn't do do anything here (but is part of the stores protocol).
        return unsubscribe;
    };
}

async function fetch_data (data, set) {
    try {
        // 5. Dispatch the request for the users
        // const response = await fetch ('https://api.github.com/users?per_page=5',
        const response = await fetch ('http://localhost/sandbox/sam/mobile/tmp/rest-2/docs/api/index.php/clists',
        { headers: new Headers ({ 'Authorization': 'token 34fc1513ea61a80cf3d0d769fe66ca51554afa89' })});


        if (response.ok) {
            const fetched_data = await response.json();
            console .log (fetched_data);

            // 6. Extract the data we need and let observers know
            const avatar = img_placeholder ();
            for (const { login, url } of fetched_data) {
                data .datum .set (login, { login, avatar });

                // Lets PRETEND we have to get the Avatar url separately. Initiate without waiting for the response.
                fetch_altdata (data, set, url);
          }
          set (data);

        }

        // TODO (!) TS2345: Argument of type 'Promise<string>' is not assignable to parameter of type 'string'.
        // else { const text = response .text(); throw new Error (response .text()) }

    }
    // 6b. if there is a fetch error - deal with it and let observers know
    catch(error) { data .error = error; set (data) }
}

async function fetch_altdata (data, set, url) {
    try {
        // 7. Dispatch the request for the user information
        const response = await fetch
        (url, { headers: new Headers ({ 'Authorization': 'token 34fc1513ea61a80cf3d0d769fe66ca51554afa89' })});

        if (response.ok) {
            const fetched_data = await response.json();

            // 8. Update the user's profile and let observers know
            let profile = data.datum.get (fetched_data.login);
            if (profile) {
                const avatar = fetched_data.avatar_url;
                data.datum.set(profile.login, {...profile, avatar});
                set (data);
            }

        }
        else { /* dont't care ... */ }

    }
    // 8b. if there is a fetch error - deal with it
    catch(error) { /* In this case we're just missing a specific avatar url - so ignore it. */ }
}

// https://css-tricks.com/lodge/svg/09-svg-data-uris/
function img_placeholder () {
  return `data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
    style="margin: auto; background: none; display: block; shape-rendering: auto;" width="74px" height="74px"
    viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
    <g transform="rotate(0 50 50)"><rect x="45.5" y="9.5" rx="4.5" ry="7.5" width="9" height="15" fill="#000fff"><animate
    attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.92s" repeatCount="indefinite"></animate></rect></g>
    <g transform="rotate(30 50 50)"><rect x="45.5" y="9.5" rx="4.5" ry="7.5" width="9" height="15" fill="#000fff"><animate
    attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.83s" repeatCount="indefinite"></animate></rect></g>
    <g transform="rotate(60 50 50)"><rect x="45.5" y="9.5" rx="4.5" ry="7.5" width="9" height="15" fill="#000fff"><animate
      attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.75s" repeatCount="indefinite"></animate></rect></g>
    <g transform="rotate(90 50 50)"><rect x="45.5" y="9.5" rx="4.5" ry="7.5" width="9" height="15" fill="#000fff"><animate
      attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.67s" repeatCount="indefinite"></animate></rect></g>
    <g transform="rotate(120 50 50)"><rect x="45.5" y="9.5" rx="4.5" ry="7.5" width="9" height="15" fill="#000fff"><animate
      attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.58s" repeatCount="indefinite"></animate></rect></g>
    <g transform="rotate(150 50 50)"><rect x="45.5" y="9.5" rx="4.5" ry="7.5" width="9" height="15" fill="#000fff"><animate
      attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.5s" repeatCount="indefinite"></animate></rect></g>
    <g transform="rotate(179 50 50)"><rect x="45.5" y="9.5" rx="4.5" ry="7.5" width="9" height="15" fill="#000fff"><animate
      attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.42s" repeatCount="indefinite"></animate></rect></g>
    <g transform="rotate(210 50 50)"><rect x="45.5" y="9.5" rx="4.5" ry="7.5" width="9" height="15" fill="#000fff"><animate
      attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.33s" repeatCount="indefinite"></animate></rect></g>
    <g transform="rotate(240 50 50)"><rect x="45.5" y="9.5" rx="4.5" ry="7.5" width="9" height="15" fill="#000fff"><animate
      attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.25s" repeatCount="indefinite"></animate></rect></g>
    <g transform="rotate(270 50 50)"><rect x="45.5" y="9.5" rx="4.5" ry="7.5" width="9" height="15" fill="#000fff"><animate
      attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.17s" repeatCount="indefinite"></animate></rect></g>
    <g transform="rotate(300 50 50)"><rect x="45.5" y="9.5" rx="4.5" ry="7.5" width="9" height="15" fill="#000fff"><animate
      attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.08s" repeatCount="indefinite"></animate></rect></g>
    <g transform="rotate(330 50 50)"><rect x="45.5" y="9.5" rx="4.5" ry="7.5" width="9" height="15" fill="#000fff"><animate
      attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="0s" repeatCount="indefinite"></animate></rect></g>
    </svg>`;
}
