const btn_store = document.getElementById('btn_store');
btn_store.addEventListener("click", function () {
    const product_name = document.getElementById('product_name').value;
    const product_image = document.getElementById('product_image').value;
    const product_quantity = document.getElementById('product_quantity').value;
    const product_regular_price = document.getElementById('product_regular_price').value;
    const product_sale_price = document.getElementById('product_sale_price').value;
    if (!product_name || !product_image || !product_quantity || !product_regular_price || !product_sale_price) {
        alert("Vui lòng không để trống thông tin");
    } else {
        document.getElementById("form_create_product").submit();
    }
})