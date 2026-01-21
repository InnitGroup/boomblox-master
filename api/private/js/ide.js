function isVista()
{
    return navigator.userAgent.indexOf("Windows NT 6.")!=-1;
}

function isIDE() 
{
    return window.external.IsRobloxAppIDE;
}

function join(placeId) {
    var visitUrl = "http://bmblox.xyz/Game/Edit.ashx?PlaceID="+placeId;
    var authenticationUrl = "http://bmblox.xyz/Login/Negotiate.ashx";
    if (isIDE()) {
        var app = window.external.GetApp();
        var workspace = app.CreateGame(44340105256);
        workspace.ExecUrlScript(visitUrl);
    } else if (isVista()) {
        var launcher = new ActiveXObject("RobloxLauncher.Launcher");
        if (!launcher)
            throw "launcher is null or undefined";

        launcher.StartGame(authenticationUrl, visitUrl, null, null, null, null);
        //var app = window.external.GetApp();//new ActiveXObject("RobloxApp.App");
        //var workspace = app.CreateGame(1);
        //workspace.ExecUrlScript(visitUrl);
    }
}