<?php
global $theme, $user;

$tradeCount = CurrencyTrade::getTradeCountByUser($user->getUserId());
$totalPages = ceil($tradeCount/10);
$page = isset($_POST["__EVENTARGUMENT"]) && !empty($_POST["__EVENTARGUMENT"]) ? explode("$", $_POST["__EVENTARGUMENT"])[1] : 1;
?>

<div id="Body">
	<div id="TradeCurrencyContainer">
		<h2>Currency Exchange</h2>
		<div style="margin-bottom:5px; text-align:center;">
			<a href="TradeCurrency.aspx">Refresh</a>
		</div>
		<div class="LeftColumn">
			<div id="CurrencyBidsPane">
				<div class="CurrencyBids">
					<h4>Available Tickets</h4>
					<div class="CurrencyBid"> 39,193 @ 9.0181:1 </div>
					<div class="AlternatingCurrencyBid"> 74,657 @ 9.0002:1 </div>
					<div class="CurrencyBid"> 4,193 @ 8.9023:1 </div>
					<div class="AlternatingCurrencyBid"> 76,475 @ 8.8872:1 </div>
					<div class="CurrencyBid"> 133 @ 8.8666:1 </div>
					<div class="AlternatingCurrencyBid"> 141 @ 8.8125:1 </div>
					<div class="CurrencyBid"> 4,848 @ 8.7985:1 </div>
					<div class="AlternatingCurrencyBid"> 47,999 @ 8.7910:1 </div>
					<div class="CurrencyBid"> 1,468 @ 8.7904:1 </div>
					<div class="AlternatingCurrencyBid"> 4,760 @ 8.7822:1 </div>
					<div class="CurrencyBid"> 71,492 @ 8.7752:1 </div>
					<div class="AlternatingCurrencyBid"> 24,115 @ 8.7690:1 </div>
					<div class="CurrencyBid"> 24,895 @ 8.7658:1 </div>
					<div class="AlternatingCurrencyBid"> 26 @ 8.6666:1 </div>
					<div class="CurrencyBid"> 1,000 @ 8.6206:1 </div>
					<div class="AlternatingCurrencyBid"> 148,782 @ 8.6001:1 </div>
					<div class="CurrencyBid"> 860 @ 8.6:1 </div>
					<div class="AlternatingCurrencyBid"> 215 @ 8.6:1 </div>
					<div class="CurrencyBid"> 21,422 @ 8.5997:1 </div>
					<div class="AlternatingCurrencyBid"> 50,069 @ 8.5940:1 </div>
				</div>
			</div>
		</div>
		<div class="CenterColumn">
			<div class="CurrencyQuote">
					<div class="TableHeader">
						<div class="Pair">Pair</div>
						<div class="Rate">Rate</div>
						<div class="Spread">Spread</div>
						<div class="HighLow">High/Low</div>
						<div style="clear: both;"></div>
					</div>
					<div class="TableRow">
						<div class="Pair">BUX/TIX</div>
						<div class="Rate">9.0181/8.9047</div>
						<div class="Spread">-113</div>
						<div class="HighLow">1000/0.0061</div>
						<div style="clear: both;"></div>
					</div>
				</div>
			<div id="ctl00_cphRoblox_CurrencyTradePane" style="margin-bottom: 20px;">
				<div class="CurrencyTrade">
					<h4>Trade</h4>
					<div class="CurrencyTradeDetails">
						<div class="CurrencyTradeDetail">
							<span title="A market order is a buy or sell order to be executed immediately at current market prices. As long as there are willing sellers and buyers, a market order will be filled.">
								<input id="ctl00_cphRoblox_MarketOrderRadioButton" type="radio" name="ctl00$cphRoblox$OrderType" value="MarketOrderRadioButton" checked="checked" onclick="if (document.getElementById('ctl00_cphRoblox_MarketOrderRadioButton').checked) { document.getElementById('LimitOrder').style.display='none'; document.getElementById('SplitTrades').style.display='none'; document.getElementById('MarketOrder').style.display=''; } else { document.getElementById('LimitOrder').style.display=''; document.getElementById('SplitTrades').style.display=''; document.getElementById('MarketOrder').style.display='none'; };">
								<label for="ctl00_cphRoblox_MarketOrderRadioButton">Market Order</label>
							</span>&nbsp; <span title="A limit order is an order to buy at no more (or sell at no less) than a specific price. This gives you some control over the price at which the trade is executed, but may prevent the order from being executed.">
								<input id="ctl00_cphRoblox_LimitOrderRadioButton" type="radio" name="ctl00$cphRoblox$OrderType" value="LimitOrderRadioButton" onclick="if (document.getElementById('ctl00_cphRoblox_LimitOrderRadioButton').checked) { document.getElementById('LimitOrder').style.display=''; document.getElementById('SplitTrades').style.display=''; document.getElementById('MarketOrder').style.display='none'; } else { document.getElementById('LimitOrder').style.display='none'; document.getElementById('SplitTrades').style.display='none'; document.getElementById('MarketOrder').style.display=''; };"> <!-- alert('Limit order is disabled until full release in November!'); return false; -->
								<label for="ctl00_cphRoblox_LimitOrderRadioButton">Limit Order</label>
							</span>
						</div>
						<div class="CurrencyTradeDetail">
							<div>What I'll give:</div>
							<input name="ctl00$cphRoblox$HaveAmountTextBox" type="text" maxlength="9" id="ctl00_cphRoblox_HaveAmountTextBox" tabindex="1" class="TradeBox" autocomplete="off" onkeyup="EstimateTrade()" onblur="if (document.getElementById('ctl00_cphRoblox_MarketOrderRadioButton').checked) { if (document.getElementById('ctl00_cphRoblox_HaveCurrencyDropDownList').selectedIndex == 0) { var haveBox = document.getElementById('ctl00_cphRoblox_HaveAmountTextBox'); if (parseInt(haveBox.value) &lt; 20) { alert('Market Orders must be at least 20 Tickets.'); haveBox.value = ''; haveBox.focus(); } } }"> &nbsp;&nbsp; <select name="ctl00$cphRoblox$HaveCurrencyDropDownList" id="ctl00_cphRoblox_HaveCurrencyDropDownList" onchange="ctl00_cphRoblox_WantCurrencyDropDownList.selectedIndex = ctl00_cphRoblox_HaveCurrencyDropDownList.selectedIndex; EstimateTrade()">
								<option value="Tickets">Tickets</option>
								<option value="Robux">Robux</option>
							</select>
						</div>
						<div id="LimitOrder" class="CurrencyTradeDetail" style="display: none;">
							<div>What I want:</div>
							<input name="ctl00$cphRoblox$WantAmountTextBox" type="text" maxlength="9" id="ctl00_cphRoblox_WantAmountTextBox" tabindex="2" class="TradeBox" autocomplete="off"> &nbsp; <select name="ctl00$cphRoblox$WantCurrencyDropDownList" id="ctl00_cphRoblox_WantCurrencyDropDownList" onchange="ctl00_cphRoblox_HaveCurrencyDropDownList.selectedIndex = ctl00_cphRoblox_WantCurrencyDropDownList.selectedIndex; EstimateTrade()">
								<option value="Robux">Robux</option>
								<option value="Tickets">Tickets</option>
							</select>
							<p style="color: Red;">* NOTE: Your money will be held for safe-keeping until either the trade executes or you cancel your position.</p>
							<p style="font-size: smaller; margin: 15px; text-align: left;">A limit order is an order to buy at no more (or sell at no less) than a specific price. This gives you some control over the price at which the trade is executed, but may prevent the order from being executed.</p>
						</div>
						<div id="SplitTrades" class="CurrencyTradeDetail" style="display: none;">
							<input id="ctl00_cphRoblox_AllowSplitTradesCheckBox" type="checkbox" name="ctl00$cphRoblox$AllowSplitTradesCheckBox" checked="checked" tabindex="3">
							<label for="ctl00_cphRoblox_AllowSplitTradesCheckBox">Allow split trades</label>
						</div>
						<div id="MarketOrder" class="CurrencyTradeDetail">
							<div>What I'll get:</div>
							<p id="EstimatedTrade" style="color: Red;">Estimated Trade: ?</p>
							<p style="color: Red;">* NOTE: Your money will be held for safe-keeping until either the trade executes or you cancel your position.</p>
							<p style="font-size: smaller; margin: 15px; text-align: left;">A market order is a buy or sell order to be executed immediately at current market prices. As long as there are willing sellers and buyers, a market order will be filled.</p>
						</div>
						<div class="CurrencyTradeDetail">
							<input type="submit" name="ctl00$cphRoblox$SubmitTradeButton" value="Submit Trade" onclick="javascript:WebForm_DoPostBackWithOptions(new WebForm_PostBackOptions(&quot;ctl00$cphRoblox$SubmitTradeButton&quot;, &quot;&quot;, true, &quot;&quot;, &quot;&quot;, false, false))" id="ctl00_cphRoblox_SubmitTradeButton" tabindex="4">
						</div>
					</div>
				</div>
			</div>
			<div class="TradingDashboard" id="UserPlaces">
				<div id="ctl00_cphRoblox_DashboardPositionsRobux">
					<div class="AccordionHeader" onclick="ShowDashboardElement(1)" style="text-align: center;">My Open <?=Site::getThemeProperty("currency", $theme)?> Positions</div>
					<div class="DashboardContent" id="ctl00_cphRoblox_DashboardElement1" style="display: none;">
						<div style="border: 1px solid #000; padding-top: 12px; text-align:center; font-family: Verdana, Sans-Serif;">
							<div>You do not have any open <?=Site::getThemeProperty("currency", $theme)?> trades.</div>
							<br>
							<div style="color:#dcdcdc;">First Previous Next Last</div>
						</div>
					</div>
				</div>
				<div id="ctl00_cphRoblox_DashboardPositionsTickets">
					<div class="AccordionHeader" onclick="ShowDashboardElement(2)" style="text-align: center;">My Open Tickets Positions</div>
					<div class="DashboardContent" id="ctl00_cphRoblox_DashboardElement2" style="display: none;">
						<div class="CurrencyBids" style="border: 1px solid #000; text-align:center; font-family: Verdana, Sans-Serif; width: 99.75%; height: 100%">
							<table style="width: 100%; height: 100%">
								<tr class="TableHeader">
									<th style="width: 33%">Action</th>
									<th style="width: 34%">Bid</th>
									<th style="width: 33%">Remainder</th>
								</tr>
								<?php
								$trades = $user->getTicketTrades(10, ((int)$page-1)*10);

								foreach ($trades as $trade):
								?>
								<tr class="TableRow">
									<td><a href="#">Cancel</a></td>
									<td><?=$trade->given()?> Tx @ <?=$trade->rate()?>:1</td>
									<td>986</td>
								</tr>
								<?php endforeach; ?>
							</table>
							<div style="margin-top:5px; color:#dcdcdc;">First Previous <span style="color: black;">1</span> Next Last</div>
						</div>
					</div>
				</div>
				<div id="ctl00_cphRoblox_DashboardTradeHistory">
					<div class="AccordionHeader" onclick="ShowDashboardElement(3)" style="text-align: center;">My Trade History</div>
					<div class="DashboardContent" id="ctl00_cphRoblox_DashboardElement3" style="display: block;">
						<div class="CurrencyBids" style="border: 1px solid #000; text-align:center; font-family: Verdana, Sans-Serif; width: 99.75%; height: 100%">
							<table style="width: 100%; height: 100%">
								<tr class="TableHeader">
									<th style="width: 30%">Trade</th>
									<th style="width: 20%">Rate</th>
									<th style="width: 50%">Date</th>
								</tr>
								<?php
								$trades = $user->getTrades(10, ((int)$page-1)*10);

								foreach ($trades as $trade):
								?>
								<tr class="TableRow">
									<td><?=number_format($trade->given()) . " " . $trade->shortCurrency() . " for " . number_format($trade->asked()) . " " . $trade->askedCurrency()?></td>
									<td><?=$trade->rate()?></td>
									<td><?=$trade->getDate()?></td>
								</tr>
								<?php endforeach; ?>
							</table>

							<?php
							if ($tradeCount < 11):
							?>
							<div style="margin-top:5px; color:#dcdcdc;">First Previous <span style="color: black;"><?=(int)$page?></span> Next Last</div>
							<?php elseif ($tradeCount > 10 && (int)$page == 1 && $totalPages > 1): ?>
							<div style="margin-top:5px; color:#dcdcdc;">First Previous <span style="color: black;"><?=(int)$page?></span> <a href="javascript:__doPostBack('ctl00$Paginator', 'Page$<?=(int)$page+1?>')">Next</a> <a href="javascript:__doPostBack('ctl00$Paginator', 'Page$<?=$totalPages?>')">Last</a></div>
							<?php elseif ($tradeCount > 10 && (int)$page > 1 && $totalPages > (int)$page): ?>
							<div style="margin-top:5px; color:#dcdcdc;"><a href="javascript:__doPostBack('ctl00$Paginator', 'Page$1')">First</a> <a href="javascript:__doPostBack('ctl00$Paginator', 'Page$<?=(int)$page-1?>')">Previous</a> <span style="color: black;"><?=(int)$page?></span> <a href="javascript:__doPostBack('ctl00$Paginator', 'Page$<?=(int)$page+1?>')">Next</a> <a href="javascript:__doPostBack('ctl00$Paginator', 'Page$<?=$totalPages?>')">Last</a></div>
							<?php elseif ($tradeCount > 10 && (int)$page > 1 && $totalPages == (int)$page): ?>
								<div style="margin-top:5px; color:#dcdcdc;"><a href="javascript:__doPostBack('ctl00$Paginator', 'Page$1')">First</a> <a href="javascript:__doPostBack('ctl00$Paginator', 'Page$<?=(int)$page-1?>')">Previous</a> <span style="color: black;"><?=(int)$page?></span> Next Last</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="RightColumn">
			<div id="CurrencyOffersPane">
				<div class="CurrencyOffers">
					<h4>Available ROBUX</h4>
					<div class="CurrencyOffer"> 42 @ 1:8.9047 </div>
					<div class="AlternatingCurrencyOffer"> 122 @ 1:9.3360 </div>
					<div class="CurrencyOffer"> 6,006 @ 1:9.3594 </div>
					<div class="AlternatingCurrencyOffer"> 99,908 @ 1:9.3596 </div>
					<div class="CurrencyOffer"> 16 @ 1:9.375 </div>
					<div class="AlternatingCurrencyOffer"> 92 @ 1:9.3913 </div>
					<div class="CurrencyOffer"> 561 @ 1:9.3992 </div>
					<div class="AlternatingCurrencyOffer"> 691 @ 1:9.4312 </div>
					<div class="CurrencyOffer"> 360 @ 1:9.5 </div>
					<div class="AlternatingCurrencyOffer"> 32 @ 1:9.5 </div>
					<div class="CurrencyOffer"> 2,164 @ 1:9.5536 </div>
					<div class="AlternatingCurrencyOffer"> 24 @ 1:9.5833 </div>
					<div class="CurrencyOffer"> 79 @ 1:9.6075 </div>
					<div class="AlternatingCurrencyOffer"> 4,635 @ 1:9.6129 </div>
					<div class="CurrencyOffer"> 55 @ 1:9.6545 </div>
					<div class="AlternatingCurrencyOffer"> 88 @ 1:9.6590 </div>
					<div class="CurrencyOffer"> 31 @ 1:9.6774 </div>
					<div class="AlternatingCurrencyOffer"> 28 @ 1:9.9285 </div>
					<div class="CurrencyOffer"> 15 @ 1:9.9333 </div>
					<div class="AlternatingCurrencyOffer"> 1,001 @ 1:9.9880 </div>
				</div>
			</div>
		</div>
		<div style="clear: both;"></div>
	</div>
	<div id="ctl00_cphRoblox_TradeCurrencyPopupPanel" class="modalPopup" style="display: none">
		<div id="ctl00_cphRoblox_TradeCurrencyPopupUpdatePanel"></div>
	</div>
	<input type="hidden" name="ctl00$cphRoblox$HiddenField1" id="ctl00_cphRoblox_HiddenField1">
	<input type="hidden" name="ctl00$cphRoblox$HiddenField2" id="ctl00_cphRoblox_HiddenField2">
	<input type="hidden" name="ctl00$cphRoblox$HiddenField3" id="ctl00_cphRoblox_HiddenField3">
	<script language="javascript">
		<!--
		function EstimateTrade() {
			if (document.getElementById('ctl00_cphRoblox_MarketOrderRadioButton').checked) {
				var amountToTrade = document.getElementById('ctl00_cphRoblox_HaveAmountTextBox').value;
				var element = document.getElementById('EstimatedTrade');
				if (amountToTrade == "") {
					element.innerHTML = "";
					return;
				}
				var wantBox = document.getElementById('ctl00_cphRoblox_WantAmountTextBox');
				var onBux = function(result, context) {
					element.innerHTML = 'Estimated Trade: ' + result + ' R$';
					wantBox.value = -1;
				};
				var onTix = function(result, context) {
					element.innerHTML = 'Estimated Trade: ' + result + ' Tx';
					wantBox.value = -1;
				};
				var onError = function(result, context) {
					element.innerHTML = 'Unable to estimate at this time.';
					wantBox.value = -1;
				};
				var isBux = document.getElementById('ctl00_cphRoblox_HaveCurrencyDropDownList').selectedIndex == 0;
				if (isBux) EconomyServices.GetEstimatedTradeReturnForTickets(amountToTrade, onBux, onError, this);
				else EconomyServices.GetEstimatedTradeReturnForRobux(amountToTrade, onTix, onError, this);
			}
		}
		// 
		-->
	</script>
</div>