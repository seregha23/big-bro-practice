<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%images}}`.
 */
class m221009_193812_create_images_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%images}}', [
            'id'         => $this->primaryKey(),
            'image_name' => $this->string()->notNull(),
            'model_name' => $this->string()->notNull(),
            'model_id'   => $this->integer()->notNull(),

            'status'     => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->dateTime()->defaultValue(new \yii\db\Expression('NOW()') ),
            'updated_at' => $this->dateTime()->defaultValue(  new \yii\db\Expression('NOW()') ),
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
