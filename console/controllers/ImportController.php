<?php
/**
 * Project: rutracker
 * File: ImportController.php
 * User: andrew
 * Date: 30.12.15
 * Time: 13:50
 */

namespace console\controllers;

use common\models\Categories;
use common\models\Torrents;
use Yii;
use yii\console\Controller;
use yii\helpers\Console;
use yii\helpers\VarDumper;

/**
 * Импорт раздач и категорий из csv-файлов
 *
 * Class ImportController
 * @package console\controllers
 */
class ImportController extends Controller
{
    public $color = true;

    public function actionIndex()
    {
        $this->stdout("Default: import/import [file_path]. \nDefault file path is frontend/runtime/csv\n\n");

        return Controller::EXIT_CODE_NORMAL;
    }

    public function actionImport($path = 'frontend/runtime/csv')
    {
        $fullPath = Yii::getAlias('@' . $path);
        if(!is_dir($fullPath))
        {
            $this->stderr("Path '{$fullPath}' not found\n", Console::FG_RED);
            return Controller::EXIT_CODE_ERROR;
        }

        if(is_file($fullPath . DIRECTORY_SEPARATOR . 'category_info.csv'))
            $categories = $this->importCategories($fullPath);
        else
        {
            $this->stderr("File 'category_info.csv' not found\n", Console::FG_RED);
            return Controller::EXIT_CODE_ERROR;
        }

        if($categories === false)
        {
            $this->stderr("Categories is NOT imported", Console::FG_RED);
            return Controller::EXIT_CODE_ERROR;
        }

        /** @var Categories $cat */
        foreach ($categories as $cat)
        {
            if(!is_file($fullPath . DIRECTORY_SEPARATOR . $cat->file_name))
                continue;

            $this->importTorrents($cat, $path);
        }


        return Controller::EXIT_CODE_NORMAL;
    }

    private function importTorrents(Categories $cat, $path)
    {
        $filePath = Yii::getAlias('@' . $path . DIRECTORY_SEPARATOR . $cat->file_name);

        $row = 1;
        if (($handle = fopen($filePath, "r")) !== FALSE)
        {
            while (($data = fgetcsv($handle, 0, ";")) !== FALSE)
            {
                $row++;
                $this->stdout("Row {$row}:\n");

                $model = Torrents::findOne(['forum_id' => $data[0], 'topic_id' => $data[2]]);

                if($model === null)
                {
                    $model = new Torrents([
                        'forum_id' => $data[0],
                        'forum_name' => $data[1],
                        'topic_id' => $data[2],
                        'hash' => $data[3],
                        'topic_name' => $data[4],
                        'size' => $data[5],
                        'datetime' => strtotime($data[6]),
                        'category_id' => $cat->id,
                    ]);
                }
                if($model->save())
                {
                    $this->stdout("Torrent \t");
                    $this->stdout($model->topic_name, Console::FG_YELLOW);
                    $this->stdout(" added\n");
                }

                $this->stdout("\n");
            }
        }
    }

    /**
     * Импорт категорий
     *
     * @param $path
     * @return array|\yii\db\ActiveRecord[]
     */
    private function importCategories($path)
    {
        $file = $path . DIRECTORY_SEPARATOR . 'category_info.csv';
        $row = 1;
        if (($handle = fopen($file, "r")) !== FALSE)
        {
            while (($data = fgetcsv($handle, 0, ";")) !== FALSE)
            {
                $row++;
                $this->stdout("Row " . $row . ":\n");

                $model = Categories::findOne($data[0]);

                if($model === null)
                {
                    $model = new Categories([
                        'id' => $data[0],
                        'category_name' => $data[1],
                        'file_name' => $data[2]
                    ]);
                }

                if($model->save())
                    $this->stdout("Category {$model->id} with name '{$model->category_name}' imported\n");

                $this->stdout("\n");
            }
        } else
            return false;

        return Categories::find()->all();
    }
}