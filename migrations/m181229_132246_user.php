<?php
use yii\db\Migration;
/**
 * Class m181229_132246_user
 */
class m181229_132246_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        if($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=INNODB';
            $this->createTable('{{%user}}', [
                'id' => $this->integer()->notNull().' PRIMARY KEY AUTO_INCREMENT',
                'username' => $this->string(32)->notNull()->unique(),
                'password' => $this->string()->notNull(),
                'photo_name' => $this->string(),
                'mobile_number' => $this->integer(),
                'location' => $this->string(),
                'email' => $this->string(255)->notNull()->unique(),
                'status' => $this->smallInteger()->notNull()->defaultValue(0),//0 - unconfirmed email, 1 - confirmed email, 2-admin
                'auth_key' => $this->string()->notNull()->unique(), //created for confirming email and changing password via email
                'bought_items_count' => $this->integer()->defaultValue(0),
                'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
                'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')
            ],
                $tableOptions);

            $this->createTable('{{%product}}',[
                'id' => $this->integer()->notNull().' PRIMARY KEY AUTO_INCREMENT',
                'name' => $this->string(32)->notNull(),
                'brand' => $this->string(100),
                'category_id' => $this->integer()->notNull(),
                'price' => $this->money()->notNull(),
                'availability' => $this->integer(7)->defaultValue(1), //кількість доступного товару
                'is_new' => $this->tinyInteger(1)->defaultValue(1),
                'discount' => $this->integer(4)->defaultValue(0),
                'description' => $this->string(1000)->notNull(),
                'reviews_count' => $this->integer(7)->defaultValue(0),
                'colors' => $this->string(200), //розділювач - ";"
                'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
                'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')
            ],
                $tableOptions);


            $this->createTable('{{%review}}',[
                'id' => $this->integer()->notNull().' PRIMARY KEY AUTO_INCREMENT',
                'user_id' => $this->integer()->notNull(),
                'product_id' => $this->integer()->notNull(),
                'mark' => $this->integer()->notNull(),
                'description' => $this->string(1000),
                'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')
            ],
                $tableOptions);

            $this->createTable('{{%favourites}}',[ // якщо запис існує то продукт є улюбленим
                'user_id' => $this->integer()->notNull(),
                'product_id' => $this->integer()->notNull()
            ],$tableOptions);


            $this-> createTable('{{%product_photo}}',[
                'id' => $this->integer()->notNull().' PRIMARY KEY AUTO_INCREMENT',
                'image_name' => $this->string(200)->notNull(),
                'product_id' => $this->integer()->notNull(),
                'product_color' => $this->string(60)
            ],$tableOptions);


            $this->createTable('{{%category}}',[
                'id' => $this->integer()->notNull().' PRIMARY KEY AUTO_INCREMENT',
                'name' => $this->string()->unique()->notNull()
            ],$tableOptions);

            $this->createTable('{{%cart}}',[
              'user_id' => $this->integer()->notNull(),
                'product_id' => $this->integer()->notNull()
            ],$tableOptions);

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
    }
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181229_132246_user cannot be reverted.\n";


        $this->dropIndex('idx-cart-user','cart');
        $this->dropForeignKey('fk-cart-user','cart');
        $this->dropIndex('idx-review-product','review');
        $this->dropForeignKey('fk-review-product','review');
        $this->dropIndex('idx-favourites-user','favourites');
        $this->dropForeignKey('fk-favourites-user','favourites');
        $this->dropIndex('idx-photos-product','product_photo');
        $this->dropForeignKey('fk-photos-product','product_photo');
        $this->dropIndex('idx-product-category','category_id');
        $this->dropForeignKey('fk-product-category','category_id');
        $this->dropTable('{{%user}}');
        $this->dropTable('{{%product}}');
        $this->dropTable('{{%product_photo}}');
        $this->dropTable('{{%review}}');
        $this->dropTable('{{%favourites}}');
        $this->dropTable('{{%category}}');
        $this->dropTable('{{%cart}}');
        return false;
    }
    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
    }
    public function down()
    {
        echo "m181229_132246_user cannot be reverted.\n";
        return false;
    }
    */
}
