<?php

use kartik\grid\GridView;

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => $gridColumns,
    'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
    'headerRowOptions' => ['class' => 'kartik-sheet-style'],
    'filterRowOptions' => ['class' => 'kartik-sheet-style'],
    'pjax' => true,
    'bordered' => true,
    'striped' => true,
    'condensed' => false,
    'responsive' => true,
    'export' => false,
    'hover' => true,
    'floatHeader' => true,
    'showPageSummary' => true,
    'panel' => [
        'type' => GridView::TYPE_INFO
    ],
]);
?>