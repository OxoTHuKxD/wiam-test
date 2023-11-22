<?php

namespace app\domain\image\domain\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "images".
 *
 * @property int $id
 * @property int $image_id
 * @property string $result
 */
class Image extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'images';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['image_id'], 'integer'],
            [['result'], 'string'],
            [['image_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'image_id' => 'Image ID',
            'result' => 'Result',
        ];
    }
}
