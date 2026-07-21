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
game:GetService("Players").PlayerAdded:connect(function(player)
	print("Player " .. player.userId .. " added")
	characterRessurection(player)
	player.Changed:connect(function(name)
		if name=="Character" then
			characterRessurection(player)
		end
	end)
end)

game:Load("http://{Url}/Data/Get.ashx?id={PlaceID}&key=8u09nhoasNHDXAOSHDL")
ns:start(port, sleeptime) 
game:GetService("RunService"):Run()