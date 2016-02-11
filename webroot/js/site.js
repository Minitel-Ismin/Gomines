/*
$(window).scroll(function() {
    //get window height
    var height = $(this).height();
    //get current scroll
    var scrollTop = $(this).scrollTop();
    //if scroll is less than window height we are still in the first part of the page
    if(scrollTop <= height) {
        //if true, animate the page scroll down
        $('html, body').animate({
            scrollTop: $(".main").offset().top
        }, 1000, 'easeOutQuint', function() {
            //once we have run the animation, make it possible to scroll up normally
            if(!isComplete) {
                isComplete = true; 
            }
        });
    } 
});
*/

var movies = 0;

$(".movie").hover(function(e){
    movie = $(e.target).parent();
    if(typeof movies == 'number'){
        movies = [];
    }
    id = movie.attr("data-key");
    if(typeof movies[movie.attr("data-key")] == 'undefined'){
        url = movie.attr("data-ajax");
        fetchFilmMeta(id, url);
    }
    viewFilmMeta(movies[id]);
});

function fetchFilmMeta(id, url){
    $.ajax({
        url: url
    }).done(function(e){
        movies[id] = e;
        viewFilmMeta(movies[id]);
    });
};

function viewFilmMeta(movie){
    if(typeof movie == "undefined")
        return;
    $("#titre").text(movie.titleVF);
    $("#synopsis").text(movie.synopsis);
};

$(function(){
    if($("tr.movie").length != 0)
        $($("tr.movie td")[0]).trigger('mouseenter');
});
