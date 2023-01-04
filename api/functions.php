<?php
$fromFunction = null;
function getAllGames($bdd)
{
    $req = $bdd->prepare("SELECT game.*, GROUP_CONCAT(distinct(concat(images.link, '::', images.id))) as 'images', GROUP_CONCAT(distinct(concat(category.label, '::', category.id))) as 'categories', GROUP_CONCAT(DISTINCT(emprunts.member_id)) as 'loans' from game left outer join game_images on game.id = game_images.game_id left outer join images on game_images.image_id = images.id left outer join link_categories on game.id = link_categories.game_id left outer join category on link_categories.category_id = category.id left outer join emprunts on emprunts.game_id = game.id and emprunts.gave_back = 0 group by game.id");
    $req->execute();
    $req = $req->fetchAll(PDO::FETCH_ASSOC);
    return $req;
}

function getGame($bdd)
{
    $req = $bdd->prepare("SELECT game.*, GROUP_CONCAT(distinct(concat(images.link, '::', images.id))) as 'images', GROUP_CONCAT(DISTINCT(category.id), '::', category.label) as 'categories', GROUP_CONCAT(DISTINCT(emprunts.member_id)) as 'id_emprunts', GROUP_CONCAT(DISTINCT(emprunts.date_emprunt)) as 'date_emprunts' from game left outer join game_images on game.id = game_images.game_id left outer join images on game_images.image_id = images.id left outer join link_categories on link_categories.game_id = game.id left outer join category on link_categories.category_id = category.id left join emprunts on emprunts.game_id = game.id and emprunts.gave_back = 0 WHERE game.id = ?");
    $req->execute(array($_GET['id']));
    $req = $req->fetch(PDO::FETCH_ASSOC);
    return $req;
}

function getLoans($bdd)
{
    $req = $bdd->prepare("SELECT game.name, emprunts.*, member.firstname, member.lastname from emprunts inner join member on member.id = emprunts.member_id inner join game on game.id = emprunts.game_id where emprunts.gave_back = 0 order by emprunts.date_emprunt asc");
    $success = $req->execute();
    $req = $req->fetchAll(PDO::FETCH_ASSOC);
    return $req;
    // return ['req' => $req, 'success' => $success, 'false' => "Erreur dans la requête", 'true' => 'Contenu chargé'];
}
function getUserLoans($bdd)
{
    $req = $bdd->prepare("SELECT emprunts.*, member.firstname, member.lastname, game.*, GROUP_CONCAT(distinct(concat(images.link, '::', images.id))) as 'images' from emprunts inner join member on member.id = emprunts.member_id inner join game on game.id = emprunts.game_id left outer join game_images on game_images.game_id = emprunts.game_id left outer join images on game_images.image_id = images.id where member.id = ? group by emprunts.id order by emprunts.date_emprunt asc");
    $success = $req->execute(array($_SESSION['id']));
    $req = $req->fetchAll(PDO::FETCH_ASSOC);
    return $req;
    // return ['req' => $req, 'success' => $success, 'false' => "Erreur dans la requête", 'true' => 'Contenu chargé'];
}
function getUpcomingGames($bdd)
{
    $req = $bdd->prepare("SELECT game.*, GROUP_CONCAT(images.link, '::',images.id) as 'images' from game left outer join game_images on game.id = game_images.game_id left outer join images on game_images.image_id = images.id WHERE date_sortie > ? group by game.id ORDER BY date_sortie ASC");
    $success = $req->execute(array(date('Y-m-d')));
    $req = $req->fetchAll(PDO::FETCH_ASSOC);
    return ['req' => $req, 'success' => $success];
}

