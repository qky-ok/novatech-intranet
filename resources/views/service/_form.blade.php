<!-- Ticket Number Input -->
<div class="form-group @if ($errors->has('ticket_number')) has-error @endif">
    {!! Form::label('ticket_number', 'N° de Ticket') !!}
    {!! Form::text('ticket_number', (!empty($service->ticket_number)) ? $service->ticket_number : null, ['class' => 'form-control', 'placeholder' => '0000-000000000']) !!}
    @if ($errors->has('ticket_number')) <p class="help-block">{{ $errors->first('ticket_number') }}</p> @endif
</div>

<!-- States Form Input -->
<div class="form-group @if ($errors->has('id_state')) has-error @endif">
    {!! Form::label('id_state', 'Estado') !!}
    {!! Form::select('id_state', $states, isset($service) ? $service->id_state : 6,  ['class' => 'form-control']) !!}
    @if ($errors->has('id_state')) <p class="help-block">{{ $errors->first('id_state') }}</p> @endif
</div>

<!-- CAS Users Form Input -->
<div class="form-group @if ($errors->has('id_user')) has-error @endif">
    {!! Form::label('id_user', 'CAS') !!}
    <select class="form-control" name="id_user" @if(Auth::user()->roles->first()->id == env('CAS_USER')) disabled @endif>
        <option value="0">Seleccione CAS</option>
        @foreach($cas_users as $cas_user)
            <option value="{{ $cas_user->id }}" @if(isset($service->id_user) && $service->id_user == $cas_user->id) selected="selected" @elseif(Auth::user()->roles->first()->id == env('CAS_USER') && $cas_user->id == Auth::user()->id) selected="selected" @endif>{{ $cas_user->name }}</option>
        @endforeach
    </select>
    @if(Auth::user()->roles->first()->id == env('CAS_USER'))
        <input type="hidden" name="id_user" value="{{ Auth::user()->id }}">
    @endif

    @if ($errors->has('id_user')) <p class="help-block">{{ $errors->first('id_user') }}</p> @endif
</div>

<!--Parts Input -->
<div class="form-group @if ($errors->has('id_part')) has-error @endif">
    {!! Form::label('id_part', 'Parte') !!}
    <select class="form-control" name="id_part">
        @foreach($parts as $part)
            <option value="{{ $part->id }}" @if(isset($service->id_part) && $service->id_part == $part->id) selected="selected" @endif>{{ $part->description }}</option>
        @endforeach
    </select>

    @if ($errors->has('id_part')) <p class="help-block">{{ $errors->first('id_part') }}</p> @endif
</div>

@if(isset($service->cas_stock))
    <!-- CAS Stock Input -->
    <div class="form-group @if ($errors->has('cas_stock')) has-error @endif">
        {!! Form::label('cas_stock', 'Stock de Parte') !!}
        <select class="form-control" name="cas_stock">
            <option value="1" @if($service->cas_stock == 1) selected="selected" @endif>Pedido</option>
            <option value="2" @if($service->cas_stock == 2) selected="selected" @endif>En proceso de compra</option>
            <option value="3" @if($service->cas_stock == 3) selected="selected" @endif>Enviado</option>
            <option value="4" @if($service->cas_stock == 4) selected="selected" @endif>Devuelto</option>
        </select>

        @if ($errors->has('cas_stock')) <p class="help-block">{{ $errors->first('cas_stock') }}</p> @endif
    </div>
@endif

<!-- Clients Form Input -->
<div class="form-group @if ($errors->has('id_client')) has-error @endif">
    {!! Form::label('id_client', 'Cliente') !!}
    <select class="form-control" name="id_client">
        <option value="0">Seleccione un Cliente</option>
        @foreach($clients as $client)
            <option value="{{ $client->id }}" @if(isset($service->id_client) && $service->id_client == $client->id) selected="selected" @endif>{{ $client->company }}</option>
        @endforeach
    </select>

    @if ($errors->has('id_client')) <p class="help-block">{{ $errors->first('id_client') }}</p> @endif
</div>

<!-- Categories Form Input -->
<div class="form-group @if ($errors->has('id_category')) has-error @endif">
    {!! Form::label('id_category', 'Categoría') !!}
    <select class="form-control" name="id_category">
        <option value="0">Seleccione una Categoría</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}" @if(isset($service->id_category) && $service->id_category == $category->id) selected="selected" @endif>{{ $category->category }}</option>
        @endforeach
    </select>

    @if ($errors->has('id_category')) <p class="help-block">{{ $errors->first('id_category') }}</p> @endif
