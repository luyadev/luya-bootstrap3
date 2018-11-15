<?php
/**
 * @var $this \luya\cms\base\PhpBlockView
 */
?>
<div class="row<?= $this->cfgValue('rowDivClass', null, ' {{rowDivClass}}');?>">
    <?php for ($i = 0; $i < $this->cfgValue('columnCount'); $i++) : ?>
		<div class="<?= $this->varValue('columnWidth' . $i, 12, 'col-md-{{columnWidth'.$i.'}}') . $this->cfgValue($i . 'ColumnClasses', null, ' {{'.$i.'ColumnClasses}}'); ?>">
            <?= $this->placeholderValue('column' . $i); ?>
		</div>
    <?php endfor; ?>
</div>