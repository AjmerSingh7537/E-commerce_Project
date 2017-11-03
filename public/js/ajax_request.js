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
                $('#total').html(response.total);
            }
        });
        e.preventDefault();
    });

})();

(function () {
    $('form[selectedCategory]').on('change', function (e) {
        var form = $(this);
        var method = form.find('input[name="_method"]').val() || 'POST';
        var url = form.prop('action');

        $.ajax({
            type: method,
            url: url,
            data: form.serialize(),

            success: function (response) {
                object = JSON.parse(response);
                $('#testing').html("");
                $.each(object, function (key, value) {
                    $('#testing').append(
                        "<div class='col-sm-6 col-lg-3 col-md-4'>" +
                            "<div class='thumbnail'>" +
                                "<img src='img/products/" + value.image + "' alt=''>" +
                                "<div class='caption'>" +
                                    "<h4 class='pull-right'>" + value.price + "</h4>" +
                                    "<h4><a href='products/" + value.slug + "'>" + value.product_name + "</a>" + "</h4>" +
                                    "<p>" + value.description + "</p>" +
                                "</div>" +
                                "<div class='ratings'>" +
                                    "<p class='pull-right'>" + value.rating_count + " reviews</p>" +
                                    "<p>" +
                                        getRating(value.rating_cache) +
                                    "</p>" +
                                "</div>" +
                            "</div>" +
                        "</div>");
                });
            }
        });
        e.preventDefault();
    });

    function getRating(num){
        var test = "";
        for (var i = 0; i < num; i++) {
            test += "<span class='glyphicon glyphicon-star'></span>";
        }
        for (var i = 0; i < 5-num; i++){
            test += "<span class='glyphicon glyphicon-star-empty'></span>";
        }
        return test;
    }

})();
