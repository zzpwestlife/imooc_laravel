<?php
/*
 * This file is part of the DebugBar package.
 *
 * (c) 2013 Maxime Bouroumeau-Fuseau
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DebugBar\Storage;

/**
 * Stores collected data into Redis
 */
class RedisStorage implements StorageInterface
{
    protected $redis;

    protected $hash;

    /**
     * @param  \Predis\Client $redis Redis Client
     * @param  string $hash
     */
    public function __construct($redis, $hash = 'phpdebugbar')
    {
        $this->redis = $redis;
        $this->hash = $hash;
    }

    /**
     * {@inheritdoc}
     */
    public function save($id, $data)
    {
        $this->redis->hset($this->hash, $id, serialize($data));
    }

    /**
     * {@inheritdoc}
     */
    public function get($id)
    {
        return unserialize($this->redis->hget($this->hash, $id));
    }

    /**
     * {@inheritdoc}
     */
    public function find(array $filters = array(), $max = 20, $offset = 0)
    {
        $results = array();
        foreach ($this->redis->hgetall($this->hash) as $id => $data) {
            if ($data = unserialize($data)) {
                $meta = $data['__meta'];
                if ($this->filter($meta, $filters)) {
                    $results[] = $meta;
                }
            }
        }
        
        usort($results, function ($a, $b) {
            return $a['utime'] < $b['utime'];
        });
        
        return array_slice($results, $offset, $max);
    }

    /**
     * Filter the metadata for matches.
     */
    protected function filter($meta, $filters)
    {
        foreach ($filters as $key => $value) {
            if (!isset($meta[$key]) || fnmatch($value, $meta[$key]) === false) {
                return false;
            }
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function clear()
    {
        $this->redis->del($this->hash);
    }
}
