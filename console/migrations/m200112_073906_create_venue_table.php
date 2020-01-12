<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%venue}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 */
class m200112_073906_create_venue_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%venue}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'location' => $this->string()->notNull(),
            'lis_image' => $this->string(),
            'category' => $this->string(),
            'about' => $this->text(),
            'price' => $this->integer()->notNull(),
            'id_user' => $this->integer(),
        ]);

        // creates index for column `id_user`
        $this->createIndex(
            '{{%idx-venue-id_user}}',
            '{{%venue}}',
            'id_user'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-venue-id_user}}',
            '{{%venue}}',
            'id_user',
            '{{%user}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-venue-id_user}}',
            '{{%venue}}'
        );

        // drops index for column `id_user`
        $this->dropIndex(
            '{{%idx-venue-id_user}}',
            '{{%venue}}'
        );

        $this->dropTable('{{%venue}}');
    }
}
