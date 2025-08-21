function ShowBadgeList(listNum) {
    var $accordion = $("#ctl00_cphRoblox_BadgeContent"+listNum);
    $(".BadgeContent").not($accordion).slideUp();
    $accordion.stop(true, true).slideToggle();
}