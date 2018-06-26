<?php

namespace redmineModule\abstractions;

use yii\caching\CacheInterface;

/**
 * Class AbstractDataCache
 * @package redmineModule\abstractions
 */
abstract class AbstractDataCache
{
    /**
     * @var CacheInterface
     */
    protected $cache;

    protected $key;

    protected $duration;

    /**
     * AbstractDataCache constructor.
     * @param CacheInterface $cache
     */
    public function __construct(CacheInterface $cache)
    {
        $this->cache = $cache;
    }

    public function setKey($key)
    {
        $this->key = $key;
    }

    public function getKey()
    {
        return $this->key;
    }

    /**
     * @return integer
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * @param integer $duration
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;
    }

    public function setValues($values)
    {
        $cache["data"] = $values;
        $cache["created_at"]= time();

        $this->cache->set($this->getKey(), $cache, $this->getDuration());
    }

    public function getValues()
    {
        if ($cache = $this->cache->get($this->getKey()))
        {
            return $cache["data"];
        }
        return false;
    }

    public function getCreatedTime()
    {
        if ($cache = $this->cache->get($this->getKey()))
        {
            return $cache["created_at"];
        }
        return false;
    }

    public function flush()
    {
        $this->cache->delete($this->getKey());
    }

}