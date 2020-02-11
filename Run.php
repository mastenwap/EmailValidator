<?php

// Author : Mas TenWap 
// AnonCybeTeam
// Date : 11/02/2020


// Jika ada error silahkan hapus saja fungsi cek koneksi nya
function CekKoneksi()
{
	$Koneksi = @fsockopen("www.tools.anoncyberteam.or.id", 443); 

	if ($Koneksi){
		$Kon = true;
		fclose($Koneksi);
	}else{
		$Kon = false; 
		echo "Tidak Ada Koneksi Internet !!! ";
		exit();
	}
	return $Kon;

}

// batas hapus sampai sini 

function Lari($param)
{

	$ch = curl_init(); 

	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_URL, "https://tools.anoncyberteam.or.id/ApiChecker/ApiCheckerProses");
	curl_setopt($ch, CURLOPT_POSTFIELDS,"email=$param");
	$headers = [
		'token: lER2MLyGC6Go3rNdE7diPVf0umanUuTf8KhVwPB9ViyZJldnsqFhmViQisdcW6s4'
	];

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);


	$output = curl_exec($ch);

	curl_close($ch);   
	$data = json_decode($output,true);
	print_r($output);
	if ($output == "Token Invalid Bosque") {
		echo "\nToken Kamu Invalid , Coba Request Ke Developer Ya";
		exit();
	}else{
		$file = fopen('LogEmailValidatorACT.txt', 'a+') or die ("gabisa di buka bosque !");
		$isi  = $param." ".$output."\n\n";
		fwrite($file, $isi);
		fclose($file); 
	}

}




$file_handle = fopen("Mail.txt", "rb");
while (!feof($file_handle) ) {
	if (CekKoneksi() == true) {
		$line_of_text = fgets($file_handle);
		$parts = explode('\n', $line_of_text);
		echo "$parts[0]\n";
		Lari($parts[0]);
		echo "\n";
	}else{

	}
}
fclose($file_handle);


?>
