class EconomyServices {
    static GetEstimatedTradeReturnForRobux(amountToTrade, onTix, onError, context) {
        try {
            if (typeof Number(amountToTrade) !== "number" || amountToTrade <= 0) {
                //throw new Error("Invalid trade amount");
            }

            onTix(Number(amountToTrade * 9), context);
        } catch (error) {
            onError(error, context);
        }
    }

    static GetEstimatedTradeReturnForTickets(amountToTrade, onBux, onError, context) {
        try {
            if (typeof Number(amountToTrade) !== "number" || amountToTrade < 20) {
                //throw new Error("Invalid trade amount");
            }

            onBux(Math.floor(Number(amountToTrade / 9)), context);
        } catch (error) {
            onError(error, context);
        }
    }
}

function ShowDashboardElement(elementNumber) {
    var $accordion = $("#ctl00_cphRoblox_DashboardElement"+elementNumber);
    $(".DashboardContent").not($accordion).slideUp();
    $accordion.stop(true, true).slideToggle();
}