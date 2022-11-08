@props(['post'])


    <article class="space-y-4 p-4 bg-white rounded-2xl">
        <!-- header part  -->
        <div class="flex space-x-4">
            <div>
                <a href="{{route('prof.index',$post->user)}}">
                    <img src="{{ $post->user->profile_photo_path ? asset('storage/' . $post->user->profile_photo_path) : asset('storage') . '/default/default.png' }}"
                    style="clip-path:circle()" class="w-12">
                </a>
            </div>

            <div>
                <p><strong class='text-lg text-darkText-200'>{{$post->user->name}}</strong></p>
                <small class="text-gray-500 font-semibold">{{$post->created_at}}</small>
            </div>
        </div>

        <!-- caption  -->
        <div>
            @if(Str::length($post->caption) <= 150) <p class="text-darkText-100">
                {{ $post->caption}}
                </p>

                @else
                <p class="text-gray-900">
                    {{ Str::substr($post->caption, 0, 150) }} <span
                        onclick="expandCaption(event,`{{ $post->caption }}`)"
                        class='text-gray-500 hover:cursor-pointer'>...view more
                    </span>
                </p>
                @endif
        </div>

        <!-- picture  -->
        <div>
            <img onclick="previewPost(event,{{$post->id}})" src="{{ asset('storage') . '/' . $post->image  }}"
                class="toggle-window rounded-xl w-full max-h-96 object-cover">
        </div>

        <!-- love, comment, share, bookmark, section -->
        <div class='flex justify-between'>
            <div class='flex space-x-4 pl-4'>
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
                    <div onclick="this.classList.toggle('hidden')" class='hidden fixed top-0 right-0 bottom-0 left-0'
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

        <!-- love list section  -->
        @if($post->likes->count())
        <div class='flex items-center space-x-2 '>
            <!-- 3 picture first  -->
            <div class='flex items-center pl-5'>
                @foreach($post->likes as $like)
                @if($loop->count >=4)
                @break
                @endif
                <div class=' -ml-4 p-1'>
                    <div style="clip-path:circle()">
                        <img src="{{ $like->user->profile_photo_path ? asset('storage/' . $like->user->profile_photo_path) : asset('storage') . '/default/default.png' }}"
                            class="w-7">
                    </div>
                </div>
                @endforeach
            </div>
            
            <p class='text-lg text-darkText-100'>liked by @if( $post->likes->first()->user->name ?? null)
                <strong class="text-darkText-200">{{ $post->likes->first()->user->name }}</strong>@endif

                @if($post->likes->count() >= 2)
                and <strong class="text-darkText-200"> {{$post->likes->count() - 1}} others </strong>
            </p>
            @endif
        </div>
        @endif
        
        <!-- view comment section  -->

        <div>
            @if($post->comments->count())
            <span onclick="previewPost(event,{{$post->id}})"
                class='toggle-window text-gray-400 text-sm hover:cursor-pointer'>view {{ $post->comments->count() }} {{Str::plural('comment', $post->comments->count() )}} </span>
            @endif
            <div class="hidden" data-id="{{ $post->id }}">
                <x-posts.comments :$post />
            </div>

        </div>


        <!-- add comment section  -->

        <div id="comment-section">
            <hr>
            <form>
                <div class='flex items-center justify-between pt-2 form'>
                    <input type="hidden" name="postId" value="{{$post->id}}">
                    <input type="text" name='comment_text' class='w-full border-none focus:ring-0 rounded-full bg-gray-50'
                        placeholder="Add a comment...😊">
                    <input type="submit" class=' submit-comment  text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br rounded-full text-lg px-4 py-2 ml-2 font-medium hover:cursor-pointer  hover:bg-white hover:ring-1 hover:ring-indigo-600 transition' value="Post" />
                </div>
                <span class='error text-red-600 text-sm'></span>
            </form>
        </div>

    </article>
