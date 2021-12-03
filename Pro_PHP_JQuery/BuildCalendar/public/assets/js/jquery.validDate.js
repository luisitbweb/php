"use strict";

// Checks for a valid date string (YYYY-MM-DD HH:MM:SS)
(function($){
    // Extends the jQuery object to validate strings
    $.validDate = function(date, options){
        // Sets up default values for the methos
        var defaults = {
            "pattern" : /^(\d{4}(-\d{2}){2} (\d{2})(:\d{2}){2})$/
        },
                // Extends the defaults with user-supplied options
                opts = $.extend(defaults, options);
                
                // Returns true if a match is found, false otherwise
                return date.match(opts.pattern) != null;
    };
})(jQuery);