<div id="PlaceReset">
    <fieldset title="Version">
        <legend>Version History</legend>
        <div class="Suggestion"> Click one of the buttons below to revert to a previous version of this item. </div>
        <style>
            #VersionHistoryTable {
                padding: 20px 20px 0px 20px;
                text-align: center;
            }
        </style>
        <table id="VersionHistoryTable">
            <tr>
                <th width="40%"></th>
                <th width="10%">Version</th>
                <th width="50%">Created</th>
            </tr>
            <?php
            $versionCount = count(Version::getVersions($_GET["ID"]));
            $page = 1;
            $pages = ceil($versionCount / 10);

            if (isset($_POST["__EVENTTARGET"]) && isset($_POST["__EVENTTARGET"])) {
                if ($_POST["__EVENTTARGET"] == 'ctl00$cphRoblox$Paginator' && str_contains($_POST["__EVENTARGUMENT"], "Page$")) {
                    $pageSet = explode("$", $_POST["__EVENTARGUMENT"]);
                    $attemptedPage = $pageSet[1];
                    if ($attemptedPage <= $pages*10) {
                        $page = $attemptedPage;
                    }
                }
            }
            
            $offset = ($page - 1) * 10;

            $versions = Version::getVersions($_GET["ID"], 10, $offset);
            foreach ($versions as $version): ?>
            <tr>
                <td>
                    <?php if (Version::getVersion($_GET["ID"]) == $version["versionId"]): ?>
                    <a disabled>[ Current ]</a></td>
                    <?php else: ?>
                    <a href="javascript:__doPostBack('ctl00$cphRoblox$MakeCurrent', '<?=(int)$version["versionId"]?>')">[ Make Current ]</a></td>
                    <?php endif; ?>
                <td><?=(int)$version["versionId"]?></td>
                <td><?=Version::formatDate($version["created_at"])?></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <p style="text-align: center;">
            <?php 
            $paginator = new CharacterPaginator('ctl00$cphRoblox$Paginator', $page, $pages);
            $paginator = str_replace("color:#dcdcdc;", "", $paginator->load());
            echo $paginator;
            ?>
            <!--
            <span>First</span>
            <span>Previous</span>
            <span>1</span>
            <a href="#">2</a>
            <a href="#">Next</a>
            <a href="#">Last</a>
            -->
        </p>
    </fieldset>
</div>