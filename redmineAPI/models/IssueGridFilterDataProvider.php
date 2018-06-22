<?php

namespace redmineModule\models;

use yii\helpers\ArrayHelper;

/**
 * Class IssueGridFilterDataProvider
 * @package redmineModule\models
 */
class IssueGridFilterDataProvider
{
    private $SearchModel;

    public function __construct(IssueSearch $issueSearch)
    {
        $this->SearchModel = $issueSearch;
    }

    public function getFilterById()
    {
        return ArrayHelper::map($this->SearchModel->getResults()->getColumn("id"), 'id', 'id');
    }


    public function getFilterByProject()
    {
        return ArrayHelper::map($this->SearchModel->getResults()->getColumn("project", true), 'id', 'name');
    }
}