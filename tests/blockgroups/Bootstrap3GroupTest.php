<?php

namespace cmstests\src\frontend\blockgroups;

use luya\testsuite\cases\CmsBlockGroupTestCase;

/**
 * Class Bootstrap3GroupTest
 *
 * @package cmstests\src\frontend\blockgroups
 * @author Alex Schmid <alex.schmid@stud.unibas.ch>
 * @since 1.0.4
 */
class Bootstrap3GroupTest extends CmsBlockGroupTestCase
{
    public $blockGroupClass = 'luya\bootstrap3\blockgroups\Bootstrap3Group';

    public $blockGroupIdentifier = 'bootstrap3';
}