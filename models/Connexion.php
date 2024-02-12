<?php
function connexion(){
		static $connect = null;
		if ($connect===null) {
			$connect = mysqli_connect('localhost','root','Andrew2963','the');
		}else{
		}
		return $connect;
	}
?>