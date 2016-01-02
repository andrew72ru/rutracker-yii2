<?php

use yii\db\Migration;

class m160102_065357_subcat extends Migration
{
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';

        $this->createTable('{{%subcategory}}', [
            'id' => $this->primaryKey(),
            'forum_name' => $this->string(255)
        ], $tableOptions);

        $this->addColumn('{{%torrents}}', 'forum_name_id', $this->integer(11)->notNull());

        $this->addForeignKey('torrent_subcat_id', '{{%torrents}}', 'forum_name_id', '{{%subcategory}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('torrent_subcat_id', '{{%torrents}}');
        $this->dropColumn('{{%torrents}}', 'forum_name_id');
        $this->dropTable('{{%subcategory}}');
    }
}
