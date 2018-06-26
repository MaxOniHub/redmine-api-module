<?php

namespace redmineModule\data_mappers;

use redmineModule\abstractions\AbstractDataCache;
use redmineModule\abstractions\AbstractDataMapper;
use redmineModule\components\RedmineClientComponent;
use redmineModule\models\Issue;
use yii\data\ArrayDataProvider;

/**
 * Class IssuesDataMapper
 * @package redmineModule\data_mappers
 */
class IssuesDataMapper extends AbstractDataMapper
{
    public $repository;

    /**
     * @var AbstractDataCache
     */
    private $dataCache;

    private $projects_ids;

    /**
     * IssuesDataMapper constructor.
     * @param RedmineClientComponent $redmineClient
     * @param AbstractDataCache $dataCache
     * @param ArrayDataProvider $dataProvider
     */
    public function __construct(RedmineClientComponent $redmineClient, AbstractDataCache $dataCache, ArrayDataProvider $dataProvider)
    {
        $this->repository = $redmineClient;
        $this->dataCache = $dataCache;

        parent::__construct($dataProvider);
    }

    public function addProjects($projects_ids)
    {
        $this->projects_ids = $projects_ids;
        return $this;
    }

    public function getAll()
    {
        $res = [];

        if (!$this->checkConditions()) return $res;

        $res = $this->multiProjectsSelection();

        return $this->getDataProvider($res);
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

    /**
     * @return array|bool
     */
    private function multiProjectsSelection()
    {
        $res = [];
        if ($data = $this->dataCache->getValues()) {
            return $data;
        }

        $options["offset"] = 0;
        $options["limit"] = 1000;

        foreach ($this->projects_ids as $projects_id) {
            $res = array_merge($res, $this->repository->getIssuesByProjectId($projects_id, $options)["issues"]);
        }

        $loaded = $this->load($res);
        $this->dataCache->setValues($loaded);

        return $loaded;
    }

    private function load($items)
    {
        $res = [];
        foreach ($items as $item) {
            $issue = new Issue();
            $issue->issue_id = $item["id"];
            $issue->subject = $item["subject"];
            $issue->description = $item["description"];
            $issue->start_date = $item["start_date"];
            $issue->due_date = $item["due_date"];

            $issue->project_id = $item["project"]["id"];
            $issue->project_name = $item["project"]["name"];

            $issue->tracker_id = $item["tracker"]["id"];
            $issue->tracker_name = $item["tracker"]["name"];

            $issue->status_id = $item["status"]["id"];
            $issue->status_name = $item["status"]["name"];

            $issue->author_id = $item["author"]["id"];
            $issue->author_name = $item["author"]["name"];

            $issue->category_id = $item["category"]["id"];
            $issue->category_name = $item["category"]["name"];

            $issue->estimated_hours = $item["estimated_hours"];

            $res [] = $issue;
        }
        return $res;
    }

    private function checkConditions()
    {
        return $this->checkParam($this->projects_ids);
    }

    private function checkParam($param)
    {
        return $param && !empty($param) ? true : false;
    }

}