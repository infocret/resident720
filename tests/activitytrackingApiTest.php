<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class activitytrackingApiTest extends TestCase
{
    use MakeactivitytrackingTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateactivitytracking()
    {
        $activitytracking = $this->fakeactivitytrackingData();
        $this->json('POST', '/api/v1/activitytrackings', $activitytracking);

        $this->assertApiResponse($activitytracking);
    }

    /**
     * @test
     */
    public function testReadactivitytracking()
    {
        $activitytracking = $this->makeactivitytracking();
        $this->json('GET', '/api/v1/activitytrackings/'.$activitytracking->id);

        $this->assertApiResponse($activitytracking->toArray());
    }

    /**
     * @test
     */
    public function testUpdateactivitytracking()
    {
        $activitytracking = $this->makeactivitytracking();
        $editedactivitytracking = $this->fakeactivitytrackingData();

        $this->json('PUT', '/api/v1/activitytrackings/'.$activitytracking->id, $editedactivitytracking);

        $this->assertApiResponse($editedactivitytracking);
    }

    /**
     * @test
     */
    public function testDeleteactivitytracking()
    {
        $activitytracking = $this->makeactivitytracking();
        $this->json('DELETE', '/api/v1/activitytrackings/'.$activitytracking->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/activitytrackings/'.$activitytracking->id);

        $this->assertResponseStatus(404);
    }
}