function searchGames($bdd)
{
    $queryString = "SELECT game.*, GROUP_CONCAT(distinct(concat(images.link, '::', images.id))) as 'images'";
    if (isset($_GET['categories'])) {
        $queryString .= ", CONCAT(GROUP_CONCAT(DISTINCT(link_categories.category_id)), ':condition:', ";
        $queryString .= isset($_GET['categories_condition']) ? " 'and'" : " 'or'";
        $queryString .= ",':list:','";
        foreach ($_GET['categories'] as $cat) {
            $queryString .= $cat;
            if ($cat != $_GET['categories'][count($_GET['categories']) - 1]) $queryString .= ":";
        }
        $queryString .= "') as 'categories'";
    }
    $queryString .= " from game left outer join game_images on game.id = game_images.game_id left outer join images on game_images.image_id = images.id";
    if (isset($_GET['c'])) {
        $queryString .= " inner join link_categories on link_categories.category_id = ";
        $queryString .= $_GET['c'];
        $queryString .= " and link_categories.game_id = game.id";
    }
    if (isset($_GET['categories'])) {
        $queryString .= " inner join link_categories on link_categories.game_id = game.id";
    }
    if (isset($_GET['search_terms']) && $_GET['search_terms'] != null) {
        $queryString .= " where game.name LIKE '%" . $_GET['search_terms'] . "%'";
    }
    if (isset($_GET['age_min']) && $_GET['age_min'] != null) {
        $queryString .= " and game.age_restriction > " . $_GET['age_min'];
    }
    if (isset($_GET['age_max']) && $_GET['age_max'] != null) {
        $queryString .= " and game.age_restriction < " . $_GET['age_max'];
    }
    $queryString .= " group by game.id";
    $req = $bdd->prepare($queryString);
    $req->execute();
    $req = $req->fetchAll(PDO::FETCH_ASSOC);
    return $req;
}
function getUserBorrowedGames($bdd)
{
    $req = $bdd->prepare("SELECT game.*, GROUP_CONCAT(images.link, '::',images.id) as 'images' from game left outer join game_images on game.id = game_images.game_id left outer join images on game_images.image_id = images.id inner join emprunts on emprunts.game_id = game.id and emprunts.member_id = ? and emprunts.gave_back = 0 group by game.id");
    $req->execute(array($_SESSION['id']));
    $req = $req->fetchAll(PDO::FETCH_ASSOC);
    return $req;
}
function getAllBorrowedGames($bdd)
{
    $req = $bdd->prepare("SELECT game.*, GROUP_CONCAT(images.link, images.id) as 'images' from game left outer join game_images on game.id = game_images.game_id left outer join images on game_images.image_id = images.id inner join emprunts on emprunts.game_id = game.id and emprunts.gave_back = 0 group by game.id");
    $req->execute();
    $req = $req->fetchAll(PDO::FETCH_ASSOC);
    return $req;
}
function borrowGame($bdd)
{
    $req = $bdd->prepare("INSERT INTO emprunts(game_id, member_id, date_emprunt, gave_back) VALUES (?,?,?,0)");
    $success = $req->execute(array($_POST['borrow'], $_SESSION['id'], date('Y-m-d')));
    $req = $req->fetchAll(PDO::FETCH_ASSOC);
    return ['req' => $req, 'success' => $success, 'true' => "Le jeu a bien été emprunté !", 'false' => "Le jeu n'a pas pu être emprunté"];
}
function getWeekTopGames($bdd)
{
    $req = $bdd->prepare("SELECT game.*, GROUP_CONCAT(distinct(concat(images.link, '::', images.id))) as 'images', GROUP_CONCAT(distinct(concat(category.label, '::', category.id))) as 'categories', COUNT(DISTINCT(emprunts.id)) as 'loans' from game left outer join game_images on game.id = game_images.game_id left outer join images on game_images.image_id = images.id left outer join link_categories on game.id = link_categories.game_id left outer join category on link_categories.category_id = category.id left outer join emprunts on emprunts.game_id = game.id where emprunts.date_emprunt >= ? group by game.id order by loans desc limit 3");
    $req->execute(array(date("Y-m-d", strtotime(date('Y-m-d') . " -7 day"))));
    $req = $req->fetchAll(PDO::FETCH_ASSOC);
    return $req;
}
function getAllCategories($bdd)
{
    $req = $bdd->prepare("SELECT * from category");
    $req->execute();
    $req = $req->fetchAll(PDO::FETCH_ASSOC);
    return $req;
}
function getCategory($bdd)
{
    $cat_id = null;
    if (isset($_GET['c'])) {
        $cat_id = $_GET['c'];
    } else if (isset($_POST['c'])) {
        $cat_id = $_POST['c'];
    } else {
        return null;
    }
    $req = $bdd->prepare("SELECT * from category where category.id = ?");
    $req->execute(array($cat_id));
    $req = $req->fetch(PDO::FETCH_ASSOC);
    return $req;
}

