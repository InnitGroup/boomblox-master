-- arguments ---------------------------------------

local threadSleepTime = 15

local test = false

print("! Joining game '0' place 0 at localhost")

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

    local success, err = pcall(function()
        replicator:RequestCharacter()
        waitingForCharacter = true
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




-- main ------------------------------------------------------------

local success, err = pcall(function()
    player = game:GetService("Players"):CreateLocalPlayer(0)

    -- Overriden
    --onPlayerAdded(player)
    client.ConnectionAccepted:connect(onConnectionAccepted)
    client.ConnectionRejected:connect(onConnectionRejected)
    connectionFailed = client.ConnectionFailed:connect(onConnectionFailed)
    client:Connect("localhost", {Port}, 0, threadSleepTime)
end)

if not success then
    reportError(err)
end