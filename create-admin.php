<?php

declare(strict_types=1);

defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/vendor/yiisoft/yii2/Yii.php';
require __DIR__ . '/common/config/bootstrap.php';
require __DIR__ . '/console/config/bootstrap.php';

$config = yii\helpers\ArrayHelper::merge(
    require __DIR__ . '/common/config/main.php',
    require __DIR__ . '/common/config/main-local.php',
    require __DIR__ . '/console/config/main.php',
    require __DIR__ . '/console/config/main-local.php'
);

$app = new yii\console\Application($config);

$username = $argv[1] ?? 'admin';
$email = $argv[2] ?? 'admin@example.com';
$password = $argv[3] ?? 'admin123';

$user = new common\models\User();
$user->username = $username;
$user->email = $email;
$user->status = common\models\User::STATUS_ACTIVE;
$user->setPassword($password);
$user->generateAuthKey();
$user->generateEmailVerificationToken();

if (!$user->save()) {
    fwrite(STDERR, "Failed to create user:\n");
    foreach ($user->getErrors() as $attr => $errors) {
        foreach ($errors as $err) {
            fwrite(STDERR, "- {$attr}: {$err}\n");
        }
    }
    exit(1);
}

fwrite(STDOUT, "Created user:\n");
fwrite(STDOUT, "- id: {$user->id}\n");
fwrite(STDOUT, "- username: {$username}\n");
fwrite(STDOUT, "- email: {$email}\n");
fwrite(STDOUT, "- password: {$password}\n");

