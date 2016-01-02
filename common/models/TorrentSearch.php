<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
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
 * @property string $topic_id
 * @property integer $topic_id_attr
 * @property integer $category_attr
 * @property string $category_id
 * @property string $name_attr
 * @property integer $forum_name_id_attr
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
            [['topic_name', 'topic_id', 'category_id'], 'string'],
            [['name_attr'], 'string'],
            [['id', 'size_attr', 'datetime_attr', 'id_attr', 'topic_id_attr', 'category_attr', 'forum_name_id_attr'], 'integer'],
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
            'category_attr' => Yii::t('app', 'Category Name'),
            'forum_name_id_attr' => Yii::t('app', 'Forum Name'),
        ];
    }

    /**
     * @param $params
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = self::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        $query->match($this->name_attr);
        $query->filterWhere(['category_attr' => $this->category_attr]);
        $query->andFilterWhere(['forum_name_id_attr' => $this->forum_name_id_attr]);
        $query->showMeta(true);

        $dataProvider->sort = [
            'defaultOrder' => ['category_attr' => SORT_ASC, 'datetime_attr' => SORT_DESC],
        ];

        return $dataProvider;
    }

    /**
     * Возвращает массив подкатегорий (forum_name) для переданной категории
     *
     * @param null|integer $id
     * @return array
     */
    public static function subsForCat($id = null)
    {
        $query = Subcategory::find();
        if ($id != null && ($cat = Categories::findOne($id)) !== null)
        {
            $subcatsArr = array_keys(self::find()->where(['category_attr' => $id])->indexBy('forum_name_id_attr')->asArray()->all());
            $query->andWhere(['id' => $subcatsArr]);
        }

        return ArrayHelper::map($query->asArray()->all(), 'id', 'forum_name');
    }

    /**
     * Возвращает массив с одной категорией, если передана подкатегория
     *
     * @param null|integer $id
     * @return array
     */
    public static function catForSubs($id = null)
    {
        $query = Categories::find();
        if($id != null && ($subCat = Subcategory::findOne($id)) !== null)
        {
            /** @var TorrentSearch $category */
            $category = self::find()->where(['forum_name_id_attr' => $id])->one();
            $query->andWhere(['id' => $category->category_attr]);
        }

        return ArrayHelper::map($query->asArray()->all(), 'id', 'category_name');
    }
}
