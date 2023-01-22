<?php
if (!isset($_GET['id'])) header("Location: ./?p=orders"); 
$paymentModes = array(
    "carte-bancaire" => "Carte bancaire",
    "espece" => "Espèce",
    "points" => "Points fidélité"
);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Treteaustore | Admin</title>
    <?php include './components/Head.php' ?>
    <link rel="stylesheet" href="./assets/order.css">
    <script src="./assets/js/utility.js" defer></script>
    <script src="./assets/js/order.js" defer></script>
</head>

<body>
    <?php
    include './components/Navbar.php';
    include './components/Variables.php';
    if(isset($_POST['submit-payment'])){
        $result = addPayment($_GET['id'], $_POST['payment-amount'], $_POST['payment-mode']);
        if (!$result) {
            $success = false;
            $msg = "Erreur lors du paiement";
            return;
        }
    }
    else if(isset($_POST['delete'])){
        $result = deleteOrder($_GET['id']);
        if (!$result) {
            $success = false;
            $msg = "Erreur lors de la suppression de la commande";
            return;
        }
    }else if (isset($_POST["submit"])) {
        if (!isset($_POST['order-client-id'])) {
            $success = false;
            $msg = "Sélectionnez un client";
        } else {
            $result = updateOrder(
                $_GET['id'],
                $_POST['order-date'],
                $_POST['order-status'],
                $_POST['order-shipping-date'],
                $_POST['order-note'],
                $_POST['order-service-fee'],
                $_POST['order-shipping-fee'],
                $_POST['order-client-id'],
                $_POST['order-eta'],
            );
            if (!$result) {
                $success = false;
                $msg = "Erreur lors de la mise à jour de la commande";
                return;
            }

            //Update les items;
            $itemList = array();
            foreach ($_POST as $key => $value) {
                if (str_contains($key, "basket-item-id-")) {
                    $id = $value;
                    $quantite = $_POST['basket-item-quantite-' . $value];
                    $price = $_POST['basket-item-price-' . $value];
                    $operation = $_POST['basket-item-operation-' . $value];
                    $status = $_POST['basket-item-status-input-' . $value];
                    array_push($itemList, $value);
                    if ($operation == "insert") {
                        $result = insertOrderItem($_GET['id'], $id, $price, $quantite, $status);
                        if (!$result) {
                            $success = false;
                            $msg = "Erreur lors de la mise à jour de la commande (ajout des items)";
                            return;
                        }
                    }
                    if ($operation == "update") {
                        $result = updateOrderItem($_GET['id'], $id, $price, $quantite, $status);
                        if (!$result) {
                            $success = false;
                            $msg = "Erreur lors de la mise à jour de la commande (mise à jour des items)";
                            return;
                        }
                    }
                }
            }
            //Supprimer tous les items de la commande qui ne sont pas parmi les items de la requête
            $result = deleteOrderItemsNotInList($_GET['id'], $itemList);
            if (!$result) {
                $success = false;
                $msg = "Erreur lors de la mise à jour de la commande (suppression d'items)";
                return;
            }
        }
    }
    $order = getOrder($_GET['id']);
    if (empty($order)) header("Location: ./?p=orders");
    ?>
    <main>
        <?php if (isset($success)) : ?>
            <div class="form-response form-<?= $success ? "success" : "failure" ?>">
                <p>
                    <?= $msg ?>
                </p>
            </div>
        <?php endif; ?>
        <div class="h1-group">
            <h1>Commande n°<?= $_GET['id'] ?></h1>
        </div>
        <div>
            <form id="order-form" method="post" action="./?p=order-detail&id=<?= $_GET['id'] ?>" data-action="edit">
                <div class="columns-2">
                    <div class="label-input-group-1">
                        <label for="order-date">Date de la commande</label>
                        <input type="date" value="<?= date_format(new DateTime($order["date_order"]), "Y-m-d") ?>" name="order-date" id="order-date">
                    </div>
                    <div class="label-input-group-1">
                        <label for="order-shipping-date">Date d'expédition</label>
                        <input type="date" value="<?= !empty($order['dispatched_date']) ? date_format(new DateTime($order["dispatched_date"]), "Y-m-d")  : "" ?>" name="order-shipping-date" id="order-shipping-date">
                    </div>
                </div>
                <div class="columns-2">
                    <div class="label-input-group-1">
                        <label for="order-eta">Date prévue d'arrivée </label>
                        <input type="date" value="<?= !empty($order['date_eta']) ? date_format(new DateTime($order["date_eta"]), "Y-m-d")  : "" ?>" name="order-eta" id="order-eta">
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
                            <input onchange="javascript:renderPrice()" min="0" step="0.01" type="number" value="<?= $order["frais_livraison"] ?? "0" ?>" name="order-shipping-fee" id="order-shipping-fee">
                        </div>
                        <div class="label-input-group-2">
                            <label for="order-service-fee">Service</label>
                            <input onchange="javascript:renderPrice()" min="0" step="0.01" type="number" value="<?= $order["frais_service"] ?? "0" ?>" name="order-service-fee" id="order-service-fee">
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
                                echo ($date->format('y') . '-' . $date->format('M') . '-' . $order['id_client']); ?>] <?= $order['last_name'] . " " . $order['first_name'] ?></p>
                            <input type="hidden" name="order-client-id" value="<?= $order['id_client'] ?>" />
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
                        <?php foreach (getOrderItems($_GET['id']) as $key => $value) : $value['operation'] = "update";
                            include './components/order-detail/OrderItem.php';
                        endforeach; ?>
                    </div>
                </div>
            </form>
        </div>
        </div>
        <div>
            <div class="h2-group">
                <h2>Paiement</h2>
            </div>
            <form method="post" id="payment-form" action="./?p=order-detail&id=<?= $_GET['id'] ?>">
                <h3>Ajouter un paiement</h3>
                <div class="label-input-group-2">
                    <label for="payment-mode">Méthode de paiement</label>
                    <select name="payment-mode" id="payment-mode">
                        <option value="carte-bancaire">Carte bancaire</option>
                        <option value="espece">Espèce</option>
                        <option value="points">Points fidélité</option>
                    </select>
                </div>
                <div class="label-input-group-2">
                    <label for="payment-amount">Montant</label>
                    <input type="number" name="payment-amount" id="payment-amount" min="0.01" step="0.01" value="0.01">
                </div>
                <div class="form-footer">
                <input name="submit-payment" type="submit" class="confirm" value="Ajouter le paiement">
                </div>
            </form>
            <div class="history">
                <p>Historique de paiement</p>
                <?php  foreach(getOrderPayments($_GET['id']) as $key => $payment): ?>
                <p class="payment-instance" data-amount="<?= $payment['montant'] ?>">
                    <?= $payment['date_paiement'] ?>
                    <?= $payment['montant'] . "€" ?>
                    <?= "via " . $paymentModes[$payment['mode_paiement']] ?>
                </p>
                <?php endforeach; ?>
            </div>
            <div class="order-total">
                <span>Items : <span id="items-total-price"></span>€</span>
                <span>Frais de service : <span id="service-fee-price"></span>€</span>
                <span>Frais de livraison : <span id="shipping-fee-price"></span>€</span>
                <span>Total : <span id="order-total-span"></span>€</span>
                <span>Reste à payer : <span id="order-remaining-span"></span>€</span>
            </div>
            <div class="form-footer">
                <input form="order-form" type="submit" name="delete" class="cancel" value="Supprimer la commande">
                <input form="order-form" name="submit" type="submit" class="confirm" value="Enregistrer">
            </div>
        </div>
        </div>
    </main>
</body>

</html>