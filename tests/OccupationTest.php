<?php

use App\Occupation;
use App\Traits\TokenizableTest;

class OccupationTest extends TestCase
{
    use TokenizableTest;
    /**
     * Test a request for te list of users
     *
     * @return void
     */
    public function testRequestForAllOccupations()
    {
        $auth = $this->getAuthToken();

        $this->json('GET', '/api/occupations', [], [
            'Authorization' => $auth['token'],
        ])
            ->seeStatusCode(200);
    }
    /**
     * Test a user creation
     *
     * @return void
     */
    public function testOccupationCreation()
    {
        $auth = $this->getAuthToken();

        $this->json('POST', '/api/occupations', [
            'description' => 'Test' . uniqid(),
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
    public function testUpdateOccupation()
    {
        $auth = $this->getAuthToken();

        $occupation = Occupation::orderByRaw("RAND()")->first();

        $this->json('PUT', '/api/occupations/' . $occupation->id, [
            'description' => 'TestChangedDescription' . uniqid(),
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
    public function testDeleteOccupation()
    {
        $auth = $this->getAuthToken();

        $occupation = Occupation::doesntHave('members')->first();

        if ($occupation) {
            $this->json('DELETE', '/api/occupations/' . $occupation->id, [], [
                'Authorization' => $auth['token'],
            ])
                ->seeStatusCode(200);
        }
    }
}
