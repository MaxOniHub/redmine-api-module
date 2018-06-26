<?php

namespace redmineModule\helpers;

use redmineModule\abstractions\AbstractDataCache;

/**
 * Class TimeEntriesCache
 * @package redmineModule\helpers
 */
class TimeEntriesCache extends AbstractDataCache
{
    protected $key = "time_entries";

    protected $duration = 300;
}