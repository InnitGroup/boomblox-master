<div id="SignInPane">
    <div id="LoginViewContainer">
        <div id="LoginView">
            <h5 id="loginViewTitle">Logged in</h5>
                <div id="AlreadySignedIn"></div>
                <?php
                global $user, $theme;
                $avatar = new Avatar($user->getUserId());
                $avatar = $avatar->GetThumbnail(540,660,"PNG");
                ?>
                <a title="<?=$user->getUsername()?>" style="display:inline-block;height:190px;width:152px;cursor:pointer;" href="/User.aspx">
                    <img src="<?=$avatar?>" style="display:inline-block;height:175px;width:145px;margin-top:15px;" border="0" alt="<?=$user->getUsername()?>">
                </a>
            </div>
            <br>
            <div>
                <div class="RobloxNews">
                    <br>
                    <h3 style="color: gray;"><?=Site::getThemeProperty("alias", $theme)?> News</h3>
                    <br>
                    <div id="RobloxNews">
                    </div>
                </div>
            </div>
        </div>
    <br/>    
</div>