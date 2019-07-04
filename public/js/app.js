$(document).ready(function () {
    $('div.table-pagination select.per-page').change(function () {
        window.location = $(this).data('uri') + '?limit=' + $(this).val();
    });

    $('select#category-expense-filter').change(function () {
        $('select#subcategory-expense-filter option').remove();
        $('select#subcategory-expense-filter').attr('disabled', 'disabled').prepend($("<option />").val('').text('Subcategory'));
    });
});
