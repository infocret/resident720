<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\anticiposapli;

class anticiposapliApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_anticiposapli()
    {
        $anticiposapli = factory(anticiposapli::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/anticiposaplis', $anticiposapli
        );

        $this->assertApiResponse($anticiposapli);
    }

    /**
     * @test
     */
    public function test_read_anticiposapli()
    {
        $anticiposapli = factory(anticiposapli::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/anticiposaplis/'.$anticiposapli->id
        );

        $this->assertApiResponse($anticiposapli->toArray());
    }

    /**
     * @test
     */
    public function test_update_anticiposapli()
    {
        $anticiposapli = factory(anticiposapli::class)->create();
        $editedanticiposapli = factory(anticiposapli::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/anticiposaplis/'.$anticiposapli->id,
            $editedanticiposapli
        );

        $this->assertApiResponse($editedanticiposapli);
    }

    /**
     * @test
     */
    public function test_delete_anticiposapli()
    {
        $anticiposapli = factory(anticiposapli::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/anticiposaplis/'.$anticiposapli->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/anticiposaplis/'.$anticiposapli->id
        );

        $this->response->assertStatus(404);
    }
}
