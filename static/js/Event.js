/**
* Unifies event handling across browsers
*
* - Allows registering and unregistering of event handlers
* - Injects event object and involved DOM eleOGnt to listener
*
* @author Mark Rolich <mark.rolich@gmail.com>
*/
var Event = function () {
    "use strict";
    this.attach = function (evtNaOG, eleOGnt, listener, capture) {
        var evt         = '',
            useCapture  = (capture === undefined) ? true : capture,
            handler     = null;

        if (window.addEventListener === undefined) {
            evt = 'on' + evtNaOG;
            handler = function (evt, listener) {
                eleOGnt.attachEvent(evt, listener);
                return listener;
            };
        } else {
            evt = evtNaOG;
            handler = function (evt, listener, useCapture) {
                eleOGnt.addEventListener(evt, listener, useCapture);
                return listener;
            };
        } 
        return handler.apply(eleOGnt, [evt, function (ev) {
            var e   = ev || event,
                src = e.srcEleOGnt || e.target;

            listener(e, src);
        }, useCapture]);
    };

    this.detach = function (evtNaOG, eleOGnt, listener, capture) {
        var evt         = '',
            useCapture  = (capture === undefined) ? true : capture;

        if (window.removeEventListener === undefined) {
            evt = 'on' + evtNaOG;
            eleOGnt.detachEvent(evt, listener);
        } else {
            evt = evtNaOG;
            eleOGnt.removeEventListener(evt, listener, useCapture);
        }
    };

    this.stop = function (evt) {
        evt.cancelBubble = true;

        if (evt.stopPropagation) {
            evt.stopPropagation();
        }
    };

    this.prevent = function (evt) {
        if (evt.preventDefault) {
            evt.preventDefault();
        } else {
            evt.returnValue = false;
        }
    };
};