<?php

use App\Traits\TokenizableTest;
use App\Church;

class ChurchTest extends TestCase
{
    use TokenizableTest;
    /**
     * Test a request for te list of users
     *
     * @return void
     */
    public function testRequestForAllChurches()
    {
        $auth = $this->getAuthToken();

        $this->json('GET', '/api/churches', [], [
            'Authorization' => $auth['token'],
        ])
            ->seeStatusCode(200);
    }
    /**
     * Test a user creation
     *
     * @return void
     */
    public function testChurchCreation()
    {
        $auth = $this->getAuthToken();
     
        $this->json('POST', '/api/churches', [
            'name' => 'Test' . uniqid(),
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
    public function testUpdateChurch()
    {
        $auth = $this->getAuthToken();

        $this->json('PUT', '/api/churches/' . mt_rand(1, env('FAKER_CANT_CHURCHES')), [
            'name' => 'TestChangedName' . uniqid(),
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
    public function testDeleteChurch()
    {
        $auth = $this->getAuthToken();

        $church = Church::doesntHave('members')->first();

        if($church){
            $this->json('DELETE', '/api/churches/' . $church->id, [], [
                'Authorization' => $auth['token'],
            ])
                ->seeStatusCode(200);
        }
    }
}
