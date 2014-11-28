<?php namespace Acme\Users\Groups;

use Eloquent;

class Group extends Eloquent {

	/**
     * Which fields may be mass assigned?
     *
     * @var array
     */
	protected $fillable = ['name', 'description'];

	/**
     * A group can belong to many users
     */
	public function users()
    {
        return $this->belongsToMany('Acme\Users\User');
    }
}