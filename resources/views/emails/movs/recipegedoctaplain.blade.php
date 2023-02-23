Estado de Cuenta

{{ $edata->ncondomi }}                 	{{-- *** CONDOMINIO *** --}}
ADP Adprocom S.A de C.V.         		{{-- *** Proveedor *** --}}

{{ 'Unidad: '. $edata->uname." ".$edata->udesc }} 	{{-- *** UNIDAD *** --}} 
{{-- {{ $edata->titprop.': '.$edata->npropietario }} 	 *** NOMBRE POPIETARIO *** --}}
{{ 'Provvedor: '. $edata->nproveedor }}


{{ 'Area: '.$edata->area }} 			{{-- *** AREA *** --}} 
{{ 'Folio: '. $edata->folio }} 			{{-- *** FOLIO *** --}} 
{{ 'Fecha Aplicación: '. \Carbon\Carbon::parse($edata->ffact)->format('d/m/Y') }}    
{{ 'Concepto: '.$edata->ccve." - ".$edata->cname }} {{-- *** CONCEPTO *** --}} 

{{ 'Cargos: $ '.number_format($edata->stotal, 2, '.', ',') }} 	{{-- *** SUBTOT *** --}} 
{{ 'I.V.A.: $ '.number_format($edata->iva, 2, '.', ',') }}  	{{-- *** IVA *** --}} 
{{ 'Total: $ '.number_format($edata->stotal+$edata->iva, 2, '.', ',') }} 	{{-- ***  TOTAL *** --}} 
{{ 'Pagos: $ '.number_format($edata->tpagos, 2, '.', ',') }} 	{{-- ***  Pagos *** --}} 
{{ 'Saldo: $ '.number_format($edata->balance, 2, '.', ',') }} 	{{-- ***  Saldo *** --}} 

{{ $edata->snotapie }} 					{{-- *** Linea a ie de pagina *** --}}   
{{ 'Nota: '.$edata->smsg }} 			{{-- *** Nota o mensaje *** --}} 

Se anexa archivo en formato pdf
