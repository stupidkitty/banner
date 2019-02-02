<?php

use yii\db\Migration;

/**
 * Class m190202_100649_create_banners
 */
class m190202_100649_create_banners extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('banners', [
            'banner_id' => 'smallint UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY',
            'name' => 'varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT \'\'',
            'comment' => 'varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT \'\'',
            'code' => 'text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL',
            'start_at' => 'timestamp NULL DEFAULT NULL',
            'end_at' => 'timestamp NULL DEFAULT NULL',
            'desktop' => 'tinyint UNSIGNED NOT NULL DEFAULT 1',
            'mobile' => 'tinyint UNSIGNED NOT NULL DEFAULT 1',
            'enabled' => 'tinyint UNSIGNED NOT NULL DEFAULT 0',
            'updated_at' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP',
            'created_at' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP',
        ], $tableOptions);

        $this->createIndex('name', 'banners', 'name', true);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190202_100649_create_banners cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190202_100649_create_banners cannot be reverted.\n";

        return false;
    }
    */
}
