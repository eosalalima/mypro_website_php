<?php
declare(strict_types=1);
require dirname(__DIR__).'/app/bootstrap.php';
use MyPro\{Content,Database};
$tests=[];$test=function(string $name,callable $fn)use(&$tests){try{$fn();echo "PASS $name\n";$tests[]=true;}catch(Throwable $e){echo "FAIL $name: {$e->getMessage()}\n";$tests[]=false;}};$assert=function(bool $value,string $message='Assertion failed'){if(!$value)throw new RuntimeException($message);};
$test('database schema is installed',function()use($assert){$tables=Database::connect()->query("SELECT name FROM sqlite_master WHERE type='table'")->fetchAll(PDO::FETCH_COLUMN);foreach(['users','contents','inquiries','settings'] as $name)$assert(in_array($name,$tables,true),"Missing $name table");});
$test('five core services are published',function()use($assert){$services=Content::published('service');$assert(count($services)===5,'Expected exactly five seeded services');$assert($services[0]['slug']==='it-infrastructure');});
$test('verified contact settings are centralized',function()use($assert){$s=Content::settings();$assert($s['email']==='sales.myprosolinc@gmail.com');$assert($s['phone_primary']==='+632 9177936188');});
$test('password hashing and verification use PHP APIs',function()use($assert){$hash=password_hash('A-long-test-password!',PASSWORD_DEFAULT);$assert(password_verify('A-long-test-password!',$hash));$assert(!password_verify('wrong',$hash));});
$test('HTML escaping prevents markup injection',function()use($assert){$assert(e('<script>alert(1)</script>')==='&lt;script&gt;alert(1)&lt;/script&gt;');});
$test('sample claims are clearly identified',function()use($assert){$items=Content::published('project');$assert(str_starts_with($items[0]['title'],'Sample:'));$assert(str_contains($items[0]['body'],'sample content'));});
$failed=count(array_filter($tests,fn($x)=>!$x));echo "\n".count($tests)." tests, $failed failures.\n";exit($failed?1:0);
