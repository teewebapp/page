<?php

namespace Tee\Page\Seeds;

use Tee\Page\Models\Page;
use Seeder, DB, DateTime, Eloquent;

class PageTableSeeder extends Seeder {

    public function run() {
        Eloquent::unguard();
        /*
        Page::create(array(
            'title' => 'Principal',
            'keywords' => '',
            'page_category_id' => 1,
            'description' => '',
            'visibility' => Page::HIDDEN,
            'text' => 'Em construção',
            'special' => 'home',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        */
    }
    
}