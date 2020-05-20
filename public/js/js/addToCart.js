let cart = {};// корзина

window.onload = function() {
   if(localStorage.getItem('cart') != null){
      cart = JSON.parse (localStorage.getItem('cart'));
   }
   let adder = document.getElementsByClassName("add");
   for(let i = 0; i < adder.length; i++) {
      adder[i].onclick = function () {
         cart[adder[i].getAttribute("data-art")] = 1; //заполняет элемент корзины, соответствующий номеру товара
         localStorage.setItem('cart', JSON.stringify(cart));
      }
   }
};



