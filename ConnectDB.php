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

    public function __construct()
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

    public function get_table($query) {
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

    public function get_result($query) {
        try {
            $result_statement = $this->bdd->query($query);
            $result = $result_statement->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e)
        {
            die('Error : ' . $e->getMessage());
        }

        return ($result);
    }

    public function change_data($sql) {
	    try {
            $this->bdd->exec($sql);
        } catch(PDOException $e)
        {
            die('Error : ' . $e->getMessage());
        }
    }

    public function close_connection() {
        try {
            $this->bdd = null;
        }
        catch (PDOException $e) {
            die('Error : ' . $e->getMessage());
        }
    }

    public function add_actors($id_film, $actors) {
        $actors = trim($actors);
        $actors = preg_replace('/\s+/', ' ', $actors);
        $actors = preg_split('/, /', $actors);
        foreach ($actors as $actor) {
            if (strlen($actor) > 1) {
                $actor = explode(' ', $actor, 2);
                $found_actor = $this->get_result("SELECT `stars`.`id`, `stars`.`first_name`, `stars`.`last_name`
                FROM `stars` WHERE `stars`.`first_name` = '$actor[0]' AND `stars`.`last_name` = '$actor[1]'");
                if (empty($found_actor)) {
                    $this->change_data("INSERT INTO `db_films`.`stars` (id, first_name, last_name)
                    VALUES (NULL, '$actor[0]', '$actor[1]')");
                }
                $id_actor = $this->get_result("SELECT `stars`.`id` FROM `stars`
                WHERE `stars`.`first_name` = '$actor[0]' AND `stars`.`last_name` = '$actor[1]'");
                $id_actor = $id_actor[0];
                $this->change_data("INSERT INTO `db_films`.`films_stars` (id, film, star)
                VALUE (NULL, '$id_film', '$id_actor[id]')");
            }
        }
    }

    public static function show_message($message) {
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
}


?>