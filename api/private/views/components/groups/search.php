<div class="MyRobloxContainer" style="margin-top:18px;">
	<script type="text/javascript">
		var SearchKeywordText = 'ctl00_ctl00_cphRoblox_cphMyRobloxContent_SearchKeyword';
		var SearchKeyword2Text = 'ctl00_ctl00_cphRoblox_cphMyRobloxContent_SearchKeyword2';
	</script>
	<style>
		.GroupsSearchHeader {
			font-size: 80px;
		}
	</style>
	<div class="StandardBox" style="height: 160px; text-align: center">
		<img src="/images/GroupsSearchLogo.png">
		<div id="Div1" style="clear: both; text-align: center">
			<div style="margin-bottom: 10px;">
				<input type="text" style="VISIBILITY: hidden;POSITION: absolute">
				<!-- Enter key submission hack - IE -->
				<input name="ctl00$ctl00$cphRoblox$cphMyRobloxContent$SearchKeyword2" type="text" id="ctl00_ctl00_cphRoblox_cphMyRobloxContent_SearchKeyword2" onclick="javascript:if($get(SearchKeyword2Text).value =='Search all groups') $get(SearchKeyword2Text).value = ''; return false;" maxlength="100" value="Search all groups">
				<input type="submit" name="ctl00$ctl00$cphRoblox$cphMyRobloxContent$Button1" value="Search" onclick="javascript:if ($get(SearchKeyword2Text).value == '') return false;" id="ctl00_ctl00_cphRoblox_cphMyRobloxContent_Button1">
			</div>
			<div class="SearchSorts" style="clear: both">
				<!-- Sort: <select name="ctl00$ctl00$cphRoblox$cphMyRobloxContent$SearchSortsDropdown2" id="ctl00_ctl00_cphRoblox_cphMyRobloxContent_SearchSortsDropdown2"><option value="Member Count">Member Count</option></select> --> Filter: <select name="ctl00$ctl00$cphRoblox$cphMyRobloxContent$SearchFiltersDropdown2" id="ctl00_ctl00_cphRoblox_cphMyRobloxContent_SearchFiltersDropdown2">
					<option value="All">All</option>
					<option value="Private">Private</option>
					<option value="Public">Public</option>
				</select>
			</div>
		</div>
	</div>
</div>