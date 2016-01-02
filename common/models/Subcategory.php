<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%subcategory}}".
 *
 * @property integer $id
 * @property string $forum_name
 *
 * @property Torrents[] $torrents
 */
class Subcategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%subcategory}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['forum_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'forum_name' => Yii::t('app', 'Forum Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTorrents()
    {
        return $this->hasMany(Torrents::className(), ['forum_name_id' => 'id']);
    }
}
