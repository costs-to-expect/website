$(document).ready(function () {
    $('div.table-pagination select.per-page').change(function () {
        window.location = $(this).data('uri') + '?limit=' + $(this).val();
    });

    let category_selector = 'select#category-expense-filter';

    $(category_selector).change(function () {

        let value = $(category_selector).val();
        let subcategory_selector = 'select#subcategory-expense-filter';

        if (value !== $(this).val()) {
            $(subcategory_selector).attr('disabled', 'disabled');
        } else {
            if ($(subcategory_selector).attr('disabled') !== undefined) {
                $(subcategory_selector).removeAttr('disabled');
            }
        }
    });
});
