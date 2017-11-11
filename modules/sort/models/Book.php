<?php
namespace app\modules\sort\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * Cliente is the model behind the cliente form.
 */
class Book extends ActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public static function tableName()
    {
        return '{{book}}';
    }

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // title, author, edition_year and telefone are required
            [['title', 'author', 'edition_year'], 'required'],
            [['title', 'author', 'edition_year'], 'safe', 'on'=>'search'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'title'             => 'Title',
            'author'            => 'Author',
            'edition_year'      => 'Edition year',
        ];
    }

    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;

        $criteria->compare('id',$this->id);
        $criteria->compare('title',$this->title);
        $criteria->compare('author',$this->author,true);
        $criteria->compare('edition_year',$this->edition_year,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
}
