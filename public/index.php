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
    $db = new PDO($dsn, $_ENV['DATABASE_USER'], $_ENV['DATABASE_PASSWORD']);
} catch (PDOException $e) {
    header('Content-Type: text/plain; charset=UTF-8', true, 500);
    exit($e->getMessage());
}

$charactor_mapper = new CharactorMapper($db);

$Yamada = new Charactor;
$Yamada->name = '山田';

$charactor_mapper->insert($Yamada);

$result = $charactor_mapper->findAll()->fetchAll();
?>

<pre>
<?= var_dump($charactor_mapper); ?>
</pre>

<hr>

<pre>
<?= var_dump($result); ?>
</pre>
