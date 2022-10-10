<?php

namespace common\models;

use ReflectionException;
use Yii;
use yii\db\ActiveRecord;

/**
 *
 * @property int $id [int(11)]
 * @property string $image_name [varchar(255)]
 * @property string $model_name [varchar(255)]
 * @property int $model_id [int(11)]
 * @property int $status [smallint(6)]
 * @property int $created_at [int(11)]
 * @property int $updated_at [int(11)]
 */
class Image extends ActiveRecord {

    public static function tableName(): string {
        return '{{%images}}';
    }

    /**
     * @throws ReflectionException
     */
    public function saveImageByUrl(ActiveRecord $model, string $url): void {
        $reflectionClass = new \ReflectionClass($model::class);
        $suffix          = pathinfo($url, PATHINFO_EXTENSION);
        $imageName       = mb_strtolower($reflectionClass->getShortName()) . "_model_id_{$model->id}." . $suffix;
        file_put_contents(Yii::$app->params['uploadDirectory'] . $imageName, file_get_contents($url));

        $image             = new Image();
        $image->image_name = $imageName;
        $image->model_name = $reflectionClass->getShortName();
        $image->model_id   = $model->id;
        $image->save();
    }

}