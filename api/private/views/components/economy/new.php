<div id="MainPanel">
    <?php
    global $user;
    $error = '';
    $success = false;

    if (Server::isPost() && $user->hasPerms(5)) {
        
        if (!isset($_POST['ctl$cphRoblox$itemName'])) {
            $error = 'Must set an item name.';
        }

        $description = "";
        if (!isset($_POST['ctl$cphRoblox$itemDescription'])) {
            $description = " ";
        } else {
            $description = $_POST['ctl$cphRoblox$itemDescription'];
        }

        if (!isset($_POST['ctl$cphRoblox$catalogType'])) {
            $error = 'Must set a type.';
        }

        global $db;

        $stmt = "SELECT itemName FROM itemqueue WHERE itemName=:itemName";
        $result = $db->execute($stmt, [":itemName" => $_POST['ctl$cphRoblox$itemName']]);

        if ($result->rowCount() > 0) {
            $error = $_POST['ctl$cphRoblox$catalogType'] . ' already exists with the same name.';
        }

        $file = $_FILES['ctl$cphRoblox$itemXML'];
        if ($file['size'] > 100000) {
            $error = 'File size is too large, must be <100KB';
        }

        if (empty($error)) {
            
            if ($_POST['ctl$cphRoblox$catalogType'] == '4') {
                if ($user->hasPerms(7)) {
                    $stmt = "INSERT INTO items (itemType, catalogType, creatorId, creatorName, itemName, itemDescription) VALUES ('catalog', 'Mesh', 1, 'Boomblox', :itemName, :itemDescription)";
                    $db->execute($stmt, [
                        ":itemName" => Helper::debugString($_POST['ctl$cphRoblox$itemName']),
                        ":itemDescription" => Helper::debugString($description)
                    ]);
                    
                    $meshId = $db->lastInsertId("items");
                    move_uploaded_file($file["tmp_name"], $_SERVER["DOCUMENT_ROOT"]."/content/$meshId");
                }
            } else {
                $tmpName = md5(rand(0,999999999999999));
                move_uploaded_file($file["tmp_name"], $_SERVER["DOCUMENT_ROOT"]."/content/temp/$tmpName");
                $stmt = "INSERT INTO itemqueue (itemName, itemDescription, catalogType, tempName, uploaderId) VALUES (:itemName, :itemDescription, :catalogType, :tempName, :uploaderId)";
                $db->execute($stmt, [
                    ":itemName" => Helper::debugString($_POST['ctl$cphRoblox$itemName']),
                    ":itemDescription" =>Helper::debugString($_POST['ctl$cphRoblox$itemDescription']),
                    ":catalogType" => $_POST['ctl$cphRoblox$catalogType'],
                    ":tempName" => $_SERVER["DOCUMENT_ROOT"]."/content/temp/$tmpName",
                    ":uploaderId" => $user->getUserId()
                ]);
            }   
            
            $success = true;
        }        
    }

    ?>
    <h1>New Product</h1>
    <p>Utilize this panel to create new products for the catalog</p>
    <p>When creating an item:</p>
    <ul>
        <li>You can make the texture a decal, just make the texture to be http://xoblog.dev/asset/?id={DECAL_ID_HERE}</li>
        <li>For meshes, you should try to utilize the asset redirect system as well, especially for retextures, you can just use Roblox meshes</li>
        <li>Please consider accuracy and tone, brainrot, slop, or any sort of NSFW is <u>strictly</u> prohibited</li>
    </ul>
    <hr>
    <div style="margin:5px;">
        <label>Name:</label>
        <input name="ctl$cphRoblox$itemName" type="text" required>
    </div>
    <div style="margin:5px;">
        <label>Description:</label>
        <input name="ctl$cphRoblox$itemDescription" type="text">
    </div>
    <div style="margin:5px;">
        <label>Type:</label>
        <select name="ctl$cphRoblox$catalogType" required>
            <option value="8">Hat</option>
            <option value="17">Head</option>
            <option value="4">Mesh</option>
        </select>
    </div>
    <div style="margin:5px;">
        <label>XML:</label>
        <input name="ctl$cphRoblox$itemXML" type="file" required>
    </div>
    <hr>
    <div style="margin:5px;">
        <label>Upload to queue:</label>
        <input name="ctl$cphRoblox$itemXML" value="Confirm" type="submit"><br>

        <?php if (Server::isPost() && !empty($error)): ?>
        <b style="color:red">Error: <?=$error?></b>
        <?php endif; ?>

        <?php if ($success): ?>
        <b style="color:green">Item uploaded to queue</b> 
        <?php endif; ?>
    </div>
</div>