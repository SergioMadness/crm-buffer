function Requests() {
    var self = this;

    var limit = 150;
    var offset = 0;

    self.isError = ko.observable(false);
    self.errors = ko.observableArray([]);
    self.isDeleted = ko.observable(false);
    self.selectedRequest = ko.observable();

    self.list = ko.observableArray([]);

    self.page = function () {

    };

    self.view = function (item) {
        self.selectedRequest(item);
        $('#request-modal').modal();
    };

    self.remove = function (request) {
        del('/api/v1/leads/' + request.id)
            .done(function () {
                self.isDeleted(true);
                updateList();
            })
            .fail(function () {
                self.isError(true);
                self.errors(response.responseJSON);
            });
    };

    self.objectToArray = function (body) {
        var result = [];
        for (var i in body) {
            result.push({
                index: i,
                value: body[i]
            });
        }
        return result;
    };

    function load(limit, offset) {
        return get('/api/v1/leads', {
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