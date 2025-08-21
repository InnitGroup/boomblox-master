<div id="TradeCurrencyContainer">
        <h2>Currency Exchange</h2>
                
         <div class="LeftColumn" style="clear:both;"></div>
         <div class="CenterColumn">
            <div class="CurrencyTrade" id="CurrencyQuotePane" style="position: relative;left:59%;">
                <h4>Trade</h4>
                <div style="height:10px;clear:both;"></div>
                <form name="Trade" action="Trade.php" method="POST" style="text-align:center;">
                    <input class="CurrencyTradeDetail" type="radio" name="TradeOrder" value="M">
                    <label class="CurrencyTradeDetail">Market Order</label>
                    <input class="CurrencyTradeDetail" type="radio" name="TradeOrder" value="L">
                    <label class="CurrencyTradeDetail">Limit Order</label><br>
                    <div style="height:6px;clear:both;"></div>
                    <label class="CurrencyTradeDetail">What I'll give:</label><br>
                    <input type="number" name="CurrencyAmount" style="width:75px;">
                    <select name="CurrencyType">
                        <option value="Tickets">Tickets</option>
                        <option value="Boombux">Boombux</option>
                    </select>
                    <div style="height:6px;clear:both;"></div>
                    <label class="CurrencyTradeDetail">What I'll get:</label><br>
                    <div style="height:14px;clear:both;"></div>
                    <span id="estTrade" style="color:red;">Estimated Trade: ?</span>
                    <div style="height:14px;clear:both;"></div>
                    <span style="color:red;">* NOTE: Your money will be held for safe-keeping until<br>either the trade executes or you cancel your position.</span>
                    <div style="height:14px;clear:both;"></div>
                    <span style="text-align:left;">A market order is a buy or sell order to be executed<br>immediately at current market prices. As long as there<br>are willing sellers and buyers, a market order will be filed.</span>
                    <div style="height:8px;clear:both;"></div>
                    <input type="submit" value="Submit Trade">
                    <div style="height:6px;clear:both;"></div>
                </form>
            </div>
         </div>
    </div>