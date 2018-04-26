<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "comment-status".
 *
 * @property int $id
 * @property string $name 名称
 * @property int $position
 */
class CommentStatus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comment_status';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['position'], 'integer'],
            [['name'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '名称',
            'position' => 'Position',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['status' => 'id']);
    }
}
