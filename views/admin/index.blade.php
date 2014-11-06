@extends('admin::layouts.main')

{{ Tee\System\Asset::add(moduleAsset('admin', 'js/tableorder.js')) }}

@section('content')
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
        
            @if($models->count() > 0)
                @foreach($models as $model)
                    <tr data-id="{{{ $model->id }}}">
                        <td>
                            @if($orderable)
                                <a href="javascript:void(0)" class="glyphicon glyphicon-chevron-up" ></div>
                                <a href="javascript:void(0)" class="glyphicon glyphicon-chevron-down" ></a>
                                &nbsp;
                            @endif
                            {{{ $model->title }}}
                        </td>
                        <td>
                            {{{ $model->description }}}
                        </td>
                        @if(moduleEnabled('i18n'))
                            <td>{{{ $model->language }}}</td>
                        @endif
                        <td>
                            {{ HTML::updateButton('Editar', route("admin.$resourceName.edit", $model->id)) }}
                            {{ HTML::deleteButton('Remover', route("admin.$resourceName.destroy", $model->id)) }}
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="4">
                        Nenhuma página cadastrada
                    </td>
                </tr>
            @endif
        </tbody>
    </table>

    <a class="btn btn-primary" href="{{ route("admin.$resourceName.create") }}">
        Cadastrar {{$resourceTitle}}
    </a>

    @if($orderable)
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
    @endif
@stop