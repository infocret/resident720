<?php
/*
Clase que genera un array con las fechas de un periodo solicitado

Autor: Julio C. Buendia G (Predator)
Fecha creación: 201//07/19 17:53

Se agrego en composer.json

"autoload": {
        "classmap": [
            "database/seeds",
            "database/factories"
        ],
        "psr-4": {
            "App\\": "app/"
        },
        "files": [
        	// se elimino por que ahora esta creado el service provider           
			"app/Helpers/GetPeriod.php"  
        ]

    },


Se agrego un alias en config/app.php
'GetPeriod' => \App\Helpers\GetPeriod::class  //Clase de Julio B. Genera array de fechas

Para usar la clase colocar:
	use App\Helpers\GetPeriod;

o puede usar el alias 
	use GetPeriodo;

Uso en Vista Blade:
	{!! GetPeriod::GetP() !!}

Uso en controlador:
	GetPeriod::GetP();

 */
namespace App\Helpers;


use DateTime;
use DateInterval;
use DatePeriod;

class GetPeriod
{
	public static function GetP()
	{
		// Genera un objeto datetime
		$d1 = new DateTime("2018/02/01");
		// Devuelve el valor de el objeto date time como cadena
		return $d1->format("d/m/Y") ;
	}

	
}