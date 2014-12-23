<?php

namespace Tee\Page\Widgets;

use View, Config;
use Tee\Page\Models\Page;
use Tee\Page\Models\PageCategory;
use Illuminate\Database\Eloquent\Collection;


class PageList {

    public function register(array $options)
    {
        $pages = $this->getPagesByFilterName($options['filter']);
        return View::make(
            $options['view'],
            compact('pages')
        );
    }

    public function getPagesByFilterName($filterName) {
        $pages = new Collection();
        $category = PageCategory::where('type', '=', PageCategory::PAGE)->first();
        if($filterName == 'hidden') {
            return $category->pages()->where('visibility', '=', Page::HIDDEN)->get();
        }
        return $pages;
    }

} 
