<?php

namespace Tests\Unit;

use App\Library\DimensionParser;

use PHPUnit\Framework\TestCase as BaseTestCase;

class DimensionParserTest extends BaseTestCase
{

    /** @test */
    public function it_parses_dimension_properly()
    {
        // Two dimensional works
        $this->assertEquals([472,345,null], DimensionParser::parse('472 x 345 mm'));
        $this->assertEquals([240,183,null], DimensionParser::parse('Approx. 24 x 18.3 cm'));
        $this->assertEquals([291,201,null], DimensionParser::parse('291 x 201 mm (plate trimmed)'));
        $this->assertEquals([1842,1489,null], DimensionParser::parse('184.2 x 148.9 cm (72 1/2 x 58 1/2 in.)'));
        $this->assertEquals([420,1317,null], DimensionParser::parse('42 × 131.7 cm (16 3/4 × 51 7/8 in.)'));
        $this->assertEquals([479,606,null], DimensionParser::parse('47.9 × 60.6 cm (18 7/8 × 23 7/8 in.)'));
        $this->assertEquals([305,254,null], DimensionParser::parse('30.5 × 25.4 cm (12 × 10 in.)'));
        $this->assertEquals([730,921,null], DimensionParser::parse('28 3/4 × 36 1/4 in. (73 × 92.1 cm)'));
        $this->assertEquals([486,393,null], DimensionParser::parse('48.6 x 39.3 cm (image/paper/mount)'));

        // Three-dimensional works
        $this->assertEquals([1305,432,310], DimensionParser::parse('130.5 × 43.2 × 31 cm (51 1/3 × 17 × 12 1/5 in.)'));
        $this->assertEquals([1397,610,660], DimensionParser::parse('139.7 × 61 × 66 cm (55 × 24 × 26 in.)'));
        $this->assertEquals([156,104,54], DimensionParser::parse('15.6 × 10.4 × 5.4 cm (6 1/8 × 4 1/8 × 2 1/8 in.)'));
        $this->assertEquals([1505,1210,390], DimensionParser::parse('150.5 × 121 × 39 cm (59 1/16 × 47 5/8 × 15 3/8 in.)'));
        $this->assertEquals([355,533,609], DimensionParser::parse('Interior: 14 × 21 × 24 in.\nScale: 1 inch = 1 foot'));
        $this->assertEquals([35,60,3], DimensionParser::parse('3.5 × 6 × .3 cm (1 3/8 × 2 3/8 × 1/8 in.)'));

        // Complicated dimesions
        $this->assertEquals([452,661,null], DimensionParser::parse('452 x 661 mm (image); 461 x 669 mm (plate); 498 x 729 mm (sheet)'));
        $this->assertEquals([875,693,null], DimensionParser::parse('87.5 × 69.3 cm (34 7/16 × 27 1/4 in.)\nPredella: 26.5 × 69.2 cm'));
        $this->assertEquals([339,255,null], DimensionParser::parse('33.9 x 25.5 cm (image/paper); 44 x 35.2 cm (mount)'));

        // Some 3D works, like armor and teapots, only have the height or width entered
        $this->assertEquals([56,109,null], DimensionParser::parse('H. 5.6 cm (2 3/16 in.); diam. 10.9 cm (4 15/16 in.)'));
        $this->assertEquals([1270,null,null], DimensionParser::parse('H. 127 cm (50 in.)'));
        $this->assertEquals([145,null,null], DimensionParser::parse('H. 14.5 cm (5 11/16 in.)'));
        $this->assertEquals([7,20,null], DimensionParser::parse('W. 0.75 cm (1/4 in.); diam. 2 cm (3/4 in.)'));
        $this->assertEquals([60,19,null], DimensionParser::parse('H. 6 cm (2 3/8 in.); diam. 1.9 cm (3/4 in.)'));
        $this->assertEquals([0,0,null], DimensionParser::parse('Dimensions vary with installation'));
    }
}
