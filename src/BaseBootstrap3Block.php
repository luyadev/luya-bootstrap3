<?php

namespace luya\bootstrap3;

use luya\cms\base\PhpBlock;

abstract class BaseBootstrap3Block extends PhpBlock
{
    public function getViewPath()
    {
        return  dirname(__DIR__) . '/src/views/blocks';
    }
}