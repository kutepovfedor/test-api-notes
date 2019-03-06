<?php

use yii\db\Migration;

/**
 * Class m190306_082516_users
 */
class m190306_082516_users extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("INSERT INTO `user` (username, auth_key, password_hash, access_token, password_reset_token, email, status, created_at, updated_at) VALUES 
            ('user1', '-cqzPQ51793mqJ38v5V7UI8I5UcyUiCq', '$2y$13$GEsKB2kWeu/i3GLUvbmdI.PfizbmP3ofltQc9xpJQ2Ev9ddfvizbi', 'ZpjW4fMwYINxFxzddMTcsVE0qThHmQ4X', NULL, 'user1@mail.ru', 10, 1551860474, 1551860474),
            ('user2', 'ZpjW4fMwYINxFxzddMTcsVE0qThHmQ4X', '$2y$13$refTAJqxs24b/IJIXa3wpewXIvTa6iID4.3K8mawEIuMaUhTnfPeC', '-cqzPQ51793mqJ38v5V7UI8I5UcyUiCq', NULL, 'user2@mail.ru', 10, 1551860487, 1551860487);
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190306_082516_users cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190306_082516_users cannot be reverted.\n";

        return false;
    }
    */
}
