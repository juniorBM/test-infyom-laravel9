<!-- Nome Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nome', __('models/produtos.fields.nome').':') !!}
    {!! Form::text('nome', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Codigo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('codigo', __('models/produtos.fields.codigo').':') !!}
    {!! Form::text('codigo', null, ['class' => 'form-control', 'required']) !!}
</div>