function loansUpdate($bdd)
{
    if ($_POST['loan_action'] == 'delete') {
        $req = $bdd->prepare("DELETE FROM emprunts WHERE emprunts.id = ?");
        $true = 'Emprunt supprimé';
    } elseif ($_POST['loan_action'] == 'confirm') {
        $req = $bdd->prepare("UPDATE emprunts SET gave_back = 1 WHERE emprunts.id = ?");
        $true = 'Le jeu a bien été rendu';
    }
    $success = $req->execute(array($_POST['loan_id']));
    return ['req' => $req, 'success' => $success, 'false' => "Erreur dans la requête", 'true' => $true];
}
function deleteGame($bdd)
{
    $req = $bdd->prepare("DELETE FROM game WHERE game.id = ?");
    $true = 'Jeu supprimé de la base de données';
    $success = $req->execute(array($_POST['game_id']));
    return ['req' => $req, 'success' => $success, 'false' => "Erreur dans la requête", 'true' => $true];
}
function editGame($bdd)
{
    $true = "Le jeu a bien été mis à jour.";
    $false = "Le jeu n'a pas pu être mis à jour.";
    $req = $bdd->prepare("UPDATE game SET name = ?, age_restriction = ?, date_sortie = ?, video = ?, stock = ?, resume = ?, cover_id = ? WHERE game.id = ?");
    $success = $req->execute(array($_POST['name'] ? $_POST['name'] : null, $_POST['age_restriction'] ? $_POST['age_restriction'] : null, $_POST['date_sortie'] ? $_POST['date_sortie'] : null, $_POST['video'] ? $_POST['video'] : null, $_POST['stock'] ? $_POST['stock'] : null, $_POST['resume'] ? $_POST['resume'] : null,  $_POST['cover_id'] ? $_POST['cover_id'] : null, $_POST['game_id']));
    if (isset($_POST['game_images'])) {
        $_POST['game_images'] = explode(',', $_POST['game_images']);
        foreach ($_POST['game_images'] as $image) {
            $exploded = explode('::', $image);
            $imageId = $exploded[0];
            $origin = $exploded[1];
            $action = $exploded[2];
            $link = isset($exploded[3]) ? $exploded[3] : null;
            if ($origin == 'original' && $action == 'unselected') {
                // supprimer le lien entre l'image et le jeu
                $req = $bdd->prepare("DELETE FROM game_images WHERE game_images.game_id = ? and game_images.image_id = ?");
                $req->execute(array($_POST['game_id'], $imageId));
            } else if ($origin == 'unoriginal' && $action == 'selected') {
                // créer un lien entre l'image et le jeu
                $req = $bdd->prepare("INSERT INTO game_images(game_id, image_id) VALUES (?,?)");
                $req->execute(array($_POST['game_id'], $imageId));
            } else if ($origin == 'added' && $action == 'selected') {
                $req = $bdd->prepare("INSERT INTO images(link) VALUES (?)");
                $req->execute(array($link));
                $imageId = $bdd->lastInsertId();
                $req = $bdd->prepare("INSERT INTO game_images(game_id, image_id) VALUES (?,?)");
                $s = $req->execute(array($_POST['game_id'], $imageId));
            } else if (($origin == 'original' || $origin == 'unoriginal') && $action == 'delete') {
                $req = $bdd->prepare("DELETE FROM images WHERE images.id = ?");
                $req->execute(array($imageId));
            }
        }
    }
    if (isset($_POST['game_categories'])) {
        $_POST['game_categories'] = explode(',', $_POST['game_categories']);
        foreach ($_POST['game_categories'] as $image) {
            $exploded = explode('::', $image);
            $catId = $exploded[0];
            $origin = $exploded[1];
            $action = $exploded[2];
            $label = isset($exploded[3]) ? $exploded[3] : null;
            if ($origin == 'original' && $action == 'unselected') {
                // supprimer le lien entre la catégorie et le jeu
                $req = $bdd->prepare("DELETE FROM link_categories WHERE link_categories.game_id = ? and link_categories.category_id = ?");
                $req->execute(array($_POST['game_id'], $catId));
            } else if ($origin == 'unoriginal' && $action == 'selected') {
                // créer un lien entre la catégorie et  le jeu
                $req = $bdd->prepare("INSERT INTO link_categories(game_id, category_id) VALUES (?,?)");
                $req->execute(array($_POST['game_id'], $catId));
            } else if ($origin == 'added' && $action == 'selected') {
                //créer une catégorie et la lier
                $req = $bdd->prepare("INSERT INTO category(label) VALUES (?)");
                $req->execute(array($label));
                $catId = $bdd->lastInsertId();
                $req = $bdd->prepare("INSERT INTO link_categories(game_id, category_id) VALUES (?,?)");
                $s = $req->execute(array($_POST['game_id'], $catId));
            } else if (($origin == 'original' || $origin == 'unoriginal') && $action == 'delete') {
                //supprimer une catégorie existante
                $req = $bdd->prepare("DELETE FROM category WHERE category.id = ?");
                $req->execute(array($catId));
            }
        }
    }
    return ['req' => $req, 'success' => $success, 'false' => $false, 'true' => $true];
}
function addGame($bdd)
{
    $true = "Le jeu a bien été ajouté.";
    $false = "Le jeu n'a pas pu être ajouté.";
    $req = $bdd->prepare("INSERT INTO game(name, age_restriction, date_sortie, video, stock, resume, cover_id) VALUES (?,?,?,?,?,?,?)");
    $success = $req->execute(array($_POST['name'] ? $_POST['name'] : null, $_POST['age_restriction'] ? $_POST['age_restriction'] : null, $_POST['date_sortie'] ? $_POST['date_sortie'] : null, $_POST['video'] ? $_POST['video'] : null, $_POST['stock'] ? $_POST['stock'] : null, $_POST['resume'] ? $_POST['resume'] : null, $_POST['cover_id'] && $_POST['cover_id'] >= 0 ? $_POST['cover_id'] : null));
    $gameId = $bdd->lastInsertId();
    if (isset($_POST['game_images'])) {
        $_POST['game_images'] = explode(',', $_POST['game_images']);
        foreach ($_POST['game_images'] as $image) {
            $exploded = explode('::', $image);
            $imageId = $exploded[0];
            $origin = $exploded[1];
            $action = $exploded[2];
            $link = isset($exploded[3]) ? $exploded[3] : null;
            if ($origin == 'original' && $action == 'unselected') {
                // supprimer le lien entre l'image et le jeu
                $req = $bdd->prepare("DELETE FROM game_images WHERE game_images.game_id = ? and game_images.image_id = ?");
                $req->execute(array($gameId, $imageId));
            } else if ($origin == 'unoriginal' && $action == 'selected') {
                // créer un lien entre l'image et le jeu
                $req = $bdd->prepare("INSERT INTO game_images(game_id, image_id) VALUES (?,?)");
                $req->execute(array($gameId, $imageId));
            } else if ($origin == 'added' && $action == 'selected') {
                $req = $bdd->prepare("INSERT INTO images(link) VALUES (?)");
                $req->execute(array($link));
                $newImageId = $bdd->lastInsertId();
                $req = $bdd->prepare("INSERT INTO game_images(game_id, image_id) VALUES (?,?)");
                $req->execute(array($gameId, $newImageId));
                if ($_POST['cover_id'] && $imageId == $_POST['cover_id']) {
                    $req = $bdd->prepare("UPDATE game SET cover_id = ? WHERE game.id = ?");
                    $req->execute(array($newImageId, $gameId));
                }
            } else if (($origin == 'original' || $origin == 'unoriginal') && $action == 'delete') {
                $req = $bdd->prepare("DELETE FROM images WHERE images.id = ?");
                $req->execute(array($imageId));
            }
        }
    }
    if (isset($_POST['game_categories'])) {
        $_POST['game_categories'] = explode(',', $_POST['game_categories']);
        foreach ($_POST['game_categories'] as $image) {
            $exploded = explode('::', $image);
            $catId = $exploded[0];
            $origin = $exploded[1];
            $action = $exploded[2];
            $label = isset($exploded[3]) ? $exploded[3] : null;
            if ($origin == 'original' && $action == 'unselected') {
                // supprimer le lien entre la catégorie et le jeu
                $req = $bdd->prepare("DELETE FROM link_categories WHERE link_categories.game_id = ? and link_categories.category_id = ?");
                $req->execute(array($gameId, $catId));
            } else if ($origin == 'unoriginal' && $action == 'selected') {
                // créer un lien entre la catégorie et  le jeu
                $req = $bdd->prepare("INSERT INTO link_categories(game_id, category_id) VALUES (?,?)");
                $req->execute(array($gameId, $catId));
            } else if ($origin == 'added' && $action == 'selected') {
                //créer une catégorie et la lier
                $req = $bdd->prepare("INSERT INTO category(label) VALUES (?)");
                $req->execute(array($label));
                $catId = $bdd->lastInsertId();
                $req = $bdd->prepare("INSERT INTO link_categories(game_id, category_id) VALUES (?,?)");
                $s = $req->execute(array($gameId, $catId));
            } else if (($origin == 'original' || $origin == 'unoriginal') && $action == 'delete') {
                //supprimer une catégorie existante
                $req = $bdd->prepare("DELETE FROM category WHERE category.id = ?");
                $req->execute(array($catId));
            }
        }
    }
    return ['req' => $req, 'success' => $success, 'false' => $false, 'true' => $true];
}
function getImages($bdd)
{
    $req = $bdd->prepare("SELECT * FROM images");
    $success = $req->execute();
    return $req;
    // return ['req' => $req, 'success' => $success, 'false' => $false, 'true' => $true];
}

