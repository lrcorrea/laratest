(function($) {
    "use strict";

   // Set private defaults.
    var settings = {
        placeholder: '',
        param: 'oi',
        onComplete: function(el) {}
    };

    // Define the public api and its public methods.
    var Selecti = {
        extend: function(name, method) {
            Selecti[name] = method;
            return this;
        },

        init: function(PublicOptions) {
            var self = Selecti,
                $el = this;

            // Do a deep copy of the options.
            var Options = $.extend(true, {}, settings, PublicOptions);


            this.each(function() {
                var select = $(this);

                var newSelect = $('<div class="selecti"></div>'),
                    placeholder = $('<div class="placeholder">'+(($(select).attr('placeholder')) ? $(select).attr('placeholder') : (Options.placeholder.length > 0) ? Options.placeholder : '')+'</div>'),
                    optionsContainer = $('<ul class="options"></ul>'),
                    options;

                //create options
                $.each(select.children(), function(index, val) {
                    self.createOptions(val, index).appendTo(optionsContainer);
                });

                placeholder.appendTo(newSelect);
                optionsContainer.appendTo(newSelect);


                // add selecti DOM
                select.after(newSelect);
            });

            return 0;

        },

        //create options
        createOptions: function(elm, i, group) {
            var self = Selecti,
                $elm = $(elm);
            // single select
            console.log($elm);
            if ($elm.is('option')) {
                var value = $elm.val(),
                    label = $elm.text(),
                    selected = $elm.attr('selected') ? true : false,
                    $el;

                $el = $('<li class="option" data-value="'+value+'">'+label+'</li>');
                return $el;
            }

            if ($elm.is('optgroup')) {
                var label = $elm.attr('label'),
                    $group = $('<div/>'),
                    group = 'group_' + i;
                    // $group = $('<ul></ul>'),
                    // $optgroup = $('<li><div class="optgroup-label">'+label+'</div></li>');

                $group.append('<li><div class="optgroup-label">'+label+'</div></li>');
                // var $el = $group;

                $.each($elm.children(), function (i, elm) {
                    console.log(elm);
                    $group.append(self.createOptions(elm, i, $group));
                });

                return $group.html();
                //     console.log($group);

                // $el = $group.html();
                // return $group.html();
            }
        },

        method1: function() {
            console.log('called: method1');
            return this;
        },
    };

    // Create the plugin name and defaults once
    var pluginName = 'selecti';

    // Attach the plugin to jQuery namespace.
    $.fn[pluginName] = function(method) {
        //call method
        if (Selecti[method]) {
            return Selecti[method].apply(this, Array.prototype.slice.call(arguments, 1));
        }
        //init plugin
        else if (typeof method === 'object' || !method) {
            return Selecti.init.apply(this, arguments);
        }
        else {
            $.error('Method ' + method + 'does not exist');
        }
    };

})(jQuery);