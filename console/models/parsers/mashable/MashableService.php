<?php

namespace console\models\parsers\mashable;

use console\models\parsers\interfaces\Parser;
use ReflectionException;
use yii\httpclient\Exception;

class MashableService {
    public function __construct(
        protected Parser $parser,
        protected MashableRepository $repository,
    ) {}

    /** @throws ReflectionException */
    public function execute(): void {
        try {

            $data = $this->parser->execute();

            $this->repository->execute($data);

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