function editAccount($bdd)
{
    global $fromFunction;
    $fromFunction = true;

    $true = 'Vos informations ont été modifiées';
    $false = "Vos informations n'ont pas pu être modifiées";
    $queryString = "UPDATE member SET";
    if (isset($_POST['picture'])) {
        $queryString = $queryString . " picture = '" . $_POST['picture'] . "',";
    }
    if (isset($_POST['lastname'])) {
        $queryString = $queryString . " lastname = '" . $_POST['lastname'] . "',";
    }
    if (isset($_POST['firstname'])) {
        $queryString = $queryString . " firstname = '" . $_POST['firstname'] . "',";
    }
    if (isset($_POST['birthdate'])) {
        $queryString = $queryString . " birthdate = '" . $_POST['birthdate'] . "'";
    }
    $queryString .= " WHERE member.id = ?";
    $req = $bdd->prepare($queryString);
    $success = $req->execute(array($_SESSION['id']));
    $userinfo = $bdd->prepare("SELECT * from member where member.id = ?");
    $userinfo->execute(array($_SESSION['id']));
    $userinfo = $userinfo->fetch(PDO::FETCH_ASSOC);
    create_session($userinfo);
    return ['req' => $req, 'success' => $success, 'false' => $false, 'true' => $true];
}

function sign_in($bdd)
{
    $email = htmlspecialchars($_POST['email']);
    $password = sha1($_POST['password']);
    $success = false;

    if (!empty($email) and !empty($password)) {
        $requser = $bdd->prepare("SELECT * FROM member WHERE email = ? AND password = ?");
        $requser->execute(array($email, $password));
        $userexist = $requser->rowCount();
        if ($userexist == 1) {
            $userinfo = $requser->fetch(PDO::FETCH_ASSOC);
            create_session($userinfo);
        } else {
            $notification = "Mauvais mail ou mot de passe !";
        }
    } else {
        $notification = "Tous les champs doivent être complétés !";
    }
    return array('notification' => $notification, 'success' => $success);
}

