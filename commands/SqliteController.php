<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use yii\console\Controller;
use yii\console\ExitCode;
use Yii;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class SqliteController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     */
    public function actionIndex($message = 'hello feioso')
    {
        $myfile = fopen(Yii::getAlias('@app') . "/database/voteja_mysql.sql", "r") or die("Unable to open file!");
        echo fread($myfile,filesize(Yii::getAlias('@app') . "/database/voteja_mysql.sql"));
        fclose($myfile);

        return ExitCode::OK;
    }
}
