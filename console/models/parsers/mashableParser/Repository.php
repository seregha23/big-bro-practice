<?php

namespace console\models\parsers\mashableParser;

use common\models\Image;
use common\models\Post;
use ReflectionException;

class Repository {
    protected array $data;

    /**
     * @throws ReflectionException
     */
    public function execute(array $data): void {
        foreach ($data as $item) {
            $lastPost = Post::find()->andWhere(['title' => $item['title']])->one();
            if (!$lastPost) {
                $lastPost              = new Post();
                $lastPost->title       = $item['title'];
                $lastPost->description = $item['description'];
                $lastPost->save();

                $image = new Image();
                $image->saveImageByUrl($lastPost, $item['imgSrc']);

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
