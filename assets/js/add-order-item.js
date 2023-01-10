var items = document.querySelectorAll('.item')
items.forEach(item => {
   const button = item.querySelector('.add-item')
   button.addEventListener('click', ()=>{
      var data = JSON.parse(button.dataset.itemData);
      data.quantity = item.querySelector('.quantity').value
      localStorage.setItem('order-item-added', JSON.stringify(data));
      history.back()
   })
});