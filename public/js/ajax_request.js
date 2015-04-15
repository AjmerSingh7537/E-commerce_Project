/**
 * Created by Ajmer on 2015-04-10.
 */
$(document).ready(function () {
    $('#rating-input').on('rating.change', function() {
        $('#product_rating').val($('#rating-input').val());
    });
});
