<div class="item" data-item-data="<?= htmlspecialchars(json_encode($value)) ?>">
   <div class="item-details">
      <img class="item-photo" src="<?= $value['photo'] ?>" alt="<?= $value['name_item'] ?>">
      <div class="item-middle">
         <p class="item-name"><?= $value['name_item'] ?></p>
         <p>Unité: <?= $value['prix_de_vente'] ?>€ | Promotion: aucune</p>
      </div>
      <div class="item-right">
         <div>
            <span><?= $itemStatuses[$value['status']]; ?></span>
            <select class="item-order-status-input" name="basket-item-status-input-<?= $value['id_item'] ?>">
               <?php foreach ($itemOrderStatuses as $raw => $formatted) : ?>
                  <option <?= $raw == $value['item_order_status'] ? "selected" : "" ?> value="<?= $raw ?>"><?= $formatted ?></option>
               <?php endforeach; ?>
            </select>
         </div>
         <div class="item-right-bottom">
            <p>Quantité : </p>
            <input class="item-quantite-input" name="basket-item-quantite-<?= $value['id_item'] ?>" type="number" min="0" step="1" value="<?= $value['quantite'] ?>">
            <input class="item-id-input" name="basket-item-id-<?= $value['id_item'] ?>" type="hidden" value="<?= $value['id_item'] ?>">
            <input class="item-price-input" name="basket-item-price-<?= $value['id_item'] ?>" type="hidden" value="<?= $value['prix_de_vente'] ?>">
            <input class="item-operation-input" name="basket-item-operation-<?= $value['id_item'] ?>" type="hidden" value="update">
            <p>Total: <?=  $value['item_order_status'] == "free-gift" ? "0.00" : ($value['quantite'] * $value['prix_de_vente']) ?>€</p>
            <button onclick="javascript:removeItem(<?= $value['id_item'] ?>)" class="delete-item" type="button">Supprimer de la commande</button>
         </div>
      </div>
   </div>
</div>