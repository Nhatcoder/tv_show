$(document).ready(function () {
    $('#search').on('input', function () {
        $("#header_search__list").css("display", "none");
        var search = $(this).val().trim().toLowerCase();
        var data_url = $(this).attr("data-url");
        $("#header_search__list").empty();

        if (search !== "") {
            $.getJSON("/json/movies.json", function (data) {
                var filterMovies = data.filter(function (movie) {
                    // return movie.name.toLowerCase().indexOf(search) > -1;
                    return movie.name.toLowerCase().includes(search);
                });

                $("#header_search__list").css("display", "block");
             
                filterMovies.forEach(function (movie) {
                    $("#header_search__list").append(
                        ` <li>
                                 <a href="${data_url}/tim-kiem-link/${movie.slug}" class="header_search__list-link">${movie.name}</a>
                             </li>`
                    );
                });
            });
        }
    });
});
