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
                    <tr>
                        <td><a href="#">010120-SOI-C001</a></td>
                        <td>30/12/2019</td>
                        <td><a href="#">20-SPR-0328</a></td>
                        <td>M.Dunder</td>
                        <td>179§</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>