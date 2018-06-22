<?php
use kartik\daterange\DateRangePicker;
use yii\helpers\Html;

?>
<hr/>
<div class="row">
    <div class="col-md-6">

        <?=
        $form->field($model, 'date_range', [])->widget(DateRangePicker::class, [
            'presetDropdown' => true,
            'hideInput' => true
        ]);

        ?>
    </div>
    <div class="col-md-6">
    </div>
</div>
<div class="row">
    <div class="col-md-6 text-right">
        <?= Html::submitButton('Send', ['class' => 'btn btn-info']); ?>
    </div>
    <div class="col-md-6">
    </div>
</div>
<hr>
