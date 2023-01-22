<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Treteaustore | Admin</title>
    <?php include './components/Head.php' ?>
    <script src="./assets/js/add-order-item.js" defer></script>
</head>
<body>
    <?php include './components/Navbar.php' ?>
    <main>
        <div class="h1-group">
            <h1>Sélectionner un objet pour la commande</h1>
        </div>
        <div id="admin-table">
            <table>
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Nom</th>
                        <th>Description</th>
                        <th>Prix unitaire</th>
                        <th>Quantité</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach (getItems() as $item => $value): ?>
                    <tr class="item">
                        <td class="item-code">
                            <img width="100" height="100" style="object-fit: cover; margin: 10px" src="<?= $value["photo"] ?>" alt="<?= $value["name_item"] ?>">
                        </td>
                        <td><?= $value["name_item"] ?></td>
                        <td><?= $value['description'] ?></td>
                        <td><?= $value['prix_de_vente'] ?></td>
                        <td><input class="quantite" type="number" min="0" step="1" value="1"></td>
                        <td>
                           <button data-item-data="<?= htmlspecialchars(json_encode($value)) ?>" class="add-item">
                              <img src="./assets/add.svg" alt="Sélectionner le item">
                           </button>
                        </td>
                    </tr>
                    <?php endforeach; ?>    
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>