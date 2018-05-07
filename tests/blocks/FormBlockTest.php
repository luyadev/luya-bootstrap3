<?php

namespace cmstests\src\frontend\blocks;

use luya\bootstrap3\tests\Bootstrap3BlockTestCase;

class FormBlockTest extends Bootstrap3BlockTestCase
{
    public $blockClass = 'luya\bootstrap3\blocks\FormBlock';
    
    public function testEmptyRenderFrontend()
    {
        $this->assertSame('Form', $this->block->name());
        $this->assertEmpty($this->renderFrontend());
    }
    
    public function testBasicInput()
    {
        $this->block->setVarValues([
            'headline' => 'My Form',
            'emailAddress' => 'hello@luya.io',
        ]);
        
        $this->assertContains('<h3>My Form</h3><form class="form-horizontal" role="form" method="post"><input type="hidden" name="_csrf" value="', $this->renderFrontendNoSpace());
        $this->assertContains('<div class="form-group"><label for="name" class="col-sm-2 control-label">Name</label><div class="col-sm-10"><input type="text" class="form-control" id="name" name="name" placeholder="First and Last Name" value=""></div></div><div class="form-group"><label for="email" class="col-sm-2 control-label">Email</label><div class="col-sm-10"><input type="email" class="form-control" id="email" name="email" placeholder="beispiel@beispiel.ch" value=""></div></div><div class="form-group"><label for="message" class="col-sm-2 control-label">Message</label><div class="col-sm-10"><textarea class="form-control" rows="4" name="message"></textarea></div></div><div class="form-group"><div class="col-sm-10 col-sm-offset-2"><input id="submit" name="submit" type="submit" value="Send" class="btn btn-primary">', $this->renderFrontendNoSpace());
    }
}
