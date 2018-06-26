<?php

namespace redmineModule\models;

use redmineModule\data_mappers\IssuesDataMapper;
use redmineModule\data_mappers\TimeEntriesDataMapper;
use redmineModule\factories\IssuesCacheFactory;
use redmineModule\factories\TimeEntriesCacheFactory;
use redmineModule\helpers\IssuesTimeEntriesConnector;
use Yii;
use yii\base\Model;
use yii\data\ArrayDataProvider;

/**
 * Class IssueSearch
 * @package app\models
 */
class TimeEntriesSearch extends Model
{
    public $date_range;

    public $projects_ids;

    /**
     * @var TimeEntriesDataMapper $dataMapper
     */
    private $dataMapper;

    private $issueDataMapper;

    /**
     * @var IssuesTimeEntriesConnector
     */
    private $dataProvidersConnector;

    private $pageSize = 1000;

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

    public function __construct(array $config = [])
    {
        parent::__construct($config);

        /** @var TimeEntries dataMapper */
        $this->dataMapper = Yii::createObject(TimeEntriesDataMapper::class,
            [Yii::$app->controller->module->redmine, (new TimeEntriesCacheFactory())->build()]);

        /** @var IssuesDataMapper $issueDataMapper */
        $this->issueDataMapper = Yii::createObject(IssuesDataMapper::class,
            [Yii::$app->controller->module->redmine, (new IssuesCacheFactory())->build()]);

        $this->dataProvidersConnector = Yii::createObject(IssuesTimeEntriesConnector::class);

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
        $this->dataMapper->setPageSize($this->pageSize);
        $this->issueDataMapper->setPageSize($this->pageSize);

        $query = $this->dataMapper;
        $issueQuery = $this->issueDataMapper;

        $this->load($params["ConditionsForm"], '');

        if ($this->checkParam($this->getProjectIds($params))) {
            $query = $this->dataMapper->addProjects($this->projects_ids);
            $issueQuery = $this->issueDataMapper->addProjects($this->projects_ids);
        }

        if ($this->checkParam($this->date_range))
        {
            $query = $this->dataMapper->addDateRange($this->date_range);
        }

        $issuesDataProvider = $issueQuery->getAll();

        if ($dataProvider = $query->getAll())
        {

            return $this->dataProvidersConnector->connect($dataProvider, $issuesDataProvider);
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

    public function columnsToExport()
    {
        /** @var TimeEntries $repository */
        $model = $this->dataMapper->geModel();

        return $model->columnsToExport();
    }

    private function checkParam($param)
    {
        return $param && !empty($param);
    }
}
