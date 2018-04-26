<?php

namespace common\models;

use Yii;
use yii\db\Query;
use yii\db\QueryBuilder;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "post_status".
 *
 * @property int $id
 * @property string $name 状态名字
 * @property int $position
 */
class PostStatus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post_status';
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
            'name' => '状态名字',
            'position' => 'Position',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['status' => 'id']);
    }

    public static function getAllPostStatus()
    {
        $result = self::find()->all();
        if ($result) {
            $result = ArrayHelper::map($result, 'id', 'name');
        }

        // 方法二：
        $allStatus = (new Query())
            ->select(['name', 'id'])
            ->from('post_status')
            ->indexBy('id') // 取id为索引
            ->column(); // 取第一列的值为健值

        // 方法三：此方法不用ArrayHelper转换
        $allStatus = self::find()
            ->select(['name', 'id'])
//            ->indexBy('id')
            ->column(); // 取第一列数据

        return $allStatus;
    }
}
