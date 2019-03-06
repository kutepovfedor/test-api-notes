<?php

use yii\db\Migration;

/**
 * Class m190306_082312_token
 */
class m190306_082312_token extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("ALTER TABLE `user` ADD COLUMN `access_token` CHAR(32) NULL AFTER `password_hash`;");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190306_082312_token cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190306_082312_token cannot be reverted.\n";

        return false;
    }
    */
}
