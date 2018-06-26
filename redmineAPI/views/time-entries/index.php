<?php

use kartik\export\ExportMenu;
use redmineModule\widgets\CacheInfoWidget;

$this->title = 'Time Entries';
$this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => \yii\helpers\Url::to(['projects/index'])];
$this->params['breadcrumbs'][] = ['label' => 'Time Entries', 'url' => ['index']];

?>
<div class="row">
    <div class="col-md-6">
        <?= $this->render("_query_info", ["searchModel" => $searchModel])?>
    </div>
    <div class="col-md-6 text-right">
        <?= CacheInfoWidget::widget()?>
    </div>
</div>

<?php

echo ExportMenu::widget([
    'dataProvider' => $dataProvider,
    'columns' => $gridColumns,
    'fontAwesome' => true,
    'showColumnSelector' => true,
    'showConfirmAlert' => false,
    'exportConfig' => [
        ExportMenu::FORMAT_EXCEL => false,
        ExportMenu::FORMAT_TEXT => false,
        ExportMenu::FORMAT_HTML => false,
    ],
    'target' => ExportMenu::TARGET_BLANK
]);
?>
<?= $this->render("_grid", ["dataProvider" => $dataProvider, "gridColumns" => $gridColumns]) ?>



