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
            $versions = Version::getVersions($_GET["ID"]);
            foreach ($versions as $version): ?>
            <tr>
                <td><a href="javascript:__doPostBack('ctl00$cphRoblox$MakeCurrent', '<?=(int)$version["versionId"]?>')">[ Make Current ]</a></td>
                <td><?=(int)$version["versionId"]?></td>
                <td><?=Version::formatDate($version["created_at"])?></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <p style="text-align: center;">
            <span>First</span>
            <span>Previous</span>
            <span>1</span>
            <a href="#">2</a>
            <a href="#">Next</a>
            <a href="#">Last</a>
        </p>
    </fieldset>
</div>