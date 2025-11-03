<?php
#made: 04/06/2025 @marsoc
#last edit: 04/06/2025 @marsoc
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

global $theme, $auth, $user;

global $auth;
!$auth->isAuthed() && Server::_404();

$content = '
<roblox xmlns:xmime="http://www.w3.org/2005/05/xmlmime" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="http://www.roblox.com/roblox.xsd" version="4">
	<External>null</External>
	<External>nil</External>
	<Item class="Workspace" referent="RBX0">
		<Properties>
			<token name="Controller">0</token>
			<bool name="ControllerFlagShown">true</bool>
			<Ref name="CurrentCamera">RBX1</Ref>
			<double name="DistributedGameTime">0</double>
			<CoordinateFrame name="ModelInPrimary">
				<X>0</X>
				<Y>0</Y>
				<Z>0</Z>
				<R00>1</R00>
				<R01>0</R01>
				<R02>0</R02>
				<R10>0</R10>
				<R11>1</R11>
				<R12>0</R12>
				<R20>0</R20>
				<R21>0</R21>
				<R22>1</R22>
			</CoordinateFrame>
			<string name="Name">Workspace</string>
			<Ref name="PrimaryPart">null</Ref>
			<bool name="archivable">true</bool>
		</Properties>
		<Item class="Camera" referent="RBX1">
			<Properties>
				<Ref name="CameraSubject">null</Ref>
				<token name="CameraType">0</token>
				<CoordinateFrame name="CoordinateFrame">
					<X>0</X>
					<Y>5</Y>
					<Z>5</Z>
					<R00>1</R00>
					<R01>0</R01>
					<R02>-0</R02>
					<R10>-0</R10>
					<R11>0.89442718</R11>
					<R12>0.44721359</R12>
					<R20>0</R20>
					<R21>-0.44721359</R21>
					<R22>0.89442718</R22>
				</CoordinateFrame>
				<CoordinateFrame name="Focus">
					<X>0</X>
					<Y>0</Y>
					<Z>-5</Z>
					<R00>1</R00>
					<R01>0</R01>
					<R02>0</R02>
					<R10>0</R10>
					<R11>1</R11>
					<R12>0</R12>
					<R20>0</R20>
					<R21>0</R21>
					<R22>1</R22>
				</CoordinateFrame>
				<string name="Name">Camera</string>
				<bool name="archivable">true</bool>
			</Properties>
		</Item>
	</Item>
	<Item class="RunService" referent="RBX2">
		<Properties>
			<string name="Name">Run Service</string>
			<bool name="archivable">true</bool>
		</Properties>
	</Item>
	<External>RBX3</External>
	<External>RBX4</External>
	<Item class="Players" referent="RBX5">
		<Properties>
			<int name="MaxPlayers">12</int>
			<string name="Name">Players</string>
			<bool name="archivable">true</bool>
		</Properties>
	</Item>
	<Item class="StarterPack" referent="RBX6">
		<Properties>
			<string name="Name">StarterPack</string>
			<bool name="archivable">true</bool>
		</Properties>
	</Item>
	<Item class="SoundService" referent="RBX7">
		<Properties>
			<token name="AmbientReverb">0</token>
			<float name="DistanceFactor">10</float>
			<float name="DopplerScale">1</float>
			<string name="Name">Soundscape</string>
			<float name="RolloffScale">1</float>
			<bool name="archivable">true</bool>
		</Properties>
		<External>RBX8</External>
		<External>RBX9</External>
		<External>RBX10</External>
		<External>RBX11</External>
		<External>RBX12</External>
		<External>RBX13</External>
		<External>RBX14</External>
		<External>RBX15</External>
		<External>RBX16</External>
		<External>RBX17</External>
		<External>RBX18</External>
		<External>RBX19</External>
		<External>RBX20</External>
		<External>RBX21</External>
	</Item>
	<Item class="ContentProvider" referent="RBX22">
		<Properties>
			<string name="Name">Instance</string>
			<bool name="archivable">true</bool>
		</Properties>
	</Item>
	<Item class="PhysicsService" referent="RBX23">
		<Properties>
			<string name="Name">PhysicsService</string>
			<bool name="archivable">true</bool>
		</Properties>
	</Item>
	<External>RBX24</External>
	<Item class="Selection" referent="RBX25">
		<Properties>
			<string name="Name">Selection</string>
			<bool name="archivable">true</bool>
		</Properties>
	</Item>
	<External>RBX26</External>
	<Item class="Lighting" referent="RBX27">
		<Properties>
			<Color3 name="Ambient">4286611584</Color3>
			<float name="Brightness">1</float>
			<Color3 name="ColorShift_Bottom">4278190080</Color3>
			<Color3 name="ColorShift_Top">4278190080</Color3>
			<float name="GeographicLatitude">41.7332993</float>
			<string name="Name">Lighting</string>
			<Color3 name="ShadowColor">4289967032</Color3>
			<string name="TimeOfDay">14:00:00</string>
			<bool name="archivable">true</bool>
		</Properties>
	</Item>
	<Item class="ControllerService" referent="RBX28">
		<Properties>
			<string name="Name">Instance</string>
			<bool name="archivable">true</bool>
		</Properties>
	</Item>
	<Item class="ChangeHistoryService" referent="RBX29">
		<Properties>
			<string name="Name">ChangeHistoryService</string>
			<bool name="archivable">true</bool>
		</Properties>
	</Item>
</roblox>
';

$half = explode('<int name="MaxPlayers">', $content);
$half = $half[1];
$half = explode('</int>', $half);

$playerCount = (int)$half[0];
if ($playerCount > 50) {
$playerCount = 50;
}

echo $playerCount;
?>

<button onclick="alert(window.external.IsRobloxAppIDE)">IsRobloxAppIDE</button>
<button onclick="window.external.GetApp().CreateGame('44340105256')">CreateGame</button>