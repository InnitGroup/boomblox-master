var RBXGS = {
  Server: {}
};

RBXGS.Server.Close = function (serverId, placeId) {
    fetch('https://bmblox.xyz/Game/Close.ashx?ServerID='+serverId+'&PlaceID='+placeId);
    setTimeout(() => {location.reload();} , 3000);
}