<?php

namespace console\models\parsers\mashableParser;

use ReflectionException;
use yii\base\InvalidConfigException;
use yii\httpclient\Exception;

class Service {
    public function __construct(
        protected Parser $parser,
        protected Repository $repository,
    ) {}

    /** @throws ReflectionException|InvalidConfigException */
    public function execute(): void {
        try {

            $data = $this->parser->execute();

            $this->repository->execute($data);

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
