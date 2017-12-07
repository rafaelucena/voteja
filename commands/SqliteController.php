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
    private $file_path;

    private $file_handler;

    private $file_content;

    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     */
    public function actionIndex($message = 'hello feioso')
    {
        $this->file_path = Yii::getAlias('@app') . "/database/voteja_mysql.sql";

        if ($this->openQueryFile()) {
            $mainString = $this->getQueryFileContent();

            $noHeaders = $this->removeHeaders($mainString);

            $differentQuotes = $this->replaceQuotes($noHeaders);

            $noSchemas = $this->removeSchemas($differentQuotes);

            echo $noSchemas;
            $this->closeQueryFile();
        }

        return ExitCode::OK;
    }

    private function openQueryFile()
    {
        $this->file_handler = fopen($this->file_path, "r") or die("Unable to open file!");

        return $this->file_handler;
    }

    private function getQueryFileContent()
    {
        $this->file_content = fread($this->file_handler, filesize($this->file_path));

        return $this->file_content;
    }

    private function closeQueryFile()
    {
        return fclose($this->file_handler);
    }

    /** ============================================================================================================ **/

    private function removeHeaders($string)
    {
        $headerStart = 'DROP TABLE IF EXISTS';

        $findHeader = strpos($string, $headerStart);

        if ($findHeader) {
            $string = substr($string, $findHeader);
        }

        return $string;
    }

    private function replaceQuotes($string)
    {
        $oldQuote = '`';
        $newQuote = "'";

        $string = str_replace($oldQuote, $newQuote, $string);

        return $string;
    }

    private function removeSchemas($string)
    {
        $findSchemaPattern = "('mydb'[?\.])";

        $string = preg_replace($findSchemaPattern, '', $string);

        return $string;
    }
}
