<?php

use App\Church;

class ChurchTest extends TestCase
{
    /**
     * Test a request for te list of users
     *
     * @return void
     */
    public function testRequestForAllChurches()
    {
        $this->json('GET', '/churches')
            ->seeStatusCode(200);
    }
    /**
     * Test a user creation
     *
     * @return void
     */
    public function testChurchCreation()
    {
        $this->json('POST', '/churches', [
            'name' => 'Test' . uniqid(),
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
        $this->json('PUT', '/churches/' . mt_rand(1, env('FAKER_CANT_CHURCHES')), [
            'name' => 'TestChangedName' . uniqid(),
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
        $church = Church::doesntHave('members')->first();

        if($church){
            $this->json('DELETE', '/churches/' . $church->id)
                ->seeStatusCode(200);
        }
    }
}
