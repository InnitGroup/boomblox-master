            <body style="height: 100%">
                <form name="aspnetForm" method="post" id="aspnetForm" enctype="multipart/form-data">
                    <input type="hidden" name="__EVENTARGUMENT">
                    <input type="hidden" name="__EVENTTARGET">
                    <input type="hidden" name="__VIEWSTATE" value="<?=Viewstate::generateViewState()?>">
                    <script src="/ScriptResource.axd?d=HXgoHdDgvXS1Bm1BtuI8XHJX8FVI8cYZ2X_EuVPYghNhT6sQZsT7p4eJkks-IyPzsTfEjdo0cSkJ_kKtErHToqXcMfwNb167RS6Rc-geSg01&amp;t=ffffffffc3de0fd2" type="text/javascript"></script>
                    <script src="/ScriptResource.axd?d=T8SwZoIUcVlsmSB3yf6PNkJVVZ2PQ8p--nTz9Md1n430dEThDozDu7H5NeZtmf99ccrJG0GKWb1_zl1-aFWrdQ2&amp;t=ffffffffdc59dab0" type="text/javascript"></script>
                    <script src="/ScriptResource.axd?d=T8SwZoIUcVlsmSB3yf6PNkJVVZ2PQ8p--nTz9Md1n40v2w0uBCzndMto9vxZou6m4w_U49xgLNs9RS_s7TJ_lA2&amp;t=ffffffffdc59dab0" type="text/javascript"></script>
                    <script src="/ScriptResource.axd?d=T8SwZoIUcVlsmSB3yf6PNkJVVZ2PQ8p--nTz9Md1n43IwD_RQ8ORhh2lPaIDGFKv_YxwkAHdk6tVsXR4iYNmPA2&amp;t=ffffffffdc59dab0" type="text/javascript"></script>
                    <script src="/ScriptResource.axd?d=T8SwZoIUcVlsmSB3yf6PNkJVVZ2PQ8p--nTz9Md1n40x7MTdGEOGm_Be98QFYSZo-vmTOH4NGb0sw0H3Qg_fqnCfG9peYRnszi5mSLMftvU1&amp;t=ffffffffdc59dab0" type="text/javascript"></script>
                    <script src="/ScriptResource.axd?d=T8SwZoIUcVlsmSB3yf6PNkJVVZ2PQ8p--nTz9Md1n40vUu_w1u9OOIOZJE3wjrLJDNL_pm_VD4LUs5jqXv6aG9si1Lba0aH16MH6sEW-UNF1kzHjqzE85vRPEmkpLXdJ0&amp;t=ffffffffdc59dab0" type="text/javascript"></script>
                    <script src="/ScriptResource.axd?d=ZGF0YQ=="></script>

                    <div id="LeftContainer">
                        <div>
                            <a id="ctl00_HyperLink1" href="/">
                                <img id="LogoSmall" src="/Admi/<?=Site::getThemeProperty("logo", $theme)?>" alt="Roblox" border="0" />
                            </a>
                        </div>
                        <div style="padding: 1em">
                            <div id="TextContent">
                                <label id="AbuseReports" style="font-weight: bold"> <?=Admin::getReportsToReview(true)?></label> <a id="ctl00_Dashboard1_HyperLink1" href="/Admi/Moderation/AbuseReports.aspx">abuse reports</a>, <label id="UnmoderatedImages" style="font-weight: bold"> <?=Admin::getImagesToReview(true)?></label> <a id="ctl00_Dashboard1_HyperLink6" href="/Admi/Moderation/AssetReview.aspx">images</a>, <label id="UnmoderatedPlayers" style="font-weight: bold"> <?=Admin::getUsersToReview(true)?></label> <a id="ctl00_Dashboard1_HyperLink10" href="/Admi/Users/Find.aspx">users</a>
                            </div>
                        </div>
                        <div style="padding: 1em">
                            <a href="#ctl00_TreeView1_SkipLink">
                                <img alt="Skip Navigation Links." src="/WebResource.axd?d=VD_Slylu6hlyEOuc5rdjWw2&amp;t=633527605112930887" width="0" height="0" border="0" />
                            </a>
                            <div id="ctl00_TreeView1" class="TreeView">
                                <table cellpadding="0" cellspacing="0" style="text-align:left;">
                                    <?php
                                    $options = Admin::getLinkTreeOptions();
                                    foreach ($options as $optionKey => $option) {
                                        $packed = compact("optionKey", "option");
                                        PageBuilder::addComponent("admin", "linktreeoption", $packed);
                                    }
                                    ?>
                                </table>
                            </div>
                            <a id="ctl00_TreeView1_SkipLink"></a>
                        </div>
                    </div>