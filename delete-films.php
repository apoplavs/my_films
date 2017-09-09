<?php
/**
 * Created by PhpStorm.
 * User: andriy
 * Date: 23.07.17
 * Time: 19:22
 */

if (!empty($_POST)) {
    require_once ('ConnectDB.php');
    $db = new ConnectDB();
    foreach ($_POST as $id_film) {
        $id = intval($id_film);
        $actors = $db->get_result("SELECT `films_stars`.`star`
        FROM `films_stars` WHERE `films_stars`.`film` = $id");
        if (!empty($actors)) {
            foreach ($actors as $actor) {
                $id_actor = intval($actor['star']);
                $films_with_actor = $db->get_result("SELECT `films_stars`.`id`
                FROM `films_stars` WHERE `films_stars`.`star` = $id_actor");
                $db->change_data("DELETE FROM `db_films`.`films_stars`
                WHERE `films_stars`.`star` = $id_actor AND `films_stars`.`film` = $id");
                if (count($films_with_actor) < 2) {
                    $db->change_data("DELETE FROM `db_films`.`stars` WHERE `stars`.`id` = $id_actor");
                }
            }
        }
        $db->change_data("DELETE FROM `films` WHERE `films`.`id` = $id;");
    }
}
header("Location: index.php");
?>