<?php

namespace App\Livewire\Forms;

use App\Clients\MailerLite;
use Livewire\Attributes\Validate;
use Livewire\Form;

class MailerliteSignupForm extends Form
{
    #[Validate('required|email')]
    public $email;

    public function submit()
    {
        $this->validate();

        return MailerLite::addSubscriber($this->email);
    }
}