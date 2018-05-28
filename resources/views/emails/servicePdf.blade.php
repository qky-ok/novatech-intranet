<body>
    <style>
        body {
            font-family: "Source Sans Pro",Calibri,Candara,Arial,sans-serif;
            font-size: 15px;
            line-height: 1.42857143;
            color: #333333;
            background-color: #ffffff;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: inline-block;
            max-width: 100%;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-control {
            display: block;
            width: 100%;
            height: 43px;
            padding: 10px 18px;
            font-size: 15px;
            line-height: 1.42857143;
            color: #333333;
            background-color: #ffffff;
            background-image: none;
            border: 1px solid #cccccc;
            border-radius: 0;
            -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,0.075);
            box-shadow: inset 0 1px 1px rgba(0,0,0,0.075);
            -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
            -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
            transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
            box-sizing: border-box;
        }

        .service-form .form-group input[type='checkbox'] {
            margin: 4px 0 0 4px;
            line-height: normal;
        }

        textarea{
            height: auto;
            box-sizing: border-box;
        }
    </style>

    <h1>Ticket:</h1><br/>
    <!-- Ticket Number Input -->
    <div class="form-group">
        {!! Form::label('ticket_number', 'N° de Ticket') !!}
        <div>{{ (!empty($ticket_number)) ? $ticket_number : null }}</div>
    </div>

    <!-- States Form Input -->
    <div class="form-group">
        {!! Form::label('id_state', 'Estado') !!}
        <div>{{ (isset($state)) ? $state : null }}</div>
    </div>

    <!-- CAS Users Form Input -->
    <div class="form-group">
        {!! Form::label('id_user', 'CAS') !!}
        <div>{{ (isset($cas)) ? $cas : null }}</div>
    </div>

    <!-- CAS Stock Input -->
    <div class="form-group">
        {!! Form::label('cas_stock', 'Stock de Parte') !!}
        <div>{{ (isset($cas_stock)) ? $cas_stock : null }}</div>
    </div>

    <!--Parts Input -->
    <div class="form-group">
        {!! Form::label('id_part', 'Parte') !!}
        <div>{{ (isset($part)) ? $part : null }}</div>
    </div>

    <!-- Clients Form Input -->
    <div class="form-group">
        {!! Form::label('id_client', 'Cliente') !!}
        <div>{{ (isset($client)) ? $client : null }}</div>
    </div>

    <!-- Categories Form Input -->
    <div class="form-group">
        {!! Form::label('id_category', 'Categoría') !!}
        <div>{{ (isset($category)) ? $category : null }}</div>
    </div>

    <!-- Brands Form Input -->
    <div class="form-group">
        {!! Form::label('id_brand', 'Marca') !!}
        <div>{{ (isset($brand)) ? $brand : null }}</div>
    </div>

    <!-- Models Form Input -->
    <div class="form-group">
        {!! Form::label('id_model', 'Modelo') !!}
        <div>{{ (isset($model)) ? $model : null }}</div>
    </div>

    <!-- Selling House Form Input -->
    <div class="form-group">
        {!! Form::label('id_selling_house', 'Casa Vendedora') !!}
        <div>{{ (isset($selling_house)) ? $selling_house : null }}</div>
    </div>

    <!-- Warranty Form Input -->
    <div class="form-group">
        {!! Form::label('id_warranty', 'Garantía') !!}
        <div>{{ (isset($warranty_name)) ? $warranty_name : null }}</div>
    </div>

    <!-- Purchase Order Number of Service Form Input -->
    <div class="form-group">
        {!! Form::label('purchase_order_num', 'Número de factura de compra') !!}
        <div>{{ (isset($purchase_order_num)) ? $purchase_order_num : null }}</div>
    </div>

    <!-- Serial/Chasis of Service Form Input -->
    <div class="form-group">
        {!! Form::label('serial_chasis', 'Serial / Chasis') !!}
        <div>{{ (isset($serial_chasis)) ? $serial_chasis : null }}</div>
    </div>

    <!-- Date IN of Service Form Input -->
    <div class="form-group">
        {!! Form::label('date_in', 'Fecha de entrada') !!}
        <div>{{ (isset($date_in) && $date_in !== '1970-01-01 00:00:00') ? $date_in : ' - ' }}</div>
        </div>
    </div>

    <!-- Date OUT of Service Form Input -->
    <div class="form-group">
        {!! Form::label('date_out', 'Fecha de salida') !!}
        <div>{{ (isset($date_out) && $date_out !== '1970-01-01 00:00:00') ? $date_out : ' - ' }}</div>
        </div>
    </div>

    <!-- Equipment type of Service Form Input -->
    <div class="form-group">
        {!! Form::label('equipment_type', 'Tipo de equipo') !!}
        <div>{{ (isset($equipment_type)) ? $equipment_type : null }}</div>
    </div>

    <!-- Defect Form Input -->
    <div class="form-group">
        {!! Form::label('defect_according_to_client', 'Defecto según el cliente') !!}
        <div>{!! $defect_according_to_client !!}</div>
    </div>

    <!-- Work Done Form Input -->
    <div class="form-group">
        {!! Form::label('work_done', 'Trabajo realizado') !!}
         <div>{!! $work_done !!}</div>
    </div>

    <!-- Warranty of Service Form Input -->
    <div class="form-group">
        {!! Form::label('warranty', 'Garantía') !!}
        {!! Form::checkbox('warranty', 1, (isset($warranty) && $warranty === 1) ? true : false) !!}
    </div>

    <!-- Stock Reposition DOA of Service Form Input -->
    <div class="form-group">
        {!! Form::label('stock_reposition_doa', 'Resposición de stock (DOA)') !!}
        {!! Form::checkbox('stock_reposition_doa', 1, (isset($stock_reposition_doa) && $stock_reposition_doa === 1) ? true : false) !!}
    </div>

    <!-- Pending Budget of Service Form Input -->
    <div class="form-group">
        {!! Form::label('pending_budget', 'A Presupuestar') !!}
        {!! Form::checkbox('pending_budget', 1, (isset($pending_budget) && $pending_budget === 1) ? true : false) !!}
    </div>

    <!-- Home service of Service Form Input -->
    <div class="form-group">
        {!! Form::label('home_service', 'Servicio a domicilio') !!}
        {!! Form::checkbox('home_service', 1, (isset($home_service) && $home_service === 1) ? true : false) !!}
    </div>

    <!-- Stock repair of Service Form Input -->
    <div class="form-group">
        {!! Form::label('stock_repair', 'Reparación de stock') !!}
        {!! Form::checkbox('stock_repair', 1, (isset($stock_repair) && $stock_repair === 1) ? true : false) !!}
    </div>

    <!-- Corrective maintenance of Service Form Input -->
    <div class="form-group">
        {!! Form::label('corrective_maintenance', 'Mantenimiento correctivo') !!}
        {!! Form::checkbox('corrective_maintenance', 1, (isset($corrective_maintenance) && $corrective_maintenance === 1) ? true : false) !!}
    </div>

    <!-- Preventive maintenance of Service Form Input -->
    <div class="form-group">
        {!! Form::label('preventive_maintenance', 'Mantenimiento preventivo') !!}
        {!! Form::checkbox('preventive_maintenance', 1, (isset($preventive_maintenance) && $preventive_maintenance === 1) ? true : false) !!}
    </div>

    <!-- Pre aproved budget of Service Form Input -->
    <div class="form-group">
        {!! Form::label('pre_aproved_budget', 'Presupuesto pre aprobado') !!}
        {!! Form::checkbox('pre_aproved_budget', 1, (isset($pre_aproved_budget) && $pre_aproved_budget === 1) ? true : false) !!}
    </div>

    <!-- Recolection service of Service Form Input -->
    <div class="form-group">
        {!! Form::label('recolection_service', 'Servicio de recolección') !!}
        {!! Form::checkbox('recolection_service', 1, (isset($recolection_service) && $recolection_service === 1) ? true : false) !!}
    </div>
</body>