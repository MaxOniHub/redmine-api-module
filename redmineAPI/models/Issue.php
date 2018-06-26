<?php

namespace redmineModule\models;

use yii\base\Model;

/**
 * Class Issue
 * @package redmineModule\models
 */
class Issue extends Model
{
    public $issue_id;

    public $subject;

    public $project_id;
    public $project_name;

    public $tracker_id;
    public $tracker_name;

    public $status_id;
    public $status_name;

    public $author_id;
    public $author_name;

    public $category_id;
    public $category_name;

    public $description;

    public $start_date;
    public $due_date;

    public $estimated_hours;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['issue_id', 'subject', 'project_id'], 'safe'],
        ];
    }


}