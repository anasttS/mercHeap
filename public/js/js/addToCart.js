let cart = {};// корзина

window.onload = function() {
   if(localStorage.getItem('cart') != null){
      cart = JSON.parse (localStorage.getItem('cart'));
   }
   let adder = document.getElementById("add");
   adder.onclick = function () {
      cart[adder.getAttribute("data-art")] = 1; //заполняет элемент корзины, соответствующий номеру товара
      localStorage.setItem('cart', JSON.stringify(cart));
   }
};



