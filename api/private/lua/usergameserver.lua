-- declarations
local port = {Port}
local sleepTime = 10

function xprint(string)
	local m = Instance.new("Message", workspace)
	m.Text = string
end

-- establish this peer as the Server
local ns = game:GetService("NetworkServer")
--xprint(game.JobId)
--ns:SetIsPlayerAuthenticationRequired(true)

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
	end
	print("STAT: death of " .. victim.userId .. " by " .. victorId)
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

game:service("Players").PlayerAdded:connect(function(player)	
	print("Player " .. player.userId .. " added")

	characterRessurection(player)
	player.Changed:connect(function(name)
		if name=="Character" then
			characterRessurection(player)
		end
	end)

	player.Chatted:connect(function(msg)  
		if (msg == ";wm") then
			player.Character.Humanoid.Health = 0
		end
	end)

end)

--[[ns.ChildAdded:connect(function(rep)
	local m = Instance.new("Message", workspace)
	m.Text = rep:GetRakStatsString(0)
	local a = Instance.new("Message", workspace)
	a.Text = rep:GetRakStatsString(1)
	local x = Instance.new("Message", workspace)
	x.Text = rep:GetRakStatsString(2)
end)]]--

if port>0 then
	-- Now start the connection
	ns:Start(port, sleepTime) 
end

game:GetService("RunService"):Run()