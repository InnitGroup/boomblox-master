<?php
$dailies = Economy::countDailies(Economy::getDailies("a"));
?>

<div id="Earnings">
			<h3>Earnings</h3>
			<div>
                <div class="Label"></div>
				<div class="Field"><img src="../images/<?=Site::getThemeProperty("currencyIcon",$theme)?>.png" alt="<?=Site::getThemeProperty("currency",$theme)?>" style="border-width:0px;" /></div>
				<div class="Field"><img src="../images/Tickets.png" alt="Tickets" style="border-width:0px;" /></div>
			</div>
			<div class="Earnings_Period">
				<h4>Past Day</h4>
				<div class="Earnings_LoginAward">
					<div class="Label">Login Award</div>
					<div class="Field"><?=Economy::countDailies(Economy::getDailies("d"))["bux"]?></div>
					<div class="Field"><?=Economy::countDailies(Economy::getDailies("d"))["tix"]?></div>
				</div>
				<div class="Earnings_PlaceTrafficAward">
					<div class="Label">Place Traffic Award</div>
					<div class="Field"><?=Economy::countPlaceIncome("d")["bux"]?></div>
					<div class="Field"><?=Economy::countPlaceIncome("d")["tix"]?></div>
				</div>
				<div id="ctl00_cphRoblox_Earnings_PastDay_SaleOfGoods" class="Earnings_SaleOfGoods">
					<div class="Label">Sale of Goods</div>
					<div class="Field"><?=Economy::countSalesIncome("d")["bux"]?></div>
					<div class="Field"><?=Economy::countSalesIncome("a")["tix"]?></div>
				</div>
				<div class="Earnings_PeriodTotal">
					<div class="Label">Total:</div>
					<div class="Field"><?=Economy::countTotal("d")["bux"]?></div>
					<div class="Field"><?=Economy::countTotal("d")["tix"]?></div>
				</div>
			</div>
			<div class="Earnings_Period">
				<br>
                <h4>Past Week</h4>
				<div class="Earnings_LoginAward">
					<div class="Label">Login Award</div>
					<div class="Field"><?=Economy::countDailies(Economy::getDailies("w"))["bux"]?></div>
					<div class="Field"><?=Economy::countDailies(Economy::getDailies("w"))["tix"]?></div>
				</div>
				<div id="ctl00_cphRoblox_Earnings_PastWeek_PlaceTrafficAward" class="Earnings_PlaceTrafficAward">
					<div class="Label">Place Traffic Award</div>
					<div class="Field"><?=Economy::countPlaceIncome("w")["bux"]?></div>
					<div class="Field"><?=Economy::countPlaceIncome("w")["tix"]?></div>
				</div>
				<div id="ctl00_cphRoblox_Earnings_PastWeek_SaleOfGoods" class="Earnings_SaleOfGoods">
					<div class="Label">Sale of Goods</div>
					<div class="Field"><?=Economy::countSalesIncome("w")["bux"]?></div>
					<div class="Field"><?=Economy::countSalesIncome("w")["tix"]?></div>
				</div>
				<div class="Earnings_PeriodTotal">
					<div class="Label">Total:</div>
					<div class="Field"><?=Economy::countTotal("w")["bux"]?></div>
					<div class="Field"><?=Economy::countTotal("w")["tix"]?></div>
				</div>
			</div>
			<div class="Earnings_Period">
                <br>
				<h4>Past Month</h4>
				<div class="Earnings_LoginAward">
					<div class="Label">Login Award</div>
					<div class="Field"><?=Economy::countDailies(Economy::getDailies("m"))["bux"]?></div>
					<div class="Field"><?=Economy::countDailies(Economy::getDailies("m"))["tix"]?></div>
				</div>
				<div id="ctl00_cphRoblox_Earnings_PastMonth_PlaceTrafficAward" class="Earnings_PlaceTrafficAward">
					<div class="Label">Place Traffic Award</div>
					<div class="Field"><?=Economy::countPlaceIncome("m")["bux"]?></div>
					<div class="Field"><?=Economy::countPlaceIncome("m")["tix"]?></div>
				</div>
				<div id="ctl00_cphRoblox_Earnings_PastMonth_SaleOfGoods" class="Earnings_SaleOfGoods">
					<div class="Label">Sale of Goods</div>
					<div class="Field"><?=Economy::countSalesIncome("m")["bux"]?></div>
					<div class="Field"><?=Economy::countSalesIncome("m")["tix"]?></div>
				</div>
				<div class="Earnings_PeriodTotal">
					<div class="Label">Total:</div>
					<div class="Field"><?=Economy::countTotal("m")["bux"]?></div>
					<div class="Field"><?=Economy::countTotal("m")["tix"]?></div>
				</div>
			</div>
			<div class="Earnings_Period">
				<h4>All Time</h4>
				<div class="Earnings_LoginAward">
					<div class="Label">Login Award</div>
					<div class="Field"><?=Economy::countDailies(Economy::getDailies("a"))["bux"]?></div>
					<div class="Field"><?=Economy::countDailies(Economy::getDailies("a"))["tix"]?></div>
				</div>
				<div id="ctl00_cphRoblox_Earnings_AllTime_PlaceTrafficAward" class="Earnings_PlaceTrafficAward">
					<div class="Label">Place Traffic Award</div>
					<div class="Field"><?=Economy::countPlaceIncome("a")["bux"]?></div>
					<div class="Field"><?=Economy::countPlaceIncome("a")["tix"]?></div>
				</div>
				<div id="ctl00_cphRoblox_Earnings_AllTime_SaleOfGoods" class="Earnings_SaleOfGoods">
					<div class="Label">Sale of Goods</div>
					<div class="Field"><?=Economy::countSalesIncome("a")["bux"]?></div>
					<div class="Field"><?=Economy::countSalesIncome("a")["tix"]?></div>
				</div>
				<div class="Earnings_PeriodTotal">
					<div class="Label">Total:</div>
					<div class="Field"><?=Economy::countTotal("a")["bux"]?></div>
					<div class="Field"><?=Economy::countTotal("a")["tix"]?></div>
				</div>
                <div style="clear:both;"></div>
			</div>
		</div>
    </div>
</div>