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
     * @var
     */
    private $file_path;

    /**
     * @var
     */
    private $file_handler;

    /**
     * @var
     */
    private $file_content;

    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     */
    public function actionIndex()
    {
        $this->file_path = Yii::getAlias('@app') . "/database/voteja_mysql.sql";

        if ($this->openQueryFile()) {
            $mainString = $this->getQueryFileContent();

            $differentQuotes = $this->replaceQuotes($mainString);

            $noSets = $this->removeSets($differentQuotes);

            $noComments = $this->removeComments($noSets);

            $noSchemas = $this->removeSchemas($noComments);

            $noHeaders = $this->removeHeaders($noSchemas);

            $noEngines = $this->removeEngines($noHeaders);

            echo $noEngines;

            $this->closeQueryFile();
        }

        return ExitCode::OK;
    }

    /**
     * @return bool|resource
     */
    private function openQueryFile()
    {
        $this->file_handler = fopen($this->file_path, "r") or die("Unable to open file!");

        return $this->file_handler;
    }

    /**
     * @return bool|string
     */
    private function getQueryFileContent()
    {
        $this->file_content = fread($this->file_handler, filesize($this->file_path));

        return $this->file_content;
    }

    /**
     * @return bool
     */
    private function closeQueryFile()
    {
        return fclose($this->file_handler);
    }

    /** ============================================================================================================ **/

    /**
     * @param $string
     * @return mixed
     */
    private function replaceQuotes($string)
    {
        $oldQuote = '`';
        $newQuote = "'";

        $string = str_replace($oldQuote, $newQuote, $string);

        return $string;
    }

    /**
     * @param $string
     * @return null|string|string[]
     */
    private function removeSets($string)
    {
        $findSetsPattern = "/(?=SET)(.*)/";

        $string = preg_replace($findSetsPattern, '', $string);

        return $string;
    }

    /**
     * @param $string
     * @return null|string|string[]
     */
    private function removeComments($string)
    {
        $findCommentsPattern = "/(?=--)(.*)/";

        $string = preg_replace($findCommentsPattern, '', $string);

        return $string;
    }

    /**
     * @param $string
     * @return mixed
     */
    private function removeSchemas($string)
    {
        $findSchemaPattern = "/Schema ([a-z]{1,25})/";

        if (preg_match($findSchemaPattern, $string, $matches)) {
            $stringSchema = $matches[1];

            $findSchemaUsagesPattern = "/('?$stringSchema'?\.?)/";
            $string = preg_replace($findSchemaUsagesPattern, '', $string);
        }

        return $string;
    }

    /**
     * @param $string
     * @return bool|string
     */
    private function removeHeaders($string)
    {
        $headerStart = 'DROP TABLE IF EXISTS';

        $findHeader = strpos($string, $headerStart);

        if ($findHeader) {
            $string = substr($string, $findHeader);
        }

        return $string;
    }

    /**
     * @param $string
     * @return mixed
     */
    private function removeEngines($string)
    {
        $findEnginePattern = "/\n(ENGINE).*(\w){3,8}/";

        $string = preg_replace($findEnginePattern, '', $string);

        return $string;
    }
}
