<?php

namespace redmineModule\data_mappers;

use redmineModule\abstractions\AbstractDataCache;
use redmineModule\abstractions\AbstractDataMapper;
use redmineModule\components\RedmineClientComponent;
use redmineModule\models\TimeEntries;
use redmineModule\utils\ArraySortTrait;
use yii\data\ArrayDataProvider;

/**
 * Class TimeEntriesDataMapper
 * @package redmineModule\data_mappers
 */
class TimeEntriesDataMapper extends AbstractDataMapper
{
    use ArraySortTrait;

    /**
     * @var AbstractDataCache
     */
    private $dataCache;

    /** @var  TimeEntries */
    private $model;

    private $repository;

    private $date_range;

    private $projects_ids;

    /**
     * IssuesDataMapper constructor.
     * @param RedmineClientComponent $redmineClient
     * @param AbstractDataCache $dataCache
     * @param TimeEntries $timeEntries
     * @param ArrayDataProvider $dataProvider
     */
    public function __construct(
        RedmineClientComponent $redmineClient,
        AbstractDataCache $dataCache,
        TimeEntries $timeEntries,
        ArrayDataProvider $dataProvider
    )
    {
        $this->repository = $redmineClient;
        $this->dataCache = $dataCache;
        $this->model = $timeEntries;

        parent::__construct($dataProvider);
    }

    public function geModel()
    {
        return $this->model;
    }

    public function getRepository()
    {
        return $this->repository;
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

        /** get cached data */
        if ($data = $this->dataCache->getValues()) {
            return  $this->getDataProvider($data);
        }
        /** get updated data */
        $res = $this->collectData();
        /** set cache */
        $this->dataCache->setValues($res);

        return $this->getDataProvider($res);
    }

    public function findById($id)
    {

    }

    private function collectData()
    {

        $res = $this->fetchData();
        $sorted = $this->array_orderby($res, 'project_id', SORT_DESC);
        $grouped = $this->array_groupby($sorted, "issue_id", "hours");

        return $grouped;
    }

    private function fetchData()
    {
        $res = [];
        foreach ($this->projects_ids as $projects_id) {
            $options["project_id"] = $projects_id;
            $options["spent_on"] = $this->getValidDateRange();
            $options["offset"] = 0;
            $options["limit"] = 1000;

            if (($data = $this->repository->getTimeEntries($options)["time_entries"]) && !empty($data)) {
                $res = array_merge($res, $this->load($data));
            }

        }
        return $res;
    }

    private function load($items)
    {
        $res = [];
        foreach ($items as $item) {
            $te = new $this->model;
            $te->project_name = $item["project"]["name"];
            $te->project_id = $item["project"]["id"];
            $te->issue_id = $item["issue"]["id"];
            $te->user_name = $item["user"]["name"];
            $te->activity_id = $item["activity"]["id"];
            $te->activity_name = $item["activity"]["name"];
            $te->hours = $item["hours"];
            $te->spent_on = $item["spent_on"];
            $res[] = $te;
        }
        return $res;
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
        if (count($dates) > 1) {
            return "><" . $dates[0] . "|" . $dates[1];
        }

        return null;
    }
}
