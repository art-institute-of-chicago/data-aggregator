<?php

namespace App\Transformers\Inbound\Shop;

use App\Transformers\Datum;
use App\Transformers\Inbound\ShopTransformer;

class Product extends ShopTransformer
{

    protected function getSync(Datum $datum)
    {

        return [
            'artists' => $this->getSyncArtists( $datum ),
        ];

    }

    private function getSyncArtists(Datum $datum)
    {

        if( !$datum->artist_ids )
        {
            return [];
        }

        return array_filter( array_map( function ($id) {

            return $this->artistMapping[$id] ?? null;

        }, $datum->artist_ids ) );

    }

    private $artistMapping = [
        2 => 35809,
        3 => 40610,
        5 => 32803,
        6 => 34155,
        7 => 37362,
        8 => 33909,
        9 => 33890,
        10 => 40810,
        11 => 34996,
        12 => null, // klimt
        13 => 110607,
        14 => 15965,
        15 => 3829,
        16 => 36351,
        17 => 20772,
        18 => 35188,
        19 => 31492,
        20 => 11782,
        21 => 21775,
        22 => 36809,
        23 => 33354,
        24 => 36198,
        25 => 36062,
        26 => 28190,
        27 => 44014,
        28 => 15877,
        29 => 42445,
        30 => 35834,
        31 => 36211,
        32 => 35801,
        33 => null, // paul paul?
        34 => 35670,
        35 => 37343,
        36 => 34323,
        37 => 35237,
        38 => null, // dankmar adler
        39 => 27615,
        40 => 36788,
        41 => 36978,
        42 => 34042,
        43 => null, // ando hiroshige
        44 => 15033,
        45 => null, // linnea riley
        46 => 33554,
        47 => 33370,
        48 => 34710,
        49 => 35964,
        50 => 11482,
        51 => 36653,
        52 => null, // allen williean seaby
        53 => 21889,
        54 => null, // ted naos
        55 => 11402,
        56 => 36336,
        57 => 27657,
        58 => 35565,
        59 => 41345,
        60 => 17526,
        61 => 35252,
        62 => 34946,
        63 => 32048,
        64 => 34123,
        65 => 34742,
        66 => 35282,
        67 => 12347,
        68 => 44014,
        69 => 35325,
        70 => 35220,
        71 => 10052,
        72 => 37293,
        73 => 36945,
        74 => 40500,
        75 => 35777,
        76 => 33838,
        77 => 41119,
        78 => 31435,
        79 => 34611,
        80 => 14911,
        81 => 35358,
        82 => 36197,
        83 => 33739,
        84 => 33672,
        85 => 37219,
        86 => 33735,
        87 => 40482,
        88 => 42434,
        89 => null, // johnathon green
        90 => 28036,
        91 => 34257,
        92 => 21570,
        93 => 40543,
        94 => 65199,
        95 => null, // chihuly
        96 => 62953,
        97 => 33376,
        98 => 37275,
        99 => 36169,
        100 => 64881,
        101 => 33550,
        102 => 34853,
        103 => 100085,
        104 => 35821,
        105 => 34898,
        106 => 57118,
        107 => 35577,
        108 => 33371,
        109 => 36467,
        110 => 40869,
        111 => 37279,
        112 => 40535,
        113 => 33841,
        114 => 46423,
        115 => 34049,
        116 => 33877,
        117 => 40769,
        118 => 47950,
        119 => 36695,
        120 => null, // henderson mackintosh
        121 => null, // katsuhiko mizuno
        122 => null, // michael michaud
        123 => null, // j.c. suares
        124 => null, // jill billington
        125 => null, // richard temple
        126 => null, // florence elizabeth marvin
        127 => null, // patricia breen
        128 => null, // anne koplik
        129 => null, // sher schier
        130 => null, // margaret axiotes
        131 => null, // jennifer holley
        132 => 87151,
        133 => null, // robert lerbron
        134 => null, // peter lipman-wulf
        135 => 40669,
        136 => 36254,
        137 => 101665,
        138 => 82537,
        139 => 4326,
        140 => null, // holly derosa
        141 => null, // rovana lee
        142 => null, // efrain ferrer
        143 => null, // danielle martin
        144 => null, // julius klinger
        145 => 97299,
        146 => 36786,
        147 => 36750,
        149 => 36247,
        150 => 34279,
        151 => 34267,
        152 => 35240,
        153 => null, // eugene samuel grasset
        154 => null, // douglas garofalo
        155 => 20727,
        156 => 25722,
        157 => null, // baccio della porta
        158 => null, // michael asher
        159 => 33692,
        160 => 34236,
        162 => 36478,
        163 => 36011,
        164 => null, // m.c. escher
        165 => 2748,
        166 => 103544,
        167 => 35928,
        168 => null, // paul pinson
        169 => 42264,
        170 => null, // hector giacomelli
        171 => 54500,
        173 => null, // and hood sakal
        174 => null, // kananginak pootoogook
        175 => 40770,
        176 => 35480,
        177 => 26388,
        178 => null, // linda pacel
        179 => 59979,
        180 => null, // lorenze ghiberti
        181 => 104036,
        182 => 35139,
        183 => 34988,
        184 => 33473,
        185 => null, // gene davis
        186 => 25999,
        187 => 36085,
        188 => 50097,
        189 => null, // charlse harper
        190 => 33483,
        191 => 17463,
        192 => 35235,
        193 => 36244,
        194 => 22940,
        195 => 42579,
        196 => null, // sean capone
        197 => 36349,
        198 => null, // harry siddons mowbray
        199 => null, // carolyn mullany
        200 => null, // jyotika purwar
        201 => null, // robert conley
        202 => 21974,
        203 => 34418,
        204 => 41361,
        205 => 35845,
        206 => 36445,
        207 => 35287,
        208 => 37052,
        209 => null, // julius shulman
        210 => 33885,
        211 => 40809,
        212 => null, // lippi-pesellino
        213 => null, // gabriele munter
        214 => null, // johanna riley kriesel
        215 => 35606,
        217 => 44021,
        218 => 100324,
        219 => 11421,
        220 => 1148,
        221 => null, // clemence bombled
        222 => 20238,
        224 => 86099,
        225 => null, // peter lipman-wulf
        226 => 33682,
        227 => 34161,
        228 => 44242,
        229 => 36180,
        230 => 22161,
        231 => 35482,
        232 => null, // katsukawa shunsho
        233 => 36540,
        234 => 33624,
        235 => 21296,
        236 => 27436,
        237 => 37156,
        238 => null, // erte
        239 => 60445,
        240 => null, // anna staritsky
        241 => 87087,
    ];

}
