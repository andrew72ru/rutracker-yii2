<?php

use yii\db\Migration;

class m151230_102638_size_column extends Migration
{
    public function up()
    {
        $this->alterColumn('{{%torrents}}', 'size', $this->bigInteger());
    }

    public function down()
    {
        echo "m151230_102638_size_column cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
