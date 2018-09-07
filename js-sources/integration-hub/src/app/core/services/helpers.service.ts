import {Injectable} from '@angular/core';
import {environment} from "../../../environments/environment";
import {StringHelpersService} from "@app/core/services/string-helpers.service";

@Injectable({
    providedIn: 'root'
})
export class HelpersService {

    constructor() {
    }

    public static prepareUrl(url: string, params: object = {}) {
        let result = StringHelpersService.rtrim(environment.baseUrl, '/') + '/' + StringHelpersService.ltrim(url, '/');

        for (let key in params) {
            result = result.replace(':' + key, params[key]);
        }
        return result;
    }

    public static urlencode(str) {
        // http://kevin.vanzonneveld.net
        // +   original by: Philip Peterson
        // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
        // +      input by: AJ
        // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
        // +   improved by: Brett Zamir (http://brett-zamir.me)
        // +   bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
        // +      input by: travc
        // +      input by: Brett Zamir (http://brett-zamir.me)
        // +   bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
        // +   improved by: Lars Fischer
        // +      input by: Ratheous
        // +      reimplemented by: Brett Zamir (http://brett-zamir.me)
        // +   bugfixed by: Joris
        // +      reimplemented by: Brett Zamir (http://brett-zamir.me)
        // %          note 1: This reflects PHP 5.3/6.0+ behavior
        // %        note 2: Please be aware that this function expects to encode into UTF-8 encoded strings, as found on
        // %        note 2: pages served as UTF-8
        // *     example 1: urlencode('Kevin van Zonneveld!');
        // *     returns 1: 'Kevin+van+Zonneveld%21'
        // *     example 2: urlencode('http://kevin.vanzonneveld.net/');
        // *     returns 2: 'http%3A%2F%2Fkevin.vanzonneveld.net%2F'
        // *     example 3: urlencode('http://www.google.nl/search?q=php.js&ie=utf-8&oe=utf-8&aq=t&rls=com.ubuntu:en-US:unofficial&client=firefox-a');
        // *     returns 3: 'http%3A%2F%2Fwww.google.nl%2Fsearch%3Fq%3Dphp.js%26ie%3Dutf-8%26oe%3Dutf-8%26aq%3Dt%26rls%3Dcom.ubuntu%3Aen-US%3Aunofficial%26client%3Dfirefox-a'
        str = (str + '').toString();

        // Tilde should be allowed unescaped in future versions of PHP (as reflected below), but if you want to reflect current
        // PHP behavior, you would need to add ".replace(/~/g, '%7E');" to the following.
        return encodeURIComponent(str).replace(/!/g, '%21').replace(/'/g, '%27').replace(/\(/g, '%28').replace(/\)/g, '%29').replace(/\*/g, '%2A').replace(/%20/g, '+');
    }

    public static prepareParams(formdata, numeric_prefix = 'param', arg_separator = "&"): string {
        // http://kevin.vanzonneveld.net
        // +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
        // +   improved by: Legaev Andrey
        // +   improved by: Michael White (http://getsprink.com)
        // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
        // +   improved by: Brett Zamir (http://brett-zamir.me)
        // +    revised by: stag019
        // +   input by: Dreamer
        // +   bugfixed by: Brett Zamir (http://brett-zamir.me)
        // +   bugfixed by: MIO_KODUKI (http://mio-koduki.blogspot.com/)
        // %        note 1: If the value is null, key and value is skipped in http_build_query of PHP. But, phpjs is not.
        // -    depends on: urlencode
        // *     example 1: http_build_query({foo: 'bar', php: 'hypertext processor', baz: 'boom', cow: 'milk'}, '', '&amp;');
        // *     returns 1: 'foo=bar&amp;php=hypertext+processor&amp;baz=boom&amp;cow=milk'
        // *     example 2: http_build_query({'php': 'hypertext processor', 0: 'foo', 1: 'bar', 2: 'baz', 3: 'boom', 'cow': 'milk'}, 'myvar_');
        // *     returns 2: 'php=hypertext+processor&myvar_0=foo&myvar_1=bar&myvar_2=baz&myvar_3=boom&cow=milk'
        let value, key, tmp = [];

        let _http_build_query_helper = function (key, val, arg_separator) {
            let k, tmp = [];
            if (val === true) {
                val = "1";
            } else if (val === false) {
                val = "0";
            }
            if (val != null) {
                if (typeof val === "object") {
                    for (k in val) {
                        if (val[k] != null) {
                            tmp.push(_http_build_query_helper(key + "[" + k + "]", val[k], arg_separator));
                        }
                    }
                    return tmp.join(arg_separator);
                } else if (typeof val !== "function") {
                    return HelpersService.urlencode(key) + "=" + HelpersService.urlencode(val);
                } else {
                    throw new Error('There was an error processing for http_build_query().');
                }
            } else {
                return '';
            }
        };

        if (!arg_separator) {
            arg_separator = "&";
        }
        for (key in formdata) {
            value = formdata[key];
            if (numeric_prefix && !isNaN(key)) {
                key = String(numeric_prefix) + key;
            }
            let query = _http_build_query_helper(key, value, arg_separator);
            if (query !== '') {
                tmp.push(query);
            }
        }

        return tmp.join(arg_separator);
    }
}
