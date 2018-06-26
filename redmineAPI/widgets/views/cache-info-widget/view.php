<?php
use yii\helpers\Html;
use yii\widgets\Pjax;

?>

<p>Data was cached at <?= $time ?>&nbsp;(<?= $timeZone; ?>) for <?= $duration ?>&nbsp;minute(s)</p>

<?php Pjax::begin(['enablePushState' => false]); ?>

<?= Html::beginForm(['cache/flush'], 'post', ['data-pjax' => '', 'class' => 'form-inline']); ?>

<?= \yii\helpers\Html::hiddenInput("key", 1)?>
<?= Html::submitButton('Flush', ['class' => 'btn btn-lg btn-primary', 'name' => 'hash-button']) ?>

<?= Html::endForm() ?>

<?php if ($is_empty_cache) :?>
    <h4>Cache is empty</h4>
<?php endif; ?>

<?php Pjax::end(); ?>

