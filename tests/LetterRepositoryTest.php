<?php

use App\Models\Letter;
use App\Repositories\LetterRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LetterRepositoryTest extends TestCase
{
    use MakeLetterTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var LetterRepository
     */
    protected $letterRepo;

    public function setUp()
    {
        parent::setUp();
        $this->letterRepo = App::make(LetterRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateLetter()
    {
        $letter = $this->fakeLetterData();
        $createdLetter = $this->letterRepo->create($letter);
        $createdLetter = $createdLetter->toArray();
        $this->assertArrayHasKey('id', $createdLetter);
        $this->assertNotNull($createdLetter['id'], 'Created Letter must have id specified');
        $this->assertNotNull(Letter::find($createdLetter['id']), 'Letter with given id must be in DB');
        $this->assertModelData($letter, $createdLetter);
    }

    /**
     * @test read
     */
    public function testReadLetter()
    {
        $letter = $this->makeLetter();
        $dbLetter = $this->letterRepo->find($letter->id);
        $dbLetter = $dbLetter->toArray();
        $this->assertModelData($letter->toArray(), $dbLetter);
    }

    /**
     * @test update
     */
    public function testUpdateLetter()
    {
        $letter = $this->makeLetter();
        $fakeLetter = $this->fakeLetterData();
        $updatedLetter = $this->letterRepo->update($fakeLetter, $letter->id);
        $this->assertModelData($fakeLetter, $updatedLetter->toArray());
        $dbLetter = $this->letterRepo->find($letter->id);
        $this->assertModelData($fakeLetter, $dbLetter->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteLetter()
    {
        $letter = $this->makeLetter();
        $resp = $this->letterRepo->delete($letter->id);
        $this->assertTrue($resp);
        $this->assertNull(Letter::find($letter->id), 'Letter should not exist in DB');
    }
}
