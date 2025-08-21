-- declarations
local port = {Port}
local sleepTime = 10

-- establish this peer as the Server
local ns = game:GetService("NetworkServer")

--game:GetService("Players"):SetAbuseReportUrl("http://www.roblox.com/AbuseReport/InGameChatHandler.ashx")

game:Load("http://{Url}/Data/Get.ashx?id=1")

-- utility
function waitForChild(parent, childName)
	while true do
		local child = parent:FindFirstChild(childName)
		if child then
			return child
		end
		parent.ChildAdded:Wait()
	end
end

-- returns the player object that killed this humanoid
-- returns nil if the killer is no longer in the game
function getKillerOfHumanoidIfStillInGame(humanoid)

	-- check for kill tag on humanoid - may be more than one - todo: deal with this
	local tag = humanoid:FindFirstChild("creator")

	-- find player with name on tag
	if tag then
		local killer = tag.Value
		if killer.Parent then -- killer still in game
			return killer
		end
	end

	return nil
end

-- send kill and death stats when a player dies
function onDied(victim, humanoid)
	local killer = getKillerOfHumanoidIfStillInGame(humanoid)

	local victorId = 0
	if killer then
		victorId = killer.userId
		print("STAT: kill by " .. victorId .. " of " .. victim.userId)
		game:HttpGet("http://{Url}/Game/Statistics.ashx?TypeID=15&UserID=" .. victorId .. "&AssociatedUserID=" .. victim.userId .. "&AssociatedPlaceID=0&Key=AWESOMESAUCE")
	end
	print("STAT: death of " .. victim.userId .. " by " .. victorId)
	game:HttpGet("http://{Url}/Game/Statistics.ashx?TypeID=16&UserID=" .. victim.userId .. "&AssociatedUserID=" .. victorId .. "&AssociatedPlaceID=0&Key=SUPERSADGRRR")
end

-- listen for the death of a Player
function createDeathMonitor(player)
	-- we don't need to clean up old monitors or connections since the Character will be destroyed soon
	if player.Character then
		local humanoid = waitForChild(player.Character, "Humanoid")
		humanoid.Died:connect(
			function ()
				onDied(player, humanoid)
			end
		)
	end
end

-- listen to all Players' Characters
game:service("Players").ChildAdded:connect(
	function (player)
		createDeathMonitor(player)
		player.Changed:connect(
			function (property)
				if property=="Character" then
					createDeathMonitor(player)
				end
			end
		)
	end
)

-- This code might move to C++
function characterRessurection(player)
	if player.Character then
		local humanoid = player.Character.Humanoid
		humanoid.Died:connect(function() wait(5) player:LoadCharacter() end)
	end
end

function performReplicatorCheck()
	for _, replicator in pairs(game.NetworkServer:children()) do
		if (replicator:GetPlayer() == nil) then
			replicator:CloseConnection()
		end
	end
end

game:service("Players").PlayerAdded:connect(function(player)	
	local ticket = player.CharacterAppearance
	if (game:HttpGet("http://{Url}/api/public/ValidateTicket.ashx?Ticket=" .. ticket, true) == "1") then
		player.userId = game:HttpGet("http://{Url}/api/public/GetUserId.ashx?Ticket=" .. ticket, true)
		player.Name = game:HttpGet("http://{Url}/api/public/GetUsername.ashx?Ticket=" .. ticket, true)
		player.CharacterAppearance = game:HttpGet("http://{Url}/api/public/GetCharacterAppearance.ashx?Ticket=" .. ticket, true)
		game:HttpGet("http://{Url}/api/public/LogTicket.ashx")
		player:LoadCharacter()

		print("Player " .. player.userId .. " added")
		
		characterRessurection(player)
		player.Changed:connect(function(name)
			if name=="Character" then
				characterRessurection(player)
			end
		end)
	else
		print("User failed to join")
		--performReplicatorCheck()
	end
end)

--[[game:service("NetworkServer").ChildAdded:connect(function(replicator)
	local count = 0
	repeat
		wait() 
		count = count + 1 
		if (count > 30) then
			break
		end
	until replicator:GetPlayer() ~= nil
	if replicator:GetPlayer() == nil then
		replicator:CloseConnection()
	end
end)]]

if port>0 then
	-- Now start the connection
	ns:Start(port, sleepTime) 
end

game:GetService("RunService"):Run()