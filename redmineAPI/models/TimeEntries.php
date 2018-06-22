<?php

namespace redmineModule\models;

use yii\base\Model;

/**
 * Class TimeEntries
 * @package redmineModule\models
 */
class TimeEntries extends Model
{
    public $projects_ids;

    public $date_range;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['projects_ids', 'date_range'], 'required'],
        ];
    }
}