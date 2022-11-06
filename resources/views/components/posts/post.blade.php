@props(['post'])


    <article class="space-y-4 p-4 bg-white rounded-2xl">
        <!-- header part  -->
        <div class="flex space-x-4">
            <div>
                <img src="{{ $post->user->profile_photo_path ? asset('storage/' . $post->user->profile_photo_path) : asset('storage') . '/default/default.png' }}"
                    style="clip-path:circle()" class="w-12">
            </div>

            <div>
                <p><strong class='text-lg'>{{$post->user->name}}</strong></p>
                <small class="text-gray-500 font-semibold">{{$post->created_at->diffForHumans()}}</small>
            </div>
        </div>

        <!-- caption  -->
        <div>
            @if(Str::length($post->caption) <= 150) <p class="text-gray-900">
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

            <p class='text-lg'>liked by @if( $post->likes->first()->user->name ?? null)
                <strong>{{ $post->likes->first()->user->name }}</strong>@endif

                @if($post->likes->count() >= 2)
                and <strong> {{$post->likes->count() - 1}} others </strong>
            </p>
            @endif
        </div>

        <!-- view comment section  -->

        <div>
            <span onclick="previewPost(event,{{$post->id}})"
                class='toggle-window text-gray-400 text-sm hover:cursor-pointer'>view all 45
                comments</span>

            <div class="hidden" data-id="{{ $post->id }}">
                <x-posts.comments :$post />
            </div>

        </div>


        <!-- add comment section  -->

        <div>
            <hr>
            <form>
                <div class='flex items-center justify-between pt-2 form'>
                    <input type="hidden" name="postId" value="{{$post->id}}">
                    <input type="text" name='comment_text' class='w-full border-none focus:ring-0 rounded-full bg-gray-50'
                        placeholder="Add a comment...😊">
                    <input type="submit" class=' submit-comment text-blue-500 hover:cursor-pointer font-semibold ml-4' value="Post" />
                </div>
                <span class='error text-red-600 text-sm'></span>
            </form>
        </div>

    </article>
