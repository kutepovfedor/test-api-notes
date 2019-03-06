<?php

use yii\db\Migration;

/**
 * Class m190306_102147_note_data
 */
class m190306_102147_note_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("INSERT INTO `note` (user_id, title, text, public_at, create_at, update_at) VALUES 
            (1, 'Утро', 'Надо проснуться', '".date('Y-m-d H:i:s', strtotime('-10 day'))."', '2019-03-06 12:33:52', '2019-03-06 12:34:28'),
            (1, 'Обед', 'Над пожрать', '".date('Y-m-d H:i:s')."', '2019-03-06 12:35:07', '2019-03-06 12:35:07'),
            (1, 'Вечер', 'Спорт', '".date('Y-m-d H:i:s')."', '2019-03-06 12:36:25', '2019-03-06 12:36:25'),
            (1, 'Ночь', 'Спатьки', '".date('Y-m-d H:i:s', strtotime('+10 day'))."', '2019-03-06 12:36:25', '2019-03-06 12:36:38'),
            (2, 'Треня 1', 'Подтягивания', '".date('Y-m-d H:i:s', strtotime('-10 day'))."', '2019-03-06 12:33:52', '2019-03-06 13:18:46'),
            (2, 'Треня 2', 'Плавание', '".date('Y-m-d H:i:s')."', '2019-03-06 12:33:52', '2019-03-06 13:19:53'),
            (2, 'Треня 3', 'Жим лёжа', '".date('Y-m-d H:i:s')."', '2019-03-06 12:33:52', '2019-03-06 13:19:40'),
            (2, 'Треня 4', 'Бег', '".date('Y-m-d H:i:s', strtotime('+10 day'))."', '2019-03-06 12:33:52', '2019-03-06 13:19:44')
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190306_102147_note_data cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190306_102147_note_data cannot be reverted.\n";

        return false;
    }
    */
}
