<?php

namespace console\controllers;

use console\models\parsers\mashableParser\Parser;
use console\models\parsers\mashableParser\Repository;
use console\models\parsers\mashableParser\Service;
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
        $service = new Service(new Parser() ,new Repository());
        $service->execute();
    }
}