function isIE() {
    var myNav = navigator.userAgent.toLowerCase();
    return (myNav.indexOf('msie') != -1) ? parseInt(myNav.split('msie')[1]) : false;
}

if (isIE()) {
    document.attachEvent("onreadystatechange", function() {
        if (document.readyState === "complete") {
            var resetButton = document.getElementById("reset");
            resetButton.attachEvent("onclick", function() {
                var popup = document.getElementById("popup");
                popup.style.visibility = "visible";
            });
        }
    });
} else {
    document.addEventListener("DOMContentLoaded", function() {
        $(".ResetPlaceRow .Button").click(function() {
            $(".popupControl").css("visibility","visible");
        });
    });
}