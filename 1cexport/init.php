<?php
//***********************************************************************
// Назначение: Передача товаров из 1С в virtuemart
// Модуль: init.php - Инициализация выгрузки

//***********************************************************************

if ( !defined( 'VM_1CEXPORT' ) )
{
	print "<h1>Несанкционированный доступ</h1>Ваш IP уже отправлен администратору.";
	die();
}

if (VM_ZIP == 'yes')
{
	$upload = 'архив с файлами';	
}
else
{
	$upload = 'файлы без архива';
}
//$log->addEntry ( array ('comment' => 'Этап 2) Выгружаем '.$upload) );	
JLog::add ( 'Этап 2) Выгружаем '.$upload, JLog::INFO, 'vmshop_1c' );
print "zip=".VM_ZIP."\n";
print "file_limit=".VM_ZIPSIZE."\n";
//$log->addEntry ( array ('comment' => 'Этап 2) Успешно') );
JLog::add ( 'Этап 2) Успешно', JLog::INFO, 'vmshop_1c' );
?>