<?php

namespace redmineModule\helpers;

use kartik\grid\GridView;

class TimeEntriesGridColumnsProvider
{

    public function getColumns()
    {
        $gridColumns = [

            /**
             *  Project name
             */
            [
                'attribute' => 'project_name',
                'value' => function ($data, $key, $index, $widget) {
                    return $data->project_name;
                },
                'label' => 'Project name',
                'group'=>true,  // enable grouping
                'groupHeader'=>function ($data, $key, $index, $widget) { // Closure method
                    return [
                        'mergeColumns'=>[[8]], // columns to merge in summary
                        'content'=>[             // content to show in each summary cell
                            2=>'Summary (' . $data->project_name . ') ',
                            8=>GridView::F_SUM,
                        ],
                        'contentFormats'=>[      // content reformatting for each summary cell
                            8 => ['format' => 'number', 'decimals' => 2],

                        ],
                        'contentOptions'=>[      // content html attributes for each summary cell
                            8 => ['style' => 'text-align:right'],
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
                    return $data->issue_id;
                },
                'label' => 'Issue ID'
            ],
            /**
             *  Issue link
             */
            [
                'format' => 'html',
                'attribute' => 'issue_link',
                'value' => function ($data, $key, $index, $widget) {
                    return \yii\helpers\Html::a($data->issue_link, $data->issue_link);
                },
                'label' => 'Issue link'
            ],
            /**
             * Issue subject
             */
            [

                'attribute' => 'issue_name',
                'value' => function ($data, $key, $index, $widget) {
                    return $data->issue_subject;
                },
                'label' => 'Issue name'
            ],
            /**
             * Tracker name
             */
            [
                'attribute' => 'tracker_name',
                'value' => function ($data, $key, $index, $widget) {
                    return $data->issue_tracker_name;
                },
                'label' => 'Tracker name'
            ],

            /**
             * Activity name
             */
            [
                'attribute' => 'tracker_name',
                'value' => function ($data, $key, $index, $widget) {
                    return $data->activity_name;
                },
                'label' => 'Activity name'
            ],

            /**
             * Status name
             */
            [
                'attribute' => 'status_name',
                'value' => function ($data, $key, $index, $widget) {
                    return $data->issue_status_name;
                },
                'label' => 'Status name'
            ],

            /**
             * User name
             */
            [
                'attribute'=>'user_name',
                'value' => function ($data, $key, $index, $widget) {
                    return $data->user_name;
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
                'label' => 'Hours',
                'value' => function ($data, $key, $index, $widget) {
                    return $data->hours;
                },
                'hAlign'=>'right',
                'pageSummary' => true,

            ],

            /**
             * Estimated hours
             */
            [
                'format'=>['decimal', 2],
                'attribute' => 'estimated_hours',
                'label' => 'Estimated hours',
                'value' => function ($data, $key, $index, $widget) {
                    return $data->issue_estimated_hours;
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
                    return $data->spent_on;
                },
            ],

        ];

        return $gridColumns;
    }
}