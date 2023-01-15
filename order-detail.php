<?php if(!isset($_GET['id'])) header("Location: ./?p=orders"); ?>

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
        $order = getOrder($_GET['id']);
        if(empty($order)) header("Location: ./?p=orders");
    ?>
    <main>
        <div class="h1-group">
            <h1>Commande n°<?= $_GET['id'] ?></h1>
        </div>
        <div>
            <form action="#" data-action="edit">
                <div class="columns-2">
                    <div class="label-input-group-1">
                        <label for="order-date">Date de la commande</label>
                        <input type="date" value="<?= date_format(new DateTime($order["date_order"]), "Y-m-d") ?>" name="order-date" id="order-date">
                    </div>
                    <div class="label-input-group-1">
                        <label for="order-shipping-date">Date d'expédition</label>
                        <input type="date" value="<?= $order['dispatched_date'] != null && date_format(new DateTime($order["dispatched_date"]), "Y-m-d") ?>" name="order-shipping-date" id="order-shipping-date">
                    </div>
                </div>
                <div class="columns-2">
                    <div class="label-input-group-1">
                        <label for="order-eta">Date prévue d'arrivée </label>
                        <input type="date" value="<?= $order['date_eta'] != null && date_format(new DateTime($order["date_eta"]), "Y-m-d") ?>" name="order-eta" id="order-eta">
                    </div>
                    <div class="label-input-group-1">
                        <label for="order-status">Statut de la commande</label>
                        <select name="order-status" id="order-status">
                            <option <?= $order['order_status'] == "To buy" ? "selected" : "" ?> value="To buy">A payer</option>
                            <option <?= $order['order_status'] == "Bought" ? "selected" : "" ?> value="Bought">Payée</option>
                            <option <?= $order['order_status'] == "Packed" ? "selected" : "" ?> value="Packed">Empaquetée</option>
                            <option <?= $order['order_status'] == "Shipped" ? "selected" : "" ?> value="Shipped">Envoyée</option>
                            <option <?= $order['order_status'] == "Arrived" ? "selected" : "" ?> value="Arrived">Arrivée</option>
                            <option <?= $order['order_status'] == "Delivered" ? "selected" : "" ?> value="Delivered">Livrée</option>
                            <option <?= $order['order_status'] == "Done" ? "selected" : "" ?> value="Done">Terminée</option>
                        </select>
                    </div>
                </div>
                <div class="columns-2">
                    <div class="label-input-group-1">
                        <label for="order-note">Note</label>
                        <textarea name="order-note" id="order-note" cols="30" rows="10"><?= $order['note'] ?></textarea>
                    </div>
                    <div class="label-input-group-1">
                        <p for="">Frais</p>
                        <div class="label-input-group-2">
                            <label for="order-shipping-fee">Livraison</label>
                            <input min="0" step="0.01" type="number" value="<?= $order["frais_livraison"] ?>" name="order-shipping-fee" id="order-shipping-fee">
                        </div>
                        <div class="label-input-group-2">
                            <label for="order-service-fee">Service</label>
                            <input min="0" step="0.01" type="number" value="<?= $order["frais_service"] ?>" name="order-service-fee" id="order-service-fee">
                        </div>
                    </div>

                </div>
                <div>
                    <div class="h2-group">
                        <h2>Client</h2>
                    </div>
                    <div class="order-client">
                        <div class="order-client-info">
                            <p>[<?php 
                            $date = $order['date_created'];
                            $date = new DateTime($date);
                            echo ($date->format('y') . '-' . $date->format('M') . '-' . $order['id_client']);?>] <?= $order['last_name'] . " " . $order['first_name'] ?></p>
                            <input type="hidden" name="order-client-id" value="<?= $order['id_client'] ?>"/>
                            <a href="./?p=client&id=<?= $order['id_client'] ?>">Voir la fiche</a>
                        </div>
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
                    <div class="history">Historique de paiement</div>
                    <div class="order-total">
                        <p>Total : <span id="order-total-span"></span>€</p>
                        <p>Reste à payer : <span id="order-remaining-span"></span>€</p>
                    </div>
                    <div class="form-footer">
                        <a href="javascript:history.back()" class="cancel">Supprimer la commande</a>
                        <button type="submit" class="confirm">Enregistrer</button>
                    </div>
                </div>
            </form>
        </div>
    </main>
</body>

</html>