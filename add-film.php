<?php
require_once("header.html");
print_r($_POST);
if (!empty($_POST))
{
$db = new ConnectDB();
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
            <td><textarea name="actors"></textarea></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" value="зберегти" onclick="return checkForm()"/></td>
        </tr>
    </table>
</form>
</body>
</html>
