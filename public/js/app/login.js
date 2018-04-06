function Login() {
    var self = this;

    self.isError = ko.observable(false);
    self.errors = ko.observableArray([]);

    self.login = ko.observable();
    self.password = ko.observable();

    self.loginClick = function () {
        self.isError(false);
        self.errors([]);
        getToken(self.login(), self.password())
            .done(function (response, textStatus, xhr) {
                login(xhr.getResponseHeader(tokenHeader), xhr.getResponseHeader(refreshTokenHeader));
            })
            .fail(function (response) {
                self.isError(true);
                self.errors(response.responseJSON);
            });

        return false;
    };

    function getToken(login, password) {
        return post('/api/v1/login', {
            login: login,
            password: password
        });
    }
}