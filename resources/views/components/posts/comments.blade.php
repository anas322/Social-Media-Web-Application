 <div onclick="previewPost(event,{{ $post->id }})"
     class="toggle-window fixed z-40 w-full right-0 top-0 left-0 bottom-0 " style=" background: rgba(0, 0, 0,0.2);">
     <span
         class="toggle-window absolute right-4 top-2 text-lg hover:cursor-pointer py-1 px-2 rounded-lg transition duration-700 font-bold bg-gray-500/25 hover:bg-gray-500/75 dark:text-white">X</span>
     <div
         class="w-10/12 h-[87%] sm:h-4/6 md:h-5/6 lg:w-9/12 xl:w-7/12 bg-white dark:bg-slate-700  absolute rounded-lg left-2/4 top-[45%] sm:top-2/4 -translate-y-2/4 -translate-x-2/4 shadow-md">
         <div class="grid grid-cols-12 grid-rows-6 auto-rows-min grid-flow-col h-full">
             <div class="sm:col-span-7 col-span-12 sm:row-span-6 row-span-2">
                 <img src="{{ asset('storage') . '/' . $post->image  }}" class="rounded-xl w-full h-full object-cover">
             </div>

             <div class="sm:col-span-5 col-span-12 p-4 space-y-4 h-full sm:row-span-6 row-span-4  ">

                <div class='flex items-center justify-start space-x-3' style='margin-top:-4px'>
                    <div>
                        <a href="{{route('prof.index',$post->user->id)}}">

                            <img src="{{ $post->user->profile_photo_path ? asset('storage/' . $post->user->profile_photo_path) : asset('storage') . '/default/default.png' }}"
                            class="w-9 md:w-12" style="clip-path:circle()">
                        </a>
                    </div>
                    <p class='text-darkText-200 dark:text-white font-semibold text-sm md:text-base'>{{ $post->user->name }}</p>
                </div>
                <hr>
                <div class="h-full">
                    <div class=" space-y-5 mb-3 overflow-y-auto h-[56%] sm:h-[62%] md:h-4/6" data-id="{{ $post->id }}">
                        <!-- list all the comments  -->
                        @forelse($post->comments as $comment)
                        <div class='flex items-start  space-x-3' id="comment">
                            <div class='pt-1 flex-shrink-0'>
                                <a href="{{ route('prof.index',$comment->user->id) }}">
                                    <img src="{{ $comment->user->profile_photo_path ? asset('storage/' . $comment->user->profile_photo_path) : asset('storage') . '/default/default.png' }}"
                                    class="w-10" style="clip-path:circle()">
                                </a>
                            </div>

                            <div class="w-full">
                                <div class="flex flex-col space-y-1">
                                    <div class="flex justify-between">
                                        <div>
                                            <p class='text-darkText-200 dark:text-white font-semibold text-sm md:text-base'>{{ $comment->user->name }}<span
                                                class=" text-[9px] md:text-xs pl-4 text-gray-400  font-normal"> {{ $comment->created_at }}
                                            </span></p>
                                        </div>
                                            
                                        <div>
                                                  
                                            
                                            <div class="relative">
                                                <button onclick="this.nextElementSibling.classList.toggle('hidden')"  class="text-gray-600 dark:text-white  focus:ring-2 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 text-center inline-flex items-center" type="button"><svg class="w-6 h-6 fill-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"></path></svg></button>

                                                <!-- Dropdown menu -->
                                                <div onmouseleave="this.classList.toggle('hidden')" class="hidden absolute -left-8  bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-800 ">
                                                    <ul class="py-1 text-sm text-gray-700 dark:text-gray-200">
                                                        <li>
                                                            <form >
                                                                <input type="hidden" name="commentId" value="{{$comment->id}}">
                                                                <input type="submit" class="delete-comment  hover:cursor-pointer text-sm py-2 px-4 dark:hover:bg-gray-600 text-red-700 capitalize hover:underline hover:underline-offset-2" value="Delete"/>
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>




                                        </div>
                                            
                                    </div>
                                    <p class="text-sm md:text-md font-serif dark:text-white text-darkText-100">{{$comment->comment_text}}</p>

                                </div>
                            </div>
                        </div>
                        @empty
                        <span class="text-gray-500 text-center dark:text-white block">No Comments 😪</span>
                        @endforelse
                    </div>
                

                <div>
                <hr>
                <div class='flex justify-between my-3'>
                    <div class='flex space-x-2 md:space-x-4 md:pl-4'>
                        <div> 
                            <form>
                                <input type="hidden" name="postId" value="{{$post->id}}">

                                <!-- renader the like button based on wheather he liked the post or not -->
                                @if($post->likes->contains('user_id',auth()->id()))
                                <button type="submit" class='submit-widget'>
                                    <x-svg.heart type='unlike' />
                                </button>
                                @else
                                <button type="submit" class='submit-widget'>
                                    <x-svg.heart type='like' />
                                </button>
                                @endif
                            </form>

                        </div>

                        <div onclick="previewPost(event,{{ $post->id }})">
                            <img src="{{asset('images/comments.svg')}}"
                                class="toggle-window block h-8 w-auto hover:cursor-pointer transition-all duration-300 hover:scale-125"></img>
                        </div>

                        <div>
                            <img onclick="this.nextElementSibling.classList.toggle('hidden')"
                                src="{{asset('images/share.svg')}}"
                                class="block h-8 w-auto hover:cursor-pointer hover:scale-125 transition-all duration-300"></img>
                            <!-- share post snippet  -->
                            <div onclick="this.classList.toggle('hidden')"
                                class='hidden fixed top-0 right-0 bottom-0 left-0'
                                style=" background: rgba(0, 0, 0,0.2);">
                                <div
                                    class="w-4/12 h-20 bg-white absolute rounded-lg left-2/4 top-2/4 -translate-y-2/4 -translate-x-2/4">
                                    <div class="h-full">
                                        <div class="flex justify-center items-center h-full">
                                            <div class="px-2 py-1 shadow space-x-4">
                                                <a class="text-sm text-blue-500 hover:underline"
                                                    href="{{ route('post.show',$post->id) }}">{{ route('post.show',$post->id) }}</a>
                                                <button onclick="sharePost('{{ route('post.show',$post->id) }}')"
                                                    class="text-lg text-blue-600 hover:cursor-pointer">Copy</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <form>
                            <input type="hidden" name="postId" value="{{$post->id}}">

                            <!-- renader the bookmark button based on wheather he bookmarked the post or not -->
                            @if($post->bookmarks->contains('user_id',auth()->id()))
                            <button type="submit" class='submit-widget'>
                                <x-svg.bookmark type='unsave' />
                            </button>
                            @else
                            <button type="submit" class='submit-widget'>
                                <x-svg.bookmark type='save' />
                            </button>
                            @endif
                        </form>

                    </div>
                </div>

                <div>
                    <hr>
                    <form>
                        <div class='flex items-center justify-between form mt-4'>
                            <input type="hidden" name="postId" value="{{$post->id}}">
                            <input type="text" autocomplete="off" name='comment_text'
                                class='w-full border-none focus:ring-0 rounded-full dark:text-white bg-gray-50 dark:bg-gray-500 dark:placeholder:text-white '
                                placeholder="Add a comment...😊">
                            <input type="submit"
                                class=' submit-comment text-white hover:cursor-pointer font-semibold ml-2 ring-1 bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br py-2 px-4 rounded-full transition duration-500'
                                value="Post" />
                        </div>
                        <span class='error text-red-600 text-sm'></span>
                    </form>
                </div>
                </div>
                </div>
            </div>

         </div>
     </div>
 </div>
