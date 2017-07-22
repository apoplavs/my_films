<?php
/**
 * Created by PhpStorm.
 * User: andriy
 * Date: 17.07.17
 * Time: 13:36
 */
class ConnectDB
{
	private $bdd;

	function __construct()
	{
		require_once('config/database.php');
		try
		{
			$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch(PDOException $e)
		{
			die('Error : ' . $e->getMessage());
		}
		$this->bdd = $bdd;
	}

	function get_table($query) {
		$table = "	";
		$result_statement = $this->bdd->query($query);
		$result = $result_statement->fetchAll(PDO::FETCH_ASSOC);
		if (empty($result))
        {
            $table .= "	<tr>
				<td colspan='5'><h2>записів не знайдено</h2></td>
			</tr>
		";
        }
        else {
            foreach ($result as $res) {
                $table .= "	<tr>
				<td>$res[id]</td>
				<td><a href='film-info.php?id=$res[id]'>$res[title]</a></td>
				<td>$res[release_year]</td>
				<td>$res[format]</td>
				<td><input type='checkbox' class='thing' name='$res[id]' value='$res[id]' form='delete-selected' /></td>
			</tr>
		";
            }
        }
	return ($table);
	}

	function get_result($query) {
        $result_statement = $this->bdd->query($query);
        $result = $result_statement->fetchAll(PDO::FETCH_ASSOC);
        return ($result);
    }

    function change_data($sql) {
        if ($this->bdd->exec($sql) === 'false') {
            show_message("Сталась помилка!");
        }
    }

    function close_connection() {
        try {
            $this->bdd = null;
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    function add_actors($id_film, $actors) {
        $actors = preg_replace('/\s+/', ' ', $actors);
        $actors = trim($actors);
        $actors = preg_split('/, /', $actors);
        print_r($actors);
        echo "<br>";
        foreach ($actors as $actor) {
            if (strlen($actor) > 1) {
                $actor = explode(' ', $actor, 2);
                print_r($actor);
                echo "<br>";
            }
        }
    }
}

function show_message($message) {
    echo "<!DOCTYPE html>
<html>
<head>
	<title>setup</title>
</head>
<body>
	<h3 align='center'>$message</h3>
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