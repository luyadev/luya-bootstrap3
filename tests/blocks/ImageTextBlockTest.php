<?php

namespace cmstests\src\frontend\blocks;

use luya\bootstrap3\tests\Bootstrap3BlockTestCase;

class ImageTextBlockTest extends Bootstrap3BlockTestCase
{
    public $blockClass = 'luya\bootstrap3\blocks\ImageTextBlock';
    
    public function testEmpty()
    {
        $this->assertSame('', $this->renderFrontend());
    }
    
    public function testImagehttpSource()
    {
        $this->block->setVarValues(['text' => 'Text']);
        $this->block->addExtraVar('image', ['source' => 'image.jpg', 'caption' => null]);
        
        $this->assertSame('<div class="media clearfix"><div class="media-left pull-left"><img class="media-object" src="image.jpg" alt="" style="margin-right:20px;margin-bottom:20px;"></div><div class="media-body"><p>Text</p></div></div>', $this->renderFrontendNoSpace());
    }
    
    public function testImageCaption()
    {
        $this->block->setVarValues(['text' => 'Text']);
        $this->block->addExtraVar('image', ['source' => 'image.jpg', 'caption' => 'foobar']);
        
        $this->assertSame('<div class="media clearfix"><div class="media-left pull-left"><img class="media-object" src="image.jpg" alt="foobar" title="foobar" style="margin-right:20px;margin-bottom:20px;"></div><div class="media-body"><p>Text</p></div></div>', $this->renderFrontendNoSpace());
    }
    
    public function testButton()
    {
        $this->block->setVarValues(['text' => 'Text']);
        $this->block->setCfgValues(['btnHref' => 'https://luya.io', 'btnLabel' => 'Button']);
        $this->block->addExtraVar('image', ['source' => 'image.jpg', 'caption' => null]);
    
        $this->assertSame('<div class="media clearfix"><div class="media-left pull-left"><img class="media-object" src="image.jpg" alt="" style="margin-right:20px;margin-bottom:20px;"></div><div class="media-body"><p>Text</p><br><a class="button" href="https://luya.io">Button</a></div></div>', $this->renderFrontendNoSpace());
    }
    
    public function testButtonTargetBlank()
    {
        $this->block->setVarValues(['text' => 'Text']);
        $this->block->setCfgValues(['btnHref' => 'https://luya.io', 'btnLabel' => 'Button', 'targetBlank' => 1]);
        $this->block->addExtraVar('image', ['source' => 'image.jpg', 'caption' => null]);
    
        $this->assertSame('<div class="media clearfix"><div class="media-left pull-left"><img class="media-object" src="image.jpg" alt="" style="margin-right:20px;margin-bottom:20px;"></div><div class="media-body"><p>Text</p><br><a class="button" href="https://luya.io" target="_blank">Button</a></div></div>', $this->renderFrontendNoSpace());
    }
    
    public function testWidthHeight()
    {
        $this->block->setVarValues(['text' => 'Text']);
        $this->block->setCfgValues(['width' => 100, 'height' => 100]);
        $this->block->addExtraVar('image', ['source' => 'image.jpg', 'caption' => null]);
    
        $this->assertSame('<div class="media clearfix"><div class="media-left pull-left"><img class="media-object" src="image.jpg" width="100" height="100" alt="" style="margin-right:20px;margin-bottom:20px;"></div><div class="media-body"><p>Text</p></div></div>', $this->renderFrontendNoSpace());
    }
}
