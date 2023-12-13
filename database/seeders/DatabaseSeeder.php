<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Enums\Type;
use App\Models\Donut;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // delete all donuts
        Storage::disk('public')->deleteDirectory('donuts');

        // truncate donuts and users
        DB::table('donuts')->truncate();
        DB::table('users')->truncate();

        /*
         * User 1
         * cake-crumble
         * sprinkle
         * sprinkle-drizzle
         * cookies
         * blueberry
         */
        $user = User::factory()->create();

        $donut = Donut::factory()->create([
            'name' => 'Chocolate Crumble',
            'user_id' => $user,
            'type' => Type::FILLED,
        ]);
        $this->upload($donut, 'cake-crumble');

        $donut = Donut::factory()->create([
            'name' => 'Sprinkle',
            'user_id' => $user,
        ]);
        $this->upload($donut, 'sprinkle');

        $donut = Donut::factory()->create([
            'name' => 'Choc-drizzle Sprinkle',
            'user_id' => $user,
        ]);
        $this->upload($donut, 'sprinkle-drizzle');

        $donut = Donut::factory()->create([
            'name' => 'Cookies and Cream',
            'user_id' => $user,
        ]);
        $this->upload($donut, 'cookies');

        $donut = Donut::factory()->create([
            'name' => 'Blueberry Ice',
            'user_id' => $user,
        ]);
        $this->upload($donut, 'blueberry');

        /*
         * User 2
         * fairy
         * jam
         * blue-sprinkle
         */
        $user = User::factory()->create();

        $donut = Donut::factory()->create([
            'name' => 'Fairy Fantasy',
            'user_id' => $user,
        ]);
        $this->upload($donut, 'fairy');

        $donut = Donut::factory()->create([
            'name' => 'Jam Donut',
            'user_id' => $user,
            'type' => Type::FILLED,
        ]);
        $this->upload($donut, 'jam');

        $donut = Donut::factory()->create([
            'name' => 'Interstellar Sprinkles',
            'user_id' => $user,
        ]);
        $this->upload($donut, 'blue-sprinkle');

        /*
         * User 3
         * maple-bacon
         * chocolate-stripe
         * pistachio
         */
        $user = User::factory()->create();

        $donut = Donut::factory()->create([
            'name' => 'Maple Bacon',
            'user_id' => $user,
        ]);
        $this->upload($donut, 'maple-bacon');

        $donut = Donut::factory()->create([
            'name' => 'Chocolate',
            'user_id' => $user,
        ]);
        $this->upload($donut, 'chocolate-stripe');

        $donut = Donut::factory()->create([
            'name' => 'Moist Pistachio Drizzle',
            'user_id' => $user,
        ]);
        $this->upload($donut, 'pistachio');

        /*
         * User 4
         * teal-sprinkle
         * chocolate
         * pink-sprinkle
         */

        $user = User::factory()->create();

        $donut = Donut::factory()->create([
            'name' => 'Sprinkle',
            'user_id' => $user,
        ]);
        $this->upload($donut, 'teal-sprinkle');

        $donut = Donut::factory()->create([
            'name' => 'Chocolate Sprinkle',
            'user_id' => $user,
        ]);
        $this->upload($donut, 'chocolate');

        $donut = Donut::factory()->create([
            'name' => 'Sprinkle',
            'user_id' => $user,
        ]);
        $this->upload($donut, 'pink-sprinkle');
    }

    protected function upload($donut, $filename)
    {
        $photo = new UploadedFile(base_path('database/seeders/donuts/'.$filename.'.webp'), $filename.'.webp');
        $newFilename = $photo->hashName('donuts');

        Storage::disk('public')->put($newFilename,
            file_get_contents(base_path('database/seeders/donuts/'.$filename.'.webp')));

        $donut->forceFill(['photo_path' => $newFilename])->save();
    }
}
