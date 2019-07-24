<?php
 
namespace Idea\Libraries;

use Idea\Traits\MagicMethod;
use Idea\Models\Badges as Model;
use Illuminate\Contracts\Cache\Factory as Cache;

class BadgeLibrary {

    use MagicMethod;

    public function __construct(Model $model, Cache $cache)
	{
		$this->model = $model;
        $this->cache = $cache->store('models');
	}

	public function get($id)
	{
		$key = 'badge-' . $id;
		if ($this->cache->has($key)) {
			$item = $this->cache->get($key);
		} else {
			$item = $this->model->where('id',$id)->first();
			$this->cache->add($key, $item, config('cache.cache_duration'));
		}
		return $item;
	}
}