dragula([document.querySelector('.packets')], {
   moves: (el, source, handle, sibling) => {
      if(!handle.classList.contains('grab-indicator') && !handle.parentNode.classList.contains('grab-indicator')) return false;
      
      var select = el.querySelector('select.item-status-input');
      if(select.value != "in-stock") return false;

      return true;
   }, 
   isContainer: (el) => {
      return el.classList.contains('packet') || el.classList.contains('packets');
   },
})

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

//  var inputPaymentHistory = document.getElementById('order-payment-history')

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

if(localStorage.getItem('order-stored') === null || localStorage.getItem('order-stored') != orderId){
   //Storage is empty, get data from inputs and store in local storage
   localStorage.clear();
   orderInputs.forEach((input, index) => {
      localStorage.setItem(orderDetails[index], JSON.stringify(input.value))
   });
   localStorage.setItem('order-stored', orderId);
}else{
   //Storage is not empty, populate data to dom
   orderDetails.forEach((field, index) => {
      var data = localStorage.getItem(field);
      orderInputs[index].value = JSON.parse(data);
   })

   //Create DOM representing the client
   const client = JSON.parse(JSON.parse(localStorage.getItem('order-client')))
   if(client !== null){
      renderOrderClient(clientContainer, client);
   }

   const addedItem = JSON.parse(localStorage.getItem('order-item-added'))
   if(addedItem !== null){
      renderItem(packetsContainer, addedItem);
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