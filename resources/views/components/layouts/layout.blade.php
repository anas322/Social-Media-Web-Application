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
    if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark')
    }
</script>
    </head>

    <body class='bg-gray-100 dark:bg-slate-800 px-8 lg:container mx-auto w-full overflow-x-hidden transition duration-500 pb-[75px] md:pb-0'>
        <x-utilities.loading />
        
        <div id='loading-page-toggle' class="hidden">
        
            <div id="errors-area" class="fixed top-10 left-0 z-50 flex flex-col gap-y-1 max-h-72 overflow-y-auto"></div>
            <header class='grid grid-cols-12 gap-x-6 px-2 py-3 bg-slate-200 sm:bg-white dark:bg-gray-700 rounded-b-lg relative'>

                <div class=' col-span-10 sm:col-span-3 ml-4'>
                    <div class="inline-block">
                        <a href="{{ route('post.index') }}" class="flex items-center space-x-1">
                            <img src="{{asset('images/logo.svg')}}" class="block h-12 w-auto" />
                            
                            <span class='text-2xl text-darkText-200 dark:text-white' style="font-family: 'Sofia', cursive;">memes</span>
                        </a>
                    </div>
                </div>


                <div class='hidden sm:block col-span-6'>

                    <div class=" bg-gray-100 dark:bg-gray-500 rounded-lg flex items-center w-11/12 mx-auto  md:w-full relative">
                        <object data="{{asset('images/search.svg')}}"
                            class="block h-6 w-auto p-3 box-content "></object>
                        <input type="text" autocomplete="off" id="search-creators" class="text-sm lg:text-normal border-none bg-gray-100 dark:bg-gray-500 dark:placeholder:text-white dark:text-white w-full rounded-full focus:ring-0 transition duration-500"
                            placeholder='Search for creators ❤️'>

                        <!-- searched users -->
                        <div id="searched-users" class="absolute top-10 left-0 right-0 bg-gray-100 dark:bg-gray-500 z-50 rounded-b-lg max-h-60 overflow-y-auto transition duration-500">
                            <div class="text-center py-4 hidden " id="loading-spining">
                                <div role="status">
                                    <svg class="inline mr-2 w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                                    </svg>
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>
                            <div id="searched-users-data">
                            </div>
                        </div>
                    
                    </div>

                </div>

                <div  class="sm:flex hidden items-center space-x-2 -ml-8 md:ml-0 md:space-x-4 col-span-3 justify-self-center">
                    
                        <button id="theme-toggle" type="button" class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5 ">
                            <svg id="theme-toggle-dark-icon" class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
                            <svg id="theme-toggle-light-icon" class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path></svg>
                        </button>
                

                    <div class="shrink-0">
                        <div class="pl-8">
                            <a href="{{route('prof.index',auth()->user()->id)}}">
                                <img src="{{$userProfilePic}}" style="clip-path:circle()" class="w-9">
                            </a>
                        </div>
                    </div>
                
                </div>
                
                <div class="col-span-2 float-right block sm:hidden">
                    <button onclick="this.nextElementSibling.classList.toggle('hidden')" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg  hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                        <span class="sr-only">Open menu</span>
                        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
                    </button>

                    <div class="hidden sm:hidden space-y-4 absolute left-0 bottom-[-191%] w-full bg-slate-200 sm:bg-white rounded-b-md dark:bg-gray-700 z-10 py-4">

                        <div>

                            <div class=" bg-gray-100 dark:bg-gray-500 rounded-lg flex items-center w-11/12 mx-auto  md:w-full relative">
                                <object data="{{asset('images/search.svg')}}"
                                    class="block h-6 w-auto p-3 box-content "></object>
                                <input type="text" autocomplete="off" id="search-creators" class="text-sm lg:text-normal border-none bg-gray-100 dark:bg-gray-500 dark:placeholder:text-white dark:text-white w-full rounded-full focus:ring-0 transition duration-500"
                                    placeholder='Search for creators ❤️'>

                                <!-- searched users -->
                                <div id="searched-users" class="absolute top-10 left-0 right-0 bg-gray-100 dark:bg-gray-500 z-50 rounded-b-lg max-h-60 overflow-y-auto transition duration-500">
                                    <div class="text-center py-4 hidden " id="loading-spining">
                                        <div role="status">
                                            <svg class="inline mr-2 w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                                            </svg>
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                    </div>
                                    <div id="searched-users-data">
                                    </div>
                                </div>
                            
                            </div>

                        </div>

                        <div  class="flex items-center justify-around space-x-2">
                        
                            <button id="theme-toggle-1" type="button" class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5 ">
                                <svg id="theme-toggle-dark-icon-1" class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
                                <svg id="theme-toggle-light-icon-1" class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path></svg>
                            </button>
                    

                            <div class="shrink-0">
                                <div>
                                    <a href="{{route('prof.index',auth()->user()->id)}}">
                                        <img src="{{$userProfilePic}}" style="clip-path:circle()" class="w-12">
                                    </a>
                                </div>
                            </div>
                        
                        </div>

                    </div>

                </div>
                    
            </header>

            <section class="grid grid-cols-12 gap-x-6 my-2 auto-rows-min max-w-screen-2xl mx-auto">
                <!-- side left -->
                <aside class="lg:col-span-3 col-span-2 row-span-2 fixed md:static bottom-0 left-2/4 -translate-x-2/4 md:translate-x-0 md:block w-full md:w-auto z-50 md:z-10">

                    <div class='hidden md:flex items-center justify-center lg:justify-start lg:space-x-5 py-4 lg:pl-4 rounded-2xl mb-4 bg-white dark:bg-slate-700 transition duration-500'>
                        <a href="{{ route('prof.index',auth()->id()) }}" class="shrink-0"><img src="{{$userProfilePic}}"
                                style='clip-path : circle()' class='block h-16 w-auto'></a>
                        <div class="hidden lg:inline-block">
                            <a href="{{ route('prof.index',auth()->id()) }}">
                                <strong class="text-darkText-200 dark:text-white">{{auth()->user()->name}}</strong>
                            </a>
                            <p class='text-gray-400'>{{auth()->user()->email}}</p>
                        </div>
                    </div>


                    <div class='flex flex-row md:flex-col justify-evenly bg-white md:dark:bg-slate-700 dark:bg-slate-800 border-y-[1px] md:border-0 border-slate-600 md:rounded-2xl overflow-hidden transition duration-500'>
                        <a href="{{ route('post.index') }}">

                            <div @class(["bg-gray-200 dark:bg-slate-600 border-l-4 border-blue-600"=> Route::currentRouteName() ==
                                'post.index','flex items-center
                                space-x-3 lg:space-x-8  justify-center lg:justify-start py-6 pl-2 lg:pl-10 px-4 rounded-md  hover:bg-gray-200 dark:hover:bg-slate-600 hover:border-l-4 hover:border-blue-600
                                hover:cursor-pointer transition duration-500']) >
                                <div>
                                    <img src="{{asset('images/home-icon.svg')}}" class="block w-7 md:w-9 lg:w-6" />
                                </div>
                                <span @class(["text-blue-600"=> Route::currentRouteName() ==
                                    'post.index','capitalize','text-darkText-100','font-semibold','dark:text-white','lg:inline-block','hidden'])>home</span>
                            </div>
                        </a>

                        <!-- <div class='flex items-center space-x-3 lg:space-x-8 py-6 pl-2 lg:pl-10 px-4 rounded-md  '>
                            <div>
                                <img src="{{asset('images/explore.svg')}}" class="block w-7 md:w-9 lg:w-6" />
                            </div>
                            <strong class='capitalize ,'text-darkText-100',ont-semibold'>explore</strong>
                        </div> -->

                        <div class='flex items-center space-x-3 lg:space-x-8 py-6 pl-2 lg:pl-10 px-4 rounded-md  justify-center lg:justify-start'>
                            <div class='relative'>
                                <img src="{{asset('images/notify.svg')}}" class="block w-7 md:w-9 lg:w-6" />
                                <span class="flex absolute h-3 w-3 top-0 right-0 -mt-1 -mr-1">
                                    <span
                                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500 "></span>
                                </span>
                            </div>
                            <span class='capitalize text-darkText-100 font-semibold dark:text-white lg:inline-block hidden'>notifications </span>
                        </div>

                        <div class='flex items-center space-x-3 lg:space-x-8 py-6 pl-2 lg:pl-10 px-4 rounded-md  justify-center lg:justify-start'>
                            <div class='relative'>
                                <img src="{{asset('images/messages.svg')}}" class="block w-7 md:w-9 lg:w-6" />
                                <span class="flex absolute h-3 w-3 top-0 right-0 -mt-1 -mr-1">
                                    <span
                                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500 "></span>
                                </span>
                            </div>
                            <span class='capitalize text-darkText-100 font-semibold dark:text-white lg:inline-block hidden'>messages</span>
                        </div>

                        <a href="{{ route('bookmark.index') }}">
                            <div @class(["bg-gray-200 dark:bg-slate-600 border-l-4 border-blue-600"=> Route::currentRouteName() ==
                                'bookmark.index','flex items-center
                                space-x-3 lg:space-x-8  justify-center lg:justify-start py-6 pl-2 lg:pl-10 px-4 rounded-md  hover:bg-gray-200 dark:hover:bg-slate-600 hover:border-l-4 hover:border-blue-600
                                hover:cursor-pointer transition duration-500 ']) >

                                <div>
                                    <img src="{{asset('images/bookmarks.svg')}}" class="block w-7 md:w-9 lg:w-6" />
                                </div>
                                <span @class(["text-blue-600"=> Route::currentRouteName() ==
                                    'bookmark.index','capitalize','text-darkText-100','font-semibold' ,'dark:text-white','lg:inline-block','hidden'])>bookmarks</span>

                            </div>
                        </a>

                        <!-- <div class='flex items-center space-x-3 lg:space-x-8 py-6 pl-2 lg:pl-10 px-4 rounded-md  '>
                            <div>
                                <img src="{{asset('images/theme.svg')}}" class="block  w-8" />
                            </div>
                            <span class='capitalize ,'text-darkText-100',ont-semibold'>theme</span>
                        </div> -->
                        <a href="{{ route('profile.show') }}">
                            <div @class(["bg-gray-200 dark:bg-slate-600 border-l-4 border-blue-600"=> Route::currentRouteName() ==
                                'profile.show','flex items-center
                                space-x-3 lg:space-x-8  justify-center lg:justify-start py-6 pl-2 lg:pl-10 px-4 rounded-md  hover:bg-gray-200 dark:hover:bg-slate-600 hover:border-l-4 hover:border-blue-600
                                hover:cursor-pointer transition duration-500 ']) >
                                <div>
                                    <img src="{{asset('images/settings.svg')}}" class="block w-7 md:w-9 lg:w-6" />
                                </div>
                                <span @class(["text-blue-600"=> Route::currentRouteName() ==
                                    'profile.show','capitalize','text-darkText-100','font-semibold','dark:text-white','lg:inline-block','hidden'])>settings</span>
                            </div>
                        </a>
                    </div>

                    <div class="my-4 hidden  lg:flex justify-center">
                        <a href="{{route('post.create')}}"
                            class="h-auto text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br rounded-full text-lg w-full py-2 text-center font-medium hover:cursor-pointer  hover:bg-white hover:ring-1 hover:ring-indigo-600 transition">create
                            post</a>
                    </div>
                </aside>

                <!-- main  -->
                <main class="lg:col-span-6 lg:row-span-6 md:col-span-10 col-span-12 row-span-9">
                    {{ $slot }}
                </main>

                <!-- side right  -->
                <aside class=" lg:col-span-3 lg:row-span-2 col-span-4 row-span-2 lg:rounded-2xl lg:inline-block hidden">
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

            <footer>
                <hr>
                <p class="text-center text-md py-4 dark:text-white">Copyright @ <time>{{ date("Y") }}</time> Anas. All Rights Reserved ❤️</p>
            </footer>
        </div>

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
                    $('#searched-users-data').html(null)

                    //show spining 
                    $("#loading-spining").removeClass('hidden');

                    let name = ($(this).val()).trim();
                    
                    //remove spining if the field is empty
                    if (!name) {
                         $("#loading-spining").addClass('hidden');
                    }

                    if(name){
                        
                           $.ajax({
                            type: "POST",
                            url: "{{route('users.search')}}",
                            data: {name},
                            success:(result)=>{
                                //remove loading spining
                                 $("#loading-spining").addClass('hidden');

                                // get the user and the insert them as html 
                                result.users.forEach(user => {
                                        $('#searched-users-data').append(`
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
                             
                            },
                            error:()=>{
                                 $("#loading-spining").addClass('hidden');
                                  $('#searched-users').append(`<p class="text-center text-red-600 p-2 font-medium"> ERROR: something went wrong! :(`)
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

            var themeToggleDarkIcon1 = document.getElementById('theme-toggle-dark-icon-1');
            var themeToggleLightIcon1 = document.getElementById('theme-toggle-light-icon-1');

            // Change the icons inside the button based on previous settings
            if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                themeToggleLightIcon1.classList.remove('hidden');
            } else {
                themeToggleDarkIcon1.classList.remove('hidden');
            }

            var themeToggleBtn1 = document.getElementById('theme-toggle-1');

            themeToggleBtn1.addEventListener('click', function() {

                // toggle icons inside button
                themeToggleDarkIcon1.classList.toggle('hidden');
                themeToggleLightIcon1.classList.toggle('hidden');

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

                //show loading page until the page is fully loaded
                $(window).on('load', function () {
                    $('#loading-placeholder').hide();
                    $("#loading-page-toggle").removeClass('hidden');
                })    
            
        </script>
        <script src="https://unpkg.com/flowbite@1.5.1/dist/flowbite.js"></script>
    </body>

</html>
