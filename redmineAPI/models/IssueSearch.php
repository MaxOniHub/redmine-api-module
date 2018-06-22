<?php

namespace redmineModule\models;

use redmineModule\data_mappers\IssuesDataMapper;
use Yii;
use yii\base\Model;
use yii\data\ArrayDataProvider;

/**
 * Class IssueSearch
 * @package app\models
 */
class IssueSearch extends Issue
{
    private $dataMapper;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['subject', 'issue_id', 'project_id'], 'safe'],
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

        /**
         * @var IssuesDataMapper $issuesDataMapper
         */
        $this->dataMapper = Yii::createObject(\redmineModule\data_mappers\IssuesDataMapper::class, [Yii::$app->controller->module->redmine]);

        $data = [];

        $this->load($params["IssueSearch"], '');

        if ($this->issue_id && !empty($this->issue_id)) {
            $data[] = $this->dataMapper->findById($this->issue_id);
        }

        if ($this->project_id && !empty($this->project_id))
        {
            return $this->dataMapper->getByProjectId($this->project_id);
        }

        if (empty($data))
        {
            return $this->dataMapper->getByProjectId(intval($this->getProjectId($params)));
        }

        return new ArrayDataProvider([
            'allModels' => $data,
            'pagination' => [
                'pageSize' => $this->dataMapper->getPageSize(),
            ],
            'sort' => [
                'attributes' => $this->dataMapper->getSortedAttributes()
            ],
        ]);
    }

    public function getResults()
    {
        return $this->dataMapper->getResults();
    }

    public function getProjectId($params)
    {
        return $params["id"];
    }
}
