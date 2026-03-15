var RBXGS = {
  Server: {}
};

RBXGS.Server.Close = function (serverId, placeId) {
    fetch('/Game/Close.ashx?ServerID='+serverId+'&PlaceID='+placeId);
    setTimeout(() => {location.reload();} , 3000);
}