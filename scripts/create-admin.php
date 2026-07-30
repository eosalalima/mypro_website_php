<?php
declare(strict_types=1);
require dirname(__DIR__).'/app/bootstrap.php';
use MyPro\{Database,Env};
$email=Env::get('ADMIN_EMAIL');$password=Env::get('ADMIN_PASSWORD');
if(!$email||!$password){fwrite(STDERR,"Set ADMIN_EMAIL and ADMIN_PASSWORD in .env first.\n");exit(1);} if(strlen($password)<12){fwrite(STDERR,"ADMIN_PASSWORD must contain at least 12 characters.\n");exit(1);}
$sql='INSERT INTO users(name,email,password,role) VALUES(?,?,?,?)';try{Database::connect()->prepare($sql)->execute([Env::get('ADMIN_NAME','MyPro Administrator'),strtolower($email),password_hash($password,PASSWORD_DEFAULT),'admin']);echo "Administrator created.\n";}catch(Throwable){fwrite(STDERR,"That administrator may already exist.\n");exit(1);}
