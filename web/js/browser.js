/*jslint browser: true */
/*global jQuery */
(function () {
    "use strict";
    var browserNotSupported = (function () {
        var div = document.createElement('DIV');
        // http://msdn.microsoft.com/en-us/library/ms537512(v=vs.85).aspx
        div.innerHTML = '<!--[if lte IE 8]><I></I><![endif]-->';
        return div.getElementsByTagName('I').length > 0;
    }());
    if (browserNotSupported) {
        jQuery("html").addClass("browserNotSupported").data("browserNotSupported", browserNotSupported);
    }
}());