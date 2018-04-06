function Applications() {
    var self = this;

    var limit = 150;
    var offset = 0;

    self.isError = ko.observable(false);
    self.errors = ko.observableArray([]);
    self.isDeleted = ko.observable(false);

    self.list = ko.observableArray([]);

    self.page = function () {

    };

    self.remove = function (application) {
        del('/api/v1/applications/' + application.id)
            .done(function () {
                self.isDeleted(true);
                updateList();
            })
            .fail(function () {
                self.isError(true);
                self.errors(response.responseJSON);
            });
    };

    function load(limit, offset) {
        return get('/api/v1/applications', {
            limit: limit,
            offset: offset
        });
    }

    function updateList() {
        load(limit, offset)
            .done(function (response) {
                self.list(response);
            })
            .fail(logout);
    }

    updateList();
}