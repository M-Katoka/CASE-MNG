<?php
$config=is_file(__DIR__.'/config.php')?require __DIR__.'/config.php':[];
$host=getenv('NGO_DB_HOST')?:($config['host']??'127.0.0.1');
$port=getenv('NGO_DB_PORT')?:($config['port']??3317);
$db=getenv('NGO_DB_NAME')?:($config['database']??'ngo_imported_v2');
$user=getenv('NGO_DB_USER')?:($config['user']??'root');
$pass=getenv('NGO_DB_PASSWORD')!==false?getenv('NGO_DB_PASSWORD'):($config['password']??'');
$pdo=new PDO("mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4",$user,$pass,[PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC,PDO::ATTR_EMULATE_PREPARES=>false]);
