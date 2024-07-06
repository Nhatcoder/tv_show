 <table class="list_movies_scoll table table-bordered table-hover">
     <thead>
         <tr class=" bg-secondary text-dark fw-bold ">
             <th> STT</th>
             <th> Tên </th>
             <th> Ảnh đại diện </th>
             <th>Tổng số tập </th>
             <th>Thêm tập phim</th>
             <th> Thời lượng </th>
             <th> Danh mục </th>
             <th> Thể loại</th>
             <th> Chất lượng</th>
             <th> Ngôn ngữ</th>
             <th> Hot Slider</th>
             <th> Trạng thái </th>
             <th> Thao tác </th>
         </tr>
     </thead>
     <tbody>
         @foreach ($movies as $key => $item)
             <tr>
                 <td> {{ $key + 1 }} </td>
                 <td> {{ $item->name }} </td>
                 <td><img src="{{ $item->poster_url }}" alt=""> </td>
                 <td>{{ $item->episode_count }}/{{ $item->total_episodes }}</td>
                 <td>
                     @if ($item->episode_count == $item->total_episodes)
                         <button class="btn btn-primary">FULL Tập</button>
                     @else
                         <a href="{{ route('episode.create', ['id' => $item->id]) }}" class="btn btn-success  ">URL</a>
                         <form action="{{ route('add-movie-episode', ['slug' => $item['slug']]) }}" method="POST">
                             @csrf
                             <button type="submit" class="btn btn-primary">API</button>
                         </form>
                     @endif


                 </td>
                 <td>{{ $item->time }}</td>
                 <td>
                     <select style="width: 150px" class="form_change form-select form-control-sm select_category"
                         data-route="{{ route('movie-change-category') }}" data-id="{{ $item->id }}">
                         @foreach ($category as $ct)
                             <option {{ $item->category->id_category == $ct->id_category ? 'selected' : '' }}
                                 value="{{ $ct->id_category }}">
                                 {{ $ct->name }}</option>
                         @endforeach
                     </select>
                 </td>
                 <td>
                     @foreach ($item->movie_genre as $genre)
                         <p class="badge badge-warning d-block m-1">{{ $genre->name }}</p>
                     @endforeach
                 </td>
                 <td>
                     @php
                         $selected_quality = $item->quality == 0 ? 'selected' : '';
                     @endphp
                     <select class="form_change form-select form-control-sm select_quality"
                         data-route="{{ route('movie-change-quality') }}" data-id="{{ $item->id }}">
                         <option {{ $selected_quality }} value="1">HD</option>
                         <option {{ $selected_quality }} value="0">FullHD</option>
                     </select>
                 </td>
                 <td>
                     @php
                         $selected_language = $item->language == 0 ? 'selected' : '';
                     @endphp
                     <select class="form_change form-select form-control-sm select_language"
                         data-route="{{ route('movie-change-language') }}" data-id="{{ $item->id }}">
                         <option {{ $selected_language }} value="1">Vietsub</option>
                         <option {{ $selected_language }} value="0">Thuyết minh
                         </option>
                     </select>
                 </td>
                 <td>
                     @php
                         $selected_hot_slider = $item->hot_slider == 0 ? 'selected' : '';
                     @endphp
                     <select class="form_change form-select form-control-sm select_hot_slider"
                         data-route="{{ route('movie-change-hot-slider') }}" data-id="{{ $item->id }}">
                         <option {{ $selected_hot_slider }} value="1">Hiện</option>
                         <option {{ $selected_hot_slider }} value="0">Ẩn</option>
                     </select>
                 </td>
                 <td>
                     @php
                         $selected_status = $item->status == 0 ? 'selected' : '';
                     @endphp
                     <select class="form_change form-select form-control-sm select_status"
                         data-route="{{ route('movie-change-status') }}" data-id="{{ $item->id }}">
                         <option {{ $selected_status }} value="1">Hiện</option>
                         <option {{ $selected_status }} value="0">Ẩn</option>
                     </select>
                 </td>
                 <td>
                     <div class="d-flex">
                         <a href="{{ route('movie.edit', ['movie' => $item->id]) }}" class="btn btn-primary  ">Sửa</a>
                         <button type="submit" data-id="{{ $item->id }}"
                             class="btn btn-danger btn_delete_movie">Xóa</button>
                     </div>
                 </td>
             </tr>
         @endforeach

     </tbody>
 </table>

 @if (!request()->is('movie-search'))
     <div class="d-flex mt-4 flex-wrap">
         <p class="text-muted">Hiển thị 10 / {{ $movies->total() }}</p>
         <nav class="ml-auto">
             @php
                 $total_pages = $movies->lastPage();
                 $current_page = $movies->currentPage();
                 $start_page = max(1, $current_page - 2);
                 $end_page = min($total_pages, $start_page + 4);
             @endphp

             <ul class="pagination separated pagination-info">
                 <li class="page-item"><a href="{{ $movies->url(1) }}" class="page-link"><i
                             class="icon-control-start"></i></a>
                 </li>
                 <li class="page-item"><a href="{{ $movies->previousPageUrl() }}" class="page-link"><i
                             class="icon-arrow-left"></i></a></li>
                 @for ($i = $start_page; $i <= $end_page; $i++)
                     <li class="page-item {{ $i == $current_page ? 'active' : '' }}"><a href="{{ $movies->url($i) }}"
                             class="page-link">{{ $i }}</a></li>
                 @endfor
                 <li class="page-item"><a href="{{ $movies->nextPageUrl() }}" class="page-link"><i
                             class="icon-arrow-right"></i></a></li>
                 <li class="page-item"><a href="{{ $movies->url($total_pages) }}" class="page-link"><i
                             class=" icon-control-end"></i></a>
                 </li>
             </ul>

         </nav>
     </div>
 @endif
