<!DOCTYPE html>
<html>
<head>
	<title>Add Film</title>
	<!-- <link rel="stylesheet" href="css/style.css"/> -->
	<!-- <link rel="import" href="test.html"/> -->
	<?php require_once("test.html") ?>
	<script>
		
		function checkForm(){
			if( document.getElementById('film_name').value.lenght < 1 ) {
				alert('name is required');
				return false;
			}
			
			if( document.getElementById('film_year').value.length != 4 ) {
				alert('year is required');
				return false;
			}
			if( document.getElementById('format_id').value == 0 ) {
				alert('format is required');
				return false;
			}
			
			return true;
		}
		
		
	</script>
</head>

<body>
	<div class="container">
		<div class="menu">
<a href="/admin/film">Films</a> | <a href="/admin/film/bulk">Film Bulk Upload</a>
</div>
		
		<div class="content">
			<h1>Film "New Film"</h1>
			
			<form method="post" action="/admin/film/save">
				<input type="hidden" name="film_id" value=""/>
				<table class="edit-form">
					<tr>
						<th>ID:</th>
						<td></td>
					</tr>
					<tr>
						<th>Name:<span class="required">*</span></th>
						<td><input type="text" name="film_name" id="film_name" value="New Film"/></td>
					</tr>
					<tr>
						<th>Year:<span class="required">*</span></th>
						<td><input type="text" name="film_year" id="film_year" value=""/></td>
					</tr>
					<tr>
						<th>Format:<span class="required">*</span></th>
						<td>
							<select name="format_id" id="format_id">
								<option value="0">-- select format --</option>
								
								<option value="3" >Blu-Ray</option>
								
								<option value="2" >DVD</option>
								
								<option value="1" >VHS</option>
								
							</select>
						</td>
					</tr>
					<tr>
						<th>Actors:</th>
						<td><textarea name="actors"></textarea></td>
					</tr>
					<tr>
						<td></td>
						<td><input type="submit" value="Save" onclick="return checkForm()"/></td>
					</tr>
				</table>
			</form>
			   
		</div>
	</div>
</body>
</html>
