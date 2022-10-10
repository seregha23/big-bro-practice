<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\StaleObjectException;

/**
 *
 * @property int $id [int(11)]
 * @property string $title [varchar(255)]
 * @property string $description [varchar(128)]
 * @property int $status [smallint(6)]
 * @property int $created_at [int(11)]
 * @property int $updated_at [int(11)]
 */
class Post extends ActiveRecord {
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string {
        return '{{%posts}}';
    }

    /**
     * @throws \ReflectionException
     * @throws StaleObjectException
     * @throws \Throwable
     */
    public function deletePostAndImage() {
        $reflectionClass = new \ReflectionClass($this::class);

        $image = Image::find()->andWhere(['model_id' => $this->id, 'model_name' => $reflectionClass->getShortName()])->one();

        unlink(Yii::$app->params['uploadDirectory'] . $image->image_name);

        $this->delete();
    }
}