function sdk() {
    var self = this;

    self.navigationItems = [];

    self.getNavigationItems = function () {
        if (self.navigationItems.length > 0) {
            var dfd = $.Deffered();

            dfd.resolve(self.navigationItems);

            return dfd.promise();
        }
        return loadNavigation();
    };

    self.getToken = function(login, password) {
        return post('/api/v1/login', {
            login: login,
            password: password
        });
    };

    function loadNavigation() {
        return get('/api/v1/navigation').then(function (data) {
            data = objectToArray(data);
            return self.navigationItems = data;
        });
    }
}

var SDK = new sdk();