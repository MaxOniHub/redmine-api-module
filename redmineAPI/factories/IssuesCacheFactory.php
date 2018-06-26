<?php

namespace redmineModule\factories;

use redmineModule\helpers\IssuesCache;
use Yii;

/**
 * Class IssuesCacheFactory
 * @package redmineModule\factories
 */
class IssuesCacheFactory
{

    public function build()
    {
        return Yii::createObject(IssuesCache::class, [Yii::$app->controller->module->cache]);
    }
}