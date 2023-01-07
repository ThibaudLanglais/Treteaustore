<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Treteaustore | Admin</title>
    <?php include './components/Head.php' ?>
    <link rel="stylesheet" href="./assets/add-orders.css">
</head>
<body>
    <?php include './components/Navbar.php' ?>
    <main>
        <div class="h1-group">
            <h1>Editer l'adresse</h1>
        </div>
        <form action="#">
            <div class="columns-2">
                <div class="label-input-group-1">
                    <label for="">Pays/Région</label>
                    <select name="" id="">
                        <option value="">France</option>
                        <option value="">Etats-Unis</option>
                    </select>
                </div>
                <div class="label-input-group-1">
                    <label for="">Nom complet</label>
                    <input type="text" name="" id="">
                </div>
            </div>
            <div class="columns-2">
                <div class="label-input-group-1">
                    <label for="">Telephone</label>
                    <input type="text" name="" id="">
                </div>
                <div class="label-input-group-1">
                    <label for="">Adresse</label>
                    <input type="text" name="" id="">
                </div>
                
            </div>
            <div class="columns-2">
                <div class="label-input-group-1">
                    <label for="">Code Postal</label>
                    <input type="text" name="" id="">
                </div>
                <div class="label-input-group-1">
                    <label for="">Ville</label>
                    <input type="text" name="" id="">
                </div>
            </div>
            <div class="columns-2">
                <div>
                    <div class="label-input-group-2">
                        <input type="checkbox" name="" id="">
                        <label for="">Adresse de livraison</label>
                    </div>  
                    <div class="label-input-group-2">
                        <input type="checkbox" name="" id="">
                        <label for="">Adresse de facturation</label>
                    </div>  
                </div>
                
            </div>
            <div class="form-footer">
                <a class="cancel" href="javascript:history.back()">Supprimer l'adresse</a>
                <button class="confirm" type="submit">Enregistrer</button>
            </div>
        </form>
    </main>
</body>
</html>