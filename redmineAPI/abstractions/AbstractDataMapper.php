<?php

namespace redmineModule\abstractions;

use redmineModule\interfaces\IDataMapper;
use yii\data\ArrayDataProvider;

/**
 * Class AbstractDataMapper
 * @package redmineModule\abstractions
 */
abstract class AbstractDataMapper implements IDataMapper
{
    /**
     * @var ArrayDataProvider
     */
    protected $dataProvider;

    protected $pageSize = 50;

    protected $sorted_attributes = ['id', 'name'];

    protected $results;

    public function __construct(ArrayDataProvider $arrayDataProvider)
    {
        $this->dataProvider = $arrayDataProvider;
    }

    public function setPageSize($pageSize)
    {
        $this->pageSize = $pageSize;
    }

    public function getPageSize()
    {
        return $this->pageSize;
    }

    public function setSortedAttributes($attr_names = [])
    {
        $this->sorted_attributes = $attr_names;
    }

    public function getSortedAttributes()
    {
        return $this->sorted_attributes;
    }

    public function getResults()
    {
        return $this;
    }

    public function getColumn($column, $is_sub_array = false)
    {
        $columns = [];
        $this->results = !isset($this->results[0]) ? [$this->results] : $this->results;

        foreach ($this->results as $result) {
            if (isset($result[$column])) {
                $columns[] = $is_sub_array ? $result[$column] : [$column => $result[$column]];
            }
        }
        return array_unique($columns, SORT_REGULAR);
    }

    /**
     * @param $data
     * @return ArrayDataProvider
     */
    public function getDataProvider($data)
    {
        if (!empty($data) && isset($data)) {
            return new $this->dataProvider([
                'allModels' => $data,
                'pagination' => [
                    'pageSize' => $this->pageSize,
                ],
                'sort' => [
                    'attributes' => $this->sorted_attributes,
                ],
            ]);
        }
        return new $this->dataProvider([
            'allModels' => [],
        ]);
    }

    protected function getData($data)
    {
        if (!empty($data) && isset($data)) {
            return $data;
        }
        return [];
    }

}