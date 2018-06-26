<?php

namespace redmineModule\widgets;

use redmineModule\abstractions\AbstractDataCache;
use redmineModule\factories\TimeEntriesCacheFactory;
use Yii;
use yii\base\Widget;
use yii\i18n\Formatter;

class CacheInfoWidget extends Widget
{
    /** @var  AbstractDataCache */
    private $TimeEntriesCache;

    /** @var  Formatter * */
    private $formatter;

    public function init()
    {
        parent::init();

        $this->TimeEntriesCache = (new TimeEntriesCacheFactory())->build();

        $this->formatter = Yii::$app->controller->module->formatter;
    }

    public function run()
    {

        return $this->render("cache-info-widget/view", [
            "time" => $this->getCreatedAt(),
            "timeZone" => $this->getTimeZone(),
            "duration" => $this->getCacheDuration()
        ]);
    }

    private function getCreatedAt()
    {
        if ($created_at = $this->TimeEntriesCache->getCreatedTime()) {
            return $this->formatter->asDateTime($created_at);
        }
        return false;
    }

    private function getTimeZone()
    {
        return $this->formatter->timeZone;
    }

    /**
     * Get cache duration in minutes
     * @return float|int
     */
    private function getCacheDuration()
    {
       return $this->TimeEntriesCache->getDuration()/60;
    }

}