$().ready(function() {
    $('#news-ticker').fadeIn();
    $('#js-news').ticker({
        speed: 0.10,
        htmlFeed: true,
        fadeInSpeed: 600,
        titleText: '',
        controls: false,
        debugMode: false
    });
});
