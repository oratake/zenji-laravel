<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Danka;
use Carbon\Carbon;

class DankasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        Danka::factory()->count(100)->create()
            ->each(function ($danka, $index) use ($now) {
                $danka->created_at = $now->addSeconds($index);
                $danka->save();
            });
    }
}
