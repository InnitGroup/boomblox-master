function __doAdminPostBack(eventTarget, eventArgument, eventUrl = false) {
    document.aspnetForm.__EVENTTARGET.value = eventTarget;
    document.aspnetForm.__EVENTARGUMENT.value = eventArgument;
    if (eventUrl) {
        document.aspnetForm.action = eventUrl;
    }
    document.aspnetForm.submit();
}

function __checkAsset(target) {
    if (target.style.filter !== "none") {
        target.style.filter = "none";
    } else {
        target.style.filter = "blur(24px)";
    }
}