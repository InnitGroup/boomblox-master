game:GetService("Visit"):SetUploadUrl("{UploadUrl}")
game:Load("http://{Url}/Data/Get.ashx?id={PlaceId}&t="..math.random(1,50000))
game:HttpGet("http://{Url}/Game/Statistics.ashx?TypeID=3&UserID={UserID}&AssociatedUserID={UserID}&AssociatedPlaceID={PlaceId}")

workspace:SetPhysicsThrottleEnabled(true)
game:GetService("RunService"):Run()

local player = game.Players:CreateLocalPlayer({UserID})
player.Name = [====[{Username}]====]
player.CharacterAppearance = "{CharacterAppearance}"
player:LoadCharacter()

player:SetSuperSafeChat(false)

player.Character.Humanoid.Died:connect(function() wait(5) player:LoadCharacter() end)