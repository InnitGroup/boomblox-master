<div style="margin: 10px; width: 703px; border: solid 1px black; background-color: White;">
	<div style="padding: 5px;">
		<div id="AssetRecommender" style="border: solid 1px grey; background-color: White;">
			<h3>Recommendations</h3>
			<div style="font-size: x-small;">Here are some other <?=$baseItem->get()->itemType == "catalog" ? Helper::makePlural($baseItem->get()->catalogType) : "free games"?> that we think you might like.</div>
			<table id="ctl00_cphRoblox_AssetRec_dlAssets" cellspacing="0" align="Center" border="0" height="200" width="600">
				<tbody>
					<tr>
                        <?php foreach ($recommendations as $recommendation): 
                            $recommended = $recommendation->get(); 
                            $asset = new Asset($recommended->itemId); 
                            $render = $asset->GetThumbnail(420, 230, "PNG"); 
                            if ($baseItem->get()->itemType == "catalog") {
                                $render = $asset->GetThumbnail(250, 250, "PNG"); 
                            }
                            ?>
						<td>
							<div id="ctl00_cphRoblox_AssetRec_dlAssets_ctl00_PortraitDiv" style="<?=$baseItem->get()->itemType == "catalog" ? "width: 140px; height: 170px;" : "width:162px; height:170px"?> overflow:hidden;">
								<div class="AssetThumbnail" style="padding-left: 15px;">
									<a id="ctl00_cphRoblox_AssetRec_dlAssets_ctl00_AssetThumbnailHyperLink" title="<?=htmlspecialchars($recommended->itemName)?>" href="/Item.aspx?ID=<?=$recommended->itemId?>" style="display:inline-block;cursor:pointer;">
										<img src="<?=$render?>" style="<?=$baseItem->get()->itemType == "catalog" ? "width:110px; height:110px" : "width:160px; height:100px"?>" border="0" onerror="return Roblox.Controls.Image.OnError(this)" alt="<?=htmlspecialchars($recommended->itemName)?>" blankurl="http://t6-cf.<?=domain?>/blank-110x110.gif">
									</a>
								</div>
								<div class="AssetDetails">
									<div class="AssetName">
										<a id="ctl00_cphRoblox_AssetRec_dlAssets_ctl00_AssetNameHyperLinkPortrait" href="Item.aspx?ID=<?=$recommended->itemId?>"><?=htmlspecialchars($recommended->itemName)?></a>
									</div>
									<div class="AssetCreator">
										<span class="Label">Creator:</span>
										<span class="Detail">
											<a id="ctl00_cphRoblox_AssetRec_dlAssets_ctl00_CreatorHyperLinkPortrait" href="/User.aspx?ID=<?=$recommended->creatorId?>"><?=htmlspecialchars($recommended->creatorName)?></a>
										</span>
									</div>
								</div>
							</div>
						</td>
                        <?php endforeach; ?>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>