</div>

<!-- Brands Form Input -->
<div class="form-group @if ($errors->has('id_brand')) has-error @endif">
    {!! Form::label('id_brand', 'Marca') !!}
    <select class="form-control" name="id_brand">
        <option value="0">Seleccione una Marca</option>
        @foreach($brands as $brand)
            <option value="{{ $brand->id }}" @if(isset($service->id_brand) && $service->id_brand == $brand->id) selected="selected" @endif>{{ $brand->brand }}</option>
        @endforeach
    </select>

    @if ($errors->has('id_brand')) <p class="help-block">{{ $errors->first('id_brand') }}</p> @endif
</div>

<!-- Models Form Input -->
<div class="form-group @if ($errors->has('id_model')) has-error @endif">
    {!! Form::label('id_model', 'Modelo') !!}
    <select class="form-control" name="id_model">
        <option value="0">Seleccione un Modelo</option>
        @foreach($models as $model)
            <option value="{{ $model->id }}" @if(isset($service->id_model) && $service->id_model == $model->id) selected="selected" @endif>{{ $model->part_model }}</option>
        @endforeach
    </select>

    @if ($errors->has('id_model')) <p class="help-block">{{ $errors->first('id_model') }}</p> @endif
</div>

<!-- Selling House Form Input -->
<div class="form-group @if ($errors->has('id_selling_house')) has-error @endif">
    {!! Form::label('id_selling_house', 'Casa Vendedora') !!}
    <select class="form-control" name="id_selling_house">
        <option value="0">Seleccione una Casa Vendedora</option>
        @foreach($selling_houses as $selling_house)
            <option value="{{ $selling_house->id }}" @if(isset($service->id_selling_house) && $service->id_selling_house == $selling_house->id) selected="selected" @endif>{{ $selling_house->business_name }}</option>
        @endforeach
    </select>

    @if ($errors->has('id_selling_house')) <p class="help-block">{{ $errors->first('id_selling_house') }}</p> @endif
</div>

<!-- Warranty Form Input -->
<div class="form-group @if ($errors->has('id_warranty')) has-error @endif">
    {!! Form::label('id_warranty', 'Garantía') !!}
    <select class="form-control" name="id_warranty">
        <option value="0">Seleccione Garantía</option>
        @foreach($warranties as $warranty)
            <option value="{{ $warranty->id }}" @if(isset($service->id_warranty) && $service->id_warranty == $warranty->id) selected="selected" @endif>{{ $warranty->num_warranty }}</option>
        @endforeach
    </select>

    @if ($errors->has('id_warranty')) <p class="help-block">{{ $errors->first('id_warranty') }}</p> @endif
</div>

<!-- Purchase Order Number of Service Form Input -->
<div class="form-group @if ($errors->has('purchase_order_num')) has-error @endif">
    {!! Form::label('purchase_order_num', 'Número de factura de compra') !!}
    {!! Form::text('purchase_order_num', (isset($service->purchase_order_num)) ? $service->purchase_order_num : null, ['class' => 'form-control', 'placeholder' => 'Número de factura de compra']) !!}
    @if ($errors->has('purchase_order_num')) <p class="help-block">{{ $errors->first('purchase_order_num') }}</p> @endif
</div>

<!-- Serial/Chasis of Service Form Input -->
<div class="form-group @if ($errors->has('serial_chasis')) has-error @endif">
    {!! Form::label('serial_chasis', 'Serial / Chasis') !!}
    {!! Form::text('serial_chasis', (isset($service->serial_chasis)) ? $service->serial_chasis : null, ['class' => 'form-control', 'placeholder' => 'Serial / Chasis']) !!}
    @if ($errors->has('serial_chasis')) <p class="help-block">{{ $errors->first('serial_chasis') }}</p> @endif
</div>

<!-- Date IN of Service Form Input -->
<div class="form-group @if ($errors->has('date_in')) has-error @endif">
    {!! Form::label('date_in', 'Fecha de entrada') !!}

    <div class="input-group date" id='date_in'>
        <input type="text" name="date_in" class="form-control" @if(isset($service->date_in) && $service->date_in !== '1970-01-01 00:00:00') value="{{ $service->dateInToString() }}" @endif />
        <span class="input-group-addon">
            <span class="glyphicon glyphicon-calendar"></span>
        </span>
    </div>
    @if ($errors->has('date_in')) <p class="help-block">{{ $errors->first('date_in') }}</p> @endif