function sign_up($bdd)
{
    $lastname = htmlspecialchars($_POST['lastname']);
    $firstname = htmlspecialchars($_POST['firstname']);
    $password = sha1($_POST['password']);
    $email = htmlspecialchars($_POST['email']);
    $birthdate = htmlspecialchars($_POST['birthdate']);
    $success = false;

    if (!empty($_POST['lastname']) and !empty($_POST['firstname']) and !empty($_POST['email']) and !empty($_POST['password'])) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $reqmail = $bdd->prepare("SELECT * FROM member WHERE email = ?");
            $reqmail->execute(array($email));
            $mailexist = $reqmail->rowCount();
            if ($mailexist == 0) {
                $passwordLength = strlen($_POST['password']);
                if ($passwordLength >= 4) {
                    $insertmbr = $bdd->prepare("INSERT INTO member(firstname, lastname, password, email, birthdate) VALUES(?, ?, ?, ?, ?)");
                    $insertmbr->execute(array($firstname, $lastname, $password, $email, $birthdate));
                    $requser = $bdd->prepare("SELECT * FROM member WHERE email = ? AND password = ?");
                    $requser->execute(array($email, $password));
                    $userinfo = $requser->fetch(PDO::FETCH_ASSOC);
                    create_session($userinfo);
                } else {
                    $notification = "Votre mot de passe doit posséder au moins 4 caractères !";
                }
            } else {
                $notification = "Adresse mail déjà utilisée !";
            }
        } else {
            $notification = "Votre adresse mail n'est pas valide !";
        }
    } else {
        $notification = "Tous les champs doivent être complétés !";
    }
    return array('notification' => $notification, 'success' => $success);
}

function create_session($data)
{
    global $fromFunction;
    session_start();
    foreach ($data as $key => $value) {
        $_SESSION[$key] = $value;
    }
    if ($fromFunction === null) header('Location: ../');
}
