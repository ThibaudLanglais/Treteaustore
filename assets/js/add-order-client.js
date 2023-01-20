var buttons = document.querySelectorAll('.add-client')

buttons.forEach(button => {
   button.addEventListener('click', ()=>{
      localStorage.setItem('order-client', JSON.stringify(button.dataset.clientData));
      localStorage.setItem('do-not-clear-cache', true);
      history.back()
   })
});