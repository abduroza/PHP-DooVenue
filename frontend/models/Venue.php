<?php

namespace frontend\models;

use Yii;
use common\models\User;
//use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "venue".
 *
 * @property int $id
 * @property string $name
 * @property string $location
 * @property string|null $lis_image
 * @property string|null $category
 * @property string|null $about
 * @property int $price
 * @property int|null $id_user
 *
 * @property User $user
 */
class Venue extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'venue';
    }

        /**
     * {@inheritdoc}
     */
    public function behaviors(){
        return [
                [
                    'class' => BlameableBehavior::className(),
                    'createdByAttribute' => 'id_user',
                    'updatedByAttribute' => null,
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'location', 'price'], 'required'],
            [['price', 'id_user'], 'integer'],
            [['name', 'location', 'lis_image', 'category', 'about'], 'string', 'max' => 255],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'location' => Yii::t('app', 'Location'),
            'lis_image' => Yii::t('app', 'Lis Image'),
            'category' => Yii::t('app', 'Category'),
            'about' => Yii::t('app', 'About'),
            'price' => Yii::t('app', 'Price'),
            'id_user' => Yii::t('app', 'Id User'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }
}
