class Sys { // simulate Sys C# namespace/environment
    WebForms = class {
        SimulatedInstance = class {
            _updateControls(table1, table2, table3, int1) {}
        }
        PageRequestManager = class {
            static _initialize(elementName, formObject) {}
            static getInstance() {
                return new Sys.WebForms.SimulatedInstance;
            }
        }
    }
}

class Type {
    static namespace;
    static registerNamespace(namespace) {
        this.namespace = namespace;
    }
}

function isIE() {
    var myNav = navigator.userAgent.toLowerCase();
    return (myNav.indexOf('msie') != -1) ? parseInt(myNav.split('msie')[1]) : false;
}

function __doPostBack(eventTarget, eventArgument) {
    document.aspnetForm.__EVENTTARGET.value = eventTarget;
    document.aspnetForm.__EVENTARGUMENT.value = eventArgument;
    document.aspnetForm.submit();
}

if (isIE() == false) {
    function OpenPlace(place) {
        var $accordion = $("#PlaceContent"+place);
        $(".PlaceContent").not($accordion).slideUp();
        $accordion.stop(true, true).slideToggle();
    }
}

//https://www.youtube.com/watch?v=Ctz1Fsgt9OE
async function __doWebPostBack(url, target, argument) {
    fetch("https://xoblog.dev/"+url, { // Site::$standaloneDomain
        "method": "POST",
        "headers": {
            "Content-Type": "application/json; charset=utf-8",
            "From": "siteApi"
        },
        "body": JSON.stringify(argument)
    }).then(function(response){
        return response.text();
    }).then(function(data){
        document.getElementById(target).innerHTML = data;
    });
}

function __loading(target, style = "") {
   document.getElementById(target).innerHTML = '<img style="'+style+'" src="/images/ProgressIndicator2.gif">'; 
}  