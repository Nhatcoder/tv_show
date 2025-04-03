 <div class="list-comment">
     <ul class="list_comment mt-4 text-white">
         <li class="list_comment__item d-flex justify-content-between align-items-start">
             <div class="d-flex">
                 <div class="image_comment">
                     <img src="{{ filter_var($commentNew->user->avatar, FILTER_VALIDATE_URL) ? $commentNew->user->avatar : asset('images/images/user.png') }}"
                         alt="">
                 </div>

                 <div class="action_comment">
                     <div class="info_comment">
                         <p class="info_comment_title">{{ $commentNew->user->name }} <span
                                 class="info_comment_time">{{ $commentNew->created_at }}</span></p>
                         <p class="info_comment_content">
                             {{ $commentNew->comment }}
                         </p>
                     </div>

                     <div class="action_link mt-2">
                         <button class="btn-link--comment">
                             {{-- <i class="fa-solid fa-thumbs-up"></i> --}}
                             <i class="fa-regular fa-thumbs-up"></i>
                             5
                         </button>

                         <button class="btn-link--comment">
                             {{-- <i class="fa-solid fa-thumbs-down"></i> --}}
                             <i class="fa-regular fa-thumbs-up fa-rotate-180"></i>
                             5
                         </button>

                         <button class="btn-link--comment">
                             Phản hồi
                         </button>



                     </div>

                 </div>
             </div>

             <div class="action_comment__btn">
                 <i class="fa-solid fa-ellipsis-vertical"></i>
             </div>
         </li>
     </ul>

 </div>
