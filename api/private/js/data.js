// simulate Sys C# namespace/environment
var Sys = {};
Sys.WebForms = {};

Sys.WebForms.SimulatedInstance = function () {};

Sys.WebForms.SimulatedInstance.prototype._updateControls = function (table1, table2, table3, int1) {
    // empty stub
};

Sys.WebForms.PageRequestManager = {};

Sys.WebForms.PageRequestManager._initialize = function (elementName, formObject) {
    // empty stub
};

Sys.WebForms.PageRequestManager.getInstance = function () {
    return new Sys.WebForms.SimulatedInstance();
};

var Type = {};
Type.namespace = null;

Type.registerNamespace = function (namespaceName) {
    Type.namespace = namespaceName;
};

function isIE() {
    var myNav = navigator.userAgent.toLowerCase();
    if (myNav.indexOf('msie') !== -1) {
        return parseInt(myNav.split('msie')[1]);
    }
    return false;
}

function __doPostBack(eventTarget, eventArgument) {
    document.aspnetForm.__EVENTTARGET.value = eventTarget;
    document.aspnetForm.__EVENTARGUMENT.value = eventArgument;
    document.aspnetForm.submit();
}

if (isIE() === false) {
    function OpenPlace(place) {
        var accordion = $("#PlaceContent" + place);
        $(".PlaceContent").not(accordion).slideUp();
        accordion.stop(true, true).slideToggle();
    }
}

function __doWebPostBack(url, target, argument) {

    var xhr;

    if (window.XMLHttpRequest) {
        xhr = new XMLHttpRequest();
    } else {
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {
            if (xhr.status == 200 || xhr.status == 0) {
                var el = document.getElementById(target);
                if (el) {
                    el.innerHTML = xhr.responseText;
                }
            }
        }
    };

    xhr.open("POST", "/" + url, true);
    xhr.setRequestHeader("Content-Type", "application/json; charset=utf-8");
    xhr.setRequestHeader("From", "siteApi");

    var data = argument;

    if (typeof argument != "string") {
        if (window.JSON && JSON.stringify) {
            data = JSON.stringify(argument);
        } else {
            data = "";
        }
    }

    xhr.send(data);
}

function __loading(target, style) {
    if (!style) {
        style = "";
    }

    var el = document.getElementById(target);

    if (el) {
        el.innerHTML = '<img style="' + style + '" src="/images/ProgressIndicator2.gif">';
    }
}