<?php
declare(strict_types=1);
$root=dirname(__DIR__);$files=[];$it=new RecursiveIteratorIterator(new RecursiveDirectoryIterator($root,FilesystemIterator::SKIP_DOTS));foreach($it as $f){$p=$f->getPathname();if($f->getExtension()==='php'&&!str_contains($p.'/','/vendor/'))$files[]=$p;}
$bad=0;foreach($files as $file){exec(escapeshellarg(PHP_BINARY).' -l '.escapeshellarg($file),$out,$code);if($code!==0){echo implode("\n",$out)."\n";$bad++;}$out=[];}echo count($files)." PHP files checked; $bad errors.\n";exit($bad?1:0);
