<?php

namespace redmineModule\factories;

use redmineModule\helpers\TimeEntriesCache;
use Yii;

/**
 * Class TimeEntriesCacheFactory
 * @package redmineModule\factories
 */
class TimeEntriesCacheFactory
{

    public function build()
    {
        return Yii::createObject(TimeEntriesCache::class, [Yii::$app->controller->module->cache]);
    }
}