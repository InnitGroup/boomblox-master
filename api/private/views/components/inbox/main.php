<div id="Body">
    <div id="InboxContainer">
        <h2>Inbox</h2>
        <div id="InboxPane">
            <table cellspacing="0" style="border:1px solid black;table-layout:fixed;">
                <tbody>
                    <tr class="InboxHeader">
                        <th style="padding-top:4px;padding-bottom:4px;padding-right:8px;"><input id="ctl00$robloxCph$SelectableMessage" name="ctl00$robloxCph$SelectAllMessages" type="checkbox" onclick="selectAll(this)"></th>
                        <th style="width:355px;text-align:left;"><a>Subject</a></th>
                        <th style="width:185px;text-align:left;"><span>From</span></th>
                        <th style="width:185px;text-align:left;"><a>Date</a></th>
                    </tr>
                
                    <?php
                    foreach ($messages as $message) {
                        PageBuilder::addComponent("inbox", "message", compact("message"));
                    }
                    ?>

                    <!--<tr class="InboxPager">
                        <th colspan="4" style="padding-top:5px;padding-bottom:5px;">1 <span style="color:white">2 3 4 5 6 7 8 9 10 ... >></span></th>
                    </tr>-->
                    <?php
                    global $user;
                    $page = 1;
                    $pages = ceil($user->getMessageCount(0)/20);

                    if (isset($_POST['__EVENTTARGET']) && isset($_POST['__EVENTARGUMENT'])) {
                        if ($_POST['__EVENTTARGET'] == 'ctl00$robloxCph$Pagination') {
                            $page = $_POST['__EVENTARGUMENT'];
                            $exploded = explode('$', $page);
                            if (isset($exploded[1])) {
                                $page = $exploded[1];
                            }
                        }
                    }
                    
                    $paginator = new InboxPaginator('ctl00$robloxCph$Pagination', $page, $pages, "");
                    echo $paginator->load();
                    ?>
                </tbody>
            </table>
            <div class="Buttons">
                <a href="javascript:__doPostBack('ctl00$robloxCph$Delete','')" class="Button">Delete</a>
                <a href="javascript:__doPostBack('ctl00$robloxCph$Cancel','')" class="Button">Cancel</a>
            </div>
        </div>
    </div>
</div>
<div style="clear:both"></div>