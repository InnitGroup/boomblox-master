print("Balefire Spell Loaded") 

bin = script.Parent 

enabled = true 

local function onButton1Down(mouse)
	if not enabled then return end 
	local function balefire(pos) 
		local player = game.Players.LocalPlayer
		if player == nil or player.Character == nil then return end 

		local char = player.Character.Torso 

		dir = (pos - char.CFrame.p).unit 

		local ex = Instance.new("Explosion") 
		ex.BlastRadius = 10
		ex.BlastPressure = 250000 
		ex.Position = char.CFrame.p + (dir * 0 * i) + (dir * 0) 
		ex.Parent = player.Character
	end 
	local function findPlane(player)
		local list = player.Character:GetChildren()
		for x = 1, #list do
			if (list[x].Name == "Plane") then
				local weld = list[x]:FindFirstChild("Parts"):FindFirstChild("Seat"):FindFirstChild("SeatWeld")
				if (weld ~= nil) and (weld.Part1 == player.Character:FindFirstChild("Torso")) then
					return list[x]
				end
			end
		end
		return nil
	end

	local player = game.Players.LocalPlayer 
	if player == nil then return end 

	enabled = false 
	mouse.Icon = "rbxasset://textures\\ArrowCursor.png" 

	-- find the best cf 
	local cf = mouse.hit
	local v = cf.lookVector --player.Character:findFirstChild("Plane") ~= nil and player.Character.Humanoid.Sit == true 
	if findPlane(player) ~= nil then
	balefire(cf.p) 
	end
	player.Character:BreakJoints()	
	wait()
	mouse.Icon = "rbxasset://textures\\ArrowCursor.png" 
	enabled = true 

end

local function onSelected(mouse) 
mouse.Icon = "rbxasset://textures\\ArrowCursor.png" 
mouse.Button1Down:connect(function() onButton1Down(mouse) end) 
end 

bin.Selected:connect(onSelected) 
