<?php

namespace cmstests\src\frontend\blocks;

use luya\bootstrap3\tests\Bootstrap3BlockTestCase;

class MapBlockTest extends Bootstrap3BlockTestCase
{
    public $blockClass = 'luya\bootstrap3\blocks\MapBlock';

    public function testEmptyRender()
    {
        $this->assertSame('', $this->renderFrontendNoSpace());
    }
    
    public function testAddress()
    {
        $this->block->setVarValues(['address' => 'Mountain View, California, United States']);
        
        $this->assertContains('<iframe src="https://maps.google.com/maps?f=q&source=s_q&hl=en&q=Mountain+View%2C+California%2C+United+States&z=15&t=h&output=embed" width="600" height="450" frameborder="0" style="border:0"></iframe>', $this->renderFrontendNoSpace());
    }
    
    public function testZoomAndType()
    {
        $this->block->setVarValues(['address' => 'Mountain View, California, United States', 'zoom' => 1, 'maptype' => 'k']);
    
        $this->assertContains('<iframe src="https://maps.google.com/maps?f=q&source=s_q&hl=en&q=Mountain+View%2C+California%2C+United+States&z=1&t=k&output=embed" width="600" height="450" frameborder="0" style="border:0"></iframe>', $this->renderFrontendNoSpace());
    
        $this->assertSame('<div class="iframe-container"><iframe src="https://maps.google.com/maps?f=q&source=s_q&hl=en&q=Mountain+View%2C+California%2C+United+States&z=1&t=k&output=embed"></iframe></div>', $this->renderAdminNoSpace());
    }
    
    public function testSnazzyMaps()
    {
        $this->block->setCfgValues(['snazzymapsUrl' => 'https://snazzymaps.com']);
        
        $this->assertContains('src="https://snazzymaps.com"', $this->renderFrontendNoSpace());
    }
}
