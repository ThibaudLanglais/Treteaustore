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
            <h1>Gérer les clients</h1>
            <a href="./?p=add-client">
                <button class="button-1">Ajouter un client</button>
            </a>
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
                            <a href="./?p=edit-client&id=<?= $value['id_client'] ?>">
                                <button>
                                    <img src="./assets/edit.svg" alt="Éditer le client">
                                </button>
                            </a> 
                        </td>
                    </tr>
                    <?php endforeach; ?>    
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>