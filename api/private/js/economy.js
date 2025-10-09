class EconomyServices {
    static GetEstimatedTradeReturnForRobux(amountToTrade, onTix, onError, context) {
        try {
            if (typeof Number(amountToTrade) !== "number" || amountToTrade <= 0) {
                //throw new Error("Invalid trade amount");
            }

            onTix(Number(amountToTrade * 10), context);
        } catch (error) {
            onError(error, context);
        }
    }

    static GetEstimatedTradeReturnForTickets(amountToTrade, onBux, onError, context) {
        try {
            if (typeof Number(amountToTrade) !== "number" || amountToTrade < 10) {
                //throw new Error("Invalid trade amount");
            }

            onBux(Math.floor(Number(amountToTrade / 10)), context);
        } catch (error) {
            onError(error, context);
        }
    }
}