<?php
require_once ('ConnectDB.php');
require_once('header.html');
$db = new ConnectDB();
$id = intval($_GET['id']);
$film = $db->get_result("SELECT `films`.`id`, `films`.`title`, `films`.`release_year`, `films`.`format`
FROM `films` WHERE `films`.`id` = $id");
if (empty($film)) {
    header("Location: index.php");
}
$film = $film[0];
$id_actors = $db->get_result("SELECT `films_stars`.`star`
        FROM `films_stars` WHERE `films_stars`.`film` = $id");
$actors = "";
if (!empty($id_actors)) {
    foreach ($id_actors as $id_actor) {
        $id_actor = intval($id_actor['star']);
        $actor_info = $db->get_result("SELECT `stars`.`first_name`, `stars`.`last_name`
        FROM `stars` WHERE `stars`.`id` = $id_actor");
        $actor_info = $actor_info[0];
        $actors .= $actor_info['first_name'] . ' ' . $actor_info['last_name'] . '<br>';
    }
}
else {
    $actors = '-';
}
?>
<link href="css/style.css" type="text/css" rel="stylesheet">
<h1 align="center">Інформація про фільм</h1>
    <table class="edit-form" align="center">
        <tr>
            <th>ID:</th>
            <td><?=$film['id']?></td>
        </tr>
        <tr>
            <th>Назва:</th>
            <td><?=$film['title']?></td>
        </tr>
        <tr>
            <th>Рік випуску:</th>
            <td><?=$film['release_year']?></td>
        </tr>
        <tr>
            <th>Формат:</th>
            <td><?=$film['format']?></td>
        </tr>
        <tr>
            <th>Актори:</th>
            <td><?=$actors?></td>
        </tr>
    </table>
</body>
</html>

