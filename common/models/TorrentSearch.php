<?php

namespace common\models;

use Yii;
use yii\sphinx\ActiveDataProvider;
use yii\sphinx\ActiveRecord;

/**
 * This is the model class for index "torrentz".
 *
 * @property integer $id
 * @property string $size
 * @property string $datetime
 * @property integer $id_attr
 * @property integer $size_attr
 * @property integer $datetime_attr
 * @property string $topic_name
 * @property string $name_attr
 */
class TorrentSearch extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function indexName()
    {
        return '{{%torrentz}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id'], 'unique'],
            [['id'], 'integer'],
            [['id_attr'], 'integer'],
            [['topic_name'], 'string'],
            [['name_attr'], 'string'],
            [['id', 'size_attr', 'datetime_attr', 'id_attr'], 'integer'],
            [['size', 'datetime', 'topic_name', 'name_attr'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_attr' => Yii::t('app', 'ID'),
            'name_attr' => Yii::t('app', 'Topic Name'),
            'id' => Yii::t('app', 'ID'),
            'size' => Yii::t('app', 'Size'),
            'datetime' => Yii::t('app', 'Datetime'),
            'topic_name' => Yii::t('app', 'Topic Name'),
            'size_attr' => Yii::t('app', 'Size'),
            'datetime_attr' => Yii::t('app', 'Torrent Registered Date'),
        ];
    }

    /**
     * @param $params
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = self::find();
        $query->from('torrentz');
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        $query->match($this->name_attr);
        $query->showMeta(true);

        $dataProvider->sort = [
            'defaultOrder' => ['datetime_attr' => SORT_DESC],
        ];

        return $dataProvider;
    }
}
