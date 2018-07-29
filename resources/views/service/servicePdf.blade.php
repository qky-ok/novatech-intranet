<html>
<body>
    <style>
        @media print{
            *{
                -webkit-transition: none !important;
                transition: none !important;
            }
        }

        body{
            font-family: "Source Sans Pro",Calibri,Candara,Arial,sans-serif;
            line-height: 1.42857143;
            color: #333333;
            background-color: #ffffff;
        }

        table{
            margin: 0;
            padding: 0;
            border-collapse: separate;
            border-spacing: 0;
        }

        .form-group label{
            font-size: 12px;
            font-weight: bold;
            color: #393185;
            text-transform: uppercase;
            background-color: #bed2ee;
            padding: 0 9px 1px 9px;
            display: block;
            border: 2px solid #393185;
        }

        .form-group div{
            font-size: 13px;
            padding: 2px 9px 4px 9px;
            display: block;
            border-left: 2px solid #393185;
            border-right: 2px solid #393185;
        }

        .form-group div.mid-row{
            border-left: 0;
            border-right: 0;
            border-top: 2px solid #393185;
            border-left: 2px solid #393185;
            border-right: 2px solid #393185;
        }

        .form-group div.mid-row.first-row{
            border-right: 0;
        }

        .form-group div.mid-row span.title{
            color: #393185;
            font-weight: bold;
            margin-right: 5px;
        }

        .form-group div.last-div{
            border-bottom: 2px solid #393185;
        }

        .more-observations{
            margin: 20px 0;
            border: 2px solid #393185;
        }

        .nova-logo img{
            display: block;
            width: 250px;
            border: none;
        }

        .nova-logo div{
            width: 235px;
            margin: 5px 0 15px;
            padding: 2px 10px 5px 10px;
            color: white;
            text-transform: uppercase;
            font-weight: bold;
            font-size: 14px;
            background-color: #048bef;
            border: none;
        }

        .nova-contact{
            margin: 0;
            padding: 0;
        }

        .nova-contact div{
            margin: -40px 0 0 0;
            padding: 0 0 0 165px;
            font-size: 14px;
            text-align: left !important;
            border: none;
            display: block;
        }
    </style>

    <table class="form-group" border="0" cellspacing="0" cellpadding="0" width="92%">
        <tr>
            <td width="50%">
                <div class="nova-logo" style="border:none;padding:0">
                    <img src="http://soporte.novatech.com.ar/img/nova_logo_pdf.jpg" />
                    <div>FORMULARIO SOPORTE TÉCNICO</div>
                </div>
            </td>
            <td width="50%">
                <div class="nova-contact" style="border:none">
                    <div>
                        Novatech Solutions S.A.<br/>
                        Uspallata 2766 - CABA<br/>
                        República Argentina<br/>
                        soportetecnico@novatech.com.ar<br/>
                        0800-333-8862<br/>
                    </div>
                </div>
            </td>
        </tr>

        <tr><td width="100%" colspan="2"><label for="ticket_number">N° de Ticket</label></td></tr>
        <tr><td width="100%" colspan="2"><div>{{ (!empty($ticket_number)) ? $ticket_number : null }}</div></td></tr>

        <tr><td width="100%" colspan="2"><label for="id_client">Cliente</label></td></tr>
        <tr><td width="100%" colspan="2"><div>{{ (isset($client)) ? $client : null }}</div></td></tr>

        <tr><td width="100%" colspan="2"><label for="id_user">CAS</label></td></tr>
        <tr><td width="100%" colspan="2"><div>{{ (isset($cas_name)) ? $cas_name : null }}</div></td></tr>
        <tr>
            <td width="50%">
                <div class="mid-row first-row"><span class="title">Dirección: </span><span>{{ (isset($cas_address)) ? $cas_address : null }}</span></div>
            </td>
            <td width="50%">
                <div class="mid-row"><span class="title">Tel.: </span><span>{{ (isset($cas_phone_customers)) ? $cas_phone_customers : null }}</span></div>
            </td>
        </tr>
        <tr>
            <td width="50%">
                <div class="mid-row first-row"><span class="title">E-mail: </span><span>{{ (isset($cas_contact_email)) ? $cas_contact_email : null }}</span></div>
            </td>
            <td width="50%">
                <div class="mid-row"><span class="title">Website: </span><span>{{ (isset($cas_website)) ? $cas_website : null }}</span></div>
            </td>
        </tr>

        <tr><td width="100%" colspan="2"><label for="id_client">Cliente</label></td></tr>
        <tr><td width="100%" colspan="2"><div>{{ (isset($client)) ? $client : null }}</div></td></tr>

        <tr><td width="100%" colspan="2"><label for="id_category">Categoría</label></td></tr>
        <tr><td width="100%" colspan="2"><div>{{ (isset($category)) ? $category : null }}</div></td></tr>

        <tr><td width="100%" colspan="2"><label for="id_brand">Marca</label></td></tr>
        <tr><td width="100%" colspan="2"><div>{{ (isset($brand)) ? $brand : null }}</div></td></tr>

        <tr><td width="100%" colspan="2"><label for="id_model">Modelo</label></td></tr>
        <tr><td width="100%" colspan="2"><div>{{ (isset($model)) ? $model : null }}</div></td></tr>

        <tr><td width="100%" colspan="2"><label for="id_selling_house">Casa Vendedora</label></td></tr>
        <tr><td width="100%" colspan="2"><div>{{ (isset($selling_house)) ? $selling_house : null }}</div></td></tr>

        <tr><td width="100%" colspan="2"><label for="purchase_order_num">Número de factura de compra</label></td></tr>
        <tr><td width="100%" colspan="2"><div>{{ (isset($purchase_order_num)) ? $purchase_order_num : null }}</div></td></tr>

        <tr><td width="100%" colspan="2"><label for="serial_chasis">Serial / Chasis</label></td></tr>
        <tr><td width="100%" colspan="2"><div>{{ (isset($serial_chasis)) ? $serial_chasis : null }}</div></td></tr>

        <tr>
            <td width="50%"><label for="date_in">Fecha de ingreso <img src="http://soporte.novatech.com.ar/img/nova_pdf_arrow.png" style="width: 9px; margin: 0 0 -1px 0" /></label></td>
            <td width="50%"><label for="date_out" style="border-left:0">Fecha de egreso <img src="http://soporte.novatech.com.ar/img/nova_pdf_arrow.png" style="width: 9px; margin: 0 0 -1px 0; transform:rotate(180deg)" /></label></td>
        </tr>
        <tr>
            <td width="50%"><div>{{ (isset($date_in) && $date_in !== '1970-01-01 00:00:00') ? $date_in : ' - ' }}</div></td>
            <td width="50%"><div style="border-left:0">{{ (isset($date_out) && $date_out !== '1970-01-01 00:00:00') ? $date_out : ' - ' }}</div></td>
        </tr>

        <tr><td width="100%" colspan="2"><label for="equipment_type">Tipo de equipo</label></td></tr>
        <tr><td width="100%" colspan="2"><div>{{ (isset($equipment_type)) ? $equipment_type : null }}</div></td></tr>

        <tr><td width="100%" colspan="2"><label for="work_done">Trabajo realizado</label></td></tr>
        <tr><td width="100%" colspan="2"><div>{!! $work_done !!}</div></td></tr>

        <tr><td width="100%" colspan="2"><label for="id_state">Estado</label></td></tr>
        <tr><td width="100%" colspan="2"><div class="last-div" style="padding: 11px 9px 40px">{{ (isset($state)) ? $state : null }}</div></td></tr>

        <tr>
            <td width="100%" colspan="2">
                <div class="more-observations">
                    <br/>
                    <br/>
                    <br/>
                </div>
            </td>
        </tr>
    </table>
</body>
</html>