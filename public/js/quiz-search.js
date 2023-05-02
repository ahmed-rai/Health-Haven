// public/js/quiz-search.js

$(document).ready(function () {
    const $searchForm = $('#search-form');
    const $quizzesTbody = $('table tbody');

    $searchForm.on('submit', function (event) {
        event.preventDefault();

        const url = $(this).attr('action');
        const data = $(this).serialize();

        $.getJSON(url, data, function (response) {
            $quizzesTbody.html(response.html);
        });
    });

    const $searchInput = $searchForm.find('input[type="text"]');
    $searchInput.on('input', function () {
        $searchForm.trigger('submit');
    });
});
