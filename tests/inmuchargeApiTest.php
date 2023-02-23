<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class inmuchargeApiTest extends TestCase
{
    use MakeinmuchargeTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateinmucharge()
    {
        $inmucharge = $this->fakeinmuchargeData();
        $this->json('POST', '/api/v1/inmucharges', $inmucharge);

        $this->assertApiResponse($inmucharge);
    }

    /**
     * @test
     */
    public function testReadinmucharge()
    {
        $inmucharge = $this->makeinmucharge();
        $this->json('GET', '/api/v1/inmucharges/'.$inmucharge->id);

        $this->assertApiResponse($inmucharge->toArray());
    }

    /**
     * @test
     */
    public function testUpdateinmucharge()
    {
        $inmucharge = $this->makeinmucharge();
        $editedinmucharge = $this->fakeinmuchargeData();

        $this->json('PUT', '/api/v1/inmucharges/'.$inmucharge->id, $editedinmucharge);

        $this->assertApiResponse($editedinmucharge);
    }

    /**
     * @test
     */
    public function testDeleteinmucharge()
    {
        $inmucharge = $this->makeinmucharge();
        $this->json('DELETE', '/api/v1/inmucharges/'.$inmucharge->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/inmucharges/'.$inmucharge->id);

        $this->assertResponseStatus(404);
    }
}
