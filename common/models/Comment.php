<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "comment".
 *
 * @property int $id
 * @property string $content 评论内容
 * @property int $status 状态
 * @property int $created_at 创建时间
 * @property int $updated_at 修改时间
 * @property int $user_id 评论用户id
 * @property string $email 邮箱
 * @property string $url 地址
 * @property int $post_id 文章id
 * @property int $remind 是否提醒
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content'], 'string'],
            [['status', 'created_at', 'updated_at', 'user_id', 'post_id', 'remind'], 'integer'],
            [['email', 'url'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content' => '评论内容',
            'status' => '状态',
            'created_at' => '创建时间',
            'updated_at' => '修改时间',
            'user_id' => '评论用户id',
            'email' => '邮箱',
            'url' => '地址',
            'post_id' => '文章id',
            'remind' => '是否提醒',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(Post::className(), ['id' => 'post_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCommonStatus()
    {
        return $this->hasOne(Commentstatus::className(), ['id' => 'status']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'userid']);
    }
}
