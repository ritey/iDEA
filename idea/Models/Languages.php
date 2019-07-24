<?php

namespace Idea\Models;

use Idea\Traits\ScopeEnabled;
use Illuminate\Database\Eloquent\Model;
use Idea\Traits\SetEnabledAttribute;

class Languages extends Model
{
	use SetEnabledAttribute, ScopeEnabled;

	/**
	* The database connection used with the model.
	*
	* @var string
	*/
	protected $connection = 'mysql';

	/**
	* The table associated with the model.
	*
	* @var string
	*/
	protected $table = 'languages';

	/**
	* The attributes that should be hidden from arrays.
	*
	* @var array
	*/
	protected $hidden = [];

	/**
	* The default attributes.
	*
	* @var array
	*/
	protected $attributes = [];

	/**
	* Carbon converted dates.
	*
	* @var array
	*/
	protected $dates = [];

	/**
	* Enable eloquent timestamps.
	*
	* @var boolean
	*/
	public $timestamps = true;

	/**
	* The attributes that are mass assignable.
	*
	* @var array
	*/
	protected $fillable = [
		'enabled',
		'sort_order',
		'created_at',
		'updated_at',
		'name',
		'code',
		'locale',
		'image_path',
	];
}
