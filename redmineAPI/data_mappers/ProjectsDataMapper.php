<?php

namespace redmineModule\data_mappers;

use redmineModule\abstractions\AbstractDataMapper;
use redmineModule\components\RedmineClientComponent;
use yii\data\ArrayDataProvider;

/**
 * Class ProjectsDataMapper
 * @package redmineModule\data_mappers
 */
class ProjectsDataMapper extends AbstractDataMapper
{
    private $repository;

    /**
     * ProjectsDataMapper constructor.
     * @param RedmineClientComponent $redmineClient
     * @param ArrayDataProvider $dataProvider
     */
    public function __construct(RedmineClientComponent $redmineClient, ArrayDataProvider $dataProvider)
    {
        $this->repository = $redmineClient;

        parent::__construct($dataProvider);
    }

    /**
     * @return ArrayDataProvider
     */
    public function getAll()
    {
        $data = $this->repository->getProjects()["projects"];

        return $this->getDataProvider($data);
    }

    public function findById($id)
    {
        $data = $this->repository->getProjectById($id)["project"];

        return $this->getData($data);
    }



}