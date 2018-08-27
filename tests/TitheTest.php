<?php

use App\Tithe;
use App\Traits\TokenizableTest;
use App\User;

class TitheTest extends TestCase
{
    use TokenizableTest;
    /**
     * Test a request for the list of tithes
     *
     * @return void
     */
    public function testRequestForAllTithes()
    {
        $auth = $this->getAuthToken();

        $this->json('GET', '/api/tithes', [], [
            'Authorization' => $auth['token'],
        ])
            ->seeStatusCode(200);
    }
    /**
     * Test a request for the list of tithes of only one user
     *
     * @return void
     */
    public function testRequestForAllTithesOfOneUser()
    {
        $auth = $this->getAuthToken();

        $user = User::has('tithes')->first();

        if ($user) {
            $this->json('GET', '/api/user/' . $user->id . '/tithes', [], [
                'Authorization' => $auth['token'],
            ])
                ->seeStatusCode(200);
        }

    }
    /**
     * Test a tithe creation
     *
     * @return void
     */
    public function testTitheCreation()
    {
        $auth = $this->getAuthToken();

        $user = User::orderByRaw("RAND()")->first();

        $this->json('POST', '/api/tithes', [
            'amount'  => rand(10000, 99999),
            'date'    => date('d-m-Y'),
            'user_id' => $user->id,
        ], [
            'Authorization' => $auth['token'],
        ])
            ->seeStatusCode(201);
    }
    /**
     * Test a tithe update
     *
     * @return void
     */
    public function testUpdateTithe()
    {
        $auth = $this->getAuthToken();

        $tithe = Tithe::orderByRaw("RAND()")->first();

        $this->json('PUT', '/api/tithes/' . $tithe->id, [
            'amount'  => rand(10000, 99999),
        ], [
            'Authorization' => $auth['token'],
        ])
            ->seeStatusCode(200);
    }
    /**
     * Test a tithe deletion
     *
     * @return void
     */
    public function testDeleteTithe()
    {
        $auth = $this->getAuthToken();

        $tithe = Tithe::orderByRaw("RAND()")->first();

        if ($tithe) {
            $this->json('DELETE', '/api/tithes/' . $tithe->id, [], [
                'Authorization' => $auth['token'],
            ])
                ->seeStatusCode(200);
        }
    }
}
