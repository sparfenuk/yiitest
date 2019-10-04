<?php

use yii\db\Migration;

/**
 * Class m190215_204112_indexes
 */
class m190215_204112_indexes extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->createIndex('idx-cart-user',
            '{{%cart}}',
            'user_id');
        $this->addForeignKey('fk-cart-user',
            '{{%cart}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        $this->createIndex('idx-review-product',
            '{{%review}}',
            'product_id');
        $this->addForeignKey('fk-review-product',
            '{{%review}}',
            'product_id',
            '{{%product}}',
            'id',
            'CASCADE'
        );
        $this->createIndex('idx-product-category',
            '{{%product}}',
            'category_id');
        $this->addForeignKey('fk-product-category',
            '{{%product}}',
            'category_id',
            '{{%category}}',
            'id',
            'CASCADE'
        );

        $this->createIndex('idx-favourites-user',
            '{{%favourites}}',
            'user_id');
        $this->addForeignKey('fk-favourites-user',
            '{{%favourites}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );
        $this->createIndex('idx-photos-product',
            '{{%product_photo}}',
            'product_id');
        $this->addForeignKey('fk-photos-product',
            '{{%product_photo}}',
            'product_id',
            '{{%product}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('idx-review-product','review');
        $this->dropForeignKey('fk-review-product','review');
        $this->dropIndex('idx-favourites-user','favourites');
        $this->dropForeignKey('fk-favourites-user','favourites');
        $this->dropIndex('idx-photos-product','product_photo');
        $this->dropForeignKey('fk-photos-product','product_photo');
        $this->dropIndex('idx-product-category','category_id');
        $this->dropForeignKey('fk-product-category','category_id');
        $this->dropIndex('idx-cart-user','cart');
        $this->dropForeignKey('fk-cart-user','cart');

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190215_204112_indexes cannot be reverted.\n";

        return false;
    }
    */
}
