/*
    Defines the API route we are using.
*/
var api_url = '';
var google_maps_js_api = window.Google.apiKey;


switch( process.env.NODE_ENV ){
    case 'development':
        api_url = 'https://roast-and-brew.dev/api/v1';
        break;
    case 'production':
        api_url = 'https://roastandbrew.coffee/api/v1';
        break;
}

export const ROAST_CONFIG = {
    API_URL: api_url,
    GOOGLE_MAPS_JS_API: google_maps_js_api
};