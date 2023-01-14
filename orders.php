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
            <h1>Gérer les commandes</h1>
            <a href="./?p=add-order"> 
                <button class="button-1">Ajouter une commande</button>
            </a>
        </div>
        <div id="admin-table">
            <table>
                <thead>
                    <tr>
                        <th>N° Commande</th>
                        <th>Date commande</th>
                        <th>N° Client</th>
                        <th>Nom client</th>
                        <th>Prix</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach (getOrders() as $key => $value): ?>
                    <tr>
                        <td><a href="./?p=order-detail&id=<?= $value['id_order'] ?>">
                        <?= date_format(new DateTime($value['date_order']), 'dmy') . '-SOI-C' . $value['id_order'] ?>
                        </a></td>
                        <td><?= date_format(new DateTime($value['date_order']), 'd/m/Y') ?></td>
                        <td><a href="./?p=client&id=<?= $value['id_client'] ?>"><?php 
                            $date = $value['date_created'];
                            $date = new DateTime($date);
                            echo ($date->format('y') . '-' . $date->format('M') . '-' . $value['id_client']);?></a></td>
                        <td><?= $value['last_name'] . " " . $value['first_name'] ?></td>
                        <td><?= $value["total"] ?>€</td>
                    </tr>
                <?php endforeach; ?> 
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>