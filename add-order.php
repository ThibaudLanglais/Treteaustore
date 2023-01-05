<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Treteaustore | Admin</title>
    <?php include './components/Head.php' ?>
</head>
<body>
    <?php include './components/Navbar.php' ?>
    <main>
        <div class="h1-group">
            <h1>Ajouter une commande </h1>
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
                        <textarea name="" id="" cols="30" rows="10" style="resize:none;"></textarea>
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
                <button>Sélectionner un client</button>
                <div class="h2-group">
                    <h2>Contenu</h2>
                    <button>Ajouter un article +</button>
                </div>
                <div class="form-actions">
                    <a href="javascript:history.back()" class="cancel">Annuler</a>
                    <button type="submit" class="confirm"></button>
                </div>
            </form>
        </div>
    </main>
</body>
</html>