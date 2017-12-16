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
    private $file_path_new;

    /**
     * @var
     */
    private $file_handle;

    /**
     * @var
     */
    private $file_handle_new;

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
        $this->file_path = Yii::getAlias('@app') . "/database/script/voteja_mysql.sql";

        $this->file_path_new = Yii::getAlias('@app') . "/database/script/voteja_sqlite.sql";

        if ($this->openQueryFile()) {
            if ($this->setFileContent()) {

                $this->manipulateFull();

                $this->manipulateSections();

                $this->openNewQueryFile();

                fwrite($this->file_handle_new, $this->getFileContent());

                fclose($this->file_handle_new);
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
        $this->file_handle = fopen($this->file_path, "r") or die("Unable to open file!");

        return $this->file_handle;
    }

    /**
     * @return bool|resource
     */
    private function openNewQueryFile()
    {
        $this->file_handle_new = fopen($this->file_path_new, "w") or die("Unable to open file!");

        return $this->file_handle_new;
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
     * @return mixed
     */
    private function getFileContent()
    {
        return $this->file_content;
    }

    /**
     * @return bool|string
     */
    private function getQueryFileContent()
    {
        $string = fread($this->file_handle, filesize($this->file_path));

        return $string;
    }

    /**
     * @return bool
     */
    private function closeQueryFile()
    {
        return fclose($this->file_handle);
    }

    /** ============================================================================================================ **/

    /**
     *
     */
    private function manipulateFull()
    {
        $this->replaceQuotes();

        $this->removeIndexes();

        $this->removeSchemas();

        $this->removeSets();

        $this->removeComments();

        $this->removeEngines();

        return;
    }

    /**
     *
     */
    private function manipulateSections()
    {
        $string = $this->getFileContent();

        if ($string) {
            $sections = explode('DROP', $string);

            foreach ($sections as &$section) {
                $section = $this->adaptPrimaryKeys($section);

                $section = $this->adaptTableEnding($section);
            }

            $string = implode('DROP', $sections);

            return $this->setFileContent($string);
        }
    }

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

    /**
     * @param $string
     * @return null|string|string[]
     */
    private function adaptPrimaryKeys($string)
    {
        if ($string) {
            $findPrimaryKeyPattern = "/(?=PRIMARY).+(\(('(\w+)'\W?){1,4})\W?\n/";

            if (preg_match($findPrimaryKeyPattern, $string, $matches)) {
                $keys = explode(',', $matches[1]);

                if (count($keys) > 1) {
                    //@TODO
                } else {
                    $string = preg_replace($findPrimaryKeyPattern, '', $string);

                    $idKeyString = $matches[3];
                    $idKeyStringReplacement = "'$idKeyString' INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT";
                    $idKeyStringPattern = "/(?=('$idKeyString'\s)).*(\w)/";

                    $string = preg_replace($idKeyStringPattern, $idKeyStringReplacement, $string);
                }
            }
        }

        return $string;
    }

    private function adaptTableEnding($string)
    {
        if ($string) {
            $findTableEndingPattern = "/,\n(\s*)\);/";

            $string = preg_replace($findTableEndingPattern, "\n);", $string);
        }

        return $string;
    }
}