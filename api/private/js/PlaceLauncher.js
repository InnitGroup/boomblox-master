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
        var workspace = app.CreateGame(44340105256);    // Window
        workspace.ExecUrlScript(visitUrl);
    } else if (Roblox.Launch.isVista()) {
        var app = new ActiveXObject("Roblox.App");
        var workspace = app.CreateGame(44340105256);
        workspace.ExecUrlScript(visitUrl);
		workspace = app.NullDispatch;
		app = app.NullDispatch;
    } else
    {
        window.location = "/Data/HandleJoin.ashx?PlaceID="+placeID+"&TypeID="+type;
    }
}

Roblox.Launch.VisitOnline = function(visit, placeID, serverID) {
    $(".modalContainer").show();
    $(".modalPopup").show();

    setTimeout(function() {
        $("#Requesting").show();
    }, 1000);

    if (__requestResponse("api/public/GameserversActive.ashx") == "0") {
        setTimeout(function() {
            $("#Spinner").hide();
            $("#Requesting").hide();
            $("#Expired").show();
        }, 2000);

        return;
    }

    setTimeout(function() {
        $("#Requesting").hide();
        $("#Waiting").show();
    }, 2000);

    setTimeout(function() {
        $("#Waiting").hide();
        $("#Loading").show();
    }, 3000);

    setTimeout(function() {
        $("#Loading").hide();
        $("#Joining").show();
    }, 4000);

    setTimeout(function() {
        window.location = "/Data/HandleJoin.ashx?PlaceID="+placeID+"&TypeID=1&ServerID="+serverID;
    }, 5000);
    
}