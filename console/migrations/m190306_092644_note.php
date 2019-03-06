<?php

use yii\db\Migration;

/**
 * Class m190306_092644_note
 */
class m190306_092644_note extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("CREATE TABLE `note` (
            `id` INT(11) NOT NULL AUTO_INCREMENT,
            `user_id` INT(11) NOT NULL COMMENT 'Автор',
            `title` VARCHAR(50) NOT NULL COMMENT 'Заголовок',
            `text` TEXT NOT NULL COMMENT 'Текст',
            `public_at` TIMESTAMP NULL DEFAULT NULL COMMENT 'Дата публикации',
            `create_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Создано',
            `update_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Обновлено',
            PRIMARY KEY (`id`),
            INDEX `FK_note_user` (`user_id`),
            CONSTRAINT `FK_note_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
        )
        COLLATE='utf8_general_ci'
        ENGINE=InnoDB
        ;
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190306_092644_note cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190306_092644_note cannot be reverted.\n";

        return false;
    }
    */
}
