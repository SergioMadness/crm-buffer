var tokenHeader = 'x-cbs-token';
var refreshTokenHeader = 'x-cbs-refresh-token';

function logout() {
    Cookies.remove('token');
    Cookies.remove('refreshToken');
    window.location = '/login.html';
}

function login(token, refreshToken) {
    Cookies.set('token', token);
    Cookies.set('refreshToken', refreshToken);
    window.location = '/';
}

function request(method, url, data) {
    return $.ajax({
        url: url,
        data: data,
        type: method,
        beforeSend: function (xhr) {
            xhr.setRequestHeader(tokenHeader, Cookies.get('token'));
            xhr.setRequestHeader(refreshTokenHeader, Cookies.get('refreshToken'));
        }
    });
}

function get(url, data) {
    return request('get', url, data);
}

function post(url, data) {
    return request('post', url, data);
}

function del(url, data) {
    return request('delete', url, data);
}