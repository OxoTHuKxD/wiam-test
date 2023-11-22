<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%images}}`.
 */
class m231121_224216_create_images_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%images}}', [
            'id' => $this->primaryKey(),
            'image_id' => $this->bigInteger()->notNull()->unique(),
            'result' => $this->text()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%images}}');
    }
}
