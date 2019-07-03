$(document).ready(function () {
    $('div.table-pagination select.per-page').change(function () {
        window.location = $(this).data('uri') + '?limit=' + $(this).val();
    });
});
