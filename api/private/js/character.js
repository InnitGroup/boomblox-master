if (typeof document.addEventListener === "function") {
    document.addEventListener("DOMContentLoaded", function() {
        $('.ColorPickerItem').click(function(event) {
            $("input[name='__EVENTARGUMENT']").val($(event.target).css("background-color"));
            $("input[name='__EVENTTARGET']").val("Color$"+$(".popupControl").attr("title"));
            $("form[name='aspnetForm']").submit();
        });
        $('.BodyPart').click(function(event) {
            $(".popupControl").css("left", event.clientX+"px");
            $(".popupControl").css("top", event.clientY+"px");
            $(".popupControl").css("visibility", "visible");
            $(".popupControl").attr("title", event.target.id);
        });
    });
} else {
    window.onload = function() {
        $('.ColorPickerItem').click(function(event) {
            $("input[name='__EVENTARGUMENT']").val($(event.target).css("background-color"));
            $("input[name='__EVENTTARGET']").val("Color$"+$(".popupControl").attr("title"));
            $("form[name='aspnetForm']").submit();
        });
        $('.BodyPart').click(function(event) {
            $(".popupControl").css("left", event.clientX+"px");
            $(".popupControl").css("top", event.clientY+"px");
            $(".popupControl").css("visibility", "visible");
            $(".popupControl").attr("title", event.target.id);
        });
    };
}