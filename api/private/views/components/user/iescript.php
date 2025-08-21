<script>
    function OpenPlace(place) {
        var targetId = "PlaceContent" + place;
        var contents = document.getElementsByTagName("*");

        for (var i = 0; i < contents.length; i++) {
            var el = contents[i];
            if (el.className && el.className.indexOf("PlaceContent") !== -1) {
                if (el.id !== targetId) {
                    el.style.display = "none";
                }
            }
        }

        var target = document.getElementById(targetId);
        if (target.style.display === "none" || target.style.display === "") {
            target.style.display = "block";
        } else {
            target.style.display = "none";
        }
    }
</script>