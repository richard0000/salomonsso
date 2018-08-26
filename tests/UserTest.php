<?php

use App\Traits\TokenizableTest;
use App\User;

class UserTest extends TestCase
{
    use TokenizableTest;

    /**
     * Test a request for te list of users
     *
     * @return void
     */
    public function testRequestForAllUsers()
    {
        $auth = $this->getAuthToken();

        $this->json('GET', '/users?filter[church_id_eq]=' . mt_rand(1, env('FAKER_CANT_CHURCHES')), [], [
            'Authorization' => $auth['token'],
        ])
            ->seeStatusCode(200);
    }
    /**
     * Test a user creation
     *
     * @return void
     */
    public function testUserCreation()
    {
        $auth = $this->getAuthToken();

        $this->json('POST', '/users/', [
            'name'      => 'Test',
            'surname'   => 'Test',
            'email'     => 'creation' . uniqid() . '@test.com',
            'password'  => '123123123',
            'church_id' => 1,
        ], [
            'Authorization' => $auth['token'],
        ])
            ->seeStatusCode(201);
    }
    /**
     * Test a user update
     *
     * @return void
     */
    public function testUpdateUserName()
    {
        $auth = $this->getAuthToken();

        $user = User::orderByRaw("RAND()")->first();

        $this->json('PUT', '/users/' . $user->id, [
            'name' => 'TestChangedName',
        ], [
            'Authorization' => $auth['token'],
        ])
            ->seeStatusCode(200);
    }

    /**
     * Test a user deletion
     *
     * @return void
     */
    public function testDeleteUser()
    {
        $auth = $this->getAuthToken();

        $user = User::orderByRaw("RAND()")->first();

        $this->json('DELETE', '/users/' . $user->id, [], [
            'Authorization' => $auth['token'],
        ])
            ->seeStatusCode(200);
    }
}