</div>

<!-- Date OUT of Service Form Input -->
<div class="form-group @if ($errors->has('date_out')) has-error @endif">
    {!! Form::label('date_out', 'Fecha de salida') !!}

    <div class="input-group date" id='date_out'>
        <input type="text" name="date_out" class="form-control" @if(isset($service->date_out) && $service->date_out !== '1970-01-01 00:00:00') value="{{ $service->dateOutToString() }}" @endif />
        <span class="input-group-addon">
            <span class="glyphicon glyphicon-calendar"></span>
        </span>
    </div>
    @if ($errors->has('date_out')) <p class="help-block">{{ $errors->first('date_out') }}</p> @endif
</div>

<!-- Date COMMITMENT of Service Form Input -->
<div class="form-group @if ($errors->has('date_commitment')) has-error @endif">
    {!! Form::label('date_commitment', 'Fecha de compromiso') !!}

    <div class="input-group date" id='date_commitment'>
        <input type="text" name="date_commitment" class="form-control" @if(isset($service->date_commitment) && $service->date_commitment !== '1970-01-01 00:00:00') value="{{ $service->dateCommitmentToString() }}" @endif />
        <span class="input-group-addon">
            <span class="glyphicon glyphicon-calendar"></span>
        </span>
    </div>
    @if ($errors->has('date_commitment')) <p class="help-block">{{ $errors->first('date_commitment') }}</p> @endif
</div>

<!-- Equipment type of Service Form Input -->
<div class="form-group @if ($errors->has('equipment_type')) has-error @endif">
    {!! Form::label('equipment_type', 'Tipo de equipo') !!}
    {!! Form::text('equipment_type', (isset($service->equipment_type)) ? $service->equipment_type : null, ['class' => 'form-control', 'placeholder' => 'Tipo de equipo']) !!}
    @if ($errors->has('equipment_type')) <p class="help-block">{{ $errors->first('equipment_type') }}</p> @endif
</div>

<!-- Location of Service Form Input -->
<div class="form-group @if ($errors->has('location')) has-error @endif">
    {!! Form::label('location', 'Ubicación') !!}
    {!! Form::text('location', (isset($service->location)) ? $service->location : null, ['class' => 'form-control', 'placeholder' => 'Ubicación']) !!}
    @if ($errors->has('location')) <p class="help-block">{{ $errors->first('location') }}</p> @endif
</div>

<!-- Warranty of Service Form Input -->
<div class="form-group @if ($errors->has('warranty')) has-error @endif">
    {!! Form::label('warranty', 'Garantía') !!}
    {!! Form::checkbox('warranty', 1, (isset($service->warranty) && $service->warranty === 1) ? true : false) !!}
    @if ($errors->has('warranty')) <p class="help-block">{{ $errors->first('warranty') }}</p> @endif
</div>

<!-- Stock Reposition DOA of Service Form Input -->
<div class="form-group @if ($errors->has('stock_reposition_doa')) has-error @endif">
    {!! Form::label('stock_reposition_doa', 'Resposición de stock (DOA)') !!}
    {!! Form::checkbox('stock_reposition_doa', 1, (isset($service->stock_reposition_doa) && $service->stock_reposition_doa === 1) ? true : false) !!}
    @if ($errors->has('stock_reposition_doa')) <p class="help-block">{{ $errors->first('stock_reposition_doa') }}</p> @endif
</div>

<!-- Pending Budget of Service Form Input -->
<div class="form-group @if ($errors->has('pending_budget')) has-error @endif">
    {!! Form::label('pending_budget', 'A Presupuestar') !!}
    {!! Form::checkbox('pending_budget', 1, (isset($service->pending_budget) && $service->pending_budget === 1) ? true : false) !!}
    @if ($errors->has('pending_budget')) <p class="help-block">{{ $errors->first('pending_budget') }}</p> @endif
</div>

<!-- Home service of Service Form Input -->
<div class="form-group @if ($errors->has('home_service')) has-error @endif">
    {!! Form::label('home_service', 'Servicio a domicilio') !!}
    {!! Form::checkbox('home_service', 1, (isset($service->home_service) && $service->home_service === 1) ? true : false) !!}
    @if ($errors->has('home_service')) <p class="help-block">{{ $errors->first('home_service') }}</p> @endif
