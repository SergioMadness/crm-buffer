function Condition(parent) {
    var self = this;
console.log(parent);
    self.parent = parent;

    self.field = null;
    self.operation = ko.observable();
    self.value1 = null;
    self.value2 = null;
    self.result = null;
    self.conditions = ko.observableArray();

    self.conditionTypes = [
        '<', '<=', '=', '>=', '>', 'in', 'between'
    ];

    self.addCondition = function () {
        self.conditions.push(new Condition(self));
        return false;
    };

    self.removeCondition = function (data, event) {
        self.conditions.remove(data);
    };

    self.toArray = function () {
        return {
            field: self.field,
            operation: self.operation(),
            value1: self.value1,
            value2: self.value2,
            result: self.result,
            success: toArray(self.conditions())
        };
    };
}

function LeadDistribution(params) {
    var self = this;

    self.conditions = ko.observableArray(params);

    self.addCondition = function () {
        self.conditions.push(new Condition(self));
        return false;
    };

    self.removeCondition = function (data, event) {
        self.conditions.remove(data);
        if (self.conditions().length === 0) {
            self.addCondition();
        }
    };

    if (self.conditions().length === 0) {
        self.addCondition();
    }

    self.toArray = function () {
        return toArray(self.conditions());
    };

    self.jsonStructure = ko.computed(function () {
        return JSON.stringify(self.toArray());
    }, self);
}

function toArray(conditions) {
    var result = [];
    for (var i in conditions) {
        if (Array.isArray(conditions[i])) {
            result.push(toArray(conditions[i]));
        } else {
            result.push(conditions[i].toArray());
        }
    }
    return result;
}

ko.components.register('lead-distribution-condition', {
    viewModel: Condition,
    template: {require: 'text!/lead-distribution/lead-distribution-condition.html'}
});

ko.components.register('lead-distribution', {
    viewModel: LeadDistribution,
    template: {require: 'text!/lead-distribution/lead-distribution.html'}
});