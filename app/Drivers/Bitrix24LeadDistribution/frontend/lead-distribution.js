function Condition(root, parent) {
    var self = this;

    self.parent = parent;
    self.root = root;

    self.field = ko.observable();
    self.operation = ko.observable();
    self.value1 = ko.observable();
    self.value2 = ko.observable();
    self.result = ko.observable();
    self.conditions = ko.observableArray();

    function notifyRoot(){
        self.root.childrenUpdated();
    }

    self.field.subscribe(notifyRoot);
    self.operation.subscribe(notifyRoot);
    self.value1.subscribe(notifyRoot);
    self.value2.subscribe(notifyRoot);
    self.result.subscribe(notifyRoot);
    self.conditions.subscribe(notifyRoot);

    self.conditionTypes = [
        '<', '<=', '=', '>=', '>', 'in', 'between'
    ];

    self.addCondition = function () {
        self.conditions.push(new Condition(self.root, self));
        notifyRoot();
        return false;
    };

    self.removeCondition = function (data, event) {
        self.conditions.remove(data);
        notifyRoot();
    };

    self.toArray = function () {
        return {
            field: self.field(),
            operation: self.operation(),
            value1: self.value1(),
            value2: self.value2(),
            result: self.result(),
            success: toArray(self.conditions())
        };
    };
}

function LeadDistribution(params) {
    var self = this;

    self.conditions = ko.observableArray(params);

    self.addCondition = function () {
        self.conditions.push(new Condition(self, self));
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

    self.childrenUpdated = function(){
        self.conditions.valueHasMutated();
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

ko.components.register('lead-distribution', {
    viewModel: LeadDistribution,
    template: {require: 'text!/lead-distribution/lead-distribution.html'}
});