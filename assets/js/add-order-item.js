var items = document.querySelectorAll('.item')
items.forEach(item => {
   const button = item.querySelector('.add-item')
   button.addEventListener('click', ()=>{
      var data = JSON.parse(button.dataset.itemData);
      data.quantite = item.querySelector('.quantite').value
      var orderItems = JSON.parse(localStorage.getItem('order-items')) ?? [];
      var isAlreadyInBasket = false;
      orderItems.forEach(orderItem => {
         if(orderItem.id_item == data.id_item){
            orderItem.quantite = parseInt(orderItem.quantite) + parseInt(data.quantite);
            isAlreadyInBasket = true;
         }
      })
      data.operation = isAlreadyInBasket ? "update" : "insert";
      if(!isAlreadyInBasket) orderItems.push(data);
      localStorage.setItem('order-items', JSON.stringify(orderItems));
      localStorage.setItem('do-not-clear-cache', true);
      history.back()
   })
});