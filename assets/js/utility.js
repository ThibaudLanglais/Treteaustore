let itemStatusList = [
   {value: "in-stock", name: "En stock"},
   {value: "available", name: "Disponible"},
   {value: "not-available", name: "Non disponible"},
   {value: "out-of-stock", name: "Plus en stock"},
   {value: "free-gift", name: "Offert"},
   {value: "packed", name: "Empaqueté"},
   {value: "dispatched", name: "Envoyé"},
   {value: "arrived", name: "Arrivé"},
   {value: "delivered", name: "Livré"},
   {value: "other", name: "Autre"},
]

let renderItem = (parentNode, itemData) => {
   

   str += `</select>
         </div>
      </div>
   `
   var str = `
   <div class="item">
   <button type="button" class="grab-indicator">
       <span></span>
       <span></span>
   </button>
   <div class="item-details">
       <img class="item-photo" src="https://m1.lmcdn.fr/media/15/5ea83d51b7c50511cc71b219/3241116728/treteau-pvc5ea83d510e25e10009c7a28d.jpg?crop=4:3&format=jpg&width=300" alt="">
       <div class="item-middle">
           <p class="item-name">${itemData.name_item}</p>
           <p>Unité: ${itemData.prix_de_vente}€ | Promotion: aucune</p>
       </div>
       <div class="item-right">
           <select class="item-status-input" name="item-status">
   `
   itemStatusList.forEach(status => {
      str += `
         <option ${status.value === itemData.status.toLowerCase().replaceAll(/ /gi, '-') ? "selected" : ""} value="${status.value}">${status.name}</option>
      `
   })

   str += `</select>
           <div class="item-right-bottom">
               <p>Quantité : </p>
               <input type="number" min="0" step="1" value="${itemData.quantity}">
               <p>Total: ${(itemData.quantity * itemData.prix_de_vente).toFixed(2)}€</p>
               <button type="button">Supprimer de la commande</button>
           </div>
       </div>
   </div>
</div>`
   parentNode.innerHTML += str;
}

let renderOrderClient = (parentNode, clientData) => {
   var createdAt = new Date(clientData.date_created);
   createdAt = createdAt.toLocaleString('fr-fr', {
      year: '2-digit',
      month: "short",
      day: undefined,
      weekday: undefined,
   })
   createdAt = createdAt.split(' ');
   const code = `${createdAt[1]}-${createdAt[0].substring(0, 3)}-${clientData.id_client}`
   parentNode.innerHTML = `
   <p>[${code}] ${clientData.last_name} ${clientData.first_name}</p>
   <input type="hidden" name="order-client-id" value="${clientData.id_client}"/>
   <a href="./?p=edit-client&id=${clientData.id_client}">Voir la fiche</a>
   `
}