<?php

namespace Tee\Page\Widgets;

use View, Config;
use Tee\Page\Models\PageCategory;

class PageBoxList {

    public function register(array $options)
    {
        $category = PageCategory::where('type', '=', PageCategory::DYNAMIC)->first();
        if(moduleEnabled('i18n'))
        {
            $pages = $category->pages()->where(function($query) {
                $query->where('language', '=', Config::get('app.locale'))
                    ->orWhere('language', '=', '')
                    ->orWhereNull('language');
            })->get();
        }
        else
        {
            $pages = $category->pages;
        }
        return View::make(
            'page::widgets.pageBoxList.list',
            compact('pages', 'options')
        );
    }

} 