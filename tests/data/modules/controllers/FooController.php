<?php

namespace luya\bootstrap3\tests\data\modules\controllers;

use luya\web\Controller;

class FooController extends Controller
{
    public function actionBar()
    {
        return 'cmsunitmodule/foo/bar';
    }
}
