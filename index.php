<?php
require_once ('ConnectDB.php');

$table = new ConnectDB();
$sql = "SELECT DISTINCT `films`.`id`, `films`.`title`, `films`.`release_year`, `films`.`format` FROM `films`";
require_once('header.html');
?>
<table class="table-data" align="center">
			<tr>
				<th>id</th>
				<th>назва</th>
				<th>рік</th>
				<th>формат</th>
				<th><input type="checkbox" onclick="checkAll(this)" title="вибрати всі" /></th>
			</tr>
	<?php
    if (isset($_GET['search']))
    {
        $sql .= "JOIN `films_stars` ON `films`.`id` = `films_stars`.`film`
        JOIN `stars` ON `stars`.`id` = `films_stars`.`star`
        WHERE `films`.`title` LIKE '%$_GET[search]%' OR `stars`.`first_name`
        LIKE '%$_GET[search]%' OR `stars`.`last_name` LIKE '%$_GET[search]%'";
    }
    if (isset($_POST['desc']))
    {
        $sql .= "ORDER BY `films`.`title` DESC";
    }
    else if (isset($_POST['asc']))
    {
        $sql .= "ORDER BY `films`.`title` ASC";
    }
    $table_data = $table->get_table($sql);
    echo $table_data;
    $table->close_connection();
	?>
</table>

</body>
</html>