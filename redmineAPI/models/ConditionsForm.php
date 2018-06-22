<?php

namespace redmineModule\models;

use yii\base\Model;

/**
 * @package redmineModule\models
 */
class ConditionsForm extends Model
{
    public $date_range;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date_range'], 'string'],
        ];
    }
}