<?php
global $user;
?>

<div class="CharacterViewer">
    <h4>My Character</h4>
    <div style="position: relative; display: inline-block">
        <img style="position: absolute; width: 16px; top: 0; left: 0; display: none;" id="CharacterLoading" src="/images/ProgressIndicator2.gif">
        <img style="width: 354px;" id="CharacterRender" src="<?=$char->GetThumbnail(500, 500, "PNG")?>">
    </div>
    <script>
        function redraw() {
            $("#CharacterRender").attr('src', '<?=Thumbnail::getUnavail("250x250")?>');
            $("#CharacterLoading").show();
            
            setTimeout(function() {
                var avatar = __requestResponse("Thumbs/Redraw.ashx?userId=<?=$user->getUserId()?>");
                if (avatar) {
                    $("#CharacterRender").attr('src', avatar);
                }
                
                $("#CharacterLoading").hide();
            }, 1000);
        }
    </script>
    <div style="text-align:center"><span>Something wrong with your Avatar? <a href="javascript:redraw()">Click here to re-draw it!</a></span></div>
</div>