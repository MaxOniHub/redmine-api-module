<?php

namespace redmineModule\helpers;

use redmineModule\models\Issue;
use redmineModule\models\TimeEntries;
use yii\data\ArrayDataProvider;

/**
 * Class IssuesTimeEntriesConnector
 * @package redmineModule\helpers
 */
class IssuesTimeEntriesConnector
{
    /**
     * @param ArrayDataProvider $timeEntriesDataProvider
     * @param ArrayDataProvider $issuesDataProvider
     * @return ArrayDataProvider
     */
    public function connect(ArrayDataProvider $timeEntriesDataProvider, ArrayDataProvider $issuesDataProvider)
    {
        /**
         * @var TimeEntries $model
         */
        foreach ($timeEntriesDataProvider->getModels() as &$model) {
            /**
             * @var Issue $issueModel
             */
            foreach ($issuesDataProvider->getModels() as $issueModel) {
                if ($model->issue_id == $issueModel->issue_id) {
                    $model->setIssue($issueModel);
                }
            }
        }

        return $timeEntriesDataProvider;
    }
}