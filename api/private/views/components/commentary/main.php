<?php
$comments = (int)$commentCount;
$pages = $comments > 0 ? ceil($comments/10) : 1;
$page = isset($page) ? $page : 1;
$itemId = $_GET["ID"] ?? $data->itemId;
if (isset($_POST['__EVENTTARGET'])) {
    if ($_POST['__EVENTTARGET'] == 'ctl00$cphRoblox$rbxTabbedInfoCommentaryTab$PageSelector_Previous' || $_POST['__EVENTTARGET'] == 'ctl00$cphRoblox$rbxTabbedInfoCommentaryTab$PageSelector_Next') {
        $page = $_POST['__EVENTARGUMENT'];
    }
}
?>
<div id="ctl00_cphRoblox_rbxCommentsContainer"  class="CommentsContainer">
    <?php if ($comments > 0): ?>
    <h3>Comments (<?=$comments?>)</h3>
    <div class="HeaderPager">
        <?php if ($page > 1): ?>
        <a href="javascript:__doWebPostBack('/api/public/views/Commentary.php?ID=<?=$itemId?>', 'ctl00_cphRoblox_rbxCommentsContainer', {'page': <?=$page?>, 'action': 'previous', 'id': <?=$itemId?>})"><span class="NavigationIndicators">&lt;&lt;</span> Previous</a>
        <?php endif; ?>

        <span>Page <?=$page?> of <?=$pages?></span>
        
        <?php if ($pages > 1 && $page < $pages): ?>
        <a href="javascript:__doWebPostBack('/api/public/views/Commentary.php?ID=<?=$itemId?>', 'ctl00_cphRoblox_rbxCommentsContainer', {'page': <?=$page?>, 'action': 'next', 'id': <?=$itemId?>})"> Next <span class="NavigationIndicators">&gt;&gt;</span></a>
        <?php endif; ?>
        
    </div>
    <div class="Comments">
        <?php 
        if ($comments > 0) {
            global $user;
            $isAdmin = $user->isStaff();
            foreach ($commentData as $commentPosition => $comment) {
                PageBuilder::addComponent("commentary", "comment", compact("comment", "commentPosition", "isAdmin"));
            }
        } else {
            #PageBuilder::addComponent("commentary", "noComments");
        }
        ?>
    </div>
    <div class="FooterPager">
        <?php if ($page > 1): ?>
        <!--<a href="javascript:__doPostBack('ctl00$cphRoblox$rbxTabbedInfoCommentaryTab$PageSelector_Previous', '<?=$page-1?>')"><span class="NavigationIndicators">&lt;&lt;</span> Previous</a>-->
        <a href="javascript:__doWebPostBack('/api/public/views/Commentary.php?ID=<?=$itemId?>', 'ctl00_cphRoblox_rbxCommentsContainer', {'page': <?=$page?>, 'action': 'previous', 'id': <?=$itemId?>})"><span class="NavigationIndicators">&lt;&lt;</span> Previous</a>
        <?php endif; ?>

        <span>Page <?=$page?> of <?=$pages?></span>

        <?php if ($pages > 1 && $page < $pages): ?>
        <a href="javascript:__doWebPostBack('/api/public/views/Commentary.php?ID=<?=$itemId?>', 'ctl00_cphRoblox_rbxCommentsContainer', {'page': <?=$page?>, 'action': 'next', 'id': <?=$itemId?>})"> Next <span class="NavigationIndicators">&gt;&gt;</span></a>
        <?php endif; ?>
        
    </div>
    <?php endif; ?>
    <div class="PostAComment">
        <h3>Comment on <?= isset($data->catalogType) && $data->catalogType == "Pants" ? "these" : "this"; ?> <?=isset($data->catalogType) ? $data->catalogType : "Place"?></h3>
        <textarea name="content" style="overflow-y:scroll;resize:none;width:350px;height:70px;" class="MultilineTextBox"></textarea>
        <br>
        <div style="height:6px;clear:both;"></div>
        <a class="Button" href="javascript:__doPostBack('ctl00$cphRoblox$Comment','')">Post Comment</a>
    </div>
</div>