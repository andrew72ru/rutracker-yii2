<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "torrents".
 *
 * @property integer $id
 * @property integer $forum_id
 * @property string $forum_name
 * @property integer $topic_id
 * @property string $hash
 * @property string $topic_name
 * @property integer $size
 * @property integer $datetime
 * @property integer $category_id
 *
 * @property Categories $category
 */
class Torrents extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'torrents';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['forum_id', 'topic_id', 'size', 'datetime', 'category_id'], 'integer'],
            [['topic_name'], 'string'],
            [['category_id'], 'required'],
            [['forum_name'], 'string', 'max' => 255],
            [['hash'], 'string', 'max' => 50],
            [['topic_id'], 'unique'],
            [['hash'], 'unique'],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categories::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'forum_id' => Yii::t('app', 'Forum ID'),
            'forum_name' => Yii::t('app', 'Forum Name'),
            'topic_id' => Yii::t('app', 'Topic ID'),
            'hash' => Yii::t('app', 'Hash'),
            'topic_name' => Yii::t('app', 'Topic Name'),
            'size' => Yii::t('app', 'Size'),
            'datetime' => Yii::t('app', 'Datetime'),
            'category_id' => Yii::t('app', 'Category ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Categories::className(), ['id' => 'category_id']);
    }
}
