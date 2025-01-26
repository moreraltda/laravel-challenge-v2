<?php

namespace Database\Seeders;

use App\Models\File;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FileSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();
        File::factory()->count(10)->create(['owner_id' => $user->id]);

        $sharedFiles = File::factory()->count(10)->create();
        $user->sharedFiles()->syncWithoutDetaching($sharedFiles);
    }
}
