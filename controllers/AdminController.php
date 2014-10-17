<?php

namespace Tee\Page\Controllers;

use Tee\Admin\Controllers\AdminBaseController;

use Tee\Page\Models\Page;
use Tee\Page\Models\PageCategory;
use View, Redirect, Validator, Breadcrumbs, URL, Input;

class AdminController extends AdminBaseController {

    public function __construct() {
        parent::__construct();
        View::share('pageTitle', 'Página');
        Breadcrumbs::addCrumb('Páginas', URL::to('admin/pages'));
    }
    
    /**
     * Display a listing of pages
     *
     * @return Response
     */
    public function index()
    {
        $categories = PageCategory::all();

        return View::make('page::admin.index',
            compact('categories') + array(
                'modelClass' => 'Tee\Page\Models\Page'
            )
        );
    }

    /**
     * Show the form for creating a new page
     *
     * @return Response
     */
    public function create()
    {
        $page = new Page();
        $page->fill(Input::all());
        $id_category = Input::get('category');
        return View::make(
            'page::admin.create',
            compact('page', 'id_category') + array(
                'pageTitle' => 'Cadastrar Página'
            )
        );
    }

    /**
     * Store a newly created page in storage.
     *
     * @return Response
     */
    public function store()
    {
        $validator = $this->getValidator();

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        Page::create(Input::all() + [
            'page_category_id' => Input::get('category')
        ]);

        return Redirect::route('admin.page.index');
    }

    /**
     * Show the form for editing the specified page.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $page = Page::find($id);

        return View::make(
            'page::admin.edit',
            compact('page')  + array(
                'pageTitle' => 'Editar Página'
            )
        );
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

    /**
     * Update the specified page in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $page = Page::findOrFail($id);

        $validator = $this->getValidator();

        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $page->update(Input::all());

        return Redirect::route('admin.page.index');
    }

    public function getValidator() {
        $validator = Validator::make($data = Input::all(), Page::$rules);
        $validator->setAttributeNames(Page::getAttributeNames());
        return $validator;
    }

    /**
     * Remove the specified page from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Page::destroy($id);

        return Redirect::route('admin.page.index');
    }

}
