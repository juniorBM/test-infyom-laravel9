<!-- Nome Field -->
<div class="col-sm-12">
    {!! Form::label('nome', __('models/produtos.fields.nome').':') !!}
    <p>{{ $produto->nome }}</p>
</div>

<!-- Codigo Field -->
<div class="col-sm-12">
    {!! Form::label('codigo', __('models/produtos.fields.codigo').':') !!}
    <p>{{ $produto->codigo }}</p>
</div>

