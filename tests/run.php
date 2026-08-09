<?php
declare(strict_types=1);
$database = sys_get_temp_dir().'/mypro-tests-'.bin2hex(random_bytes(6)).'.sqlite';
$_ENV['DB_DSN'] = 'sqlite:'.$database;
register_shutdown_function(static fn () => is_file($database) && unlink($database));
ob_start();
require dirname(__DIR__).'/scripts/install.php';
ob_end_clean();
use MyPro\{Content,Database};
$tests=[];$test=function(string $name,callable $fn)use(&$tests){try{$fn();echo "PASS $name\n";$tests[]=true;}catch(Throwable $e){echo "FAIL $name: {$e->getMessage()}\n";$tests[]=false;}};$assert=function(bool $value,string $message='Assertion failed'){if(!$value)throw new RuntimeException($message);};
$test('database schema is installed',function()use($assert){$tables=Database::connect()->query("SELECT name FROM sqlite_master WHERE type='table'")->fetchAll(PDO::FETCH_COLUMN);foreach(['users','contents','inquiries','settings'] as $name)$assert(in_array($name,$tables,true),"Missing $name table");});
$test('relative SQLite configuration resolves from project root',function()use($assert){$method=new ReflectionMethod(Database::class,'normalizeSqliteDsn');$method->setAccessible(true);$dsn=$method->invoke(null,'sqlite:storage/example.sqlite');$assert($dsn==='sqlite:'.dirname(__DIR__).'/storage/example.sqlite','Relative SQLite DSN was not normalized');});
$test('five core services are published',function()use($assert){$services=Content::published('service');$assert(count($services)===5,'Expected exactly five seeded services');$assert($services[0]['slug']==='it-infrastructure');});
$test('verified contact settings are centralized',function()use($assert){$s=Content::settings();$assert($s['email']==='sales.myprosolinc@gmail.com');$assert($s['phone_primary']==='+632 9177936188');});
$test('public content is cached and CMS invalidation refreshes it',function()use($assert){
    $before=Content::published('service');
    Database::connect()->prepare("UPDATE contents SET title='Updated service' WHERE type='service' AND slug='it-infrastructure'")->execute();
    $cached=Content::published('service');
    $assert($cached[0]['title']===$before[0]['title'],'Expected the request cache to avoid another query');
    Content::clearCache();
    $fresh=Content::published('service');
    $assert($fresh[0]['title']==='Updated service','Expected invalidation to refresh cached content');
});
$test('password hashing and verification use PHP APIs',function()use($assert){$hash=password_hash('A-long-test-password!',PASSWORD_DEFAULT);$assert(password_verify('A-long-test-password!',$hash));$assert(!password_verify('wrong',$hash));});
$test('HTML escaping prevents markup injection',function()use($assert){$assert(e('<script>alert(1)</script>')==='&lt;script&gt;alert(1)&lt;/script&gt;');});
$test('sample claims are clearly identified',function()use($assert){$items=Content::published('project');$assert(str_starts_with($items[0]['title'],'Sample:'));$assert(str_contains($items[0]['body'],'sample content'));});
$failed=count(array_filter($tests,fn($x)=>!$x));echo "\n".count($tests)." tests, $failed failures.\n";exit($failed?1:0);
