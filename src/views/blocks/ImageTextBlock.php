<?php
use yii\helpers\Html;

/**
 * @var $this \luya\cms\base\PhpBlockView
 */
?>
<?php if ($this->extraValue('image') && $this->extraValue('text')): $imageCaption = $this->extraValue('image')['caption'];?>
    <div class="media">
        <div class="<?php echo ($this->varValue('imagePosition', 'left') == 'left') ? 'media-left pull-left' : 'media-right pull-right' ?>">
            <?= Html::img($this->extraValue('image')['source'], [
                'class' => 'media-object',
                'alt' => $imageCaption === null ? '' : $imageCaption,
                'title' => $imageCaption,
                'width' => $this->cfgValue('width', null),
                'height' => $this->cfgValue('height', null),
            ]) ?>
        </div>

        <div class="media-body">
            <?= $this->extraValue('text'); ?>
            <?php if ($this->cfgValue('btnHref') && $this->cfgValue('btnLabel')): ?>
                <br>
                <?= Html::a($this->cfgValue('btnLabel'), $this->cfgValue('btnHref'), [
                    'class' => 'button',
                    'target' => ($this->cfgValue('targetBlank') == 1) ? '_blank' : null,
                ]); ?>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>
