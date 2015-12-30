<?php

use yii\db\Migration;

class m151230_082224_main_tables extends Migration
{
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';

        $this->createTable('{{%torrents}}', [
            'id' => $this->primaryKey(),
            'forum_id' => $this->integer(11),
            'forum_name' => $this->string(255),
            'topic_id' => $this->integer(11)->unique(),
            'hash' => $this->string(50)->unique(),
            'topic_name' => $this->text(),
            'size' => $this->integer(11),
            'datetime' => $this->integer(11),
            'category_id' => $this->integer(11)->notNull()
        ], $tableOptions);

        $this->createTable('{{%categories}}', [
            'id' => $this->primaryKey(),
            'category_name' => $this->string(255),
            'file_name' => $this->string(255),
        ], $tableOptions);

        $this->addForeignKey('category_torrent_fk', '{{%torrents}}', 'category_id', '{{%categories}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('category_torrent_fk', '{{%categories}}');
        $this->dropTable('{{%torrents}}');
        $this->dropTable('{{%categories}}');
    }
}
