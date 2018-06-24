<!-- Bill number -->
<div class="form-group">
    {!! Form::label('bill_number', 'N° Factura') !!}
    {!! Form::text('bill_number', (isset($billing->bill_number)) ? $billing->bill_number : null, ['class' => 'form-control', 'placeholder' => 'N° Factura']) !!}
</div>

<!-- Date Created -->
<div class="form-group @if ($errors->has('billing_date')) has-error @endif">
    {!! Form::label('billing_date', 'Fecha facturado') !!}

    <div class="input-group date" id='billing_date'>
        <input type="text" name="billing_date" class="form-control" @if(isset($billing->billing_date) && $billing->billing_date !== '1970-01-01 00:00:00') value="{{ $billing->dateToString() }}" @endif />
        <span class="input-group-addon">
            <span class="glyphicon glyphicon-calendar"></span>
        </span>
    </div>
    @if ($errors->has('billing_date')) <p class="help-block">{{ $errors->first('billing_date') }}</p> @endif
</div>

@push('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        var dateCreated = $('#billing_date');

        dateCreated.datetimepicker({
            locale: 'es',
            showClose: true,
            format: 'DD-MM-YYYY'
        });
        dateCreated.find('input').click(function(){
            $(this).next().click();
        });
    });
</script>
@endpush