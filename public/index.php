<?php

// comlposerは使えません
require_once '/var/www/html/public/App/Models/AbstractDataMapper.php';
require_once '/var/www/html/public/App/Models/AbstractDataModel.php';
require_once '/var/www/html/public/App/Models/CharactorMapper.php';
require_once '/var/www/html/public/App/Models/Charactor.php';
require_once '/var/www/html/public/App/Controllers/CharactorController.php';

// start
$dsn = "mysql:host={$_ENV['DATABASE_HOST']};dbname={$_ENV['DATABASE_NAME']};charset=utf8";

try {
    $db = new \PDO($dsn, $_ENV['DATABASE_USER'], $_ENV['DATABASE_PASSWORD']);
} catch (PDOException $e) {
    header('Content-Type: text/plain; charset=UTF-8', true, 500);
    exit($e->getMessage());
}

$charactor = new Charactor;
$charactor->name = '山田';
$charactor->grade = '1';
$charactor->atk = '2';
$charactor->def = '3';
$date = new DateTime();
$charactor->created_at = $date->format('Y-m-d H:i:s');

$charactor_mapper = new CharactorMapper($db);
$charactor_mapper->insert($charactor);


$result = $charactor_mapper->findAll()->fetchAll();
?>

<pre>
<?= var_dump($charactor); ?>
</pre>

<hr>

<pre>
<?= var_dump($result); ?>
</pre>