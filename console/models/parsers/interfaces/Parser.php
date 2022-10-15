<?php

namespace console\models\parsers\interfaces;

interface Parser {
    public function execute(): ?array;
}
