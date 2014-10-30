<?php

namespace Tee\Page\Seeds;

use Tee\Page\Models\PageCategory;
use Seeder, DB, DateTime, Eloquent;

class PageCategoryTableSeeder extends Seeder {

    public function run() {
        Eloquent::unguard();
        #DB::table('page_categories')->delete();
        PageCategory::create(array(
            'name' => 'Páginas',
            'type' => PageCategory::PAGE,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        PageCategory::create(array(
            'name' => 'Portifólio',
            'type' => PageCategory::PORTFOLIO,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
    }
    
}