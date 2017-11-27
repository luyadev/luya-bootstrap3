<?php

namespace luya\bootstrap3\blockgroups;

use luya\cms\base\BlockGroup;

/**
 * Text Block Group.
 *
 * This group belongs to all basic text elements.
 *
 * @author Basil Suter <basil@nadar.io>
 * @since 1.0.0
 */
class Bootstrap3Group extends BlockGroup
{
    public function identifier()
    {
        return 'bootstrap3';
    }
    
    public function label()
    {
        return 'Bootstrap 3';
    }
    
    public function getPosition()
    {
        return 60;
    }
}
