<?php

use Faker\Factory as Faker;
use App\Models\Letter;
use App\Repositories\LetterRepository;

trait MakeLetterTrait
{
    /**
     * Create fake instance of Letter and save it in database
     *
     * @param array $letterFields
     * @return Letter
     */
    public function makeLetter($letterFields = [])
    {
        /** @var LetterRepository $letterRepo */
        $letterRepo = App::make(LetterRepository::class);
        $theme = $this->fakeLetterData($letterFields);
        return $letterRepo->create($theme);
    }

    /**
     * Get fake instance of Letter
     *
     * @param array $letterFields
     * @return Letter
     */
    public function fakeLetter($letterFields = [])
    {
        return new Letter($this->fakeLetterData($letterFields));
    }

    /**
     * Get fake data of Letter
     *
     * @param array $postFields
     * @return array
     */
    public function fakeLetterData($letterFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'user_id' => $fake->randomDigitNotNull,
            'type' => $fake->word,
            'read_at' => $fake->word,
            'title' => $fake->word,
            'details' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $letterFields);
    }
}
