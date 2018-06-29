function Panel() {
    var self = this;

    self.navigation = ko.observable([]);

    SDK.getNavigationItems().then(function (items) {
        self.navigation(items);
        init_sidebar();
    });
}