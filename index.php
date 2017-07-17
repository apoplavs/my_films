<?php
//require_once('config/database.php');
require_once ('TableCreator.php');

$table = new TableCreator();
//
//if (!empty($result))
//{
//    print_r($result);
//}
//else {
//    echo "ferfc";
//}
require_once('header.html');
$table->get_table("SELECT films.id, films.title, films.release_year, films.format, stars.first_name, stars.last_name FROM films JOIN stars WHERE films_stars.film = films_stars.star");
?>

<table class="table-data" align="center">
				<tr>
					<th>id</th>
					<th>назва</th>
					<th>рік</th>
					<th>у головних ролях</th>
					<th><input type="checkbox" onclick="checkAll(this)" title="вибрати всі" /></th>
				</tr>
    </table>

</body>
</html>