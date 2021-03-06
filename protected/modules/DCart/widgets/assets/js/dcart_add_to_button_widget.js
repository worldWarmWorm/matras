/**
 * Script for AddToButtonWidget widget of DCart module
 * 
 * @use DCart.js
 * @use jquery-impromptu.3.2.min.js
 */
// $(document).on("click", ".dcart-add-to-cart-btn", function (e) {
// e.preventDefault();
/**
 * Пример обработчика события onBeforeAddToCart
 * $(document).on("onBeforeAddToCart", ".js-btn-add-to-cart", function(e, result)
 * { let valid=true; ...; result.valid=valid; });
 */
// var result = {};
// $(e.target).trigger('onBeforeAddToCart', [result]);
// if ((typeof (result.valid) == 'undefined') || result.valid) {
//     DCart.add($(this).attr("href"), $(this).attr("data-dcart-attributes"), e);
// }
// });



$(document).on("click", ".dcart-add-to-cart-btn", function (e) {
    e.preventDefault();
    var canBuy = typeof (window.productCanBuy) == "undefined" ? true : window.productCanBuy();
    if (canBuy) {
        DCart.add($(this).attr("href"), $(this).attr("data-dcart-attributes"), e);
    } else {
        e.stopImmediatePropagation();
    }
});