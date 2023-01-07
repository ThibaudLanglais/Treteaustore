<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Treteaustore | Admin</title>
    <?php include './components/Head.php' ?>
    <link rel="stylesheet" href="./assets/client.css">
</head>
<body>
    <?php include './components/Navbar.php' ?>
    <main>
        <div class="h1-group">
            <h1>Fiche Client n°</h1>
        </div>
        <form action="#">
            <div class="columns-2">
                <div class="label-input-group-1">
                    <label for="">Nom</label>
                    <input type="text" name="" id="">
                </div>
                <div class="label-input-group-1">
                    <label for="">Prénom</label>
                    <input type="text" name="" id="">
                </div>
            </div>
            <div class="columns-2">
                <div class="label-input-group-1">
                    <label for="">Email</label>
                    <input type="text" name="" id="">
                </div>
                <div class="label-input-group-1">
                    <label for="">Téléphone</label>
                    <input type="text" name="" id="">
                </div>
            </div>
            <div class="columns-2">
                <div class="label-input-group-1">
                    <label for="">Facebook</label>
                    <input type="text" name="" id="">
                </div>
                <div class="label-input-group-1">
                    <label for="">Instagram</label>
                    <input type="text" name="" id="">
                </div>
            </div>
            <div class="columns-2">
                <div class="label-input-group-1">
                    <label for="">Membership</label>
                    <input type="text" name="" id="">
                    <div class="label-input-group-2">
                        <input type="checkbox" name="" id="">
                        <label for="">Utilisateur Ultimate</label>
                    </div>
                </div>
                <div class="label-input-group-1">
                    <label for="">Points</label>
                    <div class="points">
                        <p>50 points, expirent le 30/12/2023</p>
                        <p>50 points, expirent le 30/12/2023</p>
                        <p>50 points, expirent le 30/12/2023</p>
                    </div>
                </div>
            </div>
            <div class="columns-2">
                <div class="orders">
                    <label for="">Historique des commandes </label>
                    <p>12/03/2018   125€    <a href="./order-detail.php">Detail commande</a></p>
                    <p>12/03/2018   125€    <a href="./order-detail.php">Detail commande</a></p>
                    <p>12/03/2018   125€    <a href="./order-detail.php">Detail commande</a></p>
                </div>
            </div>
            <div class="addresses">
                <div class="h2-group">
                    <h2>Adresses</h2>
                </div>
                <div class="columns-2">
                    <div class="label-input-group-2">
                        <p>1, Jutulheim Edda, NORWAY</p>
                        <a href="./address.php">
                            <button>
                                <img src="./assets/edit.svg" alt="Éditer l'adresse">
                            </button>
                        </a>
                    </div>
                    <div class="label-input-group-2">
                        <p>20 rue des rues du Mans 72100 Le Mans</p>
                        <a href="./address.php">
                            <button>
                            <img src="./assets/edit.svg" alt="Éditer l'adresse">
                            </button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="form-footer">
                <a class="cancel" href="javascript:history.back()">Annuler</a>
                <button class="confirm" type="submit">Enregistrer</button>
            </div>
        </form>
    </main>
</body>
</html>