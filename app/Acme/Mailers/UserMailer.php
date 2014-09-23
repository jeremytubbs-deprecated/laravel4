<?php namespace Acme\Mailers;

use Acme\Users\User;

class UserMailer extends Mailer {

    /**
     * @param User $user
     */
    public function sendWelcomeMessageTo(User $user)
    {
        $subject = 'Welcome to ' . getenv('site.name') . '!';
        $view = 'emails.auth.registration';

        return $this->sendTo($user, $subject, $view);
    }

}

