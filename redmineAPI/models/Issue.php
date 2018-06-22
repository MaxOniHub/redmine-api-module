<?php

namespace redmineModule\models;

use yii\base\Model;

class Issue extends Model
{
    public $issue_id;

    public $subject;

    public $project_id;

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