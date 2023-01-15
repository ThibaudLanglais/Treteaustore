// dragula([document.querySelector('.packets')], {
//    moves: (el, source, handle, sibling) => {
//       if(!handle.classList.contains('grab-indicator') && !handle.parentNode.classList.contains('grab-indicator')) return false;
//       var select = el.querySelector('select.item-status-input');
//       if(select.value != "in-stock") return false;

//       return true;
//    }, 
//    isContainer: (el) => {
//       return el.classList.contains('packet') || el.classList.contains('packets');
//    },
// })

const orderId = new URLSearchParams(location.href).get('id');
 var inputOrderDate = document.getElementById('order-date')
 var inputShippingDate = document.getElementById('order-shipping-date')
 var inputEta = document.getElementById('order-eta')
 var inputStatus = document.getElementById('order-status')
 var inputNote = document.getElementById('order-note')
 var inputShippingFee = document.getElementById('order-shipping-fee')
 var inputServiceFee = document.getElementById('order-service-fee')
 var clientContainer = document.querySelector('.order-client-info')
 var inputItems = document.getElementById('order-items')
 var packetsContainer = document.querySelector('.packets')
 const form = document.querySelector('form');
 const formAction = form.dataset.action;
 const totalSpan = document.getElementById('order-total-span');

var orderDetails = [
   "order-date",
   "order-shipping-date",
   "order-eta",
   "order-status",
   "order-note",
   "order-shipping-fee",
   "order-service-fee"
];

const orderInputs = [
   inputOrderDate,
   inputShippingDate,
   inputEta,
   inputStatus,
   inputNote,
   inputShippingFee,
   inputServiceFee
]

if(formAction == "edit"){
   const isNewEdit = localStorage.getItem('order-stored') === null || localStorage.getItem('order-stored') != orderId;
   if(isNewEdit){
      localStorage.clear();
      localStorage.setItem('order-stored', orderId);
      inputsToStorage();
      localStorage.setItem('order-items', JSON.stringify([]));
   }else{
      storageToInputs();
      renderItems();
   }
}else if(formAction == "add"){
   const hasAddStarted = localStorage.getItem('order-stored') === "newOrder";
   if(hasAddStarted){
      storageToInputs();
      renderItems();
   } else{
      localStorage.clear();
      localStorage.setItem('order-stored', "newOrder");
   }
}else{
   history.back();
}


orderInputs.forEach((input, index) => {
   input.addEventListener('change', (e)=>{
      localStorage.setItem(orderDetails[index], JSON.stringify(input.value))

      if(input.name == "order-date"){
         inputShippingDate.min = input.value;
      }
      if(input.name == "order-shipping-date"){
         inputEta.min = input.value;
      }
   })
})

function inputsToStorage(){
   orderInputs.forEach((input, index) => {
      localStorage.setItem(orderDetails[index], JSON.stringify(input.value))
   });
}

function storageToInputs(){
   orderDetails.forEach((field, index) => {
      var data = localStorage.getItem(field);
      orderInputs[index].value = JSON.parse(data);
   })

   const client = JSON.parse(JSON.parse(localStorage.getItem('order-client')))
   if(client !== null){
      renderOrderClient(clientContainer, client);
   }
}

function renderItems(){
   packetsContainer.innerHTML = "";
   var somme = 0;
   JSON.parse(localStorage.getItem('order-items')).forEach(item => {
      renderItem(packetsContainer, item)
      somme += item.quantity * item.prix_de_vente;
   });
   packetsContainer.querySelectorAll('.item').forEach(e => {
      const quantityInput = e.querySelector('.item-quantity-input');
      const itemIdInput = e.querySelector('.item-id-input');
      quantityInput.addEventListener('change' , () => updateItem(itemIdInput.value, quantityInput.value))
      e.querySelector('.delete-item').addEventListener('click', () => removeItem(itemIdInput.value))
   })

   totalSpan.innerHTML = somme;
}

function updateItem(id, quantity){
   var orderItems = JSON.parse(localStorage.getItem('order-items'));
   orderItems.forEach(e => {
      if(e.id_item == id) e.quantity = quantity;
   })
   localStorage.setItem('order-items', JSON.stringify(orderItems));
   renderItems()
}

function removeItem(id){
   var orderItems = JSON.parse(localStorage.getItem('order-items'));
      localStorage.setItem('order-items', JSON.stringify(orderItems.filter(e => e.id_item != id)));
   renderItems()
}