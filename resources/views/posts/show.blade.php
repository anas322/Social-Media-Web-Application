<x-layouts.layout :$userProfilePic>
    <!-- post  -->
    <x-posts.post :$post />

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

                //get the form data as array of name and value contains url of the route 
                $(".submit-like").click(function (e) {
                    e.preventDefault();
                    const postdata = $(this).parent().serializeArray();

                    //toggle the heart icon
                    const src = $(this).children("img").attr("src")
                    const data = replaceLikeSVG(src);

                    $(this).children("img").attr("src", data.newSrc)

                    // send the request
                    const newUrl = data.url
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

                });

                function replaceLikeSVG(src) {
                    let newSrc, url;
                    if (src.search("-like") != -1) {
                        newSrc = src.replace('-like', '-unlike')
                        url = "{{ route('like.store') }}";
                    } else {
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

        </script>

        </x-slot>
</x-layouts.layout>
