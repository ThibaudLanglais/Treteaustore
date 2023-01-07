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
            <h1>Ajouter un client</h1>
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