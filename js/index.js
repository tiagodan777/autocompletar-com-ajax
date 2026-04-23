$(function() {
    var $search = $('#search');
    var $recomendationsBox = $('#recomendationsBox');
    var $recomendations = $('#list');
    
    $recomendationsBox.hide();

    $search.on('focus', function() {
        $recomendationsBox.fadeIn(100);
    });

    $search.on('blur', function() {
        $recomendationsBox.fadeOut(100);
    });

    $search.on('keyup', function(e) {
        var queryString = $search.val().trim();

        var timeout = setTimeout(function() {
            $.get('index.php', {search: queryString}, function(data) {
                if (queryString.length > 0) {
                    $recomendations.empty();
                    var autocompelta = JSON.parse(data)
                    for (var c = 0; c < autocompelta.length; c++) {
                        $recomendations.append('<li><a href="https://www.google.com">' + autocompelta[c].texto + '</a></li>');
                    }
                } else {
                    $recomendations.text('');
                }
            });
        }, 250);
    });
});