function Condition() {
    var self = this;

    self.field = null;
    self.operation = ko.observable();
    self.value1 = null;
    self.value2 = null;
    self.result = null;
    self.success = ko.observableArray();

    self.conditionTypes = [
        '<', '<=', '=', '>=', '>', 'in', 'between'
    ];

    self.addCondition = function () {
        self.success.push(new Condition());
        return false;
    };
}

function LeadDistribution(params) {
    var self = this;

    self.conditions = ko.observableArray();

    self.addCondition = function () {
        self.conditions.push(new Condition());
        return false;
    };

    self.addCondition();
}

ko.components.register('lead-distribution', {
    viewModel: LeadDistribution,
    template: {require: 'text!/lead-distribution/lead-distribution.html'}
});