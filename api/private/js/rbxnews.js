function isIE() {
    var myNav = navigator.userAgent.toLowerCase();
    return (myNav.indexOf('msie') != -1) ? parseInt(myNav.split('msie')[1]) : false;
}

if (isIE()) {
    document.attachEvent("onDOMContentLoaded", function() {
        __loading("RobloxNews","position:relative;left:60px;top:28px;");
        __doWebPostBack("/api/public/views/News.ashx","RobloxNews","");
    });
} else {
    document.addEventListener("DOMContentLoaded", function() {
        __loading("RobloxNews","position:relative;left:60px;top:28px;");
        __doWebPostBack("/api/public/views/News.ashx","RobloxNews","");
    });
}
