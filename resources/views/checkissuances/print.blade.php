<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Imprimir cheque</title>
    <link rel="stylesheet" 
     href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ url('/').'/css/printcheque.css' }}" media="all" /> 
  </head>

  <body>
    <header>     
    </header>

    <main>
        <div class="cheque"  id="cheque">
        <label class="datetx"   > {!! $tcheque->datetext !!}        </label>  
        <label class="nomtx"    > {!! $tcheque->nametext !!}        </label>
        <label class="montotx"  > {!! $tcheque->amounttext !!}      </label>        
        <label class="montoltx" > {!! $tcheque->amountletertext !!} </label>
        <label class="leytx"    > {!! $tcheque->textleyenda !!}     </label>
        </div>
        {{-- 
        <button onclick="window.print()">Imprimir pantalla</button>
        <button onclick="imprSelec('cheque')">Imprimir  solo div</button> 
        --}}
    </main>

    <footer>       
    </footer>
  </body>
</html>




