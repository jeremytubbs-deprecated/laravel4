<?php namespace Acme\Users\Profiles;

use Eloquent;

class Profile extends Eloquent {

	/**
     * Which fields may be mass assigned?
     *
     * @var array
     */
	protected $fillable = ['username', 'first_name', 'last_name'];

	/**
     * A group can belong to many users
     */
	public function users()
    {
        return $this->belongsToOne('Acme\Users\User');
    }
}