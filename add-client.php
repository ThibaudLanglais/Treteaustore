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
    <?php include './components/Navbar.php';
        $success;
        if(isset($_POST['submit'])){
            $success = insertClient($_POST['first_name'], $_POST['last_name'], $_POST['facebook'], $_POST['instagram'], $_POST['email'], $_POST['phone']);
        }
    ?>
    <main>
        <?php if(isset($success)): ?>
            <div class="form-response form-<?= $success ? "success" : "failure" ?>">
            <p>
            	<?= $success ? "L'utilisateur a bien été ajouté !" : "Erreur lors de l'ajout de l'utilisateur" ?>
            </p>
            <a href="./?p=clients">Voir les clients</a>
        </div>    
        <?php endif; ?>
        <div class="h1-group">
            <h1>Ajouter un client</h1>
        </div>
        <form action="./?p=add-client" method="post">
            <div class="columns-2">
                <div class="label-input-group-1">
                    <label for="last_name">Nom</label>
                    <input type="text" name="last_name" id="last_name">
                </div>
                <div class="label-input-group-1">
                    <label for="first_name">Prénom</label>
                    <input type="text" name="first_name" id="first_name">
                </div>
                <div class="label-input-group-1">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email">
                </div>
                <div class="label-input-group-1">
                    <label for="phone">Téléphone</label>
                    <input type="tel" name="phone" id="phone">
                </div>
                <div class="label-input-group-1">
                    <label for="facebook">Facebook</label>
                    <input type="text" name="facebook" id="facebook">
                </div>
                <div class="label-input-group-1">
                    <label for="instagram">Instagram</label>
                    <input type="text" name="instagram" id="instagram">
                </div>
            </div>
            <div class="form-footer">
                <a class="cancel" href="javascript:history.back()">Annuler</a>
                <input name="submit" class="confirm" type="submit" value="Enregistrer"/>
            </div>
        </form>
    </main>
</body>
</html>