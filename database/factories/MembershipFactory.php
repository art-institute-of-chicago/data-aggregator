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
            'membership_id' => $faker->unique()->randomNumber(5),
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
            'type_id' => $faker->randomNumber(2),
            'start_at' => $faker->dateTimeThisYear,
            'end_at' => $faker->dateTimeThisYear,
            'resource_id' => $faker->randomNumber(2),
            'resource_title' => ucfirst($faker->words(3, true)),
            'is_after_hours' => $faker->boolean,
            'is_private_event' => $faker->boolean,
            'is_admission_required' => $faker->boolean,
            'available' => $has_capacity ? $faker->randomDigit * 10 : null,
            'total_capacity' => $has_capacity ? $faker->randomDigit * 100 : null,
        ],
        membershipDates($faker)
    );
});

$factory->define(App\Models\Membership\Member::class, function (Faker\Generator $faker) {
    $first = $faker->firstName;
    $last = $faker->lastName;
    return array_merge(
        membershipIdsAndTitle($faker, $first .' ' .$last),
        [
            'first_name' => $first,
            'last_name' => $last,
            'street_1' => $faker->streetAddress,
            'street_2' => $faker->secondaryAddress,
            'city' => $faker->city,
            'state' => $faker->state,
            'zip' => $faker->postcode,
            'email' => $faker->safeEmail,
            'phone' => $faker->phoneNumber,
            'membership_level' => $faker->randomElement(['Premium Member', 'Member Plus', 'Lions Council', 'Sustaining Fellow', 'Student']),
            'opened_at' => $faker->dateTimeThisYear,
            'used_at' => $faker->dateTimeThisYear,
            'expires_at' => $faker->dateTimeThisYear,
        ]
    );
});

