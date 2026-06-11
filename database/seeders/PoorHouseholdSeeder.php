<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PoorHousehold;
use App\Models\WorshipPlace;
use App\Helpers\Haversine;

class PoorHouseholdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Realistic Indonesian first and last names for generating 120 unique heads of households
        $firstNames = [
            'Ahmad', 'Muhammad', 'Syarif', 'Bambang', 'Budi', 'Eko', 'Hendra', 'Agus', 'Iwan', 'Rudi',
            'Joko', 'Herman', 'Ridwan', 'Hasan', 'Husin', 'Yusuf', 'Ibrahim', 'Ismail', 'Daud', 'Sulaiman',
            'Andi', 'Adi', 'Fajar', 'Taufik', 'Yudi', 'Zulkifli', 'Usman', 'Ali', 'Umar', 'Hamzah',
            'Hendry', 'Budiman', 'Hartono', 'Susanto', 'Wibowo', 'Chandra', 'Gunawan', 'Halim', 'Mulia', 'Surya',
            'Roni', 'Deddy', 'Asep', 'Heri', 'Kurnia', 'Teguh', 'Wahyu', 'Slamet', 'Anwar', 'Aris',
            'Suryadi', 'Mulyono', 'Supardi', 'Dedi', 'Rian', 'Denny', 'Ferry', 'Alex', 'Johan', 'Tommy'
        ];

        $lastNames = [
            'Saputra', 'Pratama', 'Wijaya', 'Hidayat', 'Santoso', 'Setiawan', 'Kurniawan', 'Siregar', 'Nasution', 'Lubis',
            'Tanjung', 'Pohan', 'Pane', 'Hasibuan', 'Pasaribu', 'Sitorus', 'Marpaung', 'Siahaan', 'Panjaitan', 'Hutapea',
            'Situmorang', 'Manurung', 'Tampubolon', 'Sinaga', 'Simanjuntak', 'Nainggolan', 'Nababan', 'Ginting', 'Tarigan', 'Sembiring',
            'Budiman', 'Hartono', 'Susanto', 'Wibowo', 'Chandra', 'Gunawan', 'Tan', 'Lim', 'Huang', 'Halim',
            'Prasetyo', 'Nugroho', 'Wicaksono', 'Subagyo', 'Darsono', 'Sudrajat', 'Kusuma', 'Putra', 'Utomo', 'Firmansyah',
            'Kusnadi', 'Mulyadi', 'Heryanto', 'Suherman', 'Rian', 'Yulianto', 'Permana', 'Zulkarnaen', 'Syarifudin', 'Arifin'
        ];

        $streets = [
            'Jl. Imam Bonjol', 'Jl. Gajah Mada', 'Jl. Khatulistiwa', 'Jl. Kom Yos Sudarso', 'Jl. Adi Sucipto',
            'Jl. Tanjung Pura', 'Jl. Sungai Raya Dalam', 'Jl. Danau Sentarum', 'Jl. Dr. Wahidin', 'Jl. Ampera',
            'Jl. Paris Haji Husin', 'Jl. KH. Ahmad Dahlan', 'Jl. Teuku Umar', 'Jl. Sutan Syahrir', 'Jl. Sultan Abdurrahman',
            'Jl. Hasanuddin', 'Jl. Merdeka', 'Jl. H. Rais A. Rahman', 'Jl. Prof. M. Yamin', 'Jl. Karya Sosial'
        ];

        $districts = [
            'Pontianak Selatan', 'Pontianak Tenggara', 'Pontianak Kota', 'Pontianak Barat', 'Pontianak Utara', 'Pontianak Timur'
        ];

        // Retrieve existing worship places to calculate initial coverage status
        $worships = WorshipPlace::all();

        $count = 0;
        for ($i = 0; $i < 200; $i++) {
            // Pick a random name
            $fn = $firstNames[array_rand($firstNames)];
            $ln = $lastNames[array_rand($lastNames)];
            // Avoid duplicates in the loops
            $name = $fn . ' ' . $ln;

            // Pick a random street, number, and district
            $street = $streets[array_rand($streets)];
            $num = rand(1, 240);
            $district = $districts[array_rand($districts)];
            $description = "Alamat: {$street} No. {$num}, {$district}, Kota Pontianak";

            // Generate coordinates within Pontianak's bounding box
            // Latitude: -0.0900000 to 0.0100000
            // Longitude: 109.2800000 to 109.4200000
            $lat = -0.09 + (rand(0, 1000000) / 1000000) * 0.10;
            $lng = 109.28 + (rand(0, 1000000) / 1000000) * 0.14;

            // Check if already covered by any worship place
            $covered = false;
            foreach ($worships as $worship) {
                $dist = Haversine::distance($lat, $lng, $worship->latitude, $worship->longitude);
                if ($dist <= $worship->radius) {
                    $covered = true;
                    break;
                }
            }

            PoorHousehold::create([
                'name'        => $name,
                'description' => $description,
                'latitude'    => $lat,
                'longitude'   => $lng,
                'is_covered'  => $covered,
            ]);
            $count++;
        }

        $this->command->info("Successfully seeded {$count} poor household records in Pontianak.");
    }
}
