<?php
	include('session.php');
	
	$fileInfo = PATHINFO($_FILES["image"]["name"]);
	
	if (empty($_FILES["image"]["name"])){
		$location=$srow['photo'];
		?>
			<script>
				window.alert('Загруженная фотография пуста!');
				window.history.back();
			</script>
		<?php
	}
	else{
		if ($fileInfo['extension'] == "jpg" OR $fileInfo['extension'] == "png") {
			$newFilename = $fileInfo['filename'] . "_" . time() . "." . $fileInfo['extension'];
			move_uploaded_file($_FILES["image"]["tmp_name"], "../upload/" . $newFilename);
			$location = "upload/" . $newFilename;
			
			mysqli_query($conn,"update `user` set photo='$location' where userid='".$_SESSION['id']."'");
	
			?>
				<script>
					window.alert('ЗФото успешно обновлено!');
					window.history.back();
				</script>
			<?php
		}
		else{
			?>
				<script>
					window.alert('Фотография не обновлена. Пожалуйста, загружайте только файлы в формате JPG или PNG!');
					window.history.back();
				</script>
			<?php
		}
	}
	
	

?>