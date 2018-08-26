<?php

class UserTest extends TestCase
{
    /**
     * Test a request for te list of users
     *
     * @return void
     */
    public function testRequestForAllUsers()
    {
        $this->json('GET', '/users')
            ->seeStatusCode(200);
    }
    /**
     * Test a user creation
     *
     * @return void
     */
    public function testUserCreation()
    {
        $this->json('POST', '/users/', [
            'name'     => 'Test',
            'surname'  => 'Test',
            'email'    => 'creation'. uniqid() .'@test.com',
            'password' => '123123123',
            'church_id' => 1,
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
        $this->json('PUT', '/users/' . mt_rand(1, env('FAKER_CANT_USERS')), [
            'name' => 'TestChangedName',
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
        $this->json('DELETE', '/users/' . mt_rand(1, env('FAKER_CANT_USERS')))
            ->seeStatusCode(200);
    }
}
