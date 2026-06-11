<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Spbu;
use App\Models\WorshipPlace;

class ImportOsmFeaturesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $geojson = '{
  "type": "FeatureCollection",
  "generator": "overpass-turbo",
  "copyright": "The data included in this document is from www.openstreetmap.org. The data is made available under ODbL.",
  "timestamp": "2026-06-11T13:09:57Z",
  "features": [
    {
      "type": "Feature",
      "properties": {
        "@id": "node/1957951783",
        "addr:city": "Pontianak",
        "addr:postcode": "78116",
        "addr:street": "Jl Sultan Syahrir Abdurahman",
        "amenity": "place_of_worship",
        "denomination": "catholic",
        "name": "Gereja Khatolik Keluarga Kudus Kota Baru",
        "religion": "christian",
        "source": "IJ-REDD Project"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3243541,
          -0.0432068
        ]
      },
      "id": "node/1957951783"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "node/1957951785",
        "amenity": "place_of_worship",
        "name": "HKBP",
        "religion": "christian"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3196548,
          -0.0477558
        ]
      },
      "id": "node/1957951785"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "node/1971167550",
        "amenity": "fuel",
        "brand": "PERTAMINA",
        "name": "SPBU OSO MT. Haryono",
        "operator": "PERTAMINA PASTI PAS"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3367485,
          -0.0448924
        ]
      },
      "id": "node/1971167550"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "node/1971167551",
        "amenity": "fuel",
        "brand": "PERTAMINA",
        "name": "SPBU KOTA BARU",
        "operator": "PERTAMINA PASTI PAS"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3186866,
          -0.0478284
        ]
      },
      "id": "node/1971167551"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "node/1971929456",
        "amenity": "place_of_worship",
        "religion": "buddhist"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.336168,
          -0.0323289
        ]
      },
      "id": "node/1971929456"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "node/1977410536",
        "amenity": "fuel",
        "brand": "PERTAMINA",
        "name": "SPBU TANJUNG PURA",
        "operator": "PERTAMINA PASTI PAS"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3452066,
          -0.0314747
        ]
      },
      "id": "node/1977410536"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "node/1977415165",
        "amenity": "place_of_worship",
        "name": "GPIB Siloam",
        "religion": "christian"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3373746,
          -0.025091
        ]
      },
      "id": "node/1977415165"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "node/1977416890",
        "amenity": "fuel"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3319082,
          -0.0343768
        ]
      },
      "id": "node/1977416890"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "node/1977711783",
        "amenity": "place_of_worship",
        "building": "mosque",
        "name": "Masjid Al Jihad",
        "religion": "muslim"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3609632,
          -0.0813745
        ]
      },
      "id": "node/1977711783"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "node/2496878733",
        "amenity": "fuel",
        "name": "SPBU KODAM"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3716688,
          -0.0736918
        ]
      },
      "id": "node/2496878733"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "node/2874022670",
        "addr:city": "Pontianak",
        "addr:street": "Jalan Imam Bonjol",
        "amenity": "place_of_worship",
        "building": "mosque",
        "denomination": "sunni",
        "name": "Masjid Besar Islamiyah",
        "religion": "muslim"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.356293,
          -0.0483951
        ]
      },
      "id": "node/2874022670"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "node/2884978143",
        "amenity": "place_of_worship",
        "building": "mosque",
        "religion": "muslim"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3481215,
          -0.0189265
        ]
      },
      "id": "node/2884978143"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "node/2922939454",
        "amenity": "place_of_worship",
        "building": "mosque",
        "name": "Masjid Polresta Pontianak",
        "religion": "muslim"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3302326,
          -0.0399129
        ]
      },
      "id": "node/2922939454"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "node/2922939455",
        "amenity": "place_of_worship",
        "name": "Masjid SMAN 1 Pontianak",
        "religion": "muslim"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.329329,
          -0.0424584
        ]
      },
      "id": "node/2922939455"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "node/2923017065",
        "amenity": "place_of_worship",
        "building": "mosque",
        "name": "Masjid Polnep",
        "religion": "muslim"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3473012,
          -0.0546157
        ]
      },
      "id": "node/2923017065"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "node/3699512792",
        "amenity": "fuel"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.415396,
          -0.0381368
        ]
      },
      "id": "node/3699512792"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "node/4969463733",
        "amenity": "place_of_worship",
        "name": "Vihara Kon Djim Thong",
        "religion": "buddhist"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3477945,
          -0.018277
        ]
      },
      "id": "node/4969463733"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "node/4969463734",
        "amenity": "place_of_worship",
        "name": "Vihara Tri Ratna",
        "religion": "buddhist"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3368241,
          -0.0318153
        ]
      },
      "id": "node/4969463734"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "node/4969481193",
        "amenity": "place_of_worship",
        "name": "Vihara Paticca Samuppada",
        "religion": "buddhist"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3365611,
          -0.0322582
        ]
      },
      "id": "node/4969481193"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "node/5336008476",
        "amenity": "place_of_worship",
        "denomination": "catholic",
        "name": "Gereja Katholik St. Agustinus",
        "religion": "christian"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3910353,
          -0.0894542
        ]
      },
      "id": "node/5336008476"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "node/5503692257",
        "amenity": "place_of_worship",
        "religion": "muslim"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3271144,
          -0.0439775
        ]
      },
      "id": "node/5503692257"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "node/5503693394",
        "amenity": "place_of_worship",
        "religion": "muslim"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3265806,
          -0.0461219
        ]
      },
      "id": "node/5503693394"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "node/5503698692",
        "amenity": "place_of_worship",
        "religion": "muslim"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3258631,
          -0.0495914
        ]
      },
      "id": "node/5503698692"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "node/5503699132",
        "amenity": "place_of_worship",
        "religion": "muslim"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.326008,
          -0.0515588
        ]
      },
      "id": "node/5503699132"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "node/7057476686",
        "amenity": "place_of_worship",
        "name": "Vihara Bodhisatva Karaniya Metta",
        "name:id": "Vihara Bodhisatva Karaniya Metta"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3421483,
          -0.023471
        ]
      },
      "id": "node/7057476686"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "node/8474843594",
        "amenity": "place_of_worship",
        "name": "GBI Borneo Blessing Pontianak",
        "religion": "christian"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3797954,
          -0.0800541
        ]
      },
      "id": "node/8474843594"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "node/8540209882",
        "amenity": "place_of_worship",
        "name": "Vihara Chien Te",
        "religion": "buddhist"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3693835,
          -0.0736156
        ]
      },
      "id": "node/8540209882"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "node/8594390180",
        "amenity": "fuel",
        "brand": "Pertamina",
        "name": "SPBU Pertamina Imam Bonjol"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3545461,
          -0.0469624
        ]
      },
      "id": "node/8594390180"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "node/10749792487",
        "amenity": "place_of_worship",
        "name": "Masjid Jami\' Sirojul Mu\'minin",
        "religion": "muslim"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.4076912,
          -0.0183864
        ]
      },
      "id": "node/10749792487"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "node/12385753860",
        "amenity": "place_of_worship",
        "name": "MASJID NURUL HAMID",
        "religion": "muslim"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.2960145,
          -0.0082259
        ]
      },
      "id": "node/12385753860"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "node/12850627135",
        "amenity": "place_of_worship",
        "name": "Gereja Katolik Gembala Baik",
        "religion": "christian"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3450803,
          -0.0280743
        ]
      },
      "id": "node/12850627135"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "node/12850627186",
        "amenity": "place_of_worship",
        "name": "Masjid Nurul Haq Kejaksaan Tingi Kalbar",
        "religion": "muslim"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3447199,
          -0.0476359
        ]
      },
      "id": "node/12850627186"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "node/12852678529",
        "amenity": "place_of_worship",
        "name": "Mushola Ulul Albab SMA 3",
        "religion": "muslim"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3396152,
          -0.0362314
        ]
      },
      "id": "node/12852678529"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "node/12898376373",
        "amenity": "place_of_worship",
        "name": "Surau Al Ikhwan",
        "religion": "muslim"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.357399,
          -0.0740791
        ]
      },
      "id": "node/12898376373"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "node/13139699845",
        "amenity": "place_of_worship",
        "denomination": "sunni",
        "name": "Masjid Kayu As-Syukur",
        "religion": "muslim"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.382155,
          -0.0558545
        ]
      },
      "id": "node/13139699845"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "node/13141995818",
        "amenity": "place_of_worship",
        "name": "Masjid Al-Falah",
        "religion": "muslim"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3660112,
          -0.0485858
        ]
      },
      "id": "node/13141995818"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "node/13185308212",
        "amenity": "place_of_worship",
        "name": "Masjid Al-Ikhlas",
        "religion": "muslim"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3816577,
          -0.0533751
        ]
      },
      "id": "node/13185308212"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "node/13251222439",
        "amenity": "place_of_worship",
        "name": "Masjid Baitussalam",
        "religion": "muslim"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3646788,
          -0.0477026
        ]
      },
      "id": "node/13251222439"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "node/13251222440",
        "amenity": "place_of_worship",
        "name": "Masjid Al-Huda",
        "religion": "muslim"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3630298,
          -0.0455791
        ]
      },
      "id": "node/13251222440"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "node/13394373014",
        "alt_name": "Phak Jie Than",
        "alt_name:en": "Phak Jie Than",
        "alt_name:id": "Phak Jie Than",
        "alt_name:ms": "Phak Jie Than",
        "alt_name:zh": "白衣壇",
        "alt_name:zh-Hans": "白衣壇",
        "alt_name:zh-Hant": "白衣壇",
        "amenity": "place_of_worship",
        "name": "Sam Thai Ci",
        "name:en": "Sam Thai Ci",
        "name:id": "Sam Thai Ci",
        "name:ms": "Sam Thai Ci",
        "name:zh": "三太子",
        "name:zh-Hans": "三太子",
        "name:zh-Hant": "三太子",
        "religion": "taoist"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.4142919,
          -0.0772342
        ]
      },
      "id": "node/13394373014"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "node/13619099666",
        "amenity": "place_of_worship",
        "level": "0",
        "name": "Masjid Hudarrahman",
        "religion": "muslim"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3787116,
          -0.0606506
        ]
      },
      "id": "node/13619099666"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "node/13776518991",
        "amenity": "place_of_worship",
        "denomination": "christian"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3399253,
          -0.0323786
        ]
      },
      "id": "node/13776518991"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "node/13784435101",
        "addr:postcode": "78117",
        "addr:street": "Jalan Mat Sainin",
        "amenity": "place_of_worship",
        "check_date": "2026-05-01",
        "name": "Masjid Al-Amin",
        "religion": "muslim"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3038021,
          -0.0070019
        ]
      },
      "id": "node/13784435101"
    }
  ]
}';

        $data = json_decode($geojson, true);

        if (!isset($data['features'])) {
            $this->command->error("Invalid GeoJSON data structure.");
            return;
        }

        $spbuCount = 0;
        $worshipCount = 0;

        foreach ($data['features'] as $feature) {
            $properties = $feature['properties'] ?? [];
            $geometry = $feature['geometry'] ?? [];
            
            if (($geometry['type'] ?? '') !== 'Point' || !isset($geometry['coordinates'])) {
                continue;
            }

            $lng = $geometry['coordinates'][0];
            $lat = $geometry['coordinates'][1];
            $amenity = $properties['amenity'] ?? '';

            if ($amenity === 'fuel') {
                // Check if already exists in DB
                if (Spbu::where('latitude', $lat)->where('longitude', $lng)->exists()) {
                    continue;
                }

                $name = $properties['name'] ?? $properties['operator'] ?? $properties['brand'] ?? 'SPBU';
                
                $descParts = [];
                if (isset($properties['brand'])) {
                    $descParts[] = "Brand: " . $properties['brand'];
                }
                if (isset($properties['operator'])) {
                    $descParts[] = "Operator: " . $properties['operator'];
                }
                if (isset($properties['addr:street'])) {
                    $descParts[] = "Alamat: " . $properties['addr:street'];
                }
                $description = implode(', ', $descParts) ?: 'SPBU dari OpenStreetMap';

                Spbu::create([
                    'name' => $name,
                    'description' => $description,
                    'latitude' => $lat,
                    'longitude' => $lng,
                    'is_24_hours' => false,
                ]);
                $spbuCount++;

            } elseif ($amenity === 'place_of_worship') {
                // Check if already exists in DB
                if (WorshipPlace::where('latitude', $lat)->where('longitude', $lng)->exists()) {
                    continue;
                }

                $religion = strtolower($properties['religion'] ?? '');
                $building = strtolower($properties['building'] ?? '');
                $name = $properties['name'] ?? '';

                // Detect type: 'Masjid', 'Gereja', 'Pura', 'Vihara', 'Kelenteng', 'Lainnya'
                $type = 'Lainnya';
                if ($religion === 'muslim' || $building === 'mosque' || stripos($name, 'Masjid') !== false || stripos($name, 'Surau') !== false || stripos($name, 'Mushola') !== false) {
                    $type = 'Masjid';
                } elseif ($religion === 'christian' || strtolower($properties['denomination'] ?? '') === 'catholic' || stripos($name, 'Gereja') !== false || stripos($name, 'HKBP') !== false || stripos($name, 'GPIB') !== false || stripos($name, 'GBI') !== false) {
                    $type = 'Gereja';
                } elseif ($religion === 'taoist' || stripos($name, 'Kelenteng') !== false || stripos($name, 'Klenteng') !== false || stripos($name, 'Sam Thai') !== false || stripos($name, 'Phak Jie') !== false) {
                    $type = 'Kelenteng';
                } elseif ($religion === 'buddhist' || stripos($name, 'Vihara') !== false || stripos($name, 'Kon Djim') !== false || stripos($name, 'Tri Ratna') !== false || stripos($name, 'Paticca') !== false || stripos($name, 'Chien Te') !== false) {
                    $type = 'Vihara';
                } elseif ($religion === 'hindu' || stripos($name, 'Pura') !== false) {
                    $type = 'Pura';
                }

                if (empty($name)) {
                    $name = $type . ' (Tanpa Nama)';
                }

                $descParts = [];
                if (isset($properties['religion'])) {
                    $descParts[] = "Agama: " . ucfirst($properties['religion']);
                }
                if (isset($properties['denomination'])) {
                    $descParts[] = "Denominasi: " . ucfirst($properties['denomination']);
                }
                if (isset($properties['addr:street'])) {
                    $descParts[] = "Alamat: " . $properties['addr:street'];
                }
                $description = implode(', ', $descParts) ?: 'Tempat ibadah dari OpenStreetMap';

                WorshipPlace::create([
                    'name' => $name,
                    'type' => $type,
                    'description' => $description,
                    'latitude' => $lat,
                    'longitude' => $lng,
                    'radius' => 500.0,
                ]);
                $worshipCount++;
            }
        }

        $this->command->info("Successfully imported: {$spbuCount} SPBU locations and {$worshipCount} Worship Places.");
    }
}
