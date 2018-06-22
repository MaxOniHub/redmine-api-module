<?php

use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = 'Projects';
$this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['index']];

?>

<?php $form = ActiveForm::begin(["action" => Url::to(["time-entries/index"])]); ?>

<?= $this->render("_query_builder_form", ["form" => $form, "model" => $conditionsForm]); ?>

<?php echo $this->render("_grid", ["dataProvider" => $dataProvider, "searchModel" => []]); ?>

<?php ActiveForm::end(); ?>
