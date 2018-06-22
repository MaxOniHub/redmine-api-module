<?php

use kartik\grid\GridView;

$gridColumns = [
    /**
     *  Project name
     */
    [
        'attribute' => 'project_name',
        'value' => function ($data, $key, $index, $widget) {
            return $data["project"]["name"];
        },
        'label' => 'Project name',
        'group'=>true,  // enable grouping
        'groupHeader'=>function ($data, $key, $index, $widget) { // Closure method
            return [
                'mergeColumns'=>[[3]], // columns to merge in summary
                'content'=>[             // content to show in each summary cell
                    2=>'Summary (' . $data["project"]["name"] . ') ',
                    3=>GridView::F_SUM,
                ],
                'contentFormats'=>[      // content reformatting for each summary cell
                    3 => ['format' => 'number', 'decimals' => 2],

                ],
                'contentOptions'=>[      // content html attributes for each summary cell
                    3 => ['style' => 'text-align:right'],
                ],
                // html attributes for group summary row
                'options' => ['class' => 'info', 'style' => 'font-weight:bold;']
            ];
        }
    ],
    /**
     *  Issue id
     */
    [
        'attribute' => 'issue_id',
        'value' => function ($data, $key, $index, $widget) {
            return $data["issue"]["id"];
        },
        'label' => 'Issue ID'
    ],
    /**
     * User name
     */
    [
        'attribute'=>'user_name',
        'value' => function ($data, $key, $index, $widget) {
            return $data["user"]["name"];
        },
        'pageSummary'=>'Summary',
        'pageSummaryOptions'=>['class'=>'text-right text-warning'],
    ],

    /**
     * Hours
     */
    [
        'format'=>['decimal', 2],
        'attribute' => 'hours',
        'label' => 'hours',
        'value' => function ($data, $key, $index, $widget) {
            return $data["hours"];
        },
        'hAlign'=>'right',
        'pageSummary' => true,

    ],

    /**
     * Spent on
     */
    [
        'attribute' => 'spent_on',
        'label' => 'Spent on',
        'value' => function ($data, $key, $index, $widget) {
            return $data["spent_on"];
        },
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
    'showPageSummary' => true,
    'panel' => [
        'type' => GridView::TYPE_INFO
    ],

]);
?>