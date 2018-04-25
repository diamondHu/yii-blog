<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "post".
 *
 * @property int $id
 * @property string $title 文章标题
 * @property string $content 文章内容
 * @property string $tags 标签
 * @property int $status 状态
 * @property int $created_at 创建事件
 * @property int $updated_at 修改时间
 * @property int $author_id 作者id
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content', 'tags'], 'string'],
            [['status', 'created_at', 'updated_at', 'author_id'], 'integer'],
            [['title'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '文章标题',
            'content' => '文章内容',
            'tags' => '标签',
            'status' => '状态',
            'created_at' => '创建事件',
            'updated_at' => '修改时间',
            'author_id' => '作者id',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['post_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(Adminuser::className(), ['id' => 'author_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostStatus()
    {
        return $this->hasOne(Poststatus::className(), ['id' => 'status']);
    }
}
