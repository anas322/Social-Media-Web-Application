<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Posts - social </title>
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        @vite(['resources/css/app.css'])

        <script>
    // On page load or when changing themes, best to add inline in `head` to avoid FOUC
    if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark')
    }
</script>
    </head>

    <body class='bg-gray-100 dark:bg-slate-800 container mx-auto w-full overflow-x-hidden transition duration-500'>

        <div id="errors-area" class="fixed top-10 left-0 z-50 flex flex-col gap-y-1 max-h-72 overflow-y-auto"></div>

        <header class='grid grid-cols-12 gap-x-6 px-2 py-3 bg-white dark:bg-slate-700 rounded-b-lg'>

            <div class='col-span-3 ml-4'>

                <a href="{{ route('post.index') }}" class="flex items-center space-x-1">
                    <object data="{{asset('images/logo.svg')}}" class="block h-12 w-auto">
                    </object><span class='text-2xl font-bold text-darkText-200 dark:text-white' style="font-family: 'Sofia', cursive;">memes</span>

                </a>
            </div>


            <div class='col-span-6'>

                <div class="bg-gray-100 dark:bg-gray-500 rounded-lg flex items-center w-full relative">
                    <object data="{{asset('images/search.svg')}}"
                        class="block h-6 w-auto p-3 box-content "></object>
                    <input type="text" id="search-creators" class="border-none bg-gray-100 dark:bg-gray-500 dark:placeholder:text-white dark:text-white w-full rounded-full focus:ring-0 transition duration-500"
                        placeholder='Search for creators ❤️'>

                    <!-- searched users -->
                    <div id="searched-users" class="absolute top-10 left-0 right-0 bg-gray-100 dark:bg-gray-500 z-50 rounded-b-lg max-h-60 overflow-y-auto transition duration-500">
                    </div>
                 
                </div>

            </div>

            <div  class="flex  items-center space-x-4 col-span-3 justify-self-center">
                
                    <button id="theme-toggle" type="button" class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5 ">
                        <svg id="theme-toggle-dark-icon" class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
                        <svg id="theme-toggle-light-icon" class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path></svg>
                    </button>
               

                <div>
                    <div class="pl-8">
                        <a href="{{route('prof.index',auth()->user()->id)}}">
                            <img src="{{$userProfilePic}}" style="clip-path:circle()" class="w-9">
                        </a>
                    </div>
                </div>
              
            </div>
        </header>

        <section class="grid grid-cols-12 gap-x-6 my-2 auto-rows-min max-w-screen-2xl mx-auto">
            <!-- side left -->
            <aside class="col-span-3 row-span-2">

                <div class='flex items-center lg:space-x-10 py-4 pl-4 rounded-2xl mb-4 bg-white dark:bg-slate-700 transition duration-500'>
                    <a href="{{ route('prof.index',auth()->id()) }}" class="shrink-0"><img src="{{$userProfilePic}}"
                            style='clip-path : circle()' class='block h-16 w-auto'></a>
                    <div>
                        <a href="{{ route('prof.index',auth()->id()) }}">
                            <strong class="text-darkText-200 dark:text-white">{{auth()->user()->name}}</strong>
                        </a>
                        <p class='text-gray-400'>{{auth()->user()->email}}</p>
                    </div>
                </div>


                <div class='flex flex-col bg-white dark:bg-slate-700 rounded-2xl overflow-hidden transition duration-500'>
                    <a href="{{ route('post.index') }}">

                        <div @class(["bg-gray-200 dark:bg-slate-600 border-l-4 border-blue-600"=> Route::currentRouteName() ==
                            'post.index','flex items-center
                            space-x-8 py-6 pl-10 hover:bg-gray-200 dark:hover:bg-slate-600 hover:border-l-4 hover:border-blue-600
                            hover:cursor-pointer transition duration-500']) >
                            <div>
                                <object data="{{asset('images/home-icon.svg')}}" class="block w-6"></object>
                            </div>
                            <span @class(["text-blue-600"=> Route::currentRouteName() ==
                                'post.index','capitalize','text-darkText-100','font-semibold','dark:text-white'])>home</span>
                        </div>
                    </a>

                    <!-- <div class='flex items-center space-x-8 py-6 pl-10 '>
                        <div>
                            <object data="{{asset('images/explore.svg')}}" class="block  w-6"></object>
                        </div>
                        <strong class='capitalize ,'text-darkText-100',ont-semibold'>explore</strong>
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
                        <span class='capitalize text-darkText-100 font-semibold dark:text-white '>notifications </span>
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
                        <span class='capitalize text-darkText-100 font-semibold dark:text-white'>messages</span>
                    </div>

                    <a href="{{ route('bookmark.index') }}">
                        <div @class(["bg-gray-200 dark:bg-slate-600 border-l-4 border-blue-600"=> Route::currentRouteName() ==
                            'bookmark.index','flex items-center
                            space-x-8 py-6 pl-10 hover:bg-gray-200 dark:hover:bg-slate-600 hover:border-l-4 hover:border-blue-600
                            hover:cursor-pointer transition duration-500 ']) >

                            <div>
                                <object data="{{asset('images/bookmarks.svg')}}" class="block  w-6"></object>
                            </div>
                            <span @class(["text-blue-600"=> Route::currentRouteName() ==
                                'bookmark.index','capitalize','text-darkText-100','font-semibold' ,'dark:text-white'])>bookmarks</span>

                        </div>
                    </a>

                    <!-- <div class='flex items-center space-x-8 py-6 pl-10 '>
                        <div>
                            <object data="{{asset('images/theme.svg')}}" class="block  w-8"></object>
                        </div>
                        <span class='capitalize ,'text-darkText-100',ont-semibold'>theme</span>
                    </div> -->
                    <a href="{{ route('profile.show') }}">
                        <div @class(["bg-gray-200 dark:bg-slate-600 border-l-4 border-blue-600"=> Route::currentRouteName() ==
                            'profile.show','flex items-center
                            space-x-8 py-6 pl-10 hover:bg-gray-200 dark:hover:bg-slate-600 hover:border-l-4 hover:border-blue-600
                            hover:cursor-pointer transition duration-500 ']) >
                            <div>
                                <object data="{{asset('images/settings.svg')}}" class="block  w-6"></object>
                            </div>
                            <span @class(["text-blue-600"=> Route::currentRouteName() ==
                                'profile.show','capitalize','text-darkText-100','font-semibold','dark:text-white'])>settings</span>
                        </div>
                    </a>
                </div>

                <div class="my-4  flex justify-center">
                    <a href="{{route('post.create')}}"
                        class="h-auto text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br rounded-full text-lg w-full py-2 text-center font-medium hover:cursor-pointer  hover:bg-white hover:ring-1 hover:ring-indigo-600 transition">create
                        post</a>
                </div>
            </aside>

            <!-- main  -->
            <main class="col-span-6 row-span-6">
                {{ $slot }}
            </main>

            <!-- side right  -->
            <aside class=" col-span-3 row-span-2 rounded-2xl">
                <div class='flex flex-col space-y-5 p-4 bg-white dark:bg-slate-700 rounded-2xl overflow-hidden transition duration-500'>
                    <div>
                        <span class='capitalize text-darkText-100 dark:text-white text-lg'>latest followers</span>
                        <hr>
                    </div>

                    <div class="flex flex-col space-y-1">

                        @forelse (auth()->user()->profile->followers as $follower)
                        @if($loop->iteration >= 10)
                        @break
                        @endif
                        <a href="{{ route('prof.index',$follower->id) }}"
                            class="p-3 hover:rounded-md hover:bg-gray-100 dark:hover:bg-slate-600">
                            <div class='flex items-center space-x-6'>
                                <div class="shrink-0"><img
                                        src="{{ $follower->profile_photo_path ? asset('storage/' . $follower->profile_photo_path) : asset('storage') . '/default/default.png' }}"
                                        class='block h-11 w-auto rounded-xl'></div>

                                <span class='text-lg text-darkText-200 dark:text-white font-medium'>{{ $follower->name }}</span>
                            </div>
                        </a>

                        @empty
                        <p>No followers 🙄</p>

                        @endforelse

                    </div>

                </div>
            </aside>
        </section>

        <footer class="px-96">
            <hr>
            <p class="text-center text-md py-4 dark:text-white">Copyright @ <time>{{ date("Y") }}</time> Anas. All Rights Reserved ❤️</p>
        </footer>

        {{ $scripts }}  
        <script>

            $(document).ready(function () {
                //set the csrf token
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                    }
                });

                $('#search-creators').keyup( function (e) {
                    //reset users
                    $('#searched-users').html(null)

                    let name = $(this).val();

                    if(name.trim()){
                        
                           $.ajax({
                            type: "POST",
                            url: "{{route('users.search')}}",
                            data: {name},
                            success:(result)=>{
                                // get the user and the insert them as html 
                                result.users.forEach(user => {
                                        $('#searched-users').append(`
                                            <a href="{{ url('/profile') }}/${user.id}">
                                            <div class="flex items-center space-x-4 p-3 hover:bg-gray-200 dark:hover:bg-slate-600 rounded-lg">
                                                <div>
                                                    <img src="{{ asset('storage')}}/${user.profile_photo_path? user.profile_photo_path : 'default/default.png'}" class="w-8" style="clip-path:circle()" >
                                                </div>
                                                <span class="font-medium">${user.name}</span>
                                            </div>
                                        </a>
                                    `)
                                });
                             
                            }
                        });
                    }
                });


            })

            var themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
            var themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

            // Change the icons inside the button based on previous settings
            if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                themeToggleLightIcon.classList.remove('hidden');
            } else {
                themeToggleDarkIcon.classList.remove('hidden');
            }

            var themeToggleBtn = document.getElementById('theme-toggle');

            themeToggleBtn.addEventListener('click', function() {

                // toggle icons inside button
                themeToggleDarkIcon.classList.toggle('hidden');
                themeToggleLightIcon.classList.toggle('hidden');

                // if set via local storage previously
                if (localStorage.getItem('color-theme')) {
                    if (localStorage.getItem('color-theme') === 'light') {
                        document.documentElement.classList.add('dark');
                        localStorage.setItem('color-theme', 'dark');
                    } else {
                        document.documentElement.classList.remove('dark');
                        localStorage.setItem('color-theme', 'light');
                    }

                // if NOT set via local storage previously
                } else {
                    if (document.documentElement.classList.contains('dark')) {
                        document.documentElement.classList.remove('dark');
                        localStorage.setItem('color-theme', 'light');
                    } else {
                        document.documentElement.classList.add('dark');
                        localStorage.setItem('color-theme', 'dark');
                    }
                }
                
            });
            
        </script>
        <script src="https://unpkg.com/flowbite@1.5.1/dist/flowbite.js"></script>
    </body>

</html>
