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
    <script src="./assets/js/order-details.js" defer></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bevacqua/dragula@3.7.3/dist/dragula.min.css">
</head>

<body>
    <?php include './components/Navbar.php' ?>
    <main>
        <div class="h1-group">
            <h1>Commande  </h1>
        </div>
        <div>
            <form action="#">
                <div class="columns-2">
                    <div class="label-input-group-1">
                        <label for="">Date de la commande</label>
                        <input type="text" name="" id="">
                    </div>
                    <div class="label-input-group-1">
                        <label for="">Date d'expédition</label>
                        <input type="text" name="" id="">
                    </div>
                </div>
                <div class="columns-2">
                    <div class="label-input-group-1">
                        <label for="">Date prévue d'arrivée </label>
                        <input type="text" name="" id="">
                    </div>
                    <div class="label-input-group-1">
                        <label for="">Statut de la commande</label>
                        <select name="" id="">
                            <option value="">en préparation</option>
                        </select>
                    </div>
                </div>
                <div class="columns-2">
                    <div class="label-input-group-1">
                        <label for="">Note</label>
                        <textarea name="" id="" cols="30" rows="10"></textarea>
                    </div>
                    <div class="label-input-group-1">
                        <label for="">Frais</label>
                        <div class="label-input-group-2">
                            <label for="">Livraison</label>
                            <input type="number" name="" id="">
                        </div>
                        <div class="label-input-group-2">
                            <label for="">Service</label>
                            <input type="number" name="" id="">
                        </div>
                    </div>

                </div>
                <div class="h2-group">
                    <h2>Client</h2>
                </div>
                <button class="button-1">Sélectionner un client</button>
                <div>
                    <div class="h2-group">
                        <h2>Contenu</h2>
                        <button>Ajouter un article +</button>
                    </div>
                    <div class="packets">
                        <div class="packet">
                            <div class="item">
                                <button type="button" class="grab-indicator">
                                    <span></span>
                                    <span></span>
                                </button>
                                <div class="item-details">
                                <p>Nom de l'item</p>
                                <select class="item-status-input" name="item-status">
                                    <option value="in-stock">En stock</option>
                                    <option selected value="prepared">Empaqueté</option>
                                </select>
                            </div>
                            </div>
                        </div>
                        <div class="item" data-id="item-1-1">
                            <button type="button" class="grab-indicator">
                                <span></span>
                                <span></span>
                            </button>
                            <div class="item-details">
                                <p>Nom de l'item</p>
                                <select class="item-status-input" name="item-status">
                                    <option value="in-stock">En stock</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="h2-group">
                    <h2>Paiement</h2>
                </div>
                <div class="history">Historique de paiement</div>
                <div class="form-footer">
                    <a href="javascript:history.back()" class="cancel">Supprimer la commande</a>
                    <button type="submit" class="confirm">Enregistrer</button>
                </div>
                
            </form>
        </div>
    </main>
</body>

</html>