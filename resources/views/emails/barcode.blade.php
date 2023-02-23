@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
           Generar Codigo de barras
        </h1>

        <div>
        {!! DNS1D::getBarcodeHTML("4445645656", "C128")   !!}
        </div>
        <div>-</div>

         <div>
        {!! DNS2D::getBarcodeHTML("4445645656", "QRCODE") !!}
        </div>
        <div>-</div>

        <div>
        {!! DNS1D::getBarcodeHTML("4445645656", "C39")  !!}                
        </div>
        <div>-</div>

        <div align="centered">
        {!! '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG("4445645656", "C39",3,33,array(0,0,0),true) . '" alt="barcode"   />'  !!}
        <p>4445645656</p>
        </div>
        <div>-</div>

        <div>
         {!! DNS1D::getBarcodeSVG("4445645656", "C39")  !!}
        </div>
    </section>
    

@endsection