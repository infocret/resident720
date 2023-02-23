<?php

use Faker\Factory as Faker;
use App\Models\relationshipPropertie;
use App\Repositories\relationshipPropertieRepository;

trait MakerelationshipPropertieTrait
{
    /**
     * Create fake instance of relationshipPropertie and save it in database
     *
     * @param array $relationshipPropertieFields
     * @return relationshipPropertie
     */
    public function makerelationshipPropertie($relationshipPropertieFields = [])
    {
        /** @var relationshipPropertieRepository $relationshipPropertieRepo */
        $relationshipPropertieRepo = App::make(relationshipPropertieRepository::class);
        $theme = $this->fakerelationshipPropertieData($relationshipPropertieFields);
        return $relationshipPropertieRepo->create($theme);
    }

    /**
     * Get fake instance of relationshipPropertie
     *
     * @param array $relationshipPropertieFields
     * @return relationshipPropertie
     */
    public function fakerelationshipPropertie($relationshipPropertieFields = [])
    {
        return new relationshipPropertie($this->fakerelationshipPropertieData($relationshipPropertieFields));
    }

    /**
     * Get fake data of relationshipPropertie
     *
     * @param array $postFields
     * @return array
     */
    public function fakerelationshipPropertieData($relationshipPropertieFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'parent_property' => $fake->randomDigitNotNull,
            'son_property' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $relationshipPropertieFields);
    }
}
