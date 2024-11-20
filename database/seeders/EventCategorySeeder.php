<?php

// Database\Seeders\EventCategorySeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;
use App\Models\Category;

class EventCategorySeeder extends Seeder
{
    public function run()
    {
        $events = Event::all();
        $categories = Category::all();

        foreach ($events as $event) {
            // Menambahkan setiap event ke kategori secara acak
            $assignedCategories = $categories->random(1);
            foreach ($assignedCategories as $category) {
                $event->categories()->attach($category->id);
            }
        }
    }
}
