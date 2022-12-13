$(document).ready(function(){
    $(".addToCartBtn").click(function (){
        var url = "http://localhost/dosyalar/wbodev/cart_db.php";
        var data = {
        p : "addToCart",
        product_id : $(this).attr("product-id")
    }
    $.post(url, data, function (response) {
       $(".cart-count").text(response);
    })
})
    
})
