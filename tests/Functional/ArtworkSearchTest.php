<?php

namespace Tests\Functional;

use Tests\TestCase;

class ArtworkSearchTest extends TestCase
{


    /**
     * @test
     * @dataProvider firstResultTests
     */
    public function it_returns_a_match_as_first_result($query, $expectedFirstId)
    {

        $response = file_get_contents(env('PRODUCTION_URL', 'http://localhost') .'/artworks/search?q=' .urlencode($query));

        $resource = json_decode($response)->data[0];
        $this->assertEquals($resource->id, $expectedFirstId);

    }

    /**
     * @test
     * @dataProvider topResultsTests
     */
    public function it_returns_expected_top_matches($query, $inTheTop, $expectToSee = [])
    {

        $response = file_get_contents(env('PRODUCTION_URL', 'http://localhost') .'/artworks/search?q=' .urlencode($query));

        $resources = array_slice(json_decode($response)->data, 0, $inTheTop);
        $ids = array_pluck($resources, 'id');
        $this->assertArrayContainsArray($expectToSee, $ids);

    }

    public function firstResultTests()

    {

        return [
            ['american gothic', 6565],
            ['nighthawks', 111628],
            ['the old guitarist', 28067],
            ['time transfixed', 34181],
            //['thorne rooms', 2222222],
            //['thorne', 222222],
            ['the assumption of the virgin', 87479],
            ['saint george killing dragon', 15468],
            ['the weaver', 151363],
            ['a sunday afternoon on the island of la grande jatte', 27992],
            ['bedroom of arles', 28560],
            ['hydra', 20579],
            //['napoleon', 22222222],
            ['the childs bath', 111442],
        ];

    }

    public function topResultsTests()
    {

        return [
            ['van gogh',         3, [28560, 80607]],
            ['vincent van gogh', 3, [28560, 80607]],
            ['vangogh',          3, [28560, 80607]],
            ['monet',            6, [64818, 16568, 16571]],
            ['claude monet',     6, [64818, 16568, 16571]],
            ['picasso',          4, [28067, 5357]],
            ['pablo picasso',    4, [28067, 5357]],
            ['seurat',           1, [27992]],
            ['georges seurat',   1, [27992]],
            ['renoir',           4, [14655, 81558]],
            ['degas',            4, [14574, 14572]],
            ['edgar degas',      4, [14574, 14572]],
            ['hopper',           1, [111628]],
            ['edward hopper',    1, [111628]],
            ['chagall',          4, [109439]],
            ['dali',             4, [185184, 151424]],
            ['salvador dali',    4, [185184, 151424]],
            ['warhol',          10, [229406, 229357, 229358, 229359, 229360, 229355, 230609, 229361]],
            ['andy warhol',     10, [229406, 229357, 229358, 229359, 229360, 229355, 230609, 229361]],
            ['rembrandt',        1, [95998]],
            ['magritte',         6, [34181, 118718, 73657, 110970]],
            ['matisse',          6, [79307, 27984, 87045, 2816]],
        ];

    }

    protected function assertArrayContainsArray($needle, $haystack)
    {

        foreach ($needle as $val) {
            $this->assertContains($val, $haystack);
        }

    }
}
