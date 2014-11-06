<?php

namespace Tee\Page\Controllers;

use Tee\Admin\Controllers\AdminBaseController;

use Tee\Page\Models\Page;
use Tee\Page\Models\PageCategory;
use View, Redirect, Validator, URL, Input;

use Tee\System\Breadcrumbs;

use Tee\Admin\Controllers\ResourceController;

class AdminController extends ResourceController {
    public $resourceTitle = 'Página';
    public $resourceName = 'page';
    public $modelClass = 'Tee\\Page\\Models\\Page';
    public $moduleName = 'page';
    public $orderable = true;
    public $orderBy = 'order';
    public $orderType = 'ASC';

    public function index() {
        View::share('orderable', $this->orderable);
        return parent::index();
    }

    public function getCategory() {
        return PageCategory::where('type', '=', PageCategory::PAGE)->first();
    }

    public function beforeSave($model) {
        $model->page_category_id = $this->getCategory()->id;
    }

    public function beforeList($queryBuilder) {
        $category = $this->getCategory();
        return $queryBuilder
            ->where('page_category_id', $category->id)
            ->orderBy($this->orderBy, $this->orderType);
    }

    /**
     * Show the form for editing the specified page.
     *
     * @param  int  $id
     * @return Response
     */
    public function order()
    {
        $page1 = Page::find((int)Input::get('id1'));
        $page2 = Page::find((int)Input::get('id2'));

        $pages = $page1->category->pages;
        $i = 0;
        foreach($pages as $page) {
            $page->order = $i;
            $page->save();
            $i += 1;
        }

        $order1 = Input::get('order1');
        $order2 = Input::get('order2');

        $page1->order = (int)$order1;
        $page2->order = (int)$order2;

        $page1->save();
        $page2->save();

        return json_encode(['success' => true]);
    }

}
