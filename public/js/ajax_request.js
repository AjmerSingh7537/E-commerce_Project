/**
 * Created by Ajmer on 2015-04-10.
 */
$(document).ready(function () {
    $('#rating-input').on('rating.change', function () {
        $('#product_rating').val($('#rating-input').val());
    });
});

(function () {
    $('form[data-remote]').on('submit', function (e) {
        var form = $(this);
        var method = form.find('input[name="_method"]').val() || 'POST';
        var url = form.prop('action');

        $.ajax({
            type: method,
            url: url,
            data: form.serialize(),

            success: function (response) {
                $('#' + response.rowid).html(response.subtotal);
            }
        });
        e.preventDefault();
    });

})();

