function Application() {
    var self = this;

    self.id = ko.observable();
    self.name = ko.observable();
    self.clientId = ko.observable();
    self.clientSecret = ko.observable();

    self.isError = ko.observable(false);
    self.isSaved = ko.observable(false);
    self.errors = ko.observableArray([]);

    self.save = function () {
        post('/api/v1/applications' + (self.id !== null ? '/' + self.id : ''), {
            name: self.name(),
            client_id: self.clientId(),
            client_secret: self.clientSecret()
        })
            .done(function (response) {
                self.isSaved(true);
                self.id(response.id);
                window.location.hash = self.id;
            })
            .fail(function (response) {
                self.isError(true);
                self.errors(response.responseJSON);
            });
    };

    self.regenerateKeys = function () {
        post('/api/v1/applications/' + self.id + '/regenerate-keys')
            .done(function (response) {
                self.isSaved(true);
                self.name(response.name);
                self.clientId(response.client_id);
                self.clientSecret(response.client_secret);
            })
            .fail(function (response) {
                self.isError(true);
                self.errors(response.responseJSON);
            });
    };

    self.id = window.location.hash.replace('#', '');

    get('/api/v1/applications/' + self.id)
        .done(function (response) {
            self.name(response.name);
            self.clientId(response.client_id);
            self.clientSecret(response.client_secret);
        })
        .fail(function () {
            window.location = '/';
        });
}