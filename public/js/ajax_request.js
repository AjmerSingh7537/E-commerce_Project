/**
 * Created by Ajmer on 2015-04-10.
 */
$(document).ready(function () {
    $('#rating-input').on('rating.change', function() {
        $('#product_rating').val($('#rating-input').val());
    });
    //$('#add_category').submit(function(e) {
    //    e.preventDefault();
    //    var category_name = $('#category_name').val();
    //    if($.trim(category_name) != '')
    //    {
    //        $.ajax({
    //           type: "POST",
    //            url: '/categories',
    //            data: category_name,
    //            cache: false,
    //            success: function(data){
    //                return data;
    //            }
    //        });
    //    }
    //});
    //$('input#submit_button').on('click', function(e){
    //    e.preventDefault();
    //    var comment = $('#comment').val();
    //    var ratings = $('#product_rating').val();
    //    if($.trim(comment) != '' && $.trim(ratings) != '' && $.trim(ratings) != 0){
    //        $.post('../reviews', function(data) {
    //            alert(data);
    //        });
    //    }
    //});
    //$('#add_review').submit(function(e){
    //    e.preventDefault();
    //    var comment = $('#comment').val();
    //    var ratings = $('#product_rating').val();
    //    var product_id = $('#product_id').val();
    //    if($.trim(comment) != '' && $.trim(ratings) != '' && $.trim(ratings) != 0) {
    //        $.post('../reviews', {product_id: product_id,comment: comment, ratings: ratings}, function(data){
    //
    //        });
    //    }
    //});
});
