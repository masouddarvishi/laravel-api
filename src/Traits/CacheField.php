<?php

namespace Hooraweb\LaravelApi\Traits;

use Illuminate\Support\Arr;

trait CacheField
{
    public function cache($key){
        
        return Arr::get($this->{$this->cacheFieldName} ?? [], $key);
    }

    public function cacheSet($key, $value){
        $cache = $this->{$this->cacheFieldName};
        Arr::set($cache, $key, $value);
        $this->{$this->cacheFieldName} = $cache;
        return $this;
    }

    public function cachePush($key, $value){
        $cache = $this->{$this->cacheFieldName};
        $v = Arr::get($cache, $key) ?? [];
        $v[] = $value;
        Arr::set($cache, $key, $v);
        $this->{$this->cacheFieldName} = $cache;
        return $this;
    }

    public function cacheAdd($key, $value){
        $cache = $this->{$this->cacheFieldName};
        $v = intval(Arr::get($cache, $key)) + intval($value);
        Arr::set($cache, $key, $v);
        $this->{$this->cacheFieldName} = $cache;
        return $this;
    }

    public function cacheForget($key){
        $cache = $this->{$this->cacheFieldName};
        Arr::forget($cache, $key);
        $this->{$this->cacheFieldName} = $cache;
        return $this;
    }

    public function cacheDelete($key, $arr){
        $cache = $this->{$this->cacheFieldName};
        $v = array_filter(Arr::get($cache, $key) ?? [], function($i) use ($arr){
            return !in_array($i, $arr);
        });
        Arr::set($cache, $key, $v);
        $this->{$this->cacheFieldName} = $cache;
        return $this;
    }
}