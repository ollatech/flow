<?php

use Olla\Surface\Porter\Builder;
use Olla\Surface\Porter\Engine;

final class queryAction {
	public function __construct(Builder $queryBuilder, Engine $engine) {

	}
	public function getCollection() {
		$query = $this->queryBuilder->resource('App\Entity\User')
		->operator('collection')
		->select(['id'])
		->where('id' => '')
		->paginate('1', '20')
		->sort('id', 'asc');
		->collection();
		return $this->engine->execute($query);
	} 
}