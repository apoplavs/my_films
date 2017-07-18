<?php
session_start();
require_once ('TableCreator.php');

$table = new TableCreator();
$sql = "SELECT * FROM `films`";
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
        $sql .= "WHERE `films`.`title` LIKE '%$_GET[search]%'";
    }
    if (isset($_POST['desc']))
    {
        $sql .= "ORDER BY `films`.`title` DESC";
    }
    if (isset($_POST['asc']))
    {
        $sql .= "ORDER BY `films`.`title` ASC";
    }
    $table_data = $table->get_table($sql);
    echo $table_data;
    print_r($_GET);
    echo "<br/>";
    print_r($_POST);
	?>
</table>

</body>
</html>