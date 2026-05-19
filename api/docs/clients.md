# Clients @ Boomblox
A key feature of Boomblox is the active client progression, and requires a level of organization and planning in order to properly release clients.

When preparing a new client for release you must take into account a few things:
- The client
- The bootstrapper
- Anticheat DLLs
- On-site client APIs

These topics will be covered in the documentation below.

## The client
The client should be the first thing you work on since it is the root of all the other things that will be packaged with the client. The bootstrapper requires the client, anticheat DLLs require client information, and on-site client APIs require the client to be completely prepped so that it can hold an accurately captured MD5 checksum of the client.

The first thing to do with the client is to patch it, which is preferably done within a program like x64dbg. Assuming the person reading this is the owner, you were selected because at minimum you at least know how to do this. Below is an extensive list of all things that should be patched within the client as well as some internally gatekept patching guides for the sole purpose of patching Boomblox clients. You should be able to obtain patching guides for non-gatekept patches from the Miraheze-hosted Unofficial Boomblox wiki, or an archive of it if it is no longer maintained at this point in time.

### Regular Patches

Assuming that the client is still progressing actively forward, this should be reviewed starting at approximately `version-38688219c12c4bc8` (June 18, 2010) or `version-ecd6a58467454f8f` (July 23, 2010) which requires the following patches (in order of importance, top to bottom):

- binary string - A vulnerability also known as bytecode execution, which allows for the user to execute raw lua opcodes which can end up bypassing the Lua sandbox and executing non-Lua subroutines

- __gc - A metatable that is held accountable for every time the garbage collector is ran on Roblox, pertains a security context of zero, which allows for server leverage and can allow the user to override common keywords used in server-ran files such as gameserver.ashx

- IncommingConnection - An event which is child of the NetworkServer and not protected by security contexts and allow for places to have scripts to possess user IPs through accessing the `string` peer parameter

- OverrideLockViewGamelayout - A client-sided vulnerability which allows for the user to unlock the game layout and access studio tools through installing a certain registry key which pertains to the keyword above, included in the patch

### Internal Patches

- RakNet key - Making a patch to this specific thing allows for only RobloxApp with the same key patched in to join other RobloxApp instances

In order to patch this, you must first locate the RakNet key which can be located in the client by looking for the "Connecting to %s:%s" string

- Signature buffer overflow - An overflow vulnerability which is presented within the looped process of writing individual bytes of the original signature into another buffer with the intention to lcok out at 10240 bytes, but fails; resulting in a buffer overflow

As of this being written (3/4/2009) the client is not affected by this vulnerability, but there are two hypothetical ways of ridding the client of this dangerous overflow:

#### Path A: DLL Hooks
This can be done through inline hooking the `RBX::Crypt::verifySignatureBase64` function.

#### Path B: Assembly Patching
This can be done by patching by writing new assembly into empty memory and jumping out of the signature read loop to it, and jumping back to it.

First, to obtain the location of this function that we want to modify, we must look for the string `CryptVerifySignature Error 0x%x. sigLen=%d sigB64='%s' message='%s'"` which is an error thrown in an exception during the effort to load in the signature byte by byte.

## Pre-release
Before releasing the client, there are a few steps that should be taken into consideration; namely, the client's presentation. In 2024 and up until late-2025, the presentation of Boomblox's clients weren't necessarily preserved entirely for sound viewing, but with the addition of custom DLLs being in use as well as the degree of accuracy in everything that is done in Boomblox being raised, this has changed.

### DLLs
Any DLL that you write and compile for Boomblox usage on the client-end should be concealed with the resource of a real Roblox DLL, for example; at the current time (5/19/2026 8:16 AM EST), the one DLL the client uses for all it's utilities is renamed to RobloxInstall.dll as well as reusing the Version section from an original RobloxInstall.dll's resource from 2008 via Resource Hacker.

Another thing that is currenlty done with the utility DLL is the exported functions being listed as they were originally, like so:
- `DllMain`
- `DllCanUnloadNow`
- `DllGetClassObject`
- `DllRegisterServer`
- `DllUnregisterServer`

This is done so that in the event that the DLL is identified in suspicion of a non-authentic Roblox DLL, it can be thrown off by the exported functions; and of course the original Roblox resources would add to this as well.