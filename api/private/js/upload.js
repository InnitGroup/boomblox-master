function WebForm_DoPostBackWithOptions() {
    document.getElementById("Uploading").style.visibility = "visible";
    window.external.ExecScript('game:Save(game:GetService("Visit"):GetUploadUrl())');
    window.external.close();
}

function publish() {
    document.getElementById("Uploading").style.display = 'block';
    try {
        window.external.ExecScript('visit=game:GetService("Visit") game:Save(visit:GetUploadUrl())');
        //args.IsValid = true;
        document.getElementById("DialogResult").value = '1';
        window.close();
    } catch (ex) {
        try {
            window.external.ExecScript('visit=game:GetService("Visit") game:Save(visit:GetUploadUrl())');
            //args.IsValid = true;
            document.getElementById("DialogResult").value = '1';
            window.close();
        } catch (ex2) {
            //args.IsValid = false;
        }
    }
    document.getElementById("Uploading").style.display = 'none';
}

function publishRegular(placeId) {
    var place = window.external.write();
    place.Upload('http://bmblox.xyz/Data/Upload.ashx?id='+placeId);
    window.close();
}