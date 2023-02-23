
<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

// ****************  Rutas PRODUCCIÓN  **********************
Route::get('/', function () {
    return view('welcome');		// muestra pantalla inicial login    
});

//Route::get('/home', 'HomeController@index');
Route::get('/home',['as' => 'home.index', 'uses'=>'HomeController@index']); //Index 

Route::get('dashboard', function () {
    return view('dashboard.dashboard');	// muestra el dashboard
});

//===========================================================================
require (__DIR__ . '/inmuebles.php');		// Relacionados con inmuebles

// Expediente inmueble, Expediente Condominio, Subir imagen, Unidades
// Medios de contacto, Ubicaciones, Rel personas desde Inmueble
// Rel Areas, Rel Ctas Bancarias 
require (__DIR__ . '/expedienteinmu.php');	

require (__DIR__ . '/paramsvalues.php');	// Parametros y Valores
require (__DIR__ . '/presupuesto.php');		// Establecer presupuesto
require (__DIR__ . '/edoscta.php');			// Estados de cuenta
require (__DIR__ . '/maillist.php');		// maillist
require (__DIR__ . '/unidadexped.php');		// unidadexped
require (__DIR__ . '/indivisos.php');		// Indivisos inmueble, unidad, gen cuotas
require (__DIR__ . '/personas.php');		// Todo sobre personas
require (__DIR__ . '/relinmufrompersonexp.php');	// rel inmu desde persona exped
require (__DIR__ . '/movtos.php');			// movtos
require (__DIR__ . '/tickets.php');			// tickets
require (__DIR__ . '/events.php');			// eventos
require (__DIR__ . '/periodos.php');		// periodos
require (__DIR__ . '/parameters.php');		// parametros
require (__DIR__ . '/bankaccounts.php');	// bankaccounts
require (__DIR__ . '/contractservices.php');// Contratos y servicios
require (__DIR__ . '/catalogos.php');		// catalogos
require (__DIR__ . '/inventarios.php');		// inventarios
require (__DIR__ . '/originalopers.php');	// operaciones originales
require (__DIR__ . '/providers.php');		// proveedores
require (__DIR__ . '/selectsubic.php');		// selects para ubicaciones
require (__DIR__ . '/genjson.php');			// generador de json y ruta "algo"
require (__DIR__ . '/sendmailsamp.php');	// ejemplos de envio de correos
require (__DIR__ . '/barcodesamp.php');  	// ejemplo de codigo de barras
require (__DIR__ . '/egresos.php');  		// registro de gastos 
require (__DIR__ . '/checkissuance.php');  	// emision de cheques
require (__DIR__ . '/procedmovtos.php');  	// (Store proced. en BD) de aplic. de movtos
require (__DIR__ . '/anticipos.php');  		// Anticipos
// **************************************************************************



 // Route::get('printtest', function () {
 //     $handle = printer_open("Nitro PDF Creato (Pro 9)");
 // 	printer_write($handle, "Julio imprimo esto");
 // 	printer_close($handle);
 // });



