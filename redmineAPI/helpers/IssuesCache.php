<?php

namespace redmineModule\helpers;

use redmineModule\abstractions\AbstractDataCache;

/**
 * Class IssuesCache
 * @package redmineModule\helpers
 */
class IssuesCache extends AbstractDataCache
{
    protected $key = "issues";

    protected $duration = 300;
}