-- arguments ---------------------------------------

local threadSleepTime = ...

if threadSleepTime==nil then
	threadSleepTime = 15
end

-- globals -----------------------------------------

client = game:GetService("NetworkClient")
visit = game:GetService("Visit")

-- functions ---------------------------------------

function setMessage(message)
	-- todo: animated "..."
	game:SetMessage(message)
end

function showErrorWindow(message)
	game:SetMessage(message)
end

function reportError(err)
	print("***ERROR*** " .. err)
	visit:SetUploadUrl("")
	client:Disconnect()
	wait(4)
	showErrorWindow("Error: " .. err)
end

-- called when the client connection closes
function onDisconnection(peer, lostConnection)
	if lostConnection then
		showErrorWindow("You have lost the connection to the game")
	else
		showErrorWindow("You have disconnected from the game")
	end
end

function requestCharacter(replicator)
	
	-- prepare code for when the Character appears
	local connection
	connection = player.Changed:connect(function (property)
		if property=="Character" then
			game:ClearMessage()
			connection:disconnect()
		end
	end)
	
	setMessage("Requesting character")
	-- a little delay to give you a chance to prepare:
	wait(1.5)

	local success, err = pcall(function()	
		replicator:RequestCharacter()
		setMessage("Waiting for character")
	end)
	if not success then
		reportError(err)
		return
	end
end

-- called when the client connection is established
function onConnectionAccepted(url, replicator)

	local waitingForMarker = true
	
	local success, err = pcall(function()	
		setMessage("Setting ping")
		visit:SetPing("", 300)

		game:SetMessageBrickCount()
		replicator.Disconnection:connect(onDisconnection)
		
		-- Wait for a marker to return before creating the Player
		local marker = replicator:SendMarker()
		
		marker.Received:connect(function()
			waitingForMarker = false
			requestCharacter(replicator)
		end)
	end)
	
	if not success then
		reportError(err)
		return
	end
	
	-- TODO: report marker progress

	while waitingForMarker do
		workspace:ZoomToExtents()
		wait(0.5)
	end
end

-- called when the client connection is rejected
function onConnectionRejected()
	showErrorWindow("Please upgrade ROBLOX")
end

-- called when the client connection fails
function onConnectionFailed()
	showErrorWindow("Failed to connect to the Game")
end

function onPlayerIdled(time)
	if time>30*60 then
		showErrorWindow(string.format("You were disconnected for being idle %d minutes", time/60))
		client:Disconnect()	
	end
end

-- main ------------------------------------------------------------


local success, err = pcall(function()	
    game:HttpGet("http://{Url}/Game/Statistics.ashx?TypeID=3&UserID={UserID}", false)
	setMessage("Creating Player")
	player = game:GetService("Players"):CreateLocalPlayer({UserID})
	player:SetUnder13(false)
	player:SetSuperSafeChat(false)
	player.Idled:connect(onPlayerIdled)
	
	player.Name = [======[{Username}]======]
	player.CharacterAppearance = "{CharacterAppearance}"	
	visit:SetUploadUrl("")

	setMessage("Connecting to Server")
	client.ConnectionAccepted:connect(onConnectionAccepted)
	client.ConnectionRejected:connect(onConnectionRejected)
	client.ConnectionFailed:connect(onConnectionFailed)
	client:Connect("{IP}", {Port}, 0, threadSleepTime)
end)

if not success then
	reportError(err)
end
