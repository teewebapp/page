<?php

namespace Tee\Page\Models;

use Illuminate\Auth\UserInterface;
use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Eloquent, Config;

class PageCategory extends Eloquent {

    const PAGE = 'page';
    const PORTFOLIO = 'portfolio';
    const NEWS = 'news';


    public function pages() {
        return $this->hasMany(__NAMESPACE__.'\\Page')->orderBy('order');
    }

    public function localizedPages() {
        $queryBuilder = $this->pages();
        if(moduleEnabled('i18n'))
        {
            $queryBuilder->where(function($query) {
                $query->where('language', '=', Config::get('app.locale'))
                    ->orWhere('language', '=', '')
                    ->orWhereNull('language');
            });
        }
        return $queryBuilder;
    }

}