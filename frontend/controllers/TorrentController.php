<?php
/**
 * Project rutracker-yii2.
 * User: andrew72ru
 * Date: 01.01.16
 * Time: 13:08
 * File: TorrentController.php
 */

namespace frontend\controllers;

use common\models\TorrentSearch;
use Yii;
use yii\web\Controller;

class TorrentController extends Controller
{
    /**
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new TorrentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }
}