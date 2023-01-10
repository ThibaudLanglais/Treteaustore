<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Treteaustore | Admin</title>
    <?php include './components/Head.php' ?>
    <link rel="stylesheet" href="./assets/order-detail.css">
    <script src="https://cdn.jsdelivr.net/gh/bevacqua/dragula@3.7.3/dist/dragula.min.js"></script>
    <script src="./assets/js/utility.js" defer></script>
    <script src="./assets/js/order-details.js" defer></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bevacqua/dragula@3.7.3/dist/dragula.min.css">
</head>

<body>
    <?php include './components/Navbar.php' ?>
    <main>
        <div class="h1-group">
            <h1>Commande n°<?= $_GET['id'] ?></h1>
        </div>
        <div>
            <form action="#">
                <div class="columns-2">
                    <div class="label-input-group-1">
                        <label for="order-date">Date de la commande</label>
                        <input type="date" name="order-date" id="order-date">
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
                        <select name="order-status" id="order-status">
                            <option value="to-buy">A payer</option>
                            <option value="bought">Payée</option>
                            <option value="packed">Empaquetée</option>
                            <option value="shipped">Envoyée</option>
                            <option value="arrived">Arrivée</option>
                            <option value="delivered">Livrée</option>
                            <option value="done">Terminée</option>
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