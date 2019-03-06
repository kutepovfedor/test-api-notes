<?php

namespace frontend\models;

use Yii;
use common\models\User;

/**
 * This is the model class for table "note".
 *
 * @property int $id
 * @property int $user_id Автор
 * @property string $title Заголовок
 * @property string $text Текст
 * @property string $public_at Дата публикации
 * @property string $create_at Создано
 * @property string $update_at Обновлено
 *
 * @property User $user
 */
class Note extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'note';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'title', 'text'], 'required'],
            [['user_id'], 'integer'],
            [['text'], 'string'],
            [['public_at', 'create_at', 'update_at'], 'safe'],
            [['title'], 'string', 'max' => 50],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'Автор',
            'title' => 'Заголовок',
            'text' => 'Текст',
            'public_at' => 'Дата публикации',
            'create_at' => 'Создано',
            'update_at' => 'Обновлено',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
