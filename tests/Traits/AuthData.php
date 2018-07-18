<?php

namespace Tests\Traits;

use App\Models\User;
use Laravel\Passport\Passport;

trait AuthData
{
    public $authUser;

    public function prepareAuth()
    {
        $this->authUser = $authUser = factory(User::class)->create();

        Passport::actingAs(
            $authUser,
            ['create-servers']
        );
    }
}
