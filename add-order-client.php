<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Treteaustore | Admin</title>
    <?php include './components/Head.php' ?>
    <script src="./assets/js/add-order-client.js" defer></script>
</head>
<body>
    <?php include './components/Navbar.php' ?>
    <main>
        <div class="h1-group">
            <h1>Sélectionner un client pour la commande</h1>
        </div>
        <div id="admin-table">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Membership</th>
                        <th>Points</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach (getClients() as $client => $value): ?>
                    <tr>
                        <td class="client-code"><?php
                            $date = $value['date_created'];
                            $date = new DateTime($date);
                            echo ($date->format('y') . '-' . $date->format('M') . '-' . $value['id_client']);
                        ?></td>
                        <td><?= $value['first_name'] ?></td>
                        <td><?= $value['last_name'] ?></td>
                        <td><?= $value['est_ultimate'] ? 'Ultimate' : getMembership($value['points']) ?></td>
                        <td><?= $value['points'] ?? 0 ?></td>
                        <td>
                           <button data-client-data="<?= htmlspecialchars(json_encode($value)) ?>" class="add-client">
                              <img src="./assets/add.svg" alt="Sélectionner le client">
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