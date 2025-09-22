const request = ( params = {}, url = postmpwbpk.ajax_url, method = 'GET' ) => {
    let options = {
        method,
        credentials: 'same-origin',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
            'Cache-Control': 'no-cache',
        }
    };
    if ( 'GET' === method ) {
        url += '?' + ( new URLSearchParams( params ) ).toString();
    } else {
        const form = new FormData();
        for ( var key in params ) {
            form.append(key, params[key]);
        }
        options.body = new URLSearchParams(form);
    }

    return fetch( url, options ).then( response => response.json() );
};

const get = ( params, url ) => request( params, url, 'GET' );
const post = ( params, url ) => request( params, url, 'POST' );

export {get, post}