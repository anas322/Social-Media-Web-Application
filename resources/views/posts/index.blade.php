<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Posts - social </title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class='bg-gray-100'>
    <header class='grid grid-cols-12 gap-x-6 px-2 py-3 bg-white rounded-b-lg'>

        <div class='ml-4 col-span-3 flex items-center space-x-1'> <object data="{{asset('images/logo.svg')}}" class="block h-12 w-auto" ></object><span class='text-2xl font-bold'>memes</span></div>

        <div class='col-span-6'>
            <form>
                <div class="bg-gray-100 rounded-full flex items-center w-full">
                    <object data="{{asset('images/search.svg')}}" class="block h-6 w-auto p-3 box-content " ></object>
                    <input type="text" class="border-none bg-gray-100 w-full rounded-full focus:ring-0" placeholder='Search for creators ❤️'>
                </div>
            </form>
        </div>

        <div class='col-span-3'>
            <div class="flex justify-end items-center space-x-16 pr-8">
                <a href="{{route('post.create')}}" class="h-auto text-white bg-indigo-600 rounded-full text-lg px-8 py-2 ">create</a>
                <div>
                    <a href="{{route('prof.index',auth()->user()->id)}}">
                        <img src="{{$userProfilePic}}" style="clip-path:circle()" class="w-9">
                    </a>
                </div>
            </div>
        </div>
        </header>
        
     <section class="grid grid-cols-12 gap-x-6 my-2">
            <!-- side left -->
            <aside class="bg-slate-300 col-span-3 rounded-2xl"></aside>

            <!-- main  -->
            <main class="col-span-6">
                <!-- create post -->
                <div class="mb-4 px-4 py-3 bg-white rounded-full box-border">
                     <form>
                        <div class="flex items-center box-border">
                            <div>
                                <img src="{{$userProfilePic}}" style="clip-path:circle()" class="w-12">
                            </div>
                            <textarea class="w-full focus:ring-0 resize-none align-center rounded-full border-none h-10"  placeholder="What's in your mind?"></textarea>
                            <button type="submit" class="h-auto text-white bg-indigo-600 rounded-full text-lg px-8 py-2">Post</button>
                        </div>
                     </form>   
                </div>

                <!-- posts  -->
                    <div class="space-y-4">
                        @foreach($posts as $post)
                            <article class="space-y-4 p-4 bg-white rounded-2xl">
                                <!-- header part  -->
                                <div class="flex space-x-4">
                                    <div>
                                        <img src="{{ $post->user->profile_photo_path ? asset('storage/' . $post->user->profile_photo_path) : asset('storage') . '/default/default.png' }}" style="clip-path:circle()" class="w-12">
                                    </div>
        
                                    <div>
                                        <p><strong class='text-lg'>{{$post->user->name}}</strong></p>
                                        <small class="text-gray-500 font-semibold">{{$post->created_at->diffForHumans()}}</small>
                                    </div>
                                </div>
        
                                <!-- picture  -->
                                <div>
                                    <img src="{{ asset('storage') . '/' . $post->image  }}" class="rounded-xl w-full">
                                </div>
                                
                                <!-- caption  -->
                                <div>
                                    <p class="text-sm text-gray-600 font-semibold"> <strong class="text-base text-black pr-2">{{$post->user->name}}</strong>{{$post->caption}}</p>
                                </div>
                            </article>
                        @endforeach
                        {{ $posts->links() }}
                    </div> 
               
            </main>

            <!-- side right  -->
            <aside class="bg-slate-300 col-span-3 rounded-2xl"></aside>
        </section>
</body>
</html>