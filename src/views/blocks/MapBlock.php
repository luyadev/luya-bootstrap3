<?php
/**
 * @var $this \luya\cms\base\PhpBlockView
*/

$identifier = $this->extraValue('identifier', 0);

?>
<?php if ($this->extraValue('embedUrl')):?>
<div class="embed-responsive embed-responsive-16by9">
    <iframe src="<?= $this->extraValue('embedUrl'); ?>" width="600" height="450" frameborder="0" style="border:0"></iframe>
</div>
<?php endif; ?>