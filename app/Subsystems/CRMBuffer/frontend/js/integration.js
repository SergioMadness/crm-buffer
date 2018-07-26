function Driver(data) {
    var self = this;

    self.name = data.name;
    self.alias = data.alias;
    self.fields = data.fields;
    self.plugins = ko.observableArray();
    if (data.plugins.length > 0) {
        for (var i = 0; i < data.plugins.length; i++) {
            self.plugins.push(new Plugin(data.plugins[i]));
        }
    }

    self.settings = ko.observable(data.settings);
}

function Plugin(data) {
    var self = this;

    self.name = data.name;
    self.alias = data.alias;
    self.settings = ko.observable(data.settings);
    self.frontend_component = data.frontend_component;
    self.loaded = ko.observable(false);
    if (self.frontend_component) {
        require(['/' + self.frontend_component + '/' + self.frontend_component + '.js'], function () {
            self.loaded(true);
        });
    } else {
        self.loaded(true);
    }
}

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
        var settings = self.settingsValues();
        for (var i in settings) {
            settings[i] = settings[i] === true ? 1 : (settings[i] === false ? 0 : settings[i]);
        }
        post('/api/v1/integrations' + (id !== null ? '/' + id : ''), {
            name: self.name(),
            driver: self.driver().alias,
            is_active: self.isActive() ? 1 : 0,
            settings: settings
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
        var currentDriver = self.driver();
        if (currentDriver !== null) {
            self.currentDriverSettings(self.driver().settings());
        }
    };

    self.id(window.location.hash.replace('#', ''));

    get('/api/v1/drivers')
        .done(function (response) {
            for (var i = 0; i < response.length; i++) {
                self.drivers.push(new Driver(response[i]));
            }
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