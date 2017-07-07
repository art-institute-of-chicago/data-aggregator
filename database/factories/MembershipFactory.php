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


$factory->define(App\Membership\Event::class, function (Faker\Generator $faker) {
    return array_merge(
        membershipIdsAndTitle($faker),
        [
            'start' => $faker->dateTimeThisYear,
            'end' => $faker->dateTimeThisYear,
            'type' => $faker->randomNumber(2),
            'on_sale' => $faker->dateTimeThisYear,
            'off_sale' => $faker->dateTimeThisYear,
            'resource' => $faker->randomNumber(2),
            'user_event_number' => $faker->randomNumber(3),
            'available' => $faker->randomDigit * 10,
            'total_capacity' => $faker->randomDigit * 10,
            'status' => $faker->randomDigit,
            'has_roster' => $faker->boolean,
            'rs_event_seat_map_id' => $faker->randomDigit,
            'private_event' => $faker->boolean,
            'has_holds' => $faker->boolean,
        ],
        membershipDates($faker)
    );
});

$factory->define(App\Membership\Member::class, function (Faker\Generator $faker) {
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

