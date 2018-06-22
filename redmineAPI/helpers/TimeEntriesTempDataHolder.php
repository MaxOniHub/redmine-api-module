<?php

namespace redmineModule\helpers;

/**
 * Class TimeEntriesTempDataHolder
 * @package redmineModule\helpers
 */
class TimeEntriesTempDataHolder
{
    /**
     * @var TempDataHolder
     */
    private $dataHolder;

    private $key = "time-entries-query";

    /**
     * TimeEntriesTempDataHolder constructor.
     */
    public function __construct()
    {
        $this->dataHolder = \Yii::createObject(TempDataHolder::class);
    }

    public function setValues($post_params, $queryParams)
    {
        if ($post_params && !empty($post_params)) {
            $old_data = $this->dataHolder->getValues($this->key);
            $updated_data = array_merge($old_data, $post_params);
            $this->dataHolder->setValues($this->key, $updated_data);
        }


        if ($queryParams && !empty($queryParams)) {
            $old_data = $this->dataHolder->getValues($this->key);
            $updated_data = array_merge($old_data, $queryParams);
            $this->dataHolder->setValues($this->key, $updated_data);
        }
    }

    public function getValues()
    {
        return $this->dataHolder->getValues($this->key);
    }

    public function destroy()
    {
        $this->dataHolder->destroy();
    }
}