<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Treteaustore | Admin</title>
    <?php include './components/Head.php' ?>
    <link rel="stylesheet" href="./assets/edit-client.css">
</head>
<body>
    <?php 
        include './components/Navbar.php';

        if(empty($_GET['id'])) header('Location: ./?p=clients');
        
        $success;
        if(isset($_POST['submit'])){
            $success = updateClient($_GET['id'], $_POST['first_name'], $_POST['last_name'], $_POST['facebook'], $_POST['instagram'], $_POST['email'], $_POST['phone'], $_POST['ultimate'] ?? "off");
        }

        $client = getClient($_GET['id']);
        if(empty($client)) header('Location: ./?p=clients');
    ?>
    <main>
        <?php if(isset($success)): ?>
            <div class="form-response form-<?= $success ? "success" : "failure" ?>">
            <p>
            	<?= $success ? "L'utilisateur a bien été modifié !" : "Erreur lors de la modification de l'utilisateur" ?>
            </p>
            <a href="./p=clients">Voir les clients</a>
        </div>    
        <?php endif; ?>
        <div class="h1-group">
            <h1>Éditer un client</h1>
        </div>
        <form action="./?p=edit-client&id=<?= $_GET['id'] ?>" method="post">
            <div class="columns-2">
                <div class="label-input-group-1">
                    <label for="last_name">Nom</label>
                    <input type="text" name="last_name" id="last_name" value="<?= $client['last_name'] ?>">
                </div>
                <div class="label-input-group-1">
                    <label for="first_name">Prénom</label>
                    <input type="text" name="first_name" id="first_name" value="<?= $client['first_name'] ?>">
                </div>
                <div class="label-input-group-1">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" value="<?= $client['email'] ?>">
                </div>
                <div class="label-input-group-1">
                    <label for="phone">Téléphone</label>
                    <input type="tel" name="phone" id="phone" value="<?= $client['phone_number'] ?>">
                </div>
                <div class="label-input-group-1">
                    <label for="facebook">Facebook</label>
                    <input type="text" name="facebook" id="facebook" value="<?= $client['fb'] ?>">
                </div>
                <div class="label-input-group-1">
                    <label for="instagram">Instagram</label>
                    <input type="text" name="instagram" id="instagram" value="<?= $client['ig'] ?>">
                </div>
                <div class="label-input-group-2">
                    <input <?= $client['points'] < 700 ? "disabled" : "" ?> type="checkbox" name="ultimate" id="ultimate" <?= $client['est_ultimate'] ? "checked" : "" ?>>
                    <label for="ultimate"><span style="<?= $client['points'] < 700 ? "text-decoration: line-through;" : "" ?>">Utilisateur Ultimate</span> <?= $client['points'] < 700 ? "(Points inférieurs à 700)" : "" ?></label>
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