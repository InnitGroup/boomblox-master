function isIE() {
    var myNav = navigator.userAgent.toLowerCase();
    return (myNav.indexOf('msie') != -1) ? parseInt(myNav.split('msie')[1]) : false;
}

if (isIE()) {
    document.attachEvent("onreadystatechange", function() {
        if (document.readyState === "complete") {
            var popup = document.getElementById("Pricing");
            if (popup.style.display == "none") {
                popup.style.display = "block";
            } else {
                popup.style.display = "none";
            }
        }
    });
} else {
    document.addEventListener("DOMContentLoaded", function() {
        var checkbox = document.getElementById("ctl00$cphRoblox$cbIsOnsale");
        checkbox.addEventListener("change", function() {
            var popup = document.getElementById("Pricing");
            if (popup.style.display == "none") {
                popup.style.display = "block";
            } else {
                popup.style.display = "none";
            }
        });

        function liveCalculate(input, outputA, outputB) {
            if (input.value !== "") {
                var price = parseInt(input.value);
                var fee = 0;
                var earn = 0;

                if (price === 0) {
                    outputA.innerHTML = "---";
                    outputB.innerHTML = "---";
                    return;
                }

                if (price === 1) {
                    fee = 0;
                    earn = 1;
                } else {
                    fee = Math.ceil(price * 0.1);
                    earn = price - fee;
                }

                outputA.innerHTML = fee;
                outputB.innerHTML = earn;
            } else {
                outputA.innerHTML = "---";
                outputB.innerHTML = "---";
            }
        }

        var input = document.getElementById("ctl00$cphRoblox$PricingFieldRobux");
        var outputA = document.getElementById("ctl00$cphRoblox$marketplaceFeeRobux");
        var outputB = document.getElementById("ctl00$cphRoblox$earningsRobux");
        input.addEventListener("input", function() {liveCalculate(input, outputA, outputB)});

        var input2 = document.getElementById("ctl00$cphRoblox$PricingFieldTickets");
        var outputA2 = document.getElementById("ctl00$cphRoblox$marketplaceFeeTickets");
        var outputB2 = document.getElementById("ctl00$cphRoblox$earningsTickets");
        input2.addEventListener("input", function() {liveCalculate(input2, outputA2, outputB2)});
    });
}