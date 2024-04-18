<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EpisodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            DB::table('episode')->insert([
                "id_movie" => "127",
                "link_movie" => "https://vip.opstream13.com/share/f87522788a2be2d171666752f97ddebb",
                "episode" => $i
            ]);
        }
    }
}
