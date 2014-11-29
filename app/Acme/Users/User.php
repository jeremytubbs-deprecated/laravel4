<?php namespace Acme\Users;

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Acme\Registration\Events\UserHasRegistered;
use Laracasts\Commander\Events\EventGenerator;
use Eloquent, Hash;
use Laracasts\Presenter\PresentableTrait;
use SammyK\LaravelFacebookSdk\FacebookableTrait;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait, EventGenerator, PresentableTrait, FacebookableTrait, SoftDeletingTrait;

    protected $dates = ['deleted_at'];

    /**
     * Which fields may be mass assigned?
     *
     * @var array
     */
    protected $fillable = ['email', 'password'];

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

    /**
     * Path to the presenter for a user.
     *
     * @var string
     */
    protected $presenter = 'Acme\Users\UserPresenter';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token', 'access_token');

    /**
     * Passwords must always be hashed.
     *
     * @param $password
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }


    protected static $facebook_field_aliases = [
        'id' => 'facebook_user_id',
    ];

    /**
     * Register a new user
     *
     * @param $username
     * @param $email
     * @param $password
     * @return User
     */
    public static function register($email, $password)
    {
        $user = new static(compact('email', 'password'));

        $user->raise(new UserHasRegistered($user));

        return $user;
    }

    /**
     * Determine if the given user is the same
     * as the current one.
     *
     * @param  $user
     * @return bool
     */
    public function is($user)
    {
        if (is_null($user)) return false;

        return $this->id == $user->id;
    }

    /**
     * A user can belong to many groups
     */
    public function groups() {
        return $this->belongsToMany('Acme\Users\Groups\Group');
    }

    public function hasGroup($name) {
        foreach ($this->groups as $group) {
            if ($group->name == $name) return true;
        }
        return false;
    }

    public function assignGroup($group) {
        return $this->groups()->attach($group);
    }

    public function removeGroup($group) {
        return $this->groups()->detach($group);
    }
}
