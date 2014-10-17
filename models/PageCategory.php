<?php

namespace Tee\Page\Models;

use Illuminate\Auth\UserInterface;
use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Eloquent;

class PageCategory extends Eloquent {

    const FIXED = 'fixed';
    const DYNAMIC = 'dynamic';


    public function pages() {
        return $this->hasMany(__NAMESPACE__.'\\Page')->orderBy('order');
    }

}