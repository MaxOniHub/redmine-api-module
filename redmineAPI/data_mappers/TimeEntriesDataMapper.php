<?php

namespace redmineModule\data_mappers;

use redmineModule\abstractions\AbstractDataMapper;
use redmineModule\components\RedmineClientComponent;
use redmineModule\utils\ArraySortTrait;
use yii\data\ArrayDataProvider;

/**
 * Class TimeEntriesDataMapper
 * @package redmineModule\data_mappers
 */
class TimeEntriesDataMapper extends AbstractDataMapper
{
    use ArraySortTrait;

    private $repository;

    private $date_range;

    private $projects_ids;

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

    public function addDateRange($dateRange)
    {
        $this->date_range = $dateRange;
        return $this;
    }

    public function addProjects($projects_ids)
    {
        $this->projects_ids = $projects_ids;
        return $this;
    }

    /**
     * @return array|ArrayDataProvider
     */
    public function getAll()
    {
        $res = [];

        if (!$this->checkConditions()) return $res;
        $res = $this->collectData();

        return $this->getDataProvider($res);
    }

    public function findById($id)
    {

    }

    private function collectData()
    {
        $res = [];

        foreach ($this->projects_ids as $projects_id) {
            $options["project_id"] = $projects_id;
            $options["spent_on"] = $this->getValidDateRange();
            if (($data = $this->repository->getTimeEntries($options)["time_entries"]) && !empty($data)) {
                $res = array_merge($res, $data);
            }
        }

        foreach ($res as $key=>&$item)
        {
            $item["project_id"] = $item["project"]["id"];
        }
        $sorted = $this->array_orderby($res, 'project_id', SORT_DESC);
        return $sorted;
    }

    private function checkConditions()
    {
        return $this->checkParam($this->projects_ids) && $this->checkParam($this->date_range);
    }

    private function checkParam($param)
    {
        return $param && !empty($param) ? true : false;
    }

    private function getValidDateRange()
    {
        $dates = explode(" - ", $this->date_range);
        if (count($dates) > 1)
        {
            return "><".$dates[0]."|".$dates[1];
        }

        return null;
    }
}
