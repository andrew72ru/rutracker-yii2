<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "categories".
 *
 * @property integer $id
 * @property string $category_name
 * @property string $file_name
 *
 * @property Torrents[] $torrents
 */
class Categories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'categories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_name', 'file_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'category_name' => Yii::t('app', 'Category Name'),
            'file_name' => Yii::t('app', 'File Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTorrents()
    {
        return $this->hasMany(Torrents::className(), ['category_id' => 'id']);
    }
}