</div>

<!-- Stock repair of Service Form Input -->
<div class="form-group @if ($errors->has('stock_repair')) has-error @endif">
    {!! Form::label('stock_repair', 'Reparación de stock') !!}
    {!! Form::checkbox('stock_repair', 1, (isset($service->stock_repair) && $service->stock_repair === 1) ? true : false) !!}
    @if ($errors->has('stock_repair')) <p class="help-block">{{ $errors->first('stock_repair') }}</p> @endif
</div>

<!-- Corrective maintenance of Service Form Input -->
<div class="form-group @if ($errors->has('corrective_maintenance')) has-error @endif">
    {!! Form::label('corrective_maintenance', 'Mantenimiento correctivo') !!}
    {!! Form::checkbox('corrective_maintenance', 1, (isset($service->corrective_maintenance) && $service->corrective_maintenance === 1) ? true : false) !!}
    @if ($errors->has('corrective_maintenance')) <p class="help-block">{{ $errors->first('corrective_maintenance') }}</p> @endif
</div>

<!-- Preventive maintenance of Service Form Input -->
<div class="form-group @if ($errors->has('preventive_maintenance')) has-error @endif">
    {!! Form::label('preventive_maintenance', 'Mantenimiento preventivo') !!}
    {!! Form::checkbox('preventive_maintenance', 1, (isset($service->preventive_maintenance) && $service->preventive_maintenance === 1) ? true : false) !!}
    @if ($errors->has('preventive_maintenance')) <p class="help-block">{{ $errors->first('preventive_maintenance') }}</p> @endif
</div>

<!-- Pre aproved budget of Service Form Input -->
<div class="form-group @if ($errors->has('pre_aproved_budget')) has-error @endif">
    {!! Form::label('pre_aproved_budget', 'Presupuesto pre aprobado') !!}
    {!! Form::checkbox('pre_aproved_budget', 1, (isset($service->pre_aproved_budget) && $service->pre_aproved_budget === 1) ? true : false) !!}
    @if ($errors->has('pre_aproved_budget')) <p class="help-block">{{ $errors->first('pre_aproved_budget') }}</p> @endif
</div>

<!-- Recolection service of Service Form Input -->
<div class="form-group @if ($errors->has('recolection_service')) has-error @endif">
    {!! Form::label('recolection_service', 'Servicio de recolección') !!}
    {!! Form::checkbox('recolection_service', 1, (isset($service->recolection_service) && $service->recolection_service === 1) ? true : false) !!}
    @if ($errors->has('recolection_service')) <p class="help-block">{{ $errors->first('recolection_service') }}</p> @endif
</div>

<!-- Defect Form Input -->
<div class="form-group @if ($errors->has('defect_according_to_client')) has-error @endif">
    {!! Form::label('defect_according_to_client', 'Defecto según el cliente') !!}
    {!! Form::textarea('defect_according_to_client', (isset($service->defect_according_to_client)) ? $service->defect_according_to_client : null, ['class' => 'form-control ckeditor', 'placeholder' => 'Defecto según el cliente...']) !!}
    @if ($errors->has('defect_according_to_client')) <p class="help-block">{{ $errors->first('defect_according_to_client') }}</p> @endif
</div>

<!-- Work Done Form Input -->
<div class="form-group @if ($errors->has('work_done')) has-error @endif">
    {!! Form::label('work_done', 'Trabajo realizado') !!}
    {!! Form::textarea('work_done', (isset($service->work_done)) ? $service->work_done : null, ['class' => 'form-control ckeditor', 'placeholder' => 'Trabajo realizado...']) !!}
    @if ($errors->has('work_done')) <p class="help-block">{{ $errors->first('work_done') }}</p> @endif
</div>

<!-- Notes Form Input -->
<div class="form-group @if ($errors->has('notes')) has-error @endif">
    {!! Form::label('notes', 'Notas') !!}
    {!! Form::textarea('notes', (isset($service->notes)) ? $service->notes : null, ['class' => 'form-control ckeditor', 'placeholder' => 'Notas...']) !!}
    @if ($errors->has('notes')) <p class="help-block">{{ $errors->first('notes') }}</p> @endif
</div>

@push('scripts')
    <script src="{{ asset('js/ckeditor_4.7/ckeditor.js') }}"></script>
    <script type="text/javascript">
        CKEDITOR.replace('description');
    </script>
@endpush