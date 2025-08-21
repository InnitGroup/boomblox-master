<div style="margin:10px;width:703px;">
    <div class="ajax__tab_xp ajax__tab_container ajax__tab_default">
        <div class="ajax__tab_header" style="height: 21px;">
            <span class="ajax__tab ajax__tab_active" style="display: inline-block;">
                <span class="ajax__tab_outer">
                    <span class="ajax__tab_inner">
                        <span class="ajax__tab_tab" id="__tab_ctl00_SampleContent_Tabs_Panel1">
                            <h3 id="cmtTab">Commentary</h3>
                        </span>
                    </span>
                </span>
            </span>
        </div>
        <div class="ajax__tab_body" id="TabbedInfo_CommentaryTab">
            <div class="ajax__tab_panel">
                <?php
                $itemId = $data->itemId;
                PageBuilder::addComponent("commentary", "main", compact("data", "commentData", "commentCount"))
                ?>
            </div>
        </div>
    </div>
</div>