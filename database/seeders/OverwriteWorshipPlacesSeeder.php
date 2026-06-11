<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WorshipPlace;

class OverwriteWorshipPlacesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Truncate/overwrite existing worship places
        WorshipPlace::truncate();

        $geojson = '{
  "type": "FeatureCollection",
  "generator": "overpass-turbo",
  "copyright": "The data included in this document is from www.openstreetmap.org. The data is made available under ODbL.",
  "timestamp": "2026-06-11T13:38:02Z",
  "features": [
    {
      "type": "Feature",
      "properties": {
        "@id": "way/174086520",
        "amenity": "place_of_worship",
        "building": "yes",
        "religion": "muslim",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3264478,
          -0.0187194
        ]
      },
      "id": "way/174086520"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/245930655",
        "amenity": "place_of_worship",
        "building": "yes",
        "religion": "muslim",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3347292,
          -0.0238372
        ]
      },
      "id": "way/245930655"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/245934423",
        "amenity": "place_of_worship",
        "building": "mosque",
        "religion": "muslim",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3176011,
          -0.0243604
        ]
      },
      "id": "way/245934423"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/288603057",
        "amenity": "place_of_worship",
        "building": "mosque",
        "name": "Al-Azhar",
        "religion": "muslim",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3514215,
          -0.0583388
        ]
      },
      "id": "way/288603057"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/288603093",
        "access:roof": "no",
        "amenity": "place_of_worship",
        "building": "retail",
        "building:levels": "1",
        "building:roof": "tin",
        "building:structure": "confined_masonry",
        "building:walls": "brick",
        "name": "Mushola Istiqomah",
        "religion": "muslim",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3461922,
          -0.0570667
        ]
      },
      "id": "way/288603093"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/288736268",
        "amenity": "place_of_worship",
        "building": "retail",
        "name": "Perdagangan",
        "religion": "muslim",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3544017,
          -0.062926
        ]
      },
      "id": "way/288736268"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/288738072",
        "amenity": "place_of_worship",
        "name": "Majid Muhammadiyah Pontianak",
        "religion": "muslim",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3518919,
          -0.0590754
        ]
      },
      "id": "way/288738072"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/288812623",
        "amenity": "place_of_worship",
        "building": "church",
        "name": "Gereja HKBP",
        "religion": "christian",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3532735,
          -0.0593754
        ]
      },
      "id": "way/288812623"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/288812624",
        "amenity": "place_of_worship",
        "building": "church",
        "name": "Gereja HKBP",
        "religion": "christian",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3534707,
          -0.0595047
        ]
      },
      "id": "way/288812624"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/288813674",
        "access:roof": "no",
        "addr:full": "Jalan Daya Nasional",
        "amenity": "place_of_worship",
        "building": "mosque",
        "building:levels": "1",
        "building:roof": "tile",
        "building:structure": "confined_masonry",
        "building:walls": "brick",
        "capacity": ">100",
        "name": "Masjid Al-Muhtaddin",
        "religion": "muslim",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3503476,
          -0.0532671
        ]
      },
      "id": "way/288813674"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/292680477",
        "amenity": "place_of_worship",
        "building": "mosque",
        "religion": "muslim",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3213978,
          -0.0203897
        ]
      },
      "id": "way/292680477"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/292693850",
        "amenity": "place_of_worship",
        "building": "mosque",
        "religion": "muslim",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3217284,
          -0.032022
        ]
      },
      "id": "way/292693850"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/292693858",
        "amenity": "place_of_worship",
        "building": "yes",
        "religion": "muslim",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3211987,
          -0.0331787
        ]
      },
      "id": "way/292693858"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/302012599",
        "access:roof": "no",
        "addr:full": "Jl Gajah Mada",
        "amenity": "place_of_worship",
        "building": "church",
        "building:condition": "good",
        "building:floor": "ceramics",
        "building:levels": "3",
        "building:roof": "concrete",
        "building:structure": "confined_masonry",
        "building:walls": "concrete",
        "capacity:persons": "250-500",
        "name": "GKKB Jemaat Pontianak",
        "religion": "christian",
        "source": "survey",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3438039,
          -0.0383871
        ]
      },
      "id": "way/302012599"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/324139755",
        "amenity": "place_of_worship",
        "building": "yes",
        "religion": "muslim",
        "source": "Bing",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.329122,
          -0.0243625
        ]
      },
      "id": "way/324139755"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/324169969",
        "amenity": "place_of_worship",
        "building": "mosque",
        "fixme": "name",
        "religion": "muslim",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3433282,
          -0.0410494
        ]
      },
      "id": "way/324169969"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/324179885",
        "amenity": "place_of_worship",
        "building": "yes",
        "name": "Masjid",
        "religion": "muslim",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3489143,
          -0.0350077
        ]
      },
      "id": "way/324179885"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/324179891",
        "amenity": "place_of_worship",
        "building": "yes",
        "religion": "muslim",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3478979,
          -0.0386897
        ]
      },
      "id": "way/324179891"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/324181370",
        "amenity": "place_of_worship",
        "building": "mosque",
        "religion": "muslim",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3163487,
          -0.0060347
        ]
      },
      "id": "way/324181370"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/324181727",
        "amenity": "place_of_worship",
        "religion": "muslim",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3006448,
          -0.0522072
        ]
      },
      "id": "way/324181727"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/324182609",
        "amenity": "place_of_worship",
        "building": "yes",
        "religion": "muslim",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3143321,
          -0.0227696
        ]
      },
      "id": "way/324182609"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/324182952",
        "amenity": "place_of_worship",
        "building": "yes",
        "religion": "muslim",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.325483,
          -0.035612
        ]
      },
      "id": "way/324182952"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/324183013",
        "amenity": "place_of_worship",
        "building": "yes",
        "religion": "muslim",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3263585,
          -0.037707
        ]
      },
      "id": "way/324183013"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/324183270",
        "amenity": "place_of_worship",
        "building": "yes",
        "religion": "muslim",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3296941,
          -0.0385826
        ]
      },
      "id": "way/324183270"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/324187148",
        "amenity": "place_of_worship",
        "building": "mosque",
        "name": "Masjid Al-Hadi",
        "religion": "muslim",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3125889,
          -0.0427771
        ]
      },
      "id": "way/324187148"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/342693949",
        "addr:street": "Jalan H.Rais A.Rachman",
        "amenity": "place_of_worship",
        "building": "yes",
        "name": "Masjid Baturrahim",
        "religion": "muslim",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.308647,
          -0.0233791
        ]
      },
      "id": "way/342693949"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/342693956",
        "amenity": "place_of_worship",
        "building": "yes",
        "religion": "muslim",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3109751,
          -0.0392247
        ]
      },
      "id": "way/342693956"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/342693963",
        "amenity": "place_of_worship",
        "religion": "muslim",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3142328,
          -0.0400467
        ]
      },
      "id": "way/342693963"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/343977791",
        "addr:street": "Jalan Tabrani Ahmad",
        "amenity": "place_of_worship",
        "building": "yes",
        "name": "Masjid Darul Muttaqien",
        "religion": "muslim",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3079139,
          -0.0187061
        ]
      },
      "id": "way/343977791"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/397015387",
        "addr:city": "Pontianak",
        "addr:street": "Jalan Dr Wahidin Sudirohusodo",
        "amenity": "place_of_worship",
        "building": "yes",
        "name": "Masjid Al Hikmah",
        "religion": "muslim",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3051884,
          -0.0295271
        ]
      },
      "id": "way/397015387"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/510953029",
        "air_conditioning": "yes",
        "amenity": "place_of_worship",
        "building": "church",
        "building:levels": "1",
        "denomination": "roman_catholic",
        "name": "Gereja St. Sesilia",
        "religion": "christian",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3597237,
          -0.0704366
        ]
      },
      "id": "way/510953029"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/519366167",
        "amenity": "place_of_worship",
        "building": "mosque",
        "name": "Ikhwanul Mukminin",
        "religion": "muslim",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3594523,
          -0.0722406
        ]
      },
      "id": "way/519366167"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/519366394",
        "amenity": "place_of_worship",
        "building": "yes",
        "name": "Majelis Agama Budha Tantrayana",
        "religion": "buddhist",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3648831,
          -0.0724079
        ]
      },
      "id": "way/519366394"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/519376158",
        "amenity": "place_of_worship",
        "building": "yes",
        "name": "Gereja Pemberita Injil (Gapembri) Sungai Raya",
        "religion": "christian",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3674242,
          -0.0749561
        ]
      },
      "id": "way/519376158"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/522134386",
        "amenity": "place_of_worship",
        "building": "mosque",
        "religion": "muslim",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3725774,
          -0.0031464
        ]
      },
      "id": "way/522134386"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/572364470",
        "amenity": "place_of_worship",
        "building": "yes",
        "name": "Klenteng Dewa Rejeki",
        "name:zh": "福德祠廟",
        "religion": "chinese_folk",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3452642,
          -0.0184737
        ]
      },
      "id": "way/572364470"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/572902485",
        "amenity": "place_of_worship",
        "building": "yes",
        "name": "GBI Sungai Yordan Jemaat Pontianak",
        "religion": "christian",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3339074,
          0.0007064
        ]
      },
      "id": "way/572902485"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/572958148",
        "amenity": "place_of_worship",
        "building": "yes",
        "religion": "muslim",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3560074,
          -0.0351647
        ]
      },
      "id": "way/572958148"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/572962203",
        "amenity": "place_of_worship",
        "building": "yes",
        "religion": "muslim",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3514687,
          -0.0350583
        ]
      },
      "id": "way/572962203"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/572962424",
        "amenity": "place_of_worship",
        "building": "yes",
        "religion": "muslim",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3506846,
          -0.0330379
        ]
      },
      "id": "way/572962424"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/572965514",
        "amenity": "place_of_worship",
        "building": "yes",
        "religion": "muslim",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3535361,
          -0.0347521
        ]
      },
      "id": "way/572965514"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/572968835",
        "amenity": "place_of_worship",
        "building": "yes",
        "religion": "muslim",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3520711,
          -0.0361452
        ]
      },
      "id": "way/572968835"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/572973031",
        "amenity": "place_of_worship",
        "building": "yes",
        "religion": "muslim",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3527091,
          -0.0332473
        ]
      },
      "id": "way/572973031"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/573036919",
        "amenity": "place_of_worship",
        "building": "yes",
        "name": "GBI Tahu Healing Movement",
        "religion": "christian",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3689649,
          -0.0328025
        ]
      },
      "id": "way/573036919"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/573077142",
        "amenity": "place_of_worship",
        "building": "yes",
        "name": "1",
        "religion": "muslim",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3574445,
          -0.0611428
        ]
      },
      "id": "way/573077142"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/573077267",
        "amenity": "place_of_worship",
        "building": "yes",
        "religion": "muslim",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3522305,
          -0.0579054
        ]
      },
      "id": "way/573077267"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/573084236",
        "amenity": "place_of_worship",
        "building": "yes",
        "religion": "muslim",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3602551,
          -0.0166075
        ]
      },
      "id": "way/573084236"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/573104208",
        "amenity": "place_of_worship",
        "building": "yes",
        "religion": "muslim",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3159375,
          -0.0295081
        ]
      },
      "id": "way/573104208"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/573124321",
        "amenity": "place_of_worship",
        "building": "mosque",
        "religion": "muslim",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3240523,
          -0.0112525
        ]
      },
      "id": "way/573124321"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/573165375",
        "amenity": "place_of_worship",
        "religion": "muslim",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3204617,
          -0.0132384
        ]
      },
      "id": "way/573165375"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/573209286",
        "addr:street": "Jalan Tanjung Raya 1",
        "amenity": "place_of_worship",
        "building": "yes",
        "name": "Masjid Jami\' Sulthan Syarif Abdurrahman",
        "religion": "muslim",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3476706,
          -0.0267693
        ]
      },
      "id": "way/573209286"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/573217550",
        "amenity": "place_of_worship",
        "building": "yes",
        "religion": "muslim",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.343558,
          -0.0610878
        ]
      },
      "id": "way/573217550"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/573217720",
        "access:roof": "no",
        "amenity": "place_of_worship",
        "building": "yes",
        "building:levels": "1",
        "building:roof": "tin",
        "building:structure": "confined_masonry",
        "building:walls": "brick",
        "name": "Mushola At-Tarbawi",
        "religion": "muslim",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.343329,
          -0.0599978
        ]
      },
      "id": "way/573217720"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/573241876",
        "amenity": "place_of_worship",
        "building": "yes",
        "religion": "muslim",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3572214,
          -0.0313574
        ]
      },
      "id": "way/573241876"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/573242983",
        "amenity": "place_of_worship",
        "building": "yes",
        "name": "Al-Badar",
        "religion": "muslim",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3501268,
          -0.0299796
        ]
      },
      "id": "way/573242983"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/573351857",
        "amenity": "place_of_worship",
        "building": "yes",
        "religion": "muslim",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3632322,
          -0.0416753
        ]
      },
      "id": "way/573351857"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/573354232",
        "amenity": "place_of_worship",
        "building": "yes",
        "religion": "muslim",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3614976,
          -0.0329554
        ]
      },
      "id": "way/573354232"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/573354645",
        "amenity": "place_of_worship",
        "building": "yes",
        "religion": "muslim",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3584922,
          -0.0428223
        ]
      },
      "id": "way/573354645"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/573375626",
        "amenity": "place_of_worship",
        "building": "yes",
        "religion": "muslim",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3569503,
          -0.0416727
        ]
      },
      "id": "way/573375626"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/573375746",
        "amenity": "place_of_worship",
        "building": "yes",
        "religion": "muslim",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3571923,
          -0.040167
        ]
      },
      "id": "way/573375746"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/573375760",
        "amenity": "place_of_worship",
        "building": "yes",
        "religion": "muslim",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3560614,
          -0.0405871
        ]
      },
      "id": "way/573375760"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/573375857",
        "amenity": "place_of_worship",
        "building": "yes",
        "religion": "muslim",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3559691,
          -0.0386483
        ]
      },
      "id": "way/573375857"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/573375918",
        "amenity": "place_of_worship",
        "building": "yes",
        "religion": "muslim",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3544972,
          -0.0391636
        ]
      },
      "id": "way/573375918"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/573382618",
        "amenity": "place_of_worship",
        "building": "yes",
        "religion": "muslim",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3532331,
          -0.0432002
        ]
      },
      "id": "way/573382618"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/573382849",
        "amenity": "place_of_worship",
        "building": "yes",
        "religion": "muslim",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3558757,
          -0.043918
        ]
      },
      "id": "way/573382849"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/573386528",
        "amenity": "place_of_worship",
        "building": "yes",
        "religion": "muslim",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3476738,
          -0.0403543
        ]
      },
      "id": "way/573386528"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/573389447",
        "amenity": "place_of_worship",
        "building": "yes",
        "religion": "muslim",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3067657,
          -0.059904
        ]
      },
      "id": "way/573389447"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/573392529",
        "amenity": "place_of_worship",
        "building": "yes",
        "religion": "muslim",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3514381,
          -0.0415037
        ]
      },
      "id": "way/573392529"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/573580887",
        "amenity": "place_of_worship",
        "building": "yes",
        "name": "Vihara Maitreya",
        "religion": "buddhist",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3652478,
          -0.0726716
        ]
      },
      "id": "way/573580887"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/573580906",
        "amenity": "place_of_worship",
        "building": "yes",
        "religion": "muslim",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3613488,
          -0.0677258
        ]
      },
      "id": "way/573580906"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/573591778",
        "amenity": "place_of_worship",
        "building": "yes",
        "religion": "muslim",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3679081,
          -0.0719565
        ]
      },
      "id": "way/573591778"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/573624056",
        "amenity": "place_of_worship",
        "building": "yes",
        "religion": "muslim",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3633405,
          -0.0529865
        ]
      },
      "id": "way/573624056"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/573624114",
        "amenity": "place_of_worship",
        "building": "yes",
        "religion": "muslim",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3627692,
          -0.0512364
        ]
      },
      "id": "way/573624114"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/573629429",
        "addr:city": "Banjar Serasan",
        "addr:postcode": "78233",
        "addr:street": "Jl. Tanjung Harapan",
        "amenity": "place_of_worship",
        "building": "yes",
        "name": "Masjid Al-Huda",
        "religion": "muslim",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3630333,
          -0.0455822
        ]
      },
      "id": "way/573629429"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/573629678",
        "amenity": "place_of_worship",
        "building": "yes",
        "religion": "muslim",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3602963,
          -0.0444551
        ]
      },
      "id": "way/573629678"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/573646741",
        "amenity": "place_of_worship",
        "building": "yes",
        "religion": "muslim",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3679439,
          -0.0533589
        ]
      },
      "id": "way/573646741"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/573646904",
        "amenity": "place_of_worship",
        "building": "yes",
        "religion": "muslim",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3666554,
          -0.0516791
        ]
      },
      "id": "way/573646904"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/573649208",
        "amenity": "place_of_worship",
        "building": "yes",
        "religion": "muslim",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3672554,
          -0.0459625
        ]
      },
      "id": "way/573649208"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/573654484",
        "amenity": "place_of_worship",
        "building": "yes",
        "religion": "muslim",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3603002,
          -0.009464
        ]
      },
      "id": "way/573654484"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/573668368",
        "amenity": "place_of_worship",
        "building": "yes",
        "name": "Kelenteng Kam Thian Thai Tie",
        "name:zh": "感天大帝庙",
        "religion": "chinese_folk",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3367613,
          -0.0041781
        ]
      },
      "id": "way/573668368"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/573706964",
        "amenity": "place_of_worship",
        "building": "mosque",
        "name": "Masjid Al-Murshalaat",
        "religion": "muslim",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3118691,
          -0.008257
        ]
      },
      "id": "way/573706964"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/573781110",
        "amenity": "place_of_worship",
        "building": "mosque",
        "religion": "muslim",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.309466,
          -0.0103631
        ]
      },
      "id": "way/573781110"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/574090532",
        "amenity": "place_of_worship",
        "building": "yes",
        "religion": "muslim",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.365147,
          -0.0295354
        ]
      },
      "id": "way/574090532"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/574105257",
        "amenity": "place_of_worship",
        "building": "yes",
        "religion": "muslim",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3655411,
          -0.0308965
        ]
      },
      "id": "way/574105257"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/574110206",
        "amenity": "place_of_worship",
        "building": "yes",
        "religion": "muslim",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3661753,
          -0.0269542
        ]
      },
      "id": "way/574110206"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/574111467",
        "amenity": "place_of_worship",
        "building": "yes",
        "religion": "muslim",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.361225,
          -0.0277567
        ]
      },
      "id": "way/574111467"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/574238421",
        "amenity": "place_of_worship",
        "building": "yes",
        "religion": "muslim",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3538852,
          -0.0171682
        ]
      },
      "id": "way/574238421"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/574754672",
        "amenity": "place_of_worship",
        "building": "yes",
        "religion": "muslim",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3640527,
          -0.0156181
        ]
      },
      "id": "way/574754672"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/574787737",
        "amenity": "place_of_worship",
        "building": "yes",
        "religion": "muslim",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3592953,
          -0.0130142
        ]
      },
      "id": "way/574787737"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/574792335",
        "amenity": "place_of_worship",
        "building": "yes",
        "religion": "muslim",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3573523,
          -0.036772
        ]
      },
      "id": "way/574792335"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/574903057",
        "amenity": "place_of_worship",
        "building": "yes",
        "religion": "muslim",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3043632,
          -0.0682657
        ]
      },
      "id": "way/574903057"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/574908772",
        "amenity": "place_of_worship",
        "building": "yes",
        "religion": "muslim",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3555216,
          -0.0066892
        ]
      },
      "id": "way/574908772"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/575035237",
        "amenity": "place_of_worship",
        "building": "yes",
        "religion": "muslim",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3478842,
          -0.0031389
        ]
      },
      "id": "way/575035237"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/575035532",
        "amenity": "place_of_worship",
        "building": "yes",
        "religion": "muslim",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3474542,
          -0.0092123
        ]
      },
      "id": "way/575035532"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/575179740",
        "amenity": "place_of_worship",
        "building": "yes",
        "name": "Gereja Katolik St. Hironimus",
        "religion": "christian",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3690799,
          -0.0340306
        ]
      },
      "id": "way/575179740"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/575206533",
        "amenity": "place_of_worship",
        "building": "yes",
        "name": "Mujahiddin",
        "religion": "muslim",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3363526,
          -0.0414735
        ]
      },
      "id": "way/575206533"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/575222259",
        "amenity": "place_of_worship",
        "building": "yes",
        "name": "Kelenteng Pekong Laut",
        "name:zh": "福德祠",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3477361,
          -0.0209159
        ]
      },
      "id": "way/575222259"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/575616428",
        "amenity": "place_of_worship",
        "building": "mosque",
        "fixme": "name",
        "religion": "muslim",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3750754,
          -0.0241193
        ]
      },
      "id": "way/575616428"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/575809806",
        "amenity": "place_of_worship",
        "building": "yes",
        "name": "Masjid Al Ihsan",
        "religion": "muslim",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3343248,
          -0.0029765
        ]
      },
      "id": "way/575809806"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/575815137",
        "amenity": "place_of_worship",
        "building": "yes",
        "name": "Vihara Dharma Pertiwi Abadi",
        "religion": "buddhist",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.333759,
          -0.0007757
        ]
      },
      "id": "way/575815137"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/575831058",
        "amenity": "place_of_worship",
        "building": "yes",
        "name": "Kelenteng Ci-Kong Sungai Selamat",
        "name:zh": "济公宫",
        "religion": "chinese_folk",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3338647,
          -0.000436
        ]
      },
      "id": "way/575831058"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/576777771",
        "amenity": "place_of_worship",
        "building": "yes",
        "religion": "muslim",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3101855,
          -0.0302643
        ]
      },
      "id": "way/576777771"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/647145103",
        "amenity": "place_of_worship",
        "building": "yes",
        "name": "Musholla Ferry Pasar Siantan",
        "religion": "muslim",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3425158,
          -0.0197369
        ]
      },
      "id": "way/647145103"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/740054082",
        "amenity": "place_of_worship",
        "name": "Masjid Annubuwah",
        "religion": "muslim",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3767433,
          -0.0509884
        ]
      },
      "id": "way/740054082"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/740054083",
        "amenity": "place_of_worship",
        "name": "Masjid Attaqwa",
        "religion": "muslim",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3743809,
          -0.0528509
        ]
      },
      "id": "way/740054083"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/777620338",
        "amenity": "place_of_worship",
        "building": "yes",
        "religion": "muslim",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3416945,
          -0.0281957
        ]
      },
      "id": "way/777620338"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/803558098",
        "amenity": "place_of_worship",
        "building": "yes",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3365653,
          -0.0328994
        ]
      },
      "id": "way/803558098"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/808803740",
        "amenity": "place_of_worship",
        "building": "yes",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3334325,
          -0.036899
        ]
      },
      "id": "way/808803740"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/821358457",
        "amenity": "place_of_worship",
        "building": "yes",
        "denomination": "catholic",
        "name": "Paroki Santo Yoseph Katedral Pontianak",
        "name:en": "St.Joseph Cathedral",
        "religion": "christian",
        "wikipedia": "id:Gereja Katedral Pontianak",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.338206,
          -0.0272998
        ]
      },
      "id": "way/821358457"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/834543937",
        "amenity": "place_of_worship",
        "building": "yes",
        "name": "Graha Mazmur 21",
        "name:en": "Psalm 21 Church",
        "name:id": "Sekolah Mazmur 21",
        "religion": "christian",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3502783,
          -0.0451657
        ]
      },
      "id": "way/834543937"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/1132629107",
        "amenity": "place_of_worship",
        "religion": "muslim",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3212424,
          -0.0332131
        ]
      },
      "id": "way/1132629107"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/1189067098",
        "amenity": "place_of_worship",
        "building": "yes",
        "name": "Gereja Baptis Indonesia Kalvari Pontianak",
        "religion": "christian",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3645695,
          -0.0277704
        ]
      },
      "id": "way/1189067098"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/1354179667",
        "amenity": "place_of_worship",
        "name": "GKKB Jemaat Siantan",
        "name:zh-Hant": "西加基督教會新埠頭堂會",
        "religion": "christian",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3444536,
          -0.0188471
        ]
      },
      "id": "way/1354179667"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/1388210637",
        "amenity": "place_of_worship",
        "name": "Gereja Katolik Stella Maris",
        "religion": "christian",
        "wikipedia": "id:Gereja Stella Maris, Siantan",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3450936,
          -0.0175938
        ]
      },
      "id": "way/1388210637"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/1429460843",
        "air_conditioning": "yes",
        "amenity": "place_of_worship",
        "building": "yes",
        "name": "Masjid Kayu As-Syukur",
        "religion": "muslim",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3821435,
          -0.0558451
        ]
      },
      "id": "way/1429460843"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "way/1444757083",
        "amenity": "place_of_worship",
        "building": "yes",
        "religion": "muslim",
        "@geometry": "center"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          109.3660883,
          -0.0486198
        ]
      },
      "id": "way/1444757083"
    },
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
            return;
        }

        $worshipCount = 0;
        foreach ($data['features'] as $feature) {
            $properties = $feature['properties'] ?? [];
            $geometry = $feature['geometry'] ?? [];
            
            if (($geometry['type'] ?? '') !== 'Point') {
                continue;
            }
            
            $coords = $geometry['coordinates'] ?? [];
            if (count($coords) < 2) {
                continue;
            }

            $lng = $coords[0];
            $lat = $coords[1];
            
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

        $this->command->info("Successfully imported/overwritten {$worshipCount} Worship Places.");

        // Recalculate household coverage
        $this->command->info("Recalculating poor household coverage based on new worship places...");
        
        $worships    = WorshipPlace::all();
        $households  = \App\Models\PoorHousehold::all();

        foreach ($households as $household) {
            $covered = false;
            foreach ($worships as $worship) {
                $dist = \App\Helpers\Haversine::distance(
                    $household->latitude, $household->longitude,
                    $worship->latitude,   $worship->longitude
                );
                if ($dist <= $worship->radius) {
                    $covered = true;
                    break;
                }
            }
            $household->update(['is_covered' => $covered]);
        }
        
        $this->command->info("Recalculation complete.");
    }
}
