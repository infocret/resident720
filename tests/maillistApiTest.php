<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class maillistApiTest extends TestCase
{
    use MakemaillistTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatemaillist()
    {
        $maillist = $this->fakemaillistData();
        $this->json('POST', '/api/v1/maillists', $maillist);

        $this->assertApiResponse($maillist);
    }

    /**
     * @test
     */
    public function testReadmaillist()
    {
        $maillist = $this->makemaillist();
        $this->json('GET', '/api/v1/maillists/'.$maillist->id);

        $this->assertApiResponse($maillist->toArray());
    }

    /**
     * @test
     */
    public function testUpdatemaillist()
    {
        $maillist = $this->makemaillist();
        $editedmaillist = $this->fakemaillistData();

        $this->json('PUT', '/api/v1/maillists/'.$maillist->id, $editedmaillist);

        $this->assertApiResponse($editedmaillist);
    }

    /**
     * @test
     */
    public function testDeletemaillist()
    {
        $maillist = $this->makemaillist();
        $this->json('DELETE', '/api/v1/maillists/'.$maillist->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/maillists/'.$maillist->id);

        $this->assertResponseStatus(404);
    }
}
