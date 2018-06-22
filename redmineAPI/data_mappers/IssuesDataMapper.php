<?php

namespace redmineModule\data_mappers;

use redmineModule\abstractions\AbstractDataMapper;
use redmineModule\components\RedmineClientComponent;
use yii\data\ArrayDataProvider;

/**
 * Class IssuesDataMapper
 * @package redmineModule\data_mappers
 */
class IssuesDataMapper extends AbstractDataMapper
{
    private $repository;

    /**
     * IssuesDataMapper constructor.
     * @param RedmineClientComponent $redmineClient
     * @param ArrayDataProvider $dataProvider
     */
    public function __construct(RedmineClientComponent $redmineClient, ArrayDataProvider $dataProvider)
    {
        $this->repository = $redmineClient;

        parent::__construct($dataProvider);
    }

    public function getAll()
    {

    }

    /**
     * @param $project_id
     * @return ArrayDataProvider
     */
    public function getByProjectId($project_id)
    {
        $this->results = $this->repository->getIssuesByProjectId($project_id)["issues"];

        return $this->getDataProvider($this->results);
    }

    public function findById($id)
    {
        $this->results = $this->repository->getIssueById($id)["issue"];

        return $this->getData($this->results);
    }


}