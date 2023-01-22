<?php

function getClients()
{
    global $bdd;
    $req = $bdd->prepare("SELECT client.id_client, date_created, est_ultimate, first_name, last_name, client.id_client, sum(quantite) as points FROM `client` left join point on point.id_client = client.id_client group by client.id_client");
    $req->execute();
    $req = $req->fetchAll(PDO::FETCH_ASSOC);
    return $req;
}
function getClient($id)
{
    global $bdd;
    $req = $bdd->prepare("SELECT email, phone_number, fb, ig, client.id_client, date_created, est_ultimate, first_name, last_name, client.id_client, sum(quantite) as points FROM `client` left join point on point.id_client = client.id_client where client.id_client = ? group by client.id_client");
    $req->execute(array($id));
    $req = $req->fetch(PDO::FETCH_ASSOC);
    return $req;
}

function insertClient($firstname, $lastname, $fb, $ig, $email, $phone)
{
    global $bdd;
    $req = $bdd->prepare("INSERT INTO client (first_name, last_name, fb, ig, email, phone_number) VALUES (?, ?, ?, ?, ?, ?)");
    return $req->execute(array(empty($firstname) ? null : $firstname, empty($lastname) ? null : $lastname, empty($fb) ? null : $fb, empty($ig) ? null : $ig, empty($email) ? null : $email, empty($phone) ? null : $phone));
}

function updateClient($id, $firstname, $lastname, $fb, $ig, $email, $phone, $ultimate)
{
    global $bdd;
    $params = array(empty($firstname) ? null : $firstname, empty($lastname) ? null : $lastname, empty($fb) ? null : $fb, empty($ig) ? null : $ig, empty($email) ? null : $email, empty($phone) ? null : $phone, $ultimate == "on" ? true : false, $id);
    $req = $bdd->prepare("UPDATE client SET first_name = ?, last_name = ?, fb = ?, ig = ?, email = ?, phone_number = ?, est_ultimate = ? WHERE id_client = ?");
    return $req->execute($params);
}

function getMembership($points)
{
    $membership = 'Silver';
    if ($points >= 300) $membership = 'Gold';
    if ($points >= 700) $membership = 'Platinum';
    return $membership;
}

function getItems()
{
    global $bdd;
    $req = $bdd->prepare("SELECT * FROM `item`");
    $req->execute();
    $req = $req->fetchAll(PDO::FETCH_ASSOC);
    return $req;
}

function getClientPoints($id)
{
    global $bdd;
    $req = $bdd->prepare("SELECT * FROM `point` WHERE point.id_client = ?");
    $req->execute(array($id));
    $req = $req->fetchAll(PDO::FETCH_ASSOC);
    return $req;
}

function getOrders()
{
    global $bdd;
    $req = $bdd->prepare("SELECT c.*, client.*, sum(prix_effectif * quantite) as total from commande as c natural join client left join contient on c.id_order = contient.id_order group by c.id_order");
    $req->execute();
    $req = $req->fetchAll(PDO::FETCH_ASSOC);
    return $req;
}
function getOrder($id)
{
    global $bdd;
    $req = $bdd->prepare("SELECT * FROM commande natural join client WHERE id_order = ?");
    $req->execute(array($id));
    $req = $req->fetch(PDO::FETCH_ASSOC);
    return $req;
}

function insertOrder($date_order, $order_status, $dispatched_date, $note, $frais_service, $frais_livraison, $id_client, $date_eta)
{
    global $bdd;
    $req = $bdd->prepare(
        "INSERT INTO commande (date_order, order_status, dispatched_date, note, frais_service, frais_livraison, id_client, date_eta) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)"
    );
    return $req->execute(array(
        $date_order,
        $order_status,
        empty($dispatched_date) ? null : $dispatched_date,
        empty($note) ? null : $note,
        empty($frais_service) ? null : $frais_service,
        empty($frais_livraison) ? null : $frais_livraison,
        $id_client,
        empty($date_eta) ? null : $date_eta
    ));
}

function updateOrder($id, $date_order, $order_status, $dispatched_date, $note, $frais_service, $frais_livraison, $id_client, $date_eta)
{
    global $bdd;
    $req = $bdd->prepare(
        "UPDATE commande SET date_order = ?, order_status = ?, dispatched_date = ?, note = ?, frais_service = ?, frais_livraison = ?, id_client = ?, date_eta = ? WHERE id_order = ?"
    );
    return $req->execute(array(
        $date_order,
        $order_status,
        empty($dispatched_date) ? null : $dispatched_date,
        empty($note) ? null : $note,
        empty($frais_service) ? null : $frais_service,
        empty($frais_livraison) ? null : $frais_livraison,
        $id_client,
        empty($date_eta) ? null : $date_eta,
        $id
    ));
}

function insertOrderItem($orderId, $itemId, $price, $quantity, $status)
{
    global $bdd;
    $req = $bdd->prepare(
        "INSERT INTO contient (id_order, id_item, prix_effectif, quantite, item_order_status) 
        VALUES (?, ?, ?, ?, ?)"
    );
    $result = $req->execute(array($orderId, $itemId, $status == "free-gift" ? 0 : $price, $quantity, $status));
    return $result;
}

function updateOrderItem($orderId, $itemId, $price, $quantity, $status)
{
    global $bdd;
    $req = $bdd->prepare(
        "UPDATE contient SET prix_effectif = ?, quantite = ?, item_order_status = ? 
        WHERE id_order = ? and id_item = ?"
    );
    return $req->execute(array($status == "free-gift" ? 0 : $price, $quantity, $status, $orderId, $itemId));
}

function getClientOrders($id)
{
    global $bdd;
    $req = $bdd->prepare("SELECT *, sum(prix_effectif * quantite) as total from commande natural join client left join contient on commande.id_order = contient.id_order WHERE commande.id_client = ? group by commande.id_order");
    $req->execute(array($id));
    $req = $req->fetchAll(PDO::FETCH_ASSOC);
    return $req;
}

function deleteOrderItemsNotInList($id, $list){
    global $bdd;
    $inQuery = implode(',', array_fill(0, count($list), '?'));
    empty($list) && $inQuery == null;
    $req = $bdd->prepare("DELETE FROM contient WHERE id_order = ? and id_item NOT IN (". (empty($inQuery) ? "''" : $inQuery) .")");
    $params = array_merge([$id], $list);
    return $req->execute($params);
}

function getOrderItems($id){
    global $bdd;
    $req = $bdd->prepare("SELECT * from item NATURAL JOIN contient WHERE contient.id_order = ?");
    $req->execute(array($id));
    $req = $req->fetchAll(PDO::FETCH_ASSOC);
    return $req;
}

function deleteOrder($id){
    global $bdd;
    $req = $bdd->prepare("DELETE FROM commande WHERE id_order = ?");
    return $req->execute(array($id));
}

function addPayment($orderId, $amount, $mode){
    global $bdd;
    $req = $bdd->prepare("INSERT INTO paiement (id_order, montant, mode_paiement) VALUES (?, ?, ?)");
    return $req->execute(array($orderId, $amount, $mode));
}

function getOrderPayments($orderId){
    global $bdd;
    $req = $bdd->prepare("SELECT * FROM paiement WHERE id_order = ?");
    $req->execute(array($orderId));
    return $req->fetchAll(PDO::FETCH_ASSOC);
}