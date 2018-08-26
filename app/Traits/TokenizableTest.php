<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

/**
 * Trait Tokenizabletest
 *
 * @method   array getAuthToken()
 */

trait TokenizableTest
{
    /**
     * Do the request for authorzation token
     *
     * @return array
     */
    function getAuthToken(): array
    {
        $auth = $this->json('POST', '/api/auth/login', [
            'email'    => env('FAKE_ADMIN_USER'),
            'password' => env('FAKE_ADMIN_PASSWORD'),
        ])->seeStatusCode(200)->response->getContent();

        return json_decode($auth, true);
    }
}
