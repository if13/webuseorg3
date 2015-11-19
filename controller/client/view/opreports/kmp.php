<?php

// Данный код создан и распространяется по лицензии GPL v3
// Изначальный автор данного кода - Грибов Павел
// http://грибовы.рф
 
include_once ("../../../../config.php");                    // загружаем первоначальные настройки

// загружаем классы

include_once("../../../../class/sql.php");               // загружаем классы работы с БД
include_once("../../../../class/config.php");		// загружаем классы настроек
include_once("../../../../class/users.php");		// загружаем классы работы с пользователями
include_once("../../../../class/employees.php");		// загружаем классы работы с профилем пользователя


// загружаем все что нужно для работы движка

include_once("../../../../inc/connect.php");		// соеденяемся с БД, получаем $mysql_base_id
include_once("../../../../inc/config.php");              // подгружаем настройки из БД, получаем заполненый класс $cfg
include_once("../../../../inc/functions.php");		// загружаем функции
include_once("../../../../inc/login.php");		// логинимся

$nome_group=_GET("nome_group");


  include_once("config.php");                  // загружаем настройки и функции для работы с 1С
  function GetData($idc, $txt){
	  if (is_object($idc)){
		
		try {
		  $par = array('kode' => $txt);
		  //var_dump($par);
		  $ret1c = $idc->GetListTMC($par);
		} catch (SoapFault $e) {
                      echo "АЩИБКА!!! </br>";
			var_dump($e);
		} 	
	  }
	  else{
		echo 'Не удалося подключиться к 1С<br>';
		var_dump($idc);
	  }
	return $ret1c;
  }
  
  $idc = Connect1C("http://10.80.16.34/upp_rss/ws/ws1.1cws?wsdl");
  $ret1c = GetData($idc, $nome_group);
  //var_dump($ret1c);
  $aa=$ret1c->return;
  echo "$aa";  

?>
