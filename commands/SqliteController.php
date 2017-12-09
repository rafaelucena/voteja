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
     * @return mixed
     */
    private function getFileContent()
    {
        return $this->file_content;
    }

    /**
     * @param $string
     * @return bool
     */
    private function setFileContent($string = '')
    {
        if ($string) {
            $this->file_content = $string;

            return true;
        } elseif (!$this->getFileContent()) {
            $this->file_content = $this->getQueryFileContent();

            return true;
        }

        return false;
    }

    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     */
    public function actionIndex()
    {
        $this->file_path = Yii::getAlias('@app') . "/database/voteja_mysql.sql";

        if ($this->openQueryFile()) {
            if ($this->setFileContent()) {

                $this->replaceQuotes();

                $this->removeIndexes();

                $this->removeSchemas();

                $this->removeSets();

                $this->removeComments();

                $this->removeEngines();

                $this->adaptPrimaryKeys();

                echo $this->getFileContent();
            }

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
        $string = fread($this->file_handler, filesize($this->file_path));

        return $string;
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
    private function replaceQuotes()
    {
        $string = $this->getFileContent();
        if ($string) {
            $oldQuote = '`';
            $newQuote = "'";

            $string = str_replace($oldQuote, $newQuote, $string);

            return $this->setFileContent($string);
        }

        return false;
    }

    /**
     * @param $string
     * @return null|string|string[]
     */
    private function removeSets()
    {
        $string = $this->getFileContent();

        if ($string) {
            $findSetsPattern = "/(?=SET)(.*\n?)/";

            $string = preg_replace($findSetsPattern, '', $string);

            return $this->setFileContent($string);
        }

        return false;
    }

    /**
     * @param $string
     * @return null|string|string[]
     */
    private function removeComments()
    {
        $string = $this->getFileContent();

        if ($string) {
            $findCommentsPattern = "/(?=--)(.*\n?)/";

            $string = preg_replace($findCommentsPattern, '', $string);

            return $this->setFileContent($string);
        }

        return false;
    }

    /**
     * @param $string
     * @return mixed
     */
    private function removeSchemas()
    {
        $string = $this->getFileContent();

        if ($string) {
            $findSchemaPattern = "/Schema ([a-z]{1,25})/";

            if (preg_match($findSchemaPattern, $string, $matches)) {
                $stringSchema = $matches[1];

                // Remove SCHEMA CREATOR
                $lineSchemaPattern = "/(?=CREATE SCHEMA)(.*\n?)/";
                $string = preg_replace($lineSchemaPattern, '', $string);

                // Remove SCHEMA USAGE
                $lineSchemaPattern = "/(?=USE)(.*\n?)/";
                $string = preg_replace($lineSchemaPattern, '', $string);

                // Remove schema references
                $findSchemaUsagesPattern = "/('?$stringSchema'?\.?)/";
                $string = preg_replace($findSchemaUsagesPattern, '', $string);

                return $this->setFileContent($string);
            }
        }

        return false;
    }

    /**
     * @param $string
     * @return mixed
     */
    private function removeEngines()
    {
        $string = $this->getFileContent();

        if ($string) {
            $findEnginePattern = "/(\)\n)(?=ENGINE).*(\w){3,8}/";

            $string = preg_replace($findEnginePattern, "\n)", $string);

            return $this->setFileContent($string);
        }

        return false;
    }

    /**
     * @param $string
     * @return mixed
     */
    private function removeIndexes()
    {
        $string = $this->getFileContent();

        if ($string) {
            $findIndexPattern = "/(?=INDEX)(.*\n?)/";

            $string = preg_replace($findIndexPattern, '', $string);

            return $this->setFileContent($string);
        }

        return false;
    }

    private function adaptPrimaryKeys()
    {
        $string = $this->getFileContent();

        if ($string) {
            $tables = explode('DROP', $string);

            foreach ($tables as $table) {
                $findPrimaryKeyPattern = '/(?=PRIMARY).+(\((\W(\w+)\W\W?){1,3})/';

                if (preg_match($findPrimaryKeyPattern, $table, $matches)) {
                    print_r($matches);
                    die;
                }
            }

            die;
            return $this->setFileContent($string);
        }

        return false;
    }
}