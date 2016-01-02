<?php
/**
 * Project rutracker-yii2.
 * User: andrew72ru
 * Date: 01.01.16
 * Time: 13:15
 * File: index.php
 *
 * @var \yii\web\View $this
 * @var TorrentSearch $searchModel
 * @var \yii\sphinx\ActiveDataProvider $dataProvider
 */

$this->title = Yii::t('app', 'Rutracker Torrents Search');

use common\models\Categories;
use common\models\Subcategory;
use common\models\Torrents;
use common\models\TorrentSearch;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

?>

<?php Pjax::begin([
    'scrollTo' => 0,
]);?>
<?= GridView::widget([
    'filterModel' => $searchModel,
    'dataProvider' => $dataProvider,
    'columns' => [
        'name_attr' => [
            'attribute' => 'name_attr',
            'value' => function($model)
            {
                return Html::a($model['name_attr'], 'http://rutracker.org/forum/viewtopic.php?t=' . $model['topic_id_attr'], [
                    'target' => '_blank'
                ]);
            },
            'format' => 'raw',
            'contentOptions' => [
                'style' => ['white-space' => 'normal'],
            ]
        ],
        [
            'attribute' => 'category_attr',
            'value' => function($model) { return Categories::findOne($model['category_attr'])->category_name; },
            'filter' => TorrentSearch::catForSubs($searchModel->forum_name_id_attr),
        ],
        [
            'attribute' => 'forum_name_id_attr',
            'value' => function($model) { return Subcategory::findOne($model['forum_name_id_attr'])->forum_name; },
            'contentOptions' => [
                'style' => ['white-space' => 'normal'],
            ],
            'filter' => TorrentSearch::subsForCat($searchModel->category_attr),
        ],
        [
            'attribute' => 'size_attr',
            'format' => 'shortSize',
            'contentOptions' => ['class' => 'text-right'],
            'filter' => false,
        ],
        [
            'attribute' => 'datetime_attr',
            'format' => 'datetime',
            'headerOptions' => ['class' => 'text-nowrap'],
            'filter' => false,
        ],
        [
            'header' => null,
            'value' => function($model)
            {
                return Html::a(Html::tag('span', '', ['class' => 'glyphicon glyphicon-download-alt']), 'magnet:?xt=urn:btih:' . Torrents::findOne($model['id'])->hash . '&tr=http://bt.rutracker.cc/ann?magnet');
            },
            'format' => 'raw'
        ]
    ]
])?>
<?php Pjax::end();?>
