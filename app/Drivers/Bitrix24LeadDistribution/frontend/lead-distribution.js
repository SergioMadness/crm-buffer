function Condition() {
    var self = this;

    self.field = null;
    self.operation = null;
    self.value1 = null;
    self.value2 = null;
    self.result = null;
    self.success = ko.observableArray();

    self.addCondition = function () {
        self.success.push(new Condition());
    };
}

function LeadDistribution(params) {
    var self = this;

    self.conditions = ko.observableArray();

    self.addCondition = function () {
        self.conditions.push(new Condition());
    };
}

ko.components.register('lead-distribution', {
    viewModel: LeadDistribution,
    template: '<div data-bind="foreach: conditions">' +
    '<input class="form-control" type="text" data-bind="value: field">' +
    '<select class="form-control"></select>' +
    '</div>'
});