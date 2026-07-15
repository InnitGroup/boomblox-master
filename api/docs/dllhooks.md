# DLL Hooks @ Boomblox
DLL Hooks are a crucial part of patching and will make your life easier as a developer especially when working with clients.

## Intro
First you need to understand a few prerequisites:
- [C](https://www.cs.columbia.edu/~sedwards/papers/cman.pdf)/[C++](https://cppreference.com/)
- [Microsoft Detours](https://github.com/microsoft/detours)
- Visual Studio (preferably [2008](https://archive.org/details/VisualStudio2008_Collection))

Although Microsoft Detours and Visual Studio are physical files or applications and libraries, C and C++ are entire langages that must be understood in order to complete a proper DLL hook. Some logic you should understand in C/C++ before writing a DLL hook is as follows:

- Variables
- Functions
- Memory operations
- Casting
- Threads
- Macros

In Visual Studio you must know how to compile and link libraries, which is what you will be doing with Microsoft Detours, and with Detours you will need to know how to actually use the Detours API that the hooks run on.

## Project Setup
Open Visual Studio 2008, and begin to create a new Win32 Project, make sure to set the Application Type as a DLL.

The only file we will be using for simplicity will be dllmain.cpp, but we must first construct our project settings. Right click on the solution and click Properties:
- Change the Configuration to Release from Active(Debug)
- In C/C++ -> General go to Additional Include Directories and add the `include` folder from your Detours installation
- In Linker -> General go to Additional Library Directories and add the `lib` folder from your Detours installation
- In Linker -> Input and in Additional Dependencies input `detours.lib`
- Then press, Apply, then OK

You now have a proper project configuration for a DLL hook, that's approximately 1/3 of the work done, but we still must find the offset of the function we're hooking and write the DLL.

## The Program
Finding offsets is included in a separate file, named `offsets.md` in this docs folder, as it is an entirely separate mode of technique and profession.

Let's assume you have an offset prepared for a `luaL_loadbuffer` function which you found using the `offsets.md` folder by comparing an indexed .idb file of your client with an older version of RBXGS's .idb, and searching for the function name, and getting the secondary address.

We will start by writing in our `dllmain.cpp`, first by introducing our headers. For our DLL hook in the interest of just testing and feeling the emotion of accomplishment, we will be hooking the `luaL_loadbuffer` function and outputting the contents of the buffer to a console window.

With that information and all else considered, we know that we need:
- `iostream` - the header which gives us input and output (we need output)
- `detours.h` - the header which gives us access to the Microsoft Detours API (we need this for hooking)

So we will start our dllmain.cpp like so:
```cpp
// dllmain.cpp : Defines the entry point for the DLL application.
#include "stdafx.h"

#include <iostream>
#include <detours.h>
```

The top 2 lines were likely already there in your DLL, and can be ignored for the time being.
Now we need to prepare a macro for our program to make offset calculation easier, considering the need for ASLR. A macro for this should be as follows:

```cpp
#define ASLR(x) (x - 0x400000 + (DWORD)GetModuleHandleA(0))
```

This is going to be used like `ASLR(address)` or basically `ASLR(0x00123456)` which will calculate the actual offset of a determined offset through accounting for ASLR, which in our case is 400,000 bytes before our real address, and we add on the base address of our module (DLL) handle as well.