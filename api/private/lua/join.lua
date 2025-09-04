-- arguments ---------------------------------------

local threadSleepTime = 15

local test = false

print("! Joining game 'cf8a733b-2409-4688-8ebe-1f1241865ebe' place 14799793 at 68.168.101.62")

local waitingForCharacter = false

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
    --if not test then visit:SetUploadUrl("") end
    client:Disconnect()
    wait(4)
    showErrorWindow("Error: " .. err)
end

-- called when the client connection closes
function onDisconnection(peer, lostConnection)
    if lostConnection then
        showErrorWindow("You have lost the connection to the game")
    else
        showErrorWindow("This game has shut down")
    end
end

function requestCharacter(replicator)

    -- prepare code for when the Character appears
    local connection
    connection = player.Changed:connect(function (property)
        if property=="Character" then
            game:ClearMessage()
            waitingForCharacter = false

            connection:disconnect()
        end
    end)

    setMessage("Requesting character")

    local success, err = pcall(function()
        replicator:RequestCharacter()
        setMessage("Waiting for character")
        waitingForCharacter = true
        game:ClearMessage()
        game["Script Context"]:Remove()
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
        if not test then
            --game:HttpGet("http://{Url}/Game/Statistics.ashx?TypeID=3&UserID={UserID}")
            --visit:SetPing("http://www.roblox.com/Game/ClientPresence.ashx?PlaceID=14799793&UserID=201573", 300)
        end

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

-- called when the client connection fails
function onConnectionFailed(_, error)
    showErrorWindow("Failed to connect to the Game. (ID=" .. error .. ")")
end

-- called when the client connection is rejected
function onConnectionRejected()
    connectionFailed:disconnect()
    showErrorWindow("This game is not available. Please try another")
end

idled = false
function onPlayerIdled(time)
    if time > 20*60 then
        showErrorWindow(string.format("You were disconnected for being idle %d minutes", time/60))
        client:Disconnect()
        if not idled then
            idled = true
        end
    end
end


-- main ------------------------------------------------------------

local success, err = pcall(function()
    game:HttpGet("http://{Url}/Game/Statistics.ashx?TypeID=3&UserID={UserID}")
    setMessage("Creating Player")
    player = game:GetService("Players"):CreateLocalPlayer({UserID})
    player:SetSuperSafeChat(false)
    player.Idled:connect(onPlayerIdled)

    -- Overriden
    --onPlayerAdded(player)

    pcall(function() player.Name = [========[{Username}]========] end)
    player.CharacterAppearance = "{ClientTicket}"
    if not test then visit:SetUploadUrl("{UploadUrl}") end

    setMessage("Connecting to Server")
    client.ConnectionAccepted:connect(onConnectionAccepted)
    client.ConnectionRejected:connect(onConnectionRejected)
    connectionFailed = client.ConnectionFailed:connect(onConnectionFailed)
    client:Connect("{IP}", {Port}, 0, threadSleepTime)
end)

if not success then
    reportError(err)
end