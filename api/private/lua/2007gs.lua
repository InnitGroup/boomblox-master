local placeId = {PlaceID}
local port = {Port}
local sleeptime = 20
local throttleEnabled = true

workspace:SetPhysicsThrottleEnabled(throttleEnabled)

-- establish this peer as the Server
local ns = game:GetService("NetworkServer")

-- This code might move to C++
function characterRessurection(player)
	if player.Character then
		local humanoid = player.Character.Humanoid
		humanoid.Died:connect(function() wait(5) player:LoadCharacter() end)
	end
end

game:service("Players").PlayerRemoving:connect(function(player)
	collectgarbage("collect")
	game:HttpGet("http://{Url}/Game/Statistics.ashx?AssociatedPlaceID={PlaceID}&TypeID=2&AssociatedUserID=" .. player.userId .. "&serverPort=" .. port .. "&t=" .. math.random(1,9999), false)
	wait(25)
	if (#game.Players:GetChildren() == 0) then
		game:HttpGet("http://{Url}/api/public/CloseServer.ashx?Port=" .. port .. "&Key=Y2M0YjFjNzNhZWY5YzAyYjkzNmM1NzFlZjg3MWZmODc=" .. "&t=" .. math.random(1,9999), false)
	end
end)

function getPlayerReplicator(player)
	for i,v in pairs(game.NetworkServer:GetChildren()) do
		if (v:GetPlayer() == player) then
			return v
		end
	end

	return false
end

game:service("Players").PlayerAdded:connect(function(player)	
	if (player.userId == 0) then
		player:Remove()
	end
	print("Player " .. player.userId .. " added")
	local result = game:HttpGet("http://{Url}/Game/Statistics.ashx?TypeID=1&AssociatedUserID=" .. player.userId .. "&serverPort=" .. port .. "&AssociatedPlaceID={PlaceID}&ClientTicket=" .. player.CharacterAppearance .. "&t=" .. math.random(1,9999), true)
    if (result and result ~= "bad") then
		player.CharacterAppearance = result
	else
		local replicator = getPlayerReplicator(player)
		if (replicator) then
			replicator:CloseConnection()
		else
			player:Remove()
		end
	end
	
	characterRessurection(player)
	player.Changed:connect(function(name)
		if name=="Character" then
			characterRessurection(player)
		end
	end)

	player.Chatted:connect(function(msg) 
		local pms = msg:lower() 
		if (pms == ";wm") then
			player.Character.Humanoid.Health = 0
		end
	end)
end)

game:Load("http://{Url}/Data/Get.ashx?id={PlaceID}&key=8u09nhoasNHDXAOSHDL")
ns:start(port, sleeptime) 
game:GetService("RunService"):Run()

pcall(function()
	wait(30)
	if (#game.Players:GetChildren() == 0) then
		game:HttpGet("http://{Url}/api/public/CloseServer.ashx?Port=" .. port .. "&Key=Y2M0YjFjNzNhZWY5YzAyYjkzNmM1NzFlZjg3MWZmODc=" .. "&t=" .. math.random(1,9999), false)
	end
end)