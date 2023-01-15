var items = document.querySelectorAll('.item')
items.forEach(item => {
   const button = item.querySelector('.add-item')
   button.addEventListener('click', ()=>{
      var data = JSON.parse(button.dataset.itemData);
      data.quantity = item.querySelector('.quantity').value
      var orderItems = JSON.parse(localStorage.getItem('order-items')) ?? [];
      var isAlreadyInBasket = false;
      orderItems.forEach(orderItem => {
         if(orderItem.id_item == data.id_item){
            orderItem.quantity = parseInt(orderItem.quantity) + parseInt(data.quantity);
            isAlreadyInBasket = true;
         }
      })
      if(!isAlreadyInBasket) orderItems.push(data);

      localStorage.setItem('order-items', JSON.stringify(orderItems));
      history.back()
   })
});