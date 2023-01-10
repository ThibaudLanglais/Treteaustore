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
    <?php
    include './components/Navbar.php';

    if (empty($_GET['id'])) header('Location: ./?p=clients');

    $success;
    if (isset($_POST['submit'])) {
        $success = updateClient($_GET['id'], $_POST['first_name'], $_POST['last_name'], $_POST['facebook'], $_POST['instagram'], $_POST['email'], $_POST['phone'], $_POST['ultimate'] ?? "off");
    }

    $client = getClient($_GET['id']);
    if (empty($client)) header('Location: ./?p=clients');
    $points = getClientPoints($_GET['id']);
    $isEdit = isset($_GET['action']) && $_GET['action'] == "edit";
    ?>
    <main>
        <?php if (isset($success)) : ?>
            <div class="form-response form-<?= $success ? "success" : "failure" ?>">
                <p>
                    <?= $success ? "L'utilisateur a bien été modifié !" : "Erreur lors de la modification de l'utilisateur" ?>
                </p>
                <a href="./p=clients">Voir les clients</a>
            </div>
        <?php endif; ?>
        <div class="h1-group">
            <?php if ($isEdit) : ?>
                <h1>Éditer un client</h1>
                <?php else : ?>
                    <h1>Fiche client n°<?= $_GET['id'] ?></h1>
                    <?php endif; ?>
                    </div>
                    <?php if ($isEdit) : ?>
                        <form action="./?p=client&id=<?= $_GET['id'] ?>" method="post">
                        <?php else : ?>
                            <div class="form">
                            <?php endif; ?>
                            <div class="columns-2">
                                <div class="label-input-group-1">
                                    <label for="last_name">Nom</label>
                                    <input <?= $isEdit ? "" : "readonly" ?> type="text" name="last_name" id="last_name" value="<?= $client['last_name'] ?>">
                                </div>
                                <div class="label-input-group-1">
                                    <label for="first_name">Prénom</label>
                                    <input <?= $isEdit ? "" : "readonly" ?> type="text" name="first_name" id="first_name" value="<?= $client['first_name'] ?>">
                                </div>
                                <div class="label-input-group-1">
                                    <label for="email">Email</label>
                                    <input <?= $isEdit ? "" : "readonly" ?> type="email" name="email" id="email" value="<?= $client['email'] ?>">
                                </div>
                                <div class="label-input-group-1">
                                    <label for="phone">Téléphone</label>
                                    <input <?= $isEdit ? "" : "readonly" ?> type="tel" name="phone" id="phone" value="<?= $client['phone_number'] ?>">
                                </div>
                                <div class="label-input-group-1">
                                    <label for="facebook">Facebook</label>
                                    <input <?= $isEdit ? "" : "readonly" ?> type="text" name="facebook" id="facebook" value="<?= $client['fb'] ?>">
                                </div>
                                <div class="label-input-group-1">
                                    <label for="instagram">Instagram</label>
                                    <input <?= $isEdit ? "" : "readonly" ?> type="text" name="instagram" id="instagram" value="<?= $client['ig'] ?>">
                                </div>

                                <div class="label-input-group-2">
                                    <input <?= $isEdit ? "" : "readonly" ?> <?= $client['points'] < 700 ? "disabled" : "" ?> type="checkbox" name="ultimate" id="ultimate" <?= $client['est_ultimate'] ? "checked" : "" ?>>
                                    <label for="ultimate"><span style="<?= $client['points'] < 700 ? "text-decoration: line-through;" : "" ?>">Utilisateur Ultimate</span> <?= $client['points'] < 700 ? "(Points inférieurs à 700)" : "" ?></label>
                                </div>
                                <br>
                                <div class="label-input-group-1">
                                    <p>Points</p>
                                    <div class="points">
                                        <?php foreach ($points as $key => $value) : ?>
                                            <p><?= $value['quantite'] ?> point(s),
                                                <?= $value['expiration_date'] == null ?
                                                    "pas d'expiration" : "expirent le " . date_format(new DateTime($value['expiration_date']), 'd/m/Y')
                                                ?>.</p>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <div class="label-input-group-1">
                                    <p>Historique des commandes </p>
                                    <div class="orders">
                                        <p>12/03/2018 - 125€ - <a href="./?p=order-detail&id=1">Voir le détail</a></p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-footer">
                                <?php if ($isEdit) : ?>
                                    <a class="cancel" href="javascript:history.back()">Annuler</a>
                                    <input name="submit" class="confirm" type="submit" value="Enregistrer" />
                                <?php else : ?>
                                    <a class="confirm" href="./?p=client&id=<?= $_GET['id'] ?>&action=edit">Modifier la fiche</a>
                                <?php endif; ?>
                            </div>
                            <?php if ($isEdit) : ?>
                        </form>
                    <?php else : ?>
        </div>
    <?php endif; ?>
    </main>
</body>

</html>