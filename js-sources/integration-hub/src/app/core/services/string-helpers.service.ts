import {Injectable} from '@angular/core';

@Injectable({
    providedIn: 'root'
})
export class StringHelpersService {

    constructor() {
    }

    public static ltrim(str, charlist) {
        //  discuss at: http://phpjs.org/functions/ltrim/
        // original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
        //    input by: Erkekjetter
        // improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
        // bugfixed by: Onno Marsman
        //   example 1: ltrim('    Kevin van Zonneveld    ');
        //   returns 1: 'Kevin van Zonneveld    '

        charlist = !charlist ? ' \\s\u00A0' : (charlist + '')
            .replace(/([\[\]\(\)\.\?\/\*\{\}\+\$\^\:])/g, '$1')
        let re = new RegExp('^[' + charlist + ']+', 'g')
        return (str + '')
            .replace(re, '')
    }

    public static rtrim(str, charlist) {
        //  discuss at: http://phpjs.org/functions/rtrim/
        // original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
        //    input by: Erkekjetter
        //    input by: rem
        // improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
        // bugfixed by: Onno Marsman
        // bugfixed by: Brett Zamir (http://brett-zamir.me)
        //   example 1: rtrim('    Kevin van Zonneveld    ');
        //   returns 1: '    Kevin van Zonneveld'

        charlist = !charlist ? ' \\s\u00A0' : (charlist + '')
            .replace(/([\[\]\(\)\.\?\/\*\{\}\+\$\^\:])/g, '\\$1')
        let re = new RegExp('[' + charlist + ']+$', 'g')
        return (str + '')
            .replace(re, '')
    }

    public static trim(str, charlist) {
        //  discuss at: http://phpjs.org/functions/trim/
        // original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
        // improved by: mdsjack (http://www.mdsjack.bo.it)
        // improved by: Alexander Ermolaev (http://snippets.dzone.com/user/AlexanderErmolaev)
        // improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
        // improved by: Steven Levithan (http://blog.stevenlevithan.com)
        // improved by: Jack
        //    input by: Erkekjetter
        //    input by: DxGx
        // bugfixed by: Onno Marsman
        //   example 1: trim('    Kevin van Zonneveld    ');
        //   returns 1: 'Kevin van Zonneveld'
        //   example 2: trim('Hello World', 'Hdle');
        //   returns 2: 'o Wor'
        //   example 3: trim(16, 1);
        //   returns 3: 6

        let whitespace, l = 0,
            i = 0;
        str += '';

        if (!charlist) {
            // default list
            whitespace =
                ' \n\r\t\f\x0b\xa0\u2000\u2001\u2002\u2003\u2004\u2005\u2006\u2007\u2008\u2009\u200a\u200b\u2028\u2029\u3000'
        } else {
            // preg_quote custom list
            charlist += '';
            whitespace = charlist.replace(/([\[\]\(\)\.\?\/\*\{\}\+\$\^\:])/g, '$1')
        }

        l = str.length;
        for (i = 0; i < l; i++) {
            if (whitespace.indexOf(str.charAt(i)) === -1) {
                str = str.substring(i);
                break
            }
        }

        l = str.length;
        for (i = l - 1; i >= 0; i--) {
            if (whitespace.indexOf(str.charAt(i)) === -1) {
                str = str.substring(0, i + 1);
                break
            }
        }

        return whitespace.indexOf(str.charAt(0)) === -1 ? str : ''
    }
}
