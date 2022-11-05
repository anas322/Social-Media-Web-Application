 <div onclick="previewPost(event,{{ $post->id }})"
     class="toggle-window fixed z-50 w-full right-0 top-0 left-0 bottom-0 " style=" background: rgba(0, 0, 0,0.2);">
     <div class="w-7/12 h-5/6 bg-white absolute rounded-lg left-2/4 top-2/4 -translate-y-2/4 -translate-x-2/4">
         <div class="grid grid-cols-12 h-full">
             <div class="col-span-7 overflow-y-auto">
                 <img src="{{ asset('storage') . '/' . $post->image  }}" class="rounded-xl w-full h-full object-cover">
             </div>

             <div class="col-span-5 p-4 space-y-4 h-full overflow-y-auto relative">
                 <span class="toggle-window absolute right-3 text-lg hover:cursor-pointer">X</span>
                 <div class='flex items-center justify-start space-x-3' style='margin-top:-4px'>
                     <div>
                         <img src="{{ $post->user->profile_photo_path ? asset('storage/' . $post->user->profile_photo_path) : asset('storage') . '/default/default.png' }}"
                             class="w-12" style="clip-path:circle()">
                     </div>
                     <p class='text-slate-800'>{{ $post->user->name }}</p>
                 </div>
                 <hr>
                 <div>
                     <div class=" space-y-5" data-id="{{ $post->id }}">
                        <!-- show the caption first  -->
                        @if($post->caption)
                        <div class='flex items-start justify-start space-x-3'>
                             <div class='pt-1'>
                                 <img src="{{ $post->user->profile_photo_path ? asset('storage/' . $post->user->profile_photo_path) : asset('storage') . '/default/default.png' }}"
                                     class="w-10" style="clip-path:circle()">
                             </div>

                             <div class="flex flex-col space-y-1">
                                 <p class='text-slate-800'>{{ $post->user->name }}<span
                                         class="text-xs pl-4 text-gray-400"> {{ $post->created_at->diffForHumans() }}
                                     </span></p>
                                 <p class="text-md font-serif">{{$post->caption}}</p>
                             </div>
                         </div>
                        @endif 
                         <!-- list all the comments  -->
                         @forelse($post->comments as $comment)
                         <div class='flex items-start justify-start space-x-3'>
                             <div class='pt-1'>
                                 <img src="{{ $comment->user->profile_photo_path ? asset('storage/' . $comment->user->profile_photo_path) : asset('storage') . '/default/default.png' }}"
                                     class="w-10" style="clip-path:circle()">
                             </div>

                             <div class="flex flex-col space-y-1">
                                 <p class='text-slate-800'>{{ $comment->user->name }}<span
                                         class="text-xs pl-4 text-gray-400"> {{ $comment->created_at->diffForHumans() }}
                                     </span></p>
                                 <p class="text-md font-serif">{{$comment->comment_text}}</p>
                             </div>
                         </div>
                         @empty
                         <span class="text-gray-500 text-center block">No Comments 😪</span>
                         @endforelse
                     </div>

                     <div>
                         <hr>
                         <form>
                             <div class='flex items-center justify-between form'>
                                 <input type="hidden" name="postId" value="{{$post->id}}">
                                 <input type="text" name='comment_text' class='w-full border-none focus:ring-0'
                                     placeholder="Add a comment...😊">
                                 <input type="submit" class=' submit-comment text-blue-500 hover:cursor-pointer'
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
