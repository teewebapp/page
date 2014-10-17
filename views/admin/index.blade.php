@extends('layouts.main')

{{ Asset::add('js/tableorder.js') }}

@section('content')

    @foreach($categories as $category)
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">{{{ $category->name }}}</h3>
            </div>
            <div class="box-body no-padding">
                <table class="table table-hover table-page-list">
                    <tbody>
                        <tr>
                            <th>{{{ attributeName($modelClass, 'title') }}}</th>
                            <th>{{{ attributeName($modelClass, 'description') }}}</th>
                            @if(moduleEnabled('i18n'))
                                <th>Linguagem</th>
                            @endif
                            <th>Opções</th>
                        </tr>
                    
                        @if($category->pages->count() > 0)
                            @foreach($category->pages as $page)
                                <tr data-id="{{{ $page->id }}}">
                                    <td>
                                        <a href="javascript:void(0)" class="glyphicon glyphicon-chevron-up" ></div>
                                        <a href="javascript:void(0)" class="glyphicon glyphicon-chevron-down" ></a>
                                        &nbsp;
                                        {{{ $page->title }}}
                                    </td>
                                    <td>
                                        {{{ $page->description }}}
                                    </td>
                                    @if(moduleEnabled('i18n'))
                                        <td>{{{ $page->language }}}</td>
                                    @endif
                                    <td>
                                        {{ HTML::updateButton('Editar', route('admin.page.edit', $page->id)) }}
                                        {{ HTML::deleteButton('Remover', route('admin.page.destroy', $page->id)) }}
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="3">
                                    Nenhuma página cadastrada
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="box-footer">
                <a class="btn btn-primary" href="{{ route('admin.page.create', array('category'=>$category->id)) }}">
                    Cadastrar Nova Página
                </a>
            </div>
        </div>
    @endforeach
    <script type="text/javascript">
        $(document).ready(function() {
            $('.table-page-list').tableOrder({
                itens: 'tbody tr',
                up: '.glyphicon-chevron-up',
                down: '.glyphicon-chevron-down',
                url: '{{ route("admin.page.order") }}'
            });
        });
    </script>
@stop