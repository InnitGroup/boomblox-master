-- declarations
local port = {Port}
local sleepTime = 10

-- establish this peer as the Server
local ns = game:GetService("NetworkServer")

--game:GetService("Players"):SetAbuseReportUrl("http://www.roblox.com/AbuseReport/InGameChatHandler.ashx")
game:GetService("Players"):SetChatFilterUrl("http://xoblog.dev/Game/ChatFilter.ashx")
game:Load("http://{Url}/Data/Get.ashx?id={PlaceID}&key=8u09nhoasNHDXAOSHDL")
--game:GetObjects("http://{Url}/content/duckydrop.rbxm")[1].Parent = workspace
game:GetObjects("http://{Url}/content/eggdrop2009.rbxm?v=20")[1].Parent = workspace
settings().Network.PhysicsSend = 1 -- 1==RoundRobin
settings().Network.ExperimentalPhysicsEnabled = true

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

local waitTime = 3
local db = {}

-- send kill and death stats when a player dies
function onDied(victim, humanoid)
	local killer = getKillerOfHumanoidIfStillInGame(humanoid)
	collectgarbage("collect")

	local victorId = 0
	if killer then
		if db[killer.userId] and db[killer.userId][1]>tick() then
			if victim.userId==db[killer.userId][2] then 
				return 
			end 
		end 

		db[killer.userId] = {tick()+waitTime, victim.userId}
		print(table.concat(db, " "))
		victorId = killer.userId
		print("STAT: kill by " .. victorId .. " of " .. victim.userId)
		if (victorId ~= victim.userId) then
			game:HttpGet("http://{Url}/Game/Statistics.ashx?TypeID=15&UserID=" .. victorId .. "&AssociatedUserID=" .. victim.userId .. "&AssociatedPlaceID=0&Key=AWESOME1SAUCE" .. "&t=" .. math.random(1,9999), false)
		end
	end
	print("STAT: death of " .. victim.userId .. " by " .. victorId)
	game:HttpGet("http://{Url}/Game/Statistics.ashx?TypeID=16&UserID=" .. victim.userId .. "&AssociatedUserID=" .. victorId .. "&AssociatedPlaceID=0&Key=SUPER1SADGRRR" .. "&t=" .. math.random(1,9999), false)
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
		collectgarbage("collect")
		createDeathMonitor(player)
		player.Changed:connect(
			function (property)
				if property=="Character" then
					createDeathMonitor(player)
				end
			end
		)
		player.Chatted:connect(function(message)
			--[[if (string.find(" ", message)) then
				local replicator = getPlayerReplicator(player)
				replicator:CloseConnection()
			end]]
		end)
		
	end
)

game.NetworkServer.ChildAdded:connect(function(replicator)
	replicator.Name = "{Url}:" .. math.random(999,2001)
end)

game:service("Players").PlayerRemoving:connect(function(player)
	collectgarbage("collect")
	game:HttpGet("http://{Url}/Game/Statistics.ashx?AssociatedPlaceID={PlaceID}&TypeID=2&AssociatedUserID=" .. player.userId .. "&serverPort=" .. port .. "&t=" .. math.random(1,9999), false)
	wait(25)
	if (#game.Players:GetChildren() == 0) then
		game:HttpGet("http://{Url}/api/public/CloseServer.ashx?Port=" .. port .. "&Key=Y2M0YjFjNzNhZWY5YzAyYjkzNmM1NzFlZjg3MWZmODc=" .. "&t=" .. math.random(1,9999), false)
	end
end)

-- This code might move to C++
function characterRessurection(player)
	if player.Character then
		local humanoid = player.Character.Humanoid
		humanoid.Died:connect(function() wait(5) player:LoadCharacter() end)
	end
end

function getPlayerReplicator(player)
	for i,v in pairs(game.NetworkServer:GetChildren()) do
		if (v:GetPlayer() == player) then
			return v
		end
	end

	return false
end

game.NetworkServer.ChildAdded:connect(function(replicator) 
	wait(60)
	if (replicator == nil) then
		return
	end

	if (replicator:GetPlayer() == nil) then
		replicator:CloseConnection()
	end
end)

game:service("Players").PlayerAdded:connect(function(player)	
	if (player.userId == 0) then
		player:Remove()
	end
	print("Player " .. player.userId .. " added")
	local result = game:HttpGet("http://{Url}/Game/Statistics.ashx?TypeID=1&AssociatedUserID=" .. player.userId .. "&serverPort=" .. port .. "&AssociatedPlaceID={PlaceID}&ClientTicket=" .. player.CharacterAppearance .. "&t=" .. math.random(1,9999), true)
	-- local result = dofile("http://{Url}/Game/Statistics.ashx?TypeID=1&AssociatedUserID=" .. player.userId .. "&serverPort=" .. port .. "&AssociatedPlaceID={PlaceID}&ClientTicket=" .. player.CharacterAppearance .. "&t=" .. math.random(1,9999))
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

	local eggValue = Instance.new("ObjectValue", player)
	eggValue.Name = "SuperCoolHopefullySecretValue"
	eggValue.Value = nil

	eggValue.Changed:connect(function()
		if eggValue.Value ~= nil then
			game:HttpGet("http://{Url}/Game/TreasureHunt.ashx?userid=" .. player.userId .. "&key=WhyY0uG0tt4UpNJ1ckl3Y4ng&assetnumber=" .. eggValue.Value.Name, false)
			
			print("destroying")
			eggValue.Value:Remove()
			eggValue.Value = nil
		end
	end)

	player.Chatted:connect(function(msg) 
		local pms = msg:lower() 
		if (pms == ";wm") then
			player.Character.Humanoid.Health = 0
		end

		if (pms == "latin is key") then
			local ms = Instance.new("Message", player)
			ms.Name = tostring(math.random(1, 100000))
			ms.Text = "Say it ain't so"
			wait(1)
			ms:Remove()
		end
	end)
end)

if port>0 then
	-- Now start the connection
	ns:Start(port, sleepTime) 
end

game:GetService("RunService"):Run()

pcall(function()
	wait(30)
	if (#game.Players:GetChildren() == 0) then
		game:HttpGet("http://{Url}/api/public/CloseServer.ashx?Port=" .. port .. "&Key=Y2M0YjFjNzNhZWY5YzAyYjkzNmM1NzFlZjg3MWZmODc=" .. "&t=" .. math.random(1,9999), false)
	end
end)