<?php
use kartik\grid\GridView;

$gridColumns = [
    [
        'class' => 'kartik\grid\CheckboxColumn',
        'headerOptions' => ['class' => 'kartik-sheet-style'],
        'checkboxOptions' => function ($data, $key, $index, $widget) {
            return ['value' => $data['id']];
        },
    ],
    // ID column
    [
        'format' => 'raw',
        'value' => function ($data, $key, $index, $widget) {
            return $data["id"];
        },
        'attribute' => 'id',
        'label' => 'Project id'

    ],
    // Name column
    [
        'format' => 'raw',
        'value' => function ($data, $key, $index, $widget) {
            return $data["name"];
        },
        'attribute' => 'name',
        'filter' => [],//ArrayHelper::map($data, 'category_id', 'category_name'),
        //'filterType' => GridView::FILTER_SELECT2,
        'filterWidgetOptions' => [
            'pluginOptions' => ['allowClear' => true]
        ],
        'filterInputOptions' => ['placeholder' => 'Select Category'],
    ],
    // Identifier column
    [
        'format' => 'raw',
        'value' => function ($data, $key, $index, $widget) {
            return $data["identifier"];
        },
        'attribute' => 'identifier',
    ],
    // Status column
    [
        'format' => 'raw',
        'value' => function ($data, $key, $index, $widget) {
            return $data["status"];
        },
        'attribute' => 'status',
        'filter' => [],//ArrayHelper::map($data, 'category_id', 'category_name'),
        'filterType' => GridView::FILTER_SELECT2,
        'filterWidgetOptions' => [
            'pluginOptions' => ['allowClear' => true]
        ],
        'filterInputOptions' => ['placeholder' => 'Select Project'],
    ],

];

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
    'floatHeader' => false,
    'showPageSummary' => false,
    'panel' => [
        'type' => GridView::TYPE_INFO
    ],

]);
?>