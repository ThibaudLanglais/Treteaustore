<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Treteaustore | Admin</title>
    <?php include './components/Head.php' ?>
    <link rel="stylesheet" href="./assets/order.css">
    <script src="https://cdn.jsdelivr.net/gh/bevacqua/dragula@3.7.3/dist/dragula.min.js"></script>
    <script src="./assets/js/utility.js" defer></script>
    <script src="./assets/js/order.js" defer></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bevacqua/dragula@3.7.3/dist/dragula.min.css">
</head>

<body>
    <?php 
        include './components/Navbar.php';
        $success;
        if(isset($_POST['submit'])){
            if(!isset($_POST['order-client-id'])){
                $success = false;
                $msg = "Sélectionnez un client";
            }else{
                $result = insertOrder($_POST['order-date'], 
                    $_POST['order-status'], 
                    $_POST['order-shipping-date'],
                    $_POST['order-note'],
                    $_POST['order-service-fee'],
                    $_POST['order-shipping-fee'],
                    $_POST['order-client-id'],
                    $_POST['order-eta'],
                );
                if(!$result){
                    $success = false;
                    $msg = "Erreur lors de la création de la commande";
                    return;
                }

                $orderId = $bdd->lastInsertId();
                
                //Ajouter les items;
                foreach ($_POST as $key => $value) {
                    if(str_contains($key, "basket-item-id-")){
                        $id = $value;
                        $quantity = $_POST['basket-item-quantity-' . $value];
                        $price = $_POST['basket-item-price-' . $value];
                        $result = insertOrderItem($orderId, $id, $price, $quantity);
                        if(!$result) {
                            $success = false;
                            $msg = "Erreur lors de la création de la commande (ajout des items)";
                            return;
                        }
                    }
                }

            }
        }
    ?>
    <main>
        <?php if(isset($success)): ?>
            <div class="form-response form-<?= $success ? "success" : "failure" ?>">
            <p>
            	<?= $msg ?>
            </p>
        </div>    
        <?php endif; ?>
        <div class="h1-group">
            <h1>Ajouter une commande</h1>
        </div>
        <div>
            <form action="./?p=add-order" data-action="add" method="post">
                <div class="columns-2">
                    <div class="label-input-group-1">
                        <label for="order-date">Date de la commande</label>
                        <input required type="date" name="order-date" id="order-date">
                    </div>
                    <div class="label-input-group-1">
                        <label for="order-shipping-date">Date d'expédition</label>
                        <input type="date" name="order-shipping-date" id="order-shipping-date">
                    </div>
                </div>
                <div class="columns-2">
                    <div class="label-input-group-1">
                        <label for="order-eta">Date prévue d'arrivée </label>
                        <input type="date" name="order-eta" id="order-eta">
                    </div>
                    <div class="label-input-group-1">
                        <label for="order-status">Statut de la commande</label>
                        <select required name="order-status" id="order-status">
                            <option value="To buy">A payer</option>
                            <option value="Bought">Payée</option>
                            <option value="Packed">Empaquetée</option>
                            <option value="Shipped">Envoyée</option>
                            <option value="Arrived">Arrivée</option>
                            <option value="Delivered">Livrée</option>
                            <option value="Done">Terminée</option>
                        </select>
                    </div>
                </div>
                <div class="columns-2">
                    <div class="label-input-group-1">
                        <label for="order-note">Note</label>
                        <textarea name="order-note" id="order-note" cols="30" rows="10"></textarea>
                    </div>
                    <div class="label-input-group-1">
                        <p for="">Frais</p>
                        <div class="label-input-group-2">
                            <label for="order-shipping-fee">Livraison</label>
                            <input min="0" step="0.01" type="number" name="order-shipping-fee" id="order-shipping-fee">
                        </div>
                        <div class="label-input-group-2">
                            <label for="order-service-fee">Service</label>
                            <input min="0" step="0.01" type="number" name="order-service-fee" id="order-service-fee">
                        </div>
                    </div>

                </div>
                <div>
                    <div class="h2-group">
                        <h2>Client</h2>
                    </div>
                    <div class="order-client">
                        <div class="order-client-info"></div>
                        <a class="add-client" href="./?p=add-order-client">
                            <button type="button" class="button-1"><span class="no-order-client">Sélectionner un</span><span class="edit-order-client">Modifier le</span> client</button>
                        </a>
                    </div>
                </div>
                <div>
                    <div class="h2-group">
                        <h2>Contenu</h2>
                        <a href="./?p=add-order-item">
                            <button type="button" class="button-1">Ajouter un article</button>
                        </a>
                    </div>
                    <div class="packets">
                    </div>
                </div>
                <div>
                    <div class="h2-group">
                        <h2>Paiement</h2>
                    </div>
                    <div class="order-total">
                        <p>Total : <span id="order-total-span">0</span>€</p>
                    </div>
                    <div class="form-footer">
                        <input name="submit" type="submit" class="confirm" value="Enregistrer">
                    </div>
                </div>
            </form>
        </div>
    </main>
</body>

</html>