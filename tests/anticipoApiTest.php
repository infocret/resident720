<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\anticipo;

class anticipoApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_anticipo()
    {
        $anticipo = factory(anticipo::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/anticipos', $anticipo
        );

        $this->assertApiResponse($anticipo);
    }

    /**
     * @test
     */
    public function test_read_anticipo()
    {
        $anticipo = factory(anticipo::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/anticipos/'.$anticipo->id
        );

        $this->assertApiResponse($anticipo->toArray());
    }

    /**
     * @test
     */
    public function test_update_anticipo()
    {
        $anticipo = factory(anticipo::class)->create();
        $editedanticipo = factory(anticipo::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/anticipos/'.$anticipo->id,
            $editedanticipo
        );

        $this->assertApiResponse($editedanticipo);
    }

    /**
     * @test
     */
    public function test_delete_anticipo()
    {
        $anticipo = factory(anticipo::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/anticipos/'.$anticipo->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/anticipos/'.$anticipo->id
        );

        $this->response->assertStatus(404);
    }
}
