<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Posts - social </title>
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        @vite(['resources/css/app.css'])
    </head>

    <body class='bg-gray-100 container mx-auto'>
        <header class='grid grid-cols-12 gap-x-6 px-2 py-3 bg-white rounded-b-lg'>
            <a href="{{ route('post.index') }}" class="col-span-3">

                <div class='ml-4  flex items-center space-x-1'> <object data="{{asset('images/logo.svg')}}"
                class="block h-12 w-auto"></object><span class='text-2xl font-bold' style="font-family: 'Sofia', cursive;">memes</span></div>
            </a>

            <div class='col-span-6'>
                <form>
                    <div class="bg-gray-100 rounded-full flex items-center w-full">
                        <object data="{{asset('images/search.svg')}}"
                            class="block h-6 w-auto p-3 box-content "></object>
                        <input type="text" class="border-none bg-gray-100 w-full rounded-full focus:ring-0"
                            placeholder='Search for creators ❤️'>
                    </div>
                </form>
            </div>

            <div class='col-span-3'>
                <div class="float-right pr-8">
                        <a href="{{route('prof.index',auth()->user()->id)}}">
                            <img src="{{$userProfilePic}}" style="clip-path:circle()" class="w-12">
                        </a>
                </div>
            </div>
        </header>

        <section class="grid grid-cols-12 gap-x-6 my-2 auto-rows-min max-w-screen-2xl mx-auto">
            <!-- side left -->
            <aside class="col-span-3 row-span-2">

                <div class='flex items-center lg:space-x-10 py-4 pl-4 rounded-2xl mb-4 bg-white'>
                    <a href="{{ route('prof.index',auth()->id()) }}" class="shrink-0"><img src="{{$userProfilePic}}"
                            style='clip-path : circle()' class='block h-16 w-auto'></a>
                    <div>
                        <a href="{{ route('prof.index',auth()->id()) }}">
                            <strong>{{auth()->user()->name}}</strong>
                        </a>
                        <p class='text-gray-400'>{{auth()->user()->email}}</p>
                    </div>
                </div>


                <div class='flex flex-col bg-white rounded-2xl overflow-hidden'>
                    <a href="{{ route('post.index') }}">

                        <div @class(["bg-gray-100 border-l-4 border-blue-600"=> Route::currentRouteName() ==
                            'post.index','flex items-center
                            space-x-8 py-6 pl-10 hover:bg-gray-100 hover:border-l-4 hover:border-blue-600
                            hover:cursor-pointer transition duration-500']) >
                            <div>
                                <object data="{{asset('images/home-icon.svg')}}" class="block  w-6"></object>
                            </div>
                            <span @class(["text-blue-600"=> Route::currentRouteName() ==
                                'post.index','capitalize','font-semibold'])>home</span>
                        </div>
                    </a>

                    <!-- <div class='flex items-center space-x-8 py-6 pl-10 '>
                        <div>
                            <object data="{{asset('images/explore.svg')}}" class="block  w-6"></object>
                        </div>
                        <strong class='capitalize font-semibold'>explore</strong>
                    </div> -->

                    <div class='flex items-center space-x-8 py-6 pl-10 '>
                        <div class='relative'>
                            <object data="{{asset('images/notify.svg')}}" class="block  w-6"></object>
                            <span class="flex absolute h-3 w-3 top-0 right-0 -mt-1 -mr-1">
                                <span
                                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500 "></span>
                            </span>
                        </div>
                        <span class='capitalize font-semibold'>notifications </span>
                    </div>

                    <div class='flex items-center space-x-8 py-6 pl-10 '>
                        <div class='relative'>
                            <object data="{{asset('images/messages.svg')}}" class="block  w-6"></object>
                            <span class="flex absolute h-3 w-3 top-0 right-0 -mt-1 -mr-1">
                                <span
                                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500 "></span>
                            </span>
                        </div>
                        <span class='capitalize font-semibold'>messages</span>
                    </div>

                    <a href="{{ route('bookmark.index') }}">
                        <div @class(["bg-gray-100 border-l-4 border-blue-600"=> Route::currentRouteName() ==
                            'bookmark.index','flex items-center
                            space-x-8 py-6 pl-10 hover:bg-gray-100 hover:border-l-4 hover:border-blue-600
                            hover:cursor-pointer transition duration-500 ']) >

                            <div>
                                <object data="{{asset('images/bookmarks.svg')}}" class="block  w-6"></object>
                            </div>
                            <span @class(["text-blue-600"=> Route::currentRouteName() ==
                                'bookmark.index','capitalize','font-semibold'])>bookmarks</span>

                        </div>
                    </a>

                    <!-- <div class='flex items-center space-x-8 py-6 pl-10 '>
                        <div>
                            <object data="{{asset('images/theme.svg')}}" class="block  w-8"></object>
                        </div>
                        <span class='capitalize font-semibold'>theme</span>
                    </div> -->
                    <a href="{{ route('profile.show') }}">
                        <div @class(["bg-gray-100 border-l-4 border-blue-600"=> Route::currentRouteName() ==
                            'profile.show','flex items-center
                            space-x-8 py-6 pl-10 hover:bg-gray-100 hover:border-l-4 hover:border-blue-600
                            hover:cursor-pointer transition duration-500 ']) >
                            <div>
                                <object data="{{asset('images/settings.svg')}}" class="block  w-6"></object>
                            </div>
                            <span @class(["text-blue-600"=> Route::currentRouteName() ==
                                'profile.show','capitalize','font-semibold'])>settings</span>
                        </div>
                    </a>
                </div>

                <div class="my-4  flex justify-center">
                    <a href="{{route('post.create')}}"
                        class="h-auto text-white bg-indigo-600 rounded-full text-lg w-full py-2 text-center font-medium">create post</a>
                </div>
            </aside>

            <!-- main  -->
            <main class="col-span-6 row-span-6">
                {{ $slot }}
            </main>

            <!-- side right  -->
            <aside class=" col-span-3 row-span-2 rounded-2xl">
                <div class='flex flex-col space-y-5 p-4 bg-white rounded-2xl overflow-hidden'>
                    <div>
                        <span class='capitalize text-lg'>latest followers</span>
                        <hr>
                    </div>

                    <div class="flex flex-col space-y-1">

                        @forelse (auth()->user()->profile->followers as $follower)
                        @if($loop->iteration >= 10)
                        @break
                        @endif
                        <a href="{{ route('prof.index',$follower->id) }}"
                            class="p-3 hover:rounded-md hover:bg-gray-100">
                            <div class='flex items-center space-x-6'>
                                <div class="shrink-0"><img
                                        src="{{ $follower->profile_photo_path ? asset('storage/' . $follower->profile_photo_path) : asset('storage') . '/default/default.png' }}"
                                        class='block h-11 w-auto rounded-xl'></div>

                                <span class='text-lg text-slate-700 font-medium'>{{ $follower->name }}</span>
                            </div>
                        </a>

                        @empty
                        <p>No followers 🙄</p>

                        @endforelse

                    </div>

                </div>
            </aside>
        </section>

        {{ $scripts }}
    </body>

</html>
