<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LetterApiTest extends TestCase
{
    use MakeLetterTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateLetter()
    {
        $letter = $this->fakeLetterData();
        $this->json('POST', '/api/v1/letters', $letter);

        $this->assertApiResponse($letter);
    }

    /**
     * @test
     */
    public function testReadLetter()
    {
        $letter = $this->makeLetter();
        $this->json('GET', '/api/v1/letters/'.$letter->id);

        $this->assertApiResponse($letter->toArray());
    }

    /**
     * @test
     */
    public function testUpdateLetter()
    {
        $letter = $this->makeLetter();
        $editedLetter = $this->fakeLetterData();

        $this->json('PUT', '/api/v1/letters/'.$letter->id, $editedLetter);

        $this->assertApiResponse($editedLetter);
    }

    /**
     * @test
     */
    public function testDeleteLetter()
    {
        $letter = $this->makeLetter();
        $this->json('DELETE', '/api/v1/letters/'.$letter->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/letters/'.$letter->id);

        $this->assertResponseStatus(404);
    }
}
