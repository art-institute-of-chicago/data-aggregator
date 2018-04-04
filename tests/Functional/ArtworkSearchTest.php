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
            ['the assumption of the virgin', 87479],
            ['saint george killing dragon', 15468],
            ['the weaver', 151363],
            ['a sunday afternoon on the island of la grande jatte', 27992],
            ['bedroom of arles', 28560],
            ['hydra', 20579],
            ['the childs bath', 111442],
            ['napoleon', 217536],
            ['creche', 217536],
            ['reclining woman', 153701],
            ['1942.51', 111628],
            ['1926.224', 27992],
            ['seurat', 27992],
            ['georges seurat', 27992],
            ['hopper', 111628],
            ['edward hopper', 111628],
            ['rodin', 11320],
            ['grant wood', 6565],
            ['pollock', 83642],
            ['jackson pollock', 83642],
            ['rothko', 100472],
            ['kandinsky', 8991],
        ];

    }

    public function topResultsTests()
    {

        return [
            ['van gogh',           3, [28560, 80607]],
            ['vincent van gogh',   3, [28560, 80607]],
            ['vangogh',            3, [28560, 80607]],
            ['monet',              6, [64818, 16568, 16571, 14598]],
            ['claude monet',       6, [64818, 16568, 16571, 14598]],
            ['picasso',           10, [28067, 5357, 18709, 66039, 109275, 111060, 135430]],
            ['pablo picasso',     10, [28067, 5357, 18709, 66039, 109275, 111060, 135430]],
            ['renoir',             4, [14655, 81558]],
            ['degas',              4, [14574, 14572, 61603]],
            ['edgar degas',        4, [14574, 14572, 61603]],
            ['gauguin',            4, [19339, 60812]],
            ['chagall',            4, [109439, 59426]],
            ['dali',               4, [185184, 151424]],
            ['salvador dali',      4, [185184, 151424]],
            ['warhol',            10, [229406, 229357, 229358, 229359, 229360, 229355, 230609, 229361, 47149]],
            ['andy warhol',       10, [229406, 229357, 229358, 229359, 229360, 229355, 230609, 229361, 47149]],
            ['rembrandt',          3, [95998, 90536]],
            ['magritte',           6, [34181, 118718, 73657, 110970]],
            ['matisse',            6, [79307, 27984, 87045, 2816, 7124]],
            ['okeefe',             6, [61428, 46327, 24687, 104031]],
            ['georgia okeeffee',   6, [61428, 46327, 24687, 104031]],
            ['georgia o\'keefe',   6, [61428, 46327, 24687, 104031]],
            ['frank lloyd wright', 4, [105203, 190558, 144272]],
            ['el greco',           4, [87479, 21907, 67362]],
            ['cezanne'  ,          6, [111436, 16487, 62371]],
            ['mary cassatt',       4, [111442, 26650]],
            ['manet',              5, [16499, 44892, 14591]],
            ['caillebotte',        4, [20684, 154121]],
            ['whistler',           3, [56905, 111164]],
            ['goya',               3, [111559, 16362]],
            ['winslow homer',      5, [25865, 16776, 44018]],
            ['david smith',        3, [22395, 79379]],
            ['thorne rooms',       3, [43714, 45385]],
            ['thorne',             3, [43714, 45385]],

            ['impressionism',     12, [14572, 14598, 14655, 15401, 16568, 20684, 27992, 64818, 69780, 111442]],
            ['impressionist',     12, [14572, 14598, 14655, 15401, 16568, 20684, 27992, 64818, 69780, 111442]],
            ['renaissance',       10, [15468, 16169, 16327, 84709, 59847, 95998, 80084, 87479, 16298]],
            ['paintings',         12, [2189, 2816, 4758, 5848, 7021, 8991, 20579, 6565, 20509]],
            ['photography',       10, [157160, 13720, 50148, 63234, 50157, 87163, 100089, 145681]],
            ['cubism',            12, [5357, 8624, 28067, 66039, 109275, 111060, 135430, 18709, ]],
            ['pop art',           10, [229406, 102234, 24836, 47149, 122054, 184362]],
            ['furniture',         12, [34116, 36161, 50330, 103347, 190558, 188845, 189289, 191197, 103943, 186047]],
            ['armor',              4, [112092, 199854]],
            ['still life',         6, [44892, 84709, 87045, 120154]],
            ['ceramic',            6, [25853, 51185, 65290, 91620]],
            ['charcoal',           5, [68823, 23684, 111810]],
        ];

    }

    protected function assertArrayContainsArray($needle, $haystack)
    {

        foreach ($needle as $val) {
            $this->assertContains($val, $haystack);
        }

    }
}
