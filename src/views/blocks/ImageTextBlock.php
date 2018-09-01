<?php
use yii\helpers\Html;

/**
 * @var $this \luya\cms\base\PhpBlockView
 */

$image = $this->extraValue('image');
$text = $this->extraValue('text');
?>
<?php if ($image && $text): ?>
    <?php $imageCaption = $image['caption']; ?>

    <div class="media clearfix">
        <div class="<?php echo ($this->varValue('imagePosition', 'left') == 'left') ? 'media-left pull-left' : 'media-right pull-right' ?>">
            <?= Html::img($image['source'], [
                'class' => 'media-object',
                'alt' => $imageCaption === null ? '' : $imageCaption,
                'title' => $imageCaption,
                'width' => $this->cfgValue('width', null),
                'height' => $this->cfgValue('height', null),
                'style' => $this->extraValue('imagePosition') . $this->cfgValue('margin', '20px', ';margin-bottom:{{margin}};'),
            ]) ?>
        </div>

        <div class="media-body">
            <?= $text; ?>
            <?php if ($this->cfgValue('btnHref') && $this->cfgValue('btnLabel')): ?>
                <br>
                <?= Html::a($this->cfgValue('btnLabel'), $this->cfgValue('btnHref'), [
                    'class' => $this->cfgValue('btnClass', 'button'),
                    'target' => ($this->cfgValue('targetBlank') == 1) ? '_blank' : null,
                ]); ?>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>
