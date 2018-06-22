<?php

$this->title = 'Time Entries';
$this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => \yii\helpers\Url::to(['projects/index'])];
$this->params['breadcrumbs'][] = ['label' => 'Time Entries', 'url' => ['index']];

?>
<?= $this->render("_query_info", ["searchModel" => $searchModel])?>

<?= $this->render("_grid", ["dataProvider" => $dataProvider])?>


