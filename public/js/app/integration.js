function Integration() {
    var self = this;

    self.id = ko.observable();
    self.name = ko.observable();
    self.driver = ko.observable();
    self.isActive = ko.observable();
    self.settingsValues = ko.observable({});

    self.isError = ko.observable(false);
    self.isSaved = ko.observable(false);
    self.errors = ko.observableArray([]);

    self.drivers = ko.observableArray([]);
    self.currentDriverSettings = ko.observable();

    self.save = function () {
        var id = self.id();
        post('/api/v1/integrations' + (id !== null ? '/' + id : ''), {
            name: self.name(),
            driver: self.driver(),
            is_active: self.isActive(),
            settings: self.settingsValues()
        })
            .done(function (response) {
                self.isSaved(true);
                self.id(response.id);
                window.location.hash = response.id;
            })
            .fail(function (response) {
                self.isError(true);
                self.errors(response.responseJSON);
            });
    };

    self.setCurrentDriver = function () {
        self.currentDriverSettings(self.drivers()[self.driver()]);
    };

    self.id(window.location.hash.replace('#', ''));

    get('/api/v1/drivers')
        .done(function (response) {
            self.drivers(response);
        });

    get('/api/v1/integrations/' + self.id())
        .done(function (response) {
            self.name(response.name);
            self.driver(response.driver);
            self.setCurrentDriver();
            self.isActive(response.is_active || false);
            self.settingsValues(response.settings || {});
        })
        .fail(function () {
            window.location = '/integrations.html';
        });
}