<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class relationshipPropertieApiTest extends TestCase
{
    use MakerelationshipPropertieTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreaterelationshipPropertie()
    {
        $relationshipPropertie = $this->fakerelationshipPropertieData();
        $this->json('POST', '/api/v1/relationshipProperties', $relationshipPropertie);

        $this->assertApiResponse($relationshipPropertie);
    }

    /**
     * @test
     */
    public function testReadrelationshipPropertie()
    {
        $relationshipPropertie = $this->makerelationshipPropertie();
        $this->json('GET', '/api/v1/relationshipProperties/'.$relationshipPropertie->id);

        $this->assertApiResponse($relationshipPropertie->toArray());
    }

    /**
     * @test
     */
    public function testUpdaterelationshipPropertie()
    {
        $relationshipPropertie = $this->makerelationshipPropertie();
        $editedrelationshipPropertie = $this->fakerelationshipPropertieData();

        $this->json('PUT', '/api/v1/relationshipProperties/'.$relationshipPropertie->id, $editedrelationshipPropertie);

        $this->assertApiResponse($editedrelationshipPropertie);
    }

    /**
     * @test
     */
    public function testDeleterelationshipPropertie()
    {
        $relationshipPropertie = $this->makerelationshipPropertie();
        $this->json('DELETE', '/api/v1/relationshipProperties/'.$relationshipPropertie->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/relationshipProperties/'.$relationshipPropertie->id);

        $this->assertResponseStatus(404);
    }
}
