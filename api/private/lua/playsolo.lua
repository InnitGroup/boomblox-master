
workspace:SetPhysicsThrottleEnabled(true)
game:GetService("RunService"):Run()
game:GetService("Visit")

local player = game.Players:CreateLocalPlayer(0)
player.CharacterAppearance = "{CharacterAppearance}"
player:LoadCharacter()

player:SetSuperSafeChat(false)

player.Character.Humanoid.Died:connect(function() wait(5) player:LoadCharacter() end)