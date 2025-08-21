function __doPostBack(eventTarget, eventArgument) {
    document.aspnetForm.__EVENTTARGET.value = eventTarget;
    document.aspnetForm.__EVENTARGUMENT.value = eventArgument;
    document.aspnetForm.submit();
}