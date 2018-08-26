<?php

use App\Occupation;

class OccupationTest extends TestCase
{
    /**
     * Test a request for te list of users
     *
     * @return void
     */
    public function testRequestForAllOccupations()
    {
        $this->json('GET', '/occupations')
            ->seeStatusCode(200);
    }
    /**
     * Test a user creation
     *
     * @return void
     */
    public function testOccupationCreation()
    {
        $this->json('POST', '/occupations', [
            'description' => 'Test' . uniqid(),
        ])
            ->seeStatusCode(201);
    }
    /**
     * Test a user update
     *
     * @return void
     */
    public function testUpdateOccupation()
    {
        $this->json('PUT', '/occupations/' . mt_rand(1, env('FAKER_CANT_OCCUPATIONS')), [
            'description' => 'TestChangedDescription' . uniqid(),
        ])
            ->seeStatusCode(200);
    }
    /**
     * Test a user deletion
     *
     * @return void
     */
    public function testDeleteOccupation()
    {
        $occupation = Occupation::doesntHave('members')->first();

        if($occupation){
            $this->json('DELETE', '/occupations/' . $occupation->id)
                ->seeStatusCode(200);
        }
    }
}
