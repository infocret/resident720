<?php

use App\Models\maillist;
use App\Repositories\maillistRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class maillistRepositoryTest extends TestCase
{
    use MakemaillistTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var maillistRepository
     */
    protected $maillistRepo;

    public function setUp()
    {
        parent::setUp();
        $this->maillistRepo = App::make(maillistRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatemaillist()
    {
        $maillist = $this->fakemaillistData();
        $createdmaillist = $this->maillistRepo->create($maillist);
        $createdmaillist = $createdmaillist->toArray();
        $this->assertArrayHasKey('id', $createdmaillist);
        $this->assertNotNull($createdmaillist['id'], 'Created maillist must have id specified');
        $this->assertNotNull(maillist::find($createdmaillist['id']), 'maillist with given id must be in DB');
        $this->assertModelData($maillist, $createdmaillist);
    }

    /**
     * @test read
     */
    public function testReadmaillist()
    {
        $maillist = $this->makemaillist();
        $dbmaillist = $this->maillistRepo->find($maillist->id);
        $dbmaillist = $dbmaillist->toArray();
        $this->assertModelData($maillist->toArray(), $dbmaillist);
    }

    /**
     * @test update
     */
    public function testUpdatemaillist()
    {
        $maillist = $this->makemaillist();
        $fakemaillist = $this->fakemaillistData();
        $updatedmaillist = $this->maillistRepo->update($fakemaillist, $maillist->id);
        $this->assertModelData($fakemaillist, $updatedmaillist->toArray());
        $dbmaillist = $this->maillistRepo->find($maillist->id);
        $this->assertModelData($fakemaillist, $dbmaillist->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletemaillist()
    {
        $maillist = $this->makemaillist();
        $resp = $this->maillistRepo->delete($maillist->id);
        $this->assertTrue($resp);
        $this->assertNull(maillist::find($maillist->id), 'maillist should not exist in DB');
    }
}
