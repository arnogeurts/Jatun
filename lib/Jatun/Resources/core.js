/**
 * The Jatun class definition
 *
 * @param options
 * @constructor
 */
var Jatun = function(options) {
    this.options = undefined;
    this.handlers = {};
    this.parsers = [];
    this.beforeRequestObservers = [];
    this.afterRequestObservers = [];

    /**
     * Constructor for the Jatun object
     * @param options
     */
    this.init = function(options) {
        var defaultOptions = {
            dataType: 'json'
        };

        this.options = $.extend(defaultOptions, options);
    };

    /**
     * Add an event handler to Jatun
     *
     * @param event
     * @param callback
     */
    this.addHandler = function(event, callback) {
        if (this.handlers[event] == undefined) {
            this.handlers[event] = [];
        }
        this.handlers[event].push(callback);
    };

    /**
     * Get all handlers for a given event
     *
     * @param event
     * @returns callback
     */
    this.getHandlers = function(event) {
        return this.handlers[event] != undefined ? this.handlers[event] : [];
    };

    /**
     * Add a parser to Jatun
     *
     * @param parser
     */
    this.addParser = function(parser) {
        this.parsers.push(parser);
    };

    /**
     * Get all available Jatun parsers
     *
     * @returns {Array}
     */
    this.getParsers = function() {
        return this.parsers;
    };

    /**
     * Add a observer to Jatun, which will be called before a request is done
     *
     * @param observer
     */
    this.addBeforeRequestObserver = function(observer) {
        this.beforeRequestObservers.push(observer);
    };

    /**
     * Get all available observers, which are called before a request is done
     *
     * @returns {Array}
     */
    this.getBeforeRequestObservers = function() {
        return this.beforeRequestObservers;
    };

    /**
     * Add a observer to Jatun, which will be called after a request is done
     *
     * @param observer
     */
    this.addAfterRequestObserver = function(observer) {
        this.afterRequestObservers.push(observer);
    };

    /**
     * Get all available observers, which are called after a request is done
     *
     * @returns {Array}
     */
    this.getAfterRequestObservers = function() {
        return this.afterRequestObservers;
    };

    /**
     * Trigger a Jatun event
     *
     * @param event
     * @param parameters
     */
    this.trigger = function(event, parameters) {
        var self = this;
        $.each(this.getHandlers(event), function(index, handler) {
            var args = self._getHandlerArguments(handler);
            var params = self._mapParameters(parameters, args);
            self._applyHandler(handler, params);
        });
    };

    /**
     * Get the arguments for a given handler function
     *
     * @param handler
     * @returns {Array}
     * @private
     */
    this._getHandlerArguments = function(handler) {
        var args = [];
        if ($.isArray(handler)) {
            $.each(handler, function(index, arg) {
                if (!$.isFunction(arg)) {
                    args.push(arg);
                }
            });
        }

        return args;
    };

    /**
     * Maps the parameters to the handler arguments
     *
     * @param parameters
     * @param arguments
     * @returns {Array}
     * @private
     */
    this._mapParameters = function(parameters, arguments) {
        var params = [];
        $.each(arguments, function(index, arg) {
            if (!parameters[arg]) {
                throw "Unable to get parameter " + arg + " for handler";
            }
            params.push(parameters[arg]);
        });

        return params;
    };

    /**
     * Apply the handler with the parameters
     *
     * @param handler
     * @param parameters
     * @private
     */
    this._applyHandler = function(handler, parameters) {
        if ($.isArray(handler)) {
            var self = this;
            $.each(handler, function(index, h) {
                self._applyHandler(h, parameters);
            });
        } else if ($.isFunction(handler)) {
            handler.apply(this, parameters);
        }
    };

    /**
     * Parse an element
     * Element is selected by the given selector
     *
     * @param selector
     */
    this.parse = function(selector) {
        var element = $(selector);
        var self = this;
        $.each(this.getParsers(), function(index, parser) {
            parser.apply(self, [element]);
        });
    };

    /**
     * Execute a Jatun request
     *
     * @param context
     * @param requestData
     */
    this.request = function(requestData, context) {
        requestData = $.extend(requestData, this.getRequestData(context));

        if (this.beforeRequest(requestData, context)) {
            this.doRequest(requestData);
        } else {
            // if before request is invoked returned false, invoke after request
            this.afterRequest();
        }
    };

    /**
     * Get an array of request data for the given context
     *
     * @param context
     * @returns {Object}
     */
    this.getRequestData = function(context) {
        if (context === undefined) {
            return {
                dataType: this.options.dataType
            }
        } else if (context.data('target')) {
            return this.getRequestData($('#' + context.data('target')));
        } else if (context.is('form')) {
            return {
                url: context.attr('action'),
                type: context.attr('method'),
                data: context.serialize(),
                dataType: this.options.dataType
            }
        } else if (context.is('a')) {
            return {
                url: context.attr('href'),
                dataType: this.options.dataType
            }
        } else {
            return {
                url: context.data('path'),
                dataType: this.options.dataType
            }
        }
    };

    /**
     * Handler executed before a request is executed
     */
    this.beforeRequest = function(requestData, context) {
        var self = this;
        var result = true;
        $.each(this.getBeforeRequestObservers(), function(index, observer) {
            result = observer.apply(self, [requestData, context]);
            // make sure the loop is broken when false is returned
            return result;
        });

        return result;
    };

    /**
     * Execute the actual request with the request data
     *
     * @param requestData
     */
    this.doRequest = function(requestData) {
        var self = this;

        requestData.success = function(response) {
            self.handleResponse(response);
        };

        requestData.complete = function() {
            self.afterRequest();
        };

        $.ajax(requestData);
    };

    /**
     * Handle the Jatun response from the server
     * @param response
     */
    this.handleResponse = function(response) {
        var self = this;
        $.each(response, function(index, event) {
            self.trigger(event.event, event.arguments);
        });
    };

    /**
     * Handler executed after the request is done
     */
    this.afterRequest = function() {
        var self = this;
        $.each(this.getAfterRequestObservers(), function(index, observer) {
            observer.apply(self, []);
        });
    };

    this.init(options);
};

/**
 * Create the Jatun object
 * @type {Jatun}
 */
$.jatun = new Jatun({});

/**
 * Add a jatun function to all elements, which handles clicks and submits
 */
$.fn.jatun = function(options) {
    if (!$.isPlainObject(options)) {
        options = {};
    }

    $(this).each(function(index, element) {
        var context = $(element);

        var eventHandler = function(event) {
            event.preventDefault();
            $.jatun.request(options, context);
        };

        if (context.is('form')) {
            context.bind('submit', eventHandler);
        } else {
            context.bind('click', eventHandler);
        }
    });
};

/**
 * trigger parse handler on load
 */
$(document).ready(function() {
    $.jatun.parse('body');
});
