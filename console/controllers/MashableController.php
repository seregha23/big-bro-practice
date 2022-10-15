<?php

namespace console\controllers;

use console\models\parsers\mashable\MashableParser;
use console\models\parsers\mashable\MashableRepository;
use console\models\parsers\mashable\MashableService;
use ReflectionException;
use yii\base\InvalidConfigException;
use yii\console\Controller;

class MashableController extends Controller {
    /**
     *
     * php -f yii mashable/parser
     *
     * @throws ReflectionException
     * @throws InvalidConfigException
     */
    public function actionParser(): void {
        $service = new MashableService(new MashableParser() ,new MashableRepository());
        $service->execute();
    }
}