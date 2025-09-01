var Roblox = {
  Launch: {}
};

Roblox.Launch._isIDE = null;
Roblox.Launch._isRobloxBrowser = null;
Roblox.Launch._LaunchGamePage = null;

Roblox.Launch.isIDE = function ()
{
    if (Roblox.Launch._isIDE==null)
    {
        Roblox.Launch._isIDE = false;
        Roblox.Launch._isRobloxBrowser = false;
        if (window.external)
        {
            try
            {
                if (window.external.IsRobloxIDE !== undefined)
                {
                    Roblox.Launch._isIDE = window.external.IsRobloxIDE;
				    Roblox.Launch._isRobloxBrowser = true;
				}   
            }
            catch (ex)
            {
            }
        }
    }
    return Roblox.Launch._isIDE;
}

Roblox.Launch.isRobloxBrowser = function()
{
    Roblox.Launch.isIDE();
    return Roblox.Launch._isRobloxBrowser;
}


Roblox.Launch.isVista = function()
{
    return navigator.userAgent.indexOf("Windows NT 6.")!=-1;
}

Roblox.Launch.StartGame = function (visitUrl, authenticationUrl, type, placeID)
{
    if (window.external.IsRobloxAppIDE)
    {
        var app = window.external.GetApp();
        var workspace = app.CreateGame(2);    // Window
        workspace.ExecUrlScript(visitUrl);
    } else if (Roblox.Launch.isVista()) {
        var app = new ActiveXObject("Roblox.App");
        var workspace = app.CreateGame(2);
        workspace.ExecUrlScript(visitUrl);
		workspace = app.NullDispatch;
		app = app.NullDispatch;
    } else
    {
        window.location = "https://xoblog.dev/Data/HandleJoin.ashx?PlaceID="+placeID+"&TypeID="+type;
    }
}

Roblox.Launch.VisitOnline = function(visit, placeID, serverID) {
    if (window.external.IsRobloxAppIDE) {
        var app = window.external.GetApp();
        var workspace = app.CreateGame(placeID);    // Window
        workspace.ExecUrlScript(visit);
    } else {
        window.location = "https://xoblog.dev/Data/HandleJoin.ashx?PlaceID="+placeID+"&TypeID=1&ServerID="+serverID;
    }
}