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
const itemTotalPriceSpan = document.getElementById('items-total-price');
const servicePriceSpan = document.getElementById('service-fee-price');
const shippingPriceSpan = document.getElementById('shipping-fee-price');
const totalSpan = document.getElementById('order-total-span');
const remainingSpan = document.getElementById('order-remaining-span');
const paymentInstances = document.querySelectorAll('.payment-instance');

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

const doNotClearCache = localStorage.getItem('do-not-clear-cache');
if(doNotClearCache == null){
   //Clear cache
   localStorage.clear();
   localStorage.setItem('order-stored', orderId ?? "newOrder");
   inputsToStorage();
   renderPrice();
   attachListenersToOrderItems();
}else{
   localStorage.removeItem('do-not-clear-cache')
   storageToInputs();
   renderItems();
   if(formAction == "edit"){
   }else if(formAction == "add"){
   }else{
      history.back();
   }
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
   //Get and store order items
   let orderItems = [];
   document.querySelectorAll('.item').forEach(e => {
      var data = JSON.parse(e.dataset.itemData);
      orderItems.push(data);
   })
   localStorage.setItem('order-items', JSON.stringify(orderItems))
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
   JSON.parse(localStorage.getItem('order-items')).forEach(item => {
      renderItem(packetsContainer, item)
   });
   
   attachListenersToOrderItems();

   renderPrice();
}

function attachListenersToOrderItems(){
   packetsContainer.querySelectorAll('.item').forEach(e => {
      const quantityInput = e.querySelector('.item-quantite-input');
      const itemIdInput = e.querySelector('.item-id-input');
      quantityInput.addEventListener('change' , () => updateItem(itemIdInput.value, quantityInput.value))
      e.querySelector('.delete-item').addEventListener('click', () => removeItem(itemIdInput.value))
   })
}

function renderPrice(){
   var sommeItems = 0, total;
   JSON.parse(localStorage.getItem('order-items')).forEach(item => {
      sommeItems += parseFloat(item.quantite) * parseFloat(item.prix_effectif);
   });
   itemTotalPriceSpan.textContent = sommeItems.toFixed(2);
   var servicePrice = parseFloat(inputServiceFee.value);
   var shippingPrice = parseFloat(inputShippingFee.value);

   servicePriceSpan.textContent = servicePrice.toFixed(2);
   shippingPriceSpan.textContent = shippingPrice.toFixed(2);
   total = sommeItems + servicePrice + shippingPrice;
   totalSpan.textContent = (total).toFixed(2);
   
   //Reste à payer
   var paid = 0;
   paymentInstances.forEach(instance => {
      paid += parseFloat(instance.dataset.amount);
   })
   remainingSpan.textContent = (total - paid).toFixed(2)
}

function updateItem(id, quantite){
   var orderItems = JSON.parse(localStorage.getItem('order-items'));
   orderItems.forEach(e => {
      if(e.id_item == id) e.quantite = quantite;
   })
   localStorage.setItem('order-items', JSON.stringify(orderItems));
   renderItems()
}

function removeItem(id){
   var orderItems = JSON.parse(localStorage.getItem('order-items'));
   localStorage.setItem('order-items', JSON.stringify(orderItems.filter(e => e.id_item != id)));
   renderItems();
}