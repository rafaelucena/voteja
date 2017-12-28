<?php

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

// Custom helpers
Yii::$classMap['yii\helpers\Common'] = '@app/components/Common.php';
Yii::$classMap['yii\helpers\Data'] = '@app/components/Data.php';

$config = require __DIR__ . '/../config/web.php';

(new yii\web\Application($config))->run();
