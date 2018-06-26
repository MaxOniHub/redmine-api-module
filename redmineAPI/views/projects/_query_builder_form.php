<?php
use kartik\daterange\DateRangePicker;
use yii\helpers\Html;

?>
<hr/>
<div class="row">
    <div class="col-md-3">

        <?=
        $form->field($model, 'date_range', [])->widget(DateRangePicker::class, [
            'presetDropdown' => true,
            'hideInput' => true
        ]);

        ?>
        <div class="row">
            <div class="col-md-6">

            </div>
            <div class="col-md-6  text-right">
                <?= Html::submitButton('Send', ['class' => 'btn btn-info']); ?>
            </div>
        </div>
        <hr>

    </div>
</div>

