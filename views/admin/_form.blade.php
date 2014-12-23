@if($errors->any())
    <div class="callout callout-danger" role="alert">
        <h4>Atenção</h4>
        <p>
            <ul>
                @foreach($errors->all() as $message)
                <li>
                    {{ $message }}
                </li>
                @endforeach
            </ul>
        </p>
    </div>
@endif

{{ Form::resource($model, "admin.$resourceName", ['files' => true]) }}

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::labelModel($model, 'title') }}
                {{ Form::text('title', null, array('class' => 'form-control')) }}
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                {{ Form::labelModel($model, 'image') }}
                {{ Form::file('image', null, array('class' => 'form-control')) }}
            </div>
        </div>
    </div>

    @if(moduleEnabled('i18n'))
        <div class="form-group">
            {{ Form::labelModel($model, 'language') }}
            {{ Form::selectLanguage('language', [
                'class' => 'form-control',
                'data-bind' => 'value:pageType'
            ]) }}
        </div>
    @endif

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::labelModel($model, 'type') }}
                {{ Form::select('type', [
                    Tee\Page\Models\Page::NORMAL => 'Normal',
                    Tee\Page\Models\Page::LINKED => 'Link Externo',
                ], null, [
                    'class' => 'form-control',
                    'data-bind' => 'value:pageType'
                ]) }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::labelModel($model, 'visibility') }}
                {{ Form::select('visibility', [
                    Tee\Page\Models\Page::VISIBLE => 'Menu Principal',
                    Tee\Page\Models\Page::HIDDEN => 'Oculto (será usado como link em outro local)',
                ], null, [
                    'class' => 'form-control',
                ]) }}
            </div>
        </div>
    </div>

    <div data-bind="visible: linkVisible">
        <div class="form-group">
            {{ Form::labelModel($model, 'link') }}
            {{ Form::text('link', null, array('class' => 'form-control')) }}
        </div>
    </div>

    <div data-bind="visible: contentVisible">
        <div class="form-group">
            {{ Form::labelModel($model, 'keywords') }}
            {{ Form::text('keywords', null, array('class' => 'form-control', 'rows' => 2)) }}
        </div>

        <div class="form-group">
            {{ Form::labelModel($model, 'description') }}
            {{ Form::textArea('description', null, array('class' => 'form-control', 'rows' => 2)) }}
        </div>

        <div class="form-group">
            {{ Form::labelModel($model, 'text') }}
            {{ Form::editor('text', null, array('class' => 'form-control')) }}
        </div>
    </div>

    {{ Form::submit($model->exists ? 'Editar' : 'Cadastrar', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

<script type="text/javascript">
    function PageFormModel() {
        var self = this;
        this.pageType = ko.observable({{ json_encode($model->type) }});
        this.contentVisible = ko.computed(function() {
            var pageType = self.pageType();
            if(pageType == '2')
                return false;
            else
                return true; 
        });
        this.linkVisible = ko.computed(function() {
            var pageType = self.pageType();
            if(pageType == '2')
                return true;
            else
                return false; 
        });
    }
    ko.applyBindings(new PageFormModel());
</script>