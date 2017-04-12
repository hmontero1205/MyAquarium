<?php
	$tbl = $_GET['table'];
	$conn = new PDO("mysql:hostname=localhost;dbname=hans", "root", "");
	$user = $_GET['user'];

	function getDatabaseResults($cmd){
		global $conn;
		$dataResult = $conn->prepare($cmd);
		$dataResult->execute();
		return $dataResult->fetchAll(PDO::FETCH_ASSOC);
	}	

	if($tbl=='userd'){
		if($_GET['action']=='update'){
	
			$col = $_GET['column'];
			$val = $_GET['value'];

			$userCMD = "UPDATE `{$tbl}` SET `{$col}`={$val} WHERE `username`='{$user}'";
			$userResult = $conn->prepare($userCMD);
			$userResult->execute();
		}
	}
	if($tbl=='fishd'){
		if($_GET['action']=='return'){
			echo json_encode(getDatabaseResults("SELECT * FROM `fishd` WHERE `username`='{$user}'"));
		}
		
		else{	
			if($_GET['action']=='add'){
				$fBreed = $_GET['bd'];
				$fPrice = $_GET['price'];
				$fIdx = $_GET['idx'];
				$fImg = $_GET['img'];

				$fishCMD = "INSERT INTO `{$tbl}`(`breed`,`price`,`idx`,`img`,`username`) VALUES ('{$fBreed}',{$fPrice},'{$fIdx}','{$fImg}','{$user}')";
				$newFish = $conn->prepare($fishCMD);
				$newFish->execute();
			}
			else{
				$fIdx = $_GET['idx'];
				$removeCMD = "DELETE FROM `$tbl` WHERE `idx`={$fIdx}";
				$removedTable = $conn->prepare($removeCMD);
				$removedTable->execute();
			}
		}
	}

	if($tbl=='decord'){

		if($_GET['action']=='return')
			echo json_encode(getDatabaseResults("SELECT * FROM `decord` WHERE `username`='{$user}'"));
		else{
			$sTop = $_GET['top'];
			$sLeft = $_GET['left'];
			$dIdx = $_GET['idx'];
			$dZ = $_GET['z'];
			$dPrice = $_GET['price'];
			$dImg = $_GET['img'];

			$decorCMD = "INSERT INTO `{$tbl}` (`cTop`,`cLeft`,`idx`,`z`,`price`,`img`,`username`) VALUES ('{$sTop}','{$sLeft}','{$dIdx}',{$dZ},{$dPrice},'{$dImg}','{$user}')";
			$newDecor = $conn->prepare($decorCMD);
			$newDecor->execute();
		}
	}
	



?>