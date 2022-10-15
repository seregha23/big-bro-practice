<?php

namespace console\models\parsers\mashable;

use common\models\Image;
use common\models\Post;
use ReflectionException;

class MashableRepository {
    protected array $data;

    /**
     * @throws ReflectionException
     */
    public function execute(array $data): void {
        foreach ($data as $item) {
            $lastPost = Post::find()->andWhere(['title' => $item['title']])->count();
            if (!$lastPost) {
                $lastPost              = new Post();
                $lastPost->title       = $item['title'];
                $lastPost->description = $item['description'];
                $lastPost->save();

                $image = new Image();
                $image->saveImageByUrl($lastPost, $item['imgSrc']);
            }

            if (Post::find()->count() > 5 ) {
                try {
                    $firstPost = Post::find()->one();
                    $firstPost->deletePostAndImage();
                } catch (\Throwable $e) {
                    echo $e->getMessage();
                }
            }
        }
    }
}
