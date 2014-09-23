<?php namespace Acme\FacebookRegister;

use Laracasts\Commander\CommandHandler;
use Acme\Users\UserRepository;
use Acme\Users\User;
use Laracasts\Commander\Events\DispatchableTrait;

class FacebookRegisterUserCommandHandler implements CommandHandler {

    use DispatchableTrait;

    /**
     * @var UserRepository
     */
    protected $repository;

    /**
     * @param UserRepository $repository
     */
    function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Handle the command
     *
     * @param $command
     * @return mixed
     */
    public function handle($command)
    {
        $user = User::createOrUpdateFacebookObject(
            $command->id, $command->email, $command->access_token
        );

        $this->repository->save($user);

        $this->dispatchEventsFor($user);

        return $user;
    }

}