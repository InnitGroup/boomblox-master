<?php
global $db;
$page = isset($_POST["PageTracker"]) ? $_POST["PageTracker"] : 1;

$stmt = "SELECT COUNT(*) AS count FROM groups";
$result = $db->execute($stmt);
$fetched = $result->fetch(PDO::FETCH_ASSOC);
$pages = (int)($fetched["count"] / 10);

$_POST['ctl00$ctl00$cphRoblox$cphMyRobloxContent$SearchFiltersDropdown'] = isset($_POST['ctl00$ctl00$cphRoblox$cphMyRobloxContent$SearchFiltersDropdown']) ? $_POST['ctl00$ctl00$cphRoblox$cphMyRobloxContent$SearchFiltersDropdown'] : "All";

if (isset($_POST['__EVENTTARGET'])) {
    if ($_POST['__EVENTTARGET'] == 'ctl00$ctl00$cphRoblox$cphMyRobloxContent$Pager1$LinkButtonNext') {
        $page += 1;
    }

    if ($_POST['__EVENTTARGET'] == 'ctl00$ctl00$cphRoblox$cphMyRobloxContent$Pager1$LinkButtonPrevious') {
        $page -= 1;
    }
}
?>

<div class="MyRobloxContainer">
	<script type="text/javascript">
		var SearchKeywordText = 'ctl00_ctl00_cphRoblox_cphMyRobloxContent_SearchKeyword';
		var SearchKeyword2Text = 'ctl00_ctl00_cphRoblox_cphMyRobloxContent_SearchKeyword2';
	</script>
	<div id="LeftColumn" class="StandardBox" style="height: 600px; width: 160px; float: left">
		<div style="overflow: hidden;">
			<iframe id="ctl00_ctl00_cphRoblox_cphMyRobloxContent_ForumsSkyscraper_AsyncAdIFrame" allowtransparency="true" frameborder="0" scrolling="no" height="600" src="/Ads/IFrameAdContent.aspx?slot=Roblox_Default_Right_160x600" width="160" data-ruffle-polyfilled=""></iframe>
			<a id="ctl00_ctl00_cphRoblox_cphMyRobloxContent_ForumsSkyscraper_ReportAdButton" title="click to give feedback on an ad" class="BadAdButton" href="javascript:__doPostBack('ctl00$ctl00$cphRoblox$cphMyRobloxContent$ForumsSkyscraper$ReportAdButton','')">[ feedback ]</a>
		</div>
	</div>
	<div id="RightColumn" class="StandardBox" style="width: 680px; float: right">
		<div id="SearchControls" style="margin-bottom: 10px;">
			<div style="float: left;">
				<input type="text" style="VISIBILITY: hidden;POSITION: absolute">
				<!-- Enter key submission hack - IE -->
				<input name="ctl00$ctl00$cphRoblox$cphMyRobloxContent$SearchKeyword" type="text" id="ctl00_ctl00_cphRoblox_cphMyRobloxContent_SearchKeyword" maxlength="100" value="<?=isset($_POST['ctl00$ctl00$cphRoblox$cphMyRobloxContent$SearchKeyword']) ? htmlspecialchars($_POST['ctl00$ctl00$cphRoblox$cphMyRobloxContent$SearchKeyword']) : htmlspecialchars($_POST['ctl00$ctl00$cphRoblox$cphMyRobloxContent$SearchKeyword2'])?>">
				<input type="submit" name="ctl00$ctl00$cphRoblox$cphMyRobloxContent$SearchButton" value="Search" id="ctl00_ctl00_cphRoblox_cphMyRobloxContent_SearchButton">
			</div>
			<div class="SearchSorts" style="float: left">
				<!-- Sort: <select name="ctl00$ctl00$cphRoblox$cphMyRobloxContent$SearchSortsDropdown" id="ctl00_ctl00_cphRoblox_cphMyRobloxContent_SearchSortsDropdown"><option value="Member Count">Member Count</option></select> --> &nbsp;&nbsp;&nbsp;Filter: <select name="ctl00$ctl00$cphRoblox$cphMyRobloxContent$SearchFiltersDropdown" id="ctl00_ctl00_cphRoblox_cphMyRobloxContent_SearchFiltersDropdown">
					<option <?=$_POST['ctl00$ctl00$cphRoblox$cphMyRobloxContent$SearchFiltersDropdown'] == 'All' ? "selected" : ""?> value="All">All</option>
					<option <?=$_POST['ctl00$ctl00$cphRoblox$cphMyRobloxContent$SearchFiltersDropdown'] == 'Private' ? "selected" : ""?> value="Private">Private</option>
					<option <?=$_POST['ctl00$ctl00$cphRoblox$cphMyRobloxContent$SearchFiltersDropdown'] == 'Public' ? "selected" : ""?> value="Public">Public</option>
				</select>
			</div>
		</div>
		<div id="SearchResults" style="clear: both">
			<table id="GroupSearchResults" class="Repeater">
				<thead>
					<tr>
						<td style="width: 50px"></td>
						<td style="text-align: center; width: 150px">Name</td>
						<td style="text-align: center">Description</td>
						<td style="text-align: center; width: 75px">Members</td>
						<td style="text-align: center; width: 50px">Public</td>
					</tr>
				</thead>
				<tbody>
                    <?php 
                    $stmt = "SELECT * FROM groups ";
                    $q = isset($_POST['ctl00$ctl00$cphRoblox$cphMyRobloxContent$SearchKeyword2']) ? $_POST['ctl00$ctl00$cphRoblox$cphMyRobloxContent$SearchKeyword2'] : $_POST['ctl00$ctl00$cphRoblox$cphMyRobloxContent$SearchKeyword'];
                    $stmt .= "WHERE `name` LIKE :q ";

                    if (isset($_POST['ctl00$ctl00$cphRoblox$cphMyRobloxContent$SearchFiltersDropdown'])) {
                        $privacyFilter = $_POST['ctl00$ctl00$cphRoblox$cphMyRobloxContent$SearchFiltersDropdown'];
                        if ($privacyFilter !== 'All') {
                            $privacy = 1;

                            if ($privacyFilter == 'Private') {
                                $privacy = 2;
                            }

                            $stmt .= " AND privacy = $privacy ";
                        }
                    }

                    $offset = ((int)$page - 1) * 10;
                    $stmt .= "LIMIT 10 OFFSET $offset";
                    $result = $db->execute($stmt, [
                        ":q" => "%" . $q . "%"
                    ]);

                    if ($result->rowCount() > 0): 
                    $count = 0;

                    while ($fetchedIndex = $result->fetch(PDO::FETCH_ASSOC)):
                    $group = new Group($fetchedIndex["id"]);
                    $count += 1;
                    ?>
					<tr class="AlternatingItemTemplate<?=$count % 2 == 0 ? "Even" : "Odd"?>">
						<td id="emblem" class="GroupEmblemImg" style="background-color: White; width:50px">
							<a id="ctl00_ctl00_cphRoblox_cphMyRobloxContent_SearchResultsListView_ctrl0_ctl00_GroupEmblemImage" title="<?=htmlspecialchars(Helper::debugString($group->name()))?>" href="/Groups/group.aspx?gid=<?=$group->id()?>" style="display:inline-block;cursor:pointer;">
								<img src="https://t3.<?=url?>/<?=$group->emblemId()?>.png" style="width:48px" border="0" onerror="return Roblox.Controls.Image.OnError(this)" alt="<?=htmlspecialchars(Helper::debugString($group->name()))?>" blankurl="http://t6bg.<?=url?>/blank-48x48.gif">
							</a>
						</td>
						<td id="Name">
							<div style="overflow: hidden; width: 100px">
								<div id="ctl00_ctl00_cphRoblox_cphMyRobloxContent_SearchResultsListView_ctrl0_ctl00_Panel1" title="<?=htmlspecialchars(Helper::debugString($group->name()))?>">
									<a href="group.aspx?gid=<?=$group->id()?>"><?=htmlspecialchars(Helper::debugString($group->name()))?></a>
								</div>
							</div>
						</td>
						<td id="Description" width="50">
							<div style="overflow: hidden;"><span style="word-break:break-all" id="ctl00_ctl00_cphroblox_cphmyrobloxcontent_searchresultslistview_ctrl0_ctl00_label1" title="<?=htmlspecialchars(Helper::debugString($group->description()))?> "><?=mb_strimwidth(htmlspecialchars(Helper::debugString($group->description())), 0, 200)?></div>
						</td>
						<td id="NumUsers" style="text-align: center"><?=count($group->members())?></td>
						<td id="PublicEntry" style="text-align: center"><?=$group->privacy() == 1 ? "Yes" : "No"?></td>
					</tr>
                    <?php endwhile; ?>

                    <?php endif; ?>
				</tbody>
			</table>
			<hr style="clear: both">
            
            <input type="hidden" name="PageTracker" value="<?=$page?>">
            
			<div id="ctl00_ctl00_cphRoblox_cphMyRobloxContent_Pager1_PanelPages" align="center">
                <?php if ($page > 1): ?> <a id="ctl00_ctl00_cphRoblox_cphMyRobloxContent_Pager1_LinkButtonPrevious" href="javascript:__doPostBack('ctl00$ctl00$cphRoblox$cphMyRobloxContent$Pager1$LinkButtonPrevious','')">&lt;&lt; Previous</a><?php endif; ?>
                 Pages:
                <?php if ($page !== $pages && $page < $pages): ?><a id="ctl00_ctl00_cphRoblox_cphMyRobloxContent_Pager1_LinkButtonNext" href="javascript:__doPostBack('ctl00$ctl00$cphRoblox$cphMyRobloxContent$Pager1$LinkButtonNext','')">Next &gt;&gt;</a><?php endif; ?>
            </div>
        </div>
	</div>
</div>