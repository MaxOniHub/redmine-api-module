<?php

namespace redmineModule\models;

use redmineModule\data_mappers\IssuesDataMapper;
use redmineModule\data_mappers\TimeEntriesDataMapper;
use Yii;
use yii\base\Model;
use yii\data\ArrayDataProvider;

/**
 * Class IssueSearch
 * @package app\models
 */
class TimeEntriesSearch extends TimeEntries
{
    /**
     * @var TimeEntriesDataMapper $dataMapper
     */
    private $dataMapper;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date_range', 'projects_ids'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ArrayDataProvider
     */
    public function search($params)
    {

        $this->dataMapper = Yii::createObject(\redmineModule\data_mappers\TimeEntriesDataMapper::class, [Yii::$app->controller->module->redmine]);
        $this->dataMapper->setPageSize(200);
        $query = $this->dataMapper;

        $this->load($params["ConditionsForm"], '');

        if ($this->checkParam($this->getProjectIds($params))) {
            $query = $this->dataMapper->addProjects($this->projects_ids);
        }

        if ($this->checkParam($this->date_range))
        {
            $query = $this->dataMapper->addDateRange($this->date_range);
        }

        if ($dataProvider = $query->getAll())
        {
            return $dataProvider;
        }

        return new ArrayDataProvider([
            'allModels' => [],
        ]);
    }

    public function getResults()
    {
        return $this->dataMapper->getResults();
    }

    public function getProjectIds($params)
    {
        $this->projects_ids = $params["selection"];
        return $this->projects_ids;
    }


    private function checkParam($param)
    {
        return $param && !empty($param);
    }
}
