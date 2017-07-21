<?php
require_once('header.html');
require_once('ConnectDB.php');
if (!empty($_POST))
{
$db = new ConnectDB();
$db->change_data("INSERT INTO `db_films`.`films` (id, title, release_year, format) VALUES (NULL, '$_POST[film_name]', '$_POST[film_year]', '$_POST[format_id]')");
    if (!empty($_POST['actors']))
    {
       $actors = preg_replace('/\s+/', ' ', $_POST['actors']);
       $actors = trim($actors);
        print_r($actors);
        echo "<br>";
       $actors = preg_split('/(\w+ \w+)*/', $actors);
       print_r($actors);
    }
$db->close_connection();
    echo "<!DOCTYPE html>
<html>
<head>
	<title>setup</title>
</head>
<body>
	<h3 align='center'>фільм додано в базу данних</h3>
	<div style='text-align: center'>
		<a href='index.php'>
		<button>на головну</button>
		</a>
	</div>
</body>
</html>";
    die();
}
?>
<link href="css/style.css" type="text/css" rel="stylesheet">
<script>
    function checkForm(){
        if(document.getElementById('film_name').value == '') {
            alert('вкажіть назву фільму');
            return false;
        }
        if(document.getElementById('film_name').value.length >= 64) {
            alert('назва фільму занадто довга');
            return false;
        }
        if( document.getElementById('format_id').value == 0 ) {
            alert('необхідно вибрати формат фільму');
            return false;
        }
        return true;
    }
</script>
<h1 align="center">Додати новий фільм</h1>
<form method="post" action="">
    <table class="edit-form" align="center">
        <tr>
            <th>ID:</th>
            <td></td>
        </tr>
        <tr>
            <th>Назва:<span>*</span></th>
            <td><input type="text" name="film_name" id="film_name" placeholder="новий фільм" /></td>
        </tr>
        <tr>
            <th>Рік випуску:<span>*</span></th>
            <td>
                <select name="film_year" id="film_year">
                    <?php
                    for ($year = date("Y"); $year >= 1895; $year--) {
                        echo "<option value='$year'> $year </option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <th>Формат:<span>*</span></th>
            <td>
                <select name="format_id" id="format_id">
                    <option value="0">-- вибрати формат --</option>

                    <option value="Blu-Ray" >Blu-Ray</option>

                    <option value="DVD" >DVD</option>

                    <option value="VHS" >VHS</option>

                </select>
            </td>
        </tr>
        <tr>
            <th>Список акторів:</th>
            <td><textarea name="actors" placeholder="актор 1, актор 2, актор 3,..."></textarea></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" value="зберегти" onclick="return checkForm()"/></td>
        </tr>
    </table>
</form>
</body>
</html>
