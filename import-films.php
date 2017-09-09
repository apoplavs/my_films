<?php
/**
 * Created by PhpStorm.
 * User: andriy
 * Date: 17.07.18
 * Time: 10:21
 */
require_once ('ConnectDB.php');
$db = new ConnectDB();
$array_films = file($_FILES['choice-file']['name'], FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$validator = array(
    'title' => 'Title: ',
    'title_len' => 7,
    'year' => 'Release Year: ',
    'year_len' => 14,
    'format' => 'Format: ',
    'format_len' => 8,
    'stars' => 'Stars: ',
    'stars_len' => 7,
);
$i = 0;
$array_len = count($array_films);
while ($i < $array_len) {
    if (strpos($array_films[$i], $validator['title'])  === 'false'
        || strpos($array_films[$i + 1], $validator['year'])  === 'false'
        || strpos($array_films[$i + 2], $validator['format'])  === 'false'
        || strpos($array_films[$i + 3], $validator['stars'])  === 'false') {
        ConnectDB::show_message('файл "'. $_FILES['choice-file']['name'] . '" не валідний');
        }
    $title = substr($array_films[$i], $validator['title_len']);
    $i++;
    $year = substr($array_films[$i], $validator['year_len']);
    $i++;
    $format = substr($array_films[$i], $validator['format_len']);
    if (strcmp($format, 'VHS')
        && strcmp($format, 'DVD')
        &&strcmp($format, 'Blu-Ray')) {
        ConnectDB::show_message('невідомий формат фільму: ' . $format);
    }
    $i++;
    $stars = substr($array_films[$i], $validator['stars_len']);
    $i++;
    $year = intval($year);
    $film_exists = $db->get_result("SELECT * FROM `db_films`.`films` WHERE `title` = '$title' AND `release_year` = '$year' AND `format` = '$format'");
    if (empty($film_exists)) {
        $db->change_data("INSERT INTO `db_films`.`films` (`id`, `title`, `release_year`, `format`) VALUES (NULL, '$title', '$year', '$format')");
        if (!empty($stars)) {
            $id_film = $db->get_result("SELECT MAX(id) AS id FROM `db_films`.`films`");
            $id_film = $id_film[0];
            $db->add_actors($id_film['id'],$stars);
        }
    }
}
$db->close_connection();
header("Location: index.php");
?>