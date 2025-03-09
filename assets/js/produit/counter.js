$(document).ready(function () {
    $('.counter-plus').click(function (e) {
        let qty = $(e.currentTarget).siblings('#pl');
        let currentValue = parseInt(qty.val()) || 0;
        qty.val(currentValue + 1); 
    });

    $('.counter-moins').click(function (e) {
        let qty = $(e.currentTarget).siblings('#pl');
        let currentValue = parseInt(qty.val()) || 0;
        if (currentValue > 1) {
            qty.val(currentValue - 1); 
        }
    });
});


let panier = [];

document.getElementById('ajouterbtn').addEventListener('click', function() {
    let productId = document.getElementById('product_id').value;
    let productName = document.getElementById('product_name').value;
    let productPrice = document.getElementById('product_price').value;
    let qty = document.getElementById('pl').value;

    if (qty > 0) {
        panier.push({
            id: productId,
            name: productName,
            price: productPrice,
            quantity: qty
        });

        console.log(panier);

        alert("تم إضافة المنتج إلى السلة!");
    } else {
        alert("الرجاء تحديد كمية صحيحة.");
    }
});

function sendCart() {
    let formData = new FormData();
    panier.forEach((item, index) => {
        formData.append('product_id[' + index + ']', item.id);
        formData.append('product_name[' + index + ']', item.name);
        formData.append('product_price[' + index + ']', item.price);
        formData.append('qty[' + index + ']', item.quantity);
    });

    fetch('panier.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        console.log('ok');
        alert(" ok");
    })
    .catch(error => {
        console.error('ok', error);
    });
}

