<?php
/**
 * @var $this \luya\cms\base\PhpBlockView
*/

$identifier = $this->extraValue('identifier', 0);

?>
<?php if (!empty($this->varValue('address'))):?>
    <div class="embed-responsive embed-responsive-16by9">
            <iframe src="<? if ($this->cfgValue('snazzymapsUrl', false)): ?><?= $this->cfgValue('snazzymapsUrl', '') ?><? else: ?>https://maps.google.com/maps?f=q&source=s_q&hl=de&geocode=&q=<?= $this->extraValue('address');?>&z=<?= $this->extraValue('zoom');?>&t=<?= $this->extraValue('maptype')?>&output=embed<? endif; ?>" width="600" height="450" frameborder="0" style="border:0"></iframe>
    </div>
<?php endif; ?>