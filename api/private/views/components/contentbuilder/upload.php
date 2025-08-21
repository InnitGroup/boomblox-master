<?php
$error = isset($error) ? $error : "";
?>
            <div class="UploaderPanel">
                <h3>Upload Texture</h3>
                <br>
                <input id="filename" type="text" name="filename" disabled value="">
                <input id="files" type="file" name="texture">
                <br>
                <br>
                <input type="submit" value="Create <?=$name?>">
                <br>
                <span id="warning" class="Attention"><?=$error?></span>
                <span id="result" style="color:green;"></span>
                <br>
                <div style='padding:10px 1px 1px 1px'></div>
                <script>
                    $("#files").change(function() {
                        filename = this.files[0].name;
                        $("#filename").attr("value", filename);
                    }); // i suck at jquery gotta learn that later :thumbs_up: 👍
                </script>
            </div>
        </div>
    </form>
</div>