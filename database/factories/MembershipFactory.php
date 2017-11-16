<?php

/*
|--------------------------------------------------------------------------
| Membership Factory
|--------------------------------------------------------------------------
|
| Create models with stub data for all data coming from the Membership
| Data Service.
|
*/

if (!function_exists('membershipIdsAndTitle'))
{
    function membershipIdsAndTitle($faker, $title = '')
    {

        return [
            'membership_id' => $faker->unique()->randomNumber(5) + 999 * pow(10, 5),
            'title' => $title ? $title : ucfirst($faker->words(3, true)),
        ];

    }

    function membershipDates($faker)
    {

        return [
            'source_created_at' => $faker->dateTimeThisYear,
            'source_modified_at' => $faker->dateTimeThisYear,
        ];

    }

}


$factory->define(App\Models\Membership\Event::class, function (Faker\Generator $faker) {

    $has_capacity = rand(0,1) == 1;

    return array_merge(
        membershipIdsAndTitle($faker),
        [
            'description' => $faker->paragraph(2),
            'short_description' => $faker->sentence(6),
            'image_url' => $faker->imageUrl,
            'type' => ucfirst($faker->words(3, true)),
            'start_at' => $faker->dateTimeThisYear,
            'end_at' => $faker->dateTimeThisYear,
            'resource_id' => $faker->randomNumber(2),
            'resource_title' => ucfirst($faker->words(3, true)),
            'is_after_hours' => $faker->boolean,
            'is_private_event' => $faker->boolean,
            'is_admission_required' => $faker->boolean,
            'available' => $has_capacity ? $faker->randomDigit * 10 : null,
            'total_capacity' => $has_capacity ? $faker->randomDigit * 100 : null,
            'is_ticketed' => $faker->boolean,
        ],
        membershipDates($faker)
    );

});
