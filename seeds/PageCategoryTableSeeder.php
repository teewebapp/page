<?php

namespace Tee\Page\Seeds;

use Tee\Page\Models\PageCategory;
use Seeder, DB, DateTime, Eloquent;

class PageCategoryTableSeeder extends Seeder {

    public function run() {
        Eloquent::unguard();
        DB::table('page_categories')->delete();
        PageCategory::create(array(
            'id' => 1,
            'name' => 'Fixa',
            'type' => PageCategory::FIXED,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        PageCategory::create(array(
            'id' => 2,
            'name' => 'Outras',
            'type' => PageCategory::DYNAMIC,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
    }
    
}