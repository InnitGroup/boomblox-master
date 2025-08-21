workspace:SetPhysicsThrottleEnabled(true)
game:GetService("RunService"):Run()

local player = game.Players:CreateLocalPlayer({UserID})
player.CharacterAppearance = "{CharacterAppearance}"
player:LoadCharacter()

player:SetSuperSafeChat(false)

player.Character.Humanoid.Died:connect(function() wait(5) player:LoadCharacter() end)