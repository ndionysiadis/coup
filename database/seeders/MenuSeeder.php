<?php

namespace Database\Seeders;

use App\Models\MenuType;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            [
                'name' => 'Brunch',
                'description' => 'Παρακαλούμε ενημερώστε το προσωπικό της επιχείρησης για τυχόν αλλεργίες ή δυσανεξίες που μπορεί να έχετε, το μενού μας μπορεί (ή είναι πιθανό) να περιέχει ίχνη από αλλεργιογόνες ουσίες.',
                'order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ],
            [
                'name' => 'Food',
                'description' => 'Παρακαλούμε ενημερώστε το προσωπικό της επιχείρησης για τυχόν αλλεργίες ή δυσανεξίες που μπορεί να έχετε, το μενού μας μπορεί (ή είναι πιθανό) να περιέχει ίχνη από αλλεργιογόνες ουσίες.',
                'order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ],
            [
                'name' => 'Wine by Glass',
                'description' => null,
                'order' => 3,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ],
            [
                'name' => 'Wine List',
                'description' => null,
                'order' => 4,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ],
            [
                'name' => 'Coffee & Drinks',
                'description' => null,
                'order' => 5,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ],
            [
                'name' => 'Cocktails',
                'description' => null,
                'order' => 6,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ],
        ];

        MenuType::query()->insert($types);
    }
}
