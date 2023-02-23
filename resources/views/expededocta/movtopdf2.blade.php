<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Adprocon - Recibo</title>
    <link rel="stylesheet" 
     href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">   
    {{-- 
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    --}}
    <link rel="stylesheet" href="{{ url('/').'/css/pdfrecip2.css' }}" media="all" /> 
  </head>

  <body>
   

<!------ Include the above in your HEAD tag ---------->

<div class="container">


        <div class="col-xs-12">
            <div class="invoice-title">
                <h2>Estado de Cuenta</h2><h3 class="pull-right">Order # 12345</h3>
            </div>
        </div>

    <div class="row">
        <div class="col-md-12">

        <table>
        <tbody>
          <tr>
          <td class="tithl">
                Unidad:
          </td>
           <td class="tithr">
                Propietario:
          </td>
          <td class="dathr">
               cve 101 Departamento 101
          </td>         
          <td class="dathr">
               Homero Simpsom Ruiz
          </td>          
         </tr>  
        </tbody>  
        </table>
      </div>
    </div>

 
    
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><strong>Order summary</strong></h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-condensed">
                            <thead>
                                <tr>
                                    <td><strong>Item</strong></td>
                                    <td class="text-center"><strong>Price</strong></td>
                                    <td class="text-center"><strong>Quantity</strong></td>
                                    <td class="text-right"><strong>Totals</strong></td>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- foreach ($order->lineItems as $line) or some such thing here -->
                                <tr>
                                    <td>BS-200</td>
                                    <td class="text-center">$10.99</td>
                                    <td class="text-center">1</td>
                                    <td class="text-right">$10.99</td>
                                </tr>
                                <tr>
                                    <td>BS-400</td>
                                    <td class="text-center">$20.00</td>
                                    <td class="text-center">3</td>
                                    <td class="text-right">$60.00</td>
                                </tr>
                                <tr>
                                    <td>BS-1000</td>
                                    <td class="text-center">$600.00</td>
                                    <td class="text-center">1</td>
                                    <td class="text-right">$600.00</td>
                                </tr>
                                <tr>
                                    <td class="thick-line"></td>
                                    <td class="thick-line"></td>
                                    <td class="thick-line text-center"><strong>Subtotal</strong></td>
                                    <td class="thick-line text-right">$670.99</td>
                                </tr>
                                <tr>
                                    <td class="no-line"></td>
                                    <td class="no-line"></td>
                                    <td class="no-line text-center"><strong>Shipping</strong></td>
                                    <td class="no-line text-right">$15</td>
                                </tr>
                                <tr>
                                    <td class="no-line"></td>
                                    <td class="no-line"></td>
                                    <td class="no-line text-center"><strong>Total</strong></td>
                                    <td class="no-line text-right">$685.99</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>  

  </body>
</html>




