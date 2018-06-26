<?php

namespace redmineModule\models;

use yii\base\Model;

/**
 * Class TimeEntries
 * @package redmineModule\models
 */
class TimeEntries extends Model
{
    public $project_name;

    public $project_id;

    public $activity_id;

    public $activity_name;

    public $issue_id;

    public $user_name;

    public $hours;

    public $spent_on;

    /**
     * Of course, we could inject an Issue object to this one (like $this->issue = $Issue), but we won't be able to
     * export any columns from an `Issue`. So to be able to export all columns (related to the `Issue`)
     * we need to create additional options for current object.
     */
    public $issue_link;

    public $issue_subject;

    public $issue_tracker_name;

    public $issue_status_name;

    public $issue_estimated_hours;

    private $endpoint = "https://redmine.yanpix.com/issues/";

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [
                [
                    'project_name', 'project_id', 'activity_id', 'activity_name', 'issue_id',
                    'spent_on', 'user_name', 'hours', 'spent_on', 'issue_link', 'issue_subject',
                    'issue_tracker_name', 'issue_status_name', 'issue_estimated_hours'],
                'safe'],
        ];
    }

    public function columnsToExport()
    {
        $exceptions = ["project_id", "activity_id"];
        return array_keys($this->getAttributes(null, $exceptions));
    }

    public function setIssueLink($issue_id)
    {
        $this->issue_link = $this->endpoint.$issue_id;
    }


    public function setIssue(Issue $issue)
    {
        $this->issue_subject = $issue->subject;
        $this->issue_tracker_name = $issue->tracker_name;
        $this->issue_status_name = $issue->status_name;
        $this->issue_estimated_hours = $issue->estimated_hours;
        $this->setIssueLink($issue->issue_id);
    }
}