<x-layouts.layout :$userProfilePic>
    <!-- create post -->
    <div class="flex flex-col space-y-3 mb-4 px-4 py-3 bg-white rounded-lg box-border max-h-96  transition-all duration-1000 ">
        <form id="create-post" >
            <div class="flex items-center box-border space-x-2">
                <div>
                    <img src="{{$userProfilePic}}" style="clip-path:circle()" class="w-12">
                </div>

                <textarea class="w-full focus:ring-0 resize-none align-center rounded-full border-none h-10"
                    name="caption" placeholder="What's in your mind?" id="caption"></textarea>

                <div>
                    <label for="file-upload" class="custom-file-upload">
                        <img src="{{ asset('images/upload-image.svg') }}" class="w-12 hover:cursor-pointer">
                    </label>
                    <input  type="file" id="file-upload" name="image"
                        class="absolute w-px h-px p-0 -m-px overflow-hidden border-0" style="clip:rect(0,0,0,0)" />
                </div>

                <input type="submit" name="upload"
                    class="h-auto text-white bg-indigo-600 rounded-full text-lg px-8 py-2 font-medium hover:cursor-pointer hover:text-indigo-600 hover:bg-white hover:ring-1 hover:ring-indigo-600 transition"
                    value="Post" />

            </div>
        </form>

        <div class="relative hidden" id="temporaryImageWrapper">
            <img  id="temporaryImage"  src=""
            class="rounded-md  object-cover w-full max-h-72 "><span id="deleteTemporaryImage" class="absolute right-4 top-2 text-lg hover:cursor-pointer py-1 px-2 rounded-lg transition duration-700 font-bold text-white bg-gray-500/70 ">X</span></img>
        </div>
            
    </div>

    <!-- posts  -->
    <div class="space-y-4">

        @foreach($posts as $post)
        <x-posts.post :$post />
        @endforeach
        {{ $posts->links() }}

    </div>

    <x-slot:scripts>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

        <script>
            $(document).ready(function () {
                //set the csrf token
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                    }
                });
                
                //create the post reqest
                
                $('#create-post').on('submit', function (e) {
                    e.preventDefault();
                    $.ajax({
                        type: "POST",
                        url: "{{route('post.store')}}",
                        data: new FormData(this),
                        dataType:'JSON',
                        processData: false,
                        cache:false,
                        contentType: false,
                        complete:(xhr)=>{
                            if(xhr.status == 200 && xhr.statusText == 'OK'){
                                temporaryImage();
                                $("#caption").val("");
                            }else{
                                console.log("somthing wrong occured"); //error handle
                            }
                        }
                    });

                });

                $("#file-upload").on('change',function (e){
                    const file = e.target.files[0];
                    document.querySelector("#temporaryImage").src = URL.createObjectURL(file)
                     $("#temporaryImageWrapper").removeClass('hidden');
                })

                $("#deleteTemporaryImage").click(()=>{
                   temporaryImage();
                })

                const  temporaryImage = () =>{
                    //delete the temporary file upload and hide the empty element
                    $("#file-upload").val(null);
                    document.querySelector("#temporaryImage").src = "";
                    $("#temporaryImageWrapper").addClass('hidden');
                }

                $(".submit-widget").click(function (e) {
                    e.preventDefault();
                    const postdata = $(this).parent().serializeArray();

                    //toggle the bookmark icon
                    const src = $(this).children("img").attr("src")
                    const data = replaceSVG(src);

                    $(this).children("img").attr("src", data.newSrc)

                    // send the request if the url is defined
                    const newUrl = data.url
                    if (newUrl != undefined) {
                        $.ajax({
                            type: "POST",
                            url: newUrl,
                            data: {
                                postId: postdata[0].value
                            },
                            success: (result) => {
                                console.log(result.success);

                            }
                        });
                    }
                })


                function replaceSVG(src) {
                    let newSrc, url;

                    if (src.search("-save") != -1) {
                        newSrc = src.replace('-save', '-unsave')
                        url = "{{ route('bookmark.store') }}";
                    } else if (src.search("-unsave") != -1) {
                        newSrc = src.replace('-unsave', '-save');
                        url = "{{ route('bookmark.delete') }}";
                    } else if (src.search("-like") != -1) {
                        newSrc = src.replace('-like', '-unlike')
                        url = "{{ route('like.store') }}";
                    } else if (src.search("-unlike") != -1) {
                        newSrc = src.replace('-unlike', '-like');
                        url = "{{ route('like.delete') }}";
                    }

                    return {
                        newSrc,
                        url
                    }

                }



                //get the form data as array of name and value contains url of the route 
                $(".submit-comment").click(function (e) {
                    e.preventDefault();
                    $(this).parents('form').children('span').text(" ")

                    const postdata = $(this).parents('form').serializeArray();

                    $.ajax({
                        type: "POST",
                        url: "{{route('comment.store')}}",
                        data: {
                            postId: postdata[0].value,
                            comment_text: postdata[1].value
                        },
                        success: (result) => {
                            console.log(result.success);

                            $(`div[data-id=${postdata[0].value}]`).append($(` <div class="flex items-start justify-start space-x-3">
                            <div class="pt-1">
                                <img src="${result.imagePath}"
                                    class="w-10" style="clip-path:circle()">
                            </div>

                            <div class="flex flex-col space-y-1">
                                <p class="text-slate-800">${result.comment_user_name}<span
                                        class="text-xs pl-4 text-gray-400"> ${result.comment_created_at}
                                    </span></p>
                                <p class="text-md font-serif">${result.comment_text}</p>
                            </div>
                        </div>`))
                        },
                        error: (result) => {
                            $(this).parents('form').children('span').text(result
                                .responseJSON.message)
                        }
                    });


                });
            });

            function previewPost(event, id) {
                let ele = event.target
                if (ele.classList.contains('toggle-window')) {
                    $("div").find(`[data-id='${id}']`)[0].classList.toggle('hidden');
                }
            }

            function expandCaption(event, caption) {
                let parent = event.target.parentElement;

                parent.innerHTML = caption;
            }

            function sharePost(link) {
                navigator.clipboard.writeText(link)
            }

        </script>

        </x-slot>

</x-layouts.layout>
