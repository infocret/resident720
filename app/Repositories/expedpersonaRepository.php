<?php

namespace App\Repositories;

use App\Models\persona;             // Modelo persona
use App\Models\ContactType;         // Modelo Tipos de Contacto
use App\Models\PersonaContacto;     // Modelo Relacion de Persona a un Tipo de contacto 
                                    // y se asigna valor

use InfyOm\Generator\Common\BaseRepository;

/**
 * Class personaRepository
 * @package App\Repositories
 * @version January 12, 2018, 11:46 pm UTC
 *
 * @method persona findWithoutFail($id, $columns = ['*'])
 * @method persona find($id, $columns = ['*'])
 * @method persona first($columns = ['*'])
*/
class expedpersonaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'appat',
        'apmat',
        'datebirth',
        'rfc',
        'curp',
        'nss'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return persona::class;
    }

    // Funcion que extrae datos de una persona Ya no la use pero si funciona
    public function Persona($id) 
    {
         //return persona::where('id', "{$id}")
         return persona::find($id);
         //->first();         
    }

    // Funcion que extrae la lista de modos de contactar a una persona
    public function PersonaModosContacto($id) 

    {
        // Return  PersonaContacto::select('persona_contactos.id','contact_types.nombre', 'persona_contactos.valor', 'persona_contactos.observaciones')
        // ->join('contact_types', 'persona_contactos.id_contact_type', '=', 'contact_types.id')
        // ->where('persona_contactos.id_persona',$id)
        // ->orderBy('contact_types.id','ASC')
        // ->get();
        //dd($personaContactos[0]->valor);   // si devuelve un array o colleccion de modelos
        

    //     $result = User
    // ::join('contacts', 'users.id', '=', 'contacts.user_id')
    // ->join('orders', 'users.id', '=', 'orders.user_id')
    // ->select('users.id', 'contacts.phone', 'orders.price')
    // ->getQuery() // Optional: downgrade to non-eloquent builder so we don't build invalid User objects.
    // ->get();
        //return codPo::where('cp','like', "{$cp}")
        //  ->where('ciudad','like', "{$ciudad}")
        //  ->where('estado','like', "{$estado}")
        //  ->where('municipio','like',"{$municipio}")
        //  ->where('tipo','like',"{$tipo}")
        //  ->where('asentamiento','like',"{$asentamiento}")
        //  ->paginate(10);
    }


    // Funcion creada por JB para personalizar busqueda y ejecutar paginate
    public function filtrado($request)  //$cp,$ciudad)
    {
        
        //dd($request);
        $cp="%{$request->cp}%";
        $ciudad="%{$request->ciudad}%";
        $estado="%{$request->estado}%";
        $municipio="%{$request->municipio}%";
        $tipo="%{$request->tipo}%";
        $asentamiento="%{$request->asentamiento}%";
        
        // dd( " cp:{$cp}
        //      --ciudad:{$ciudad}
        //      --estado:{$estado}
        //      --municipio:{$municipio}
        //      --tipo:{$tipo}
        //      --asentamiento:{$asentamiento}"
        // );

        // return codPo::where('cp','like', "{$cp}")
        //  ->where('ciudad','like', "{$ciudad}")
        //  ->where('estado','like', "{$estado}")
        //  ->where('municipio','like',"{$municipio}")
        //  ->where('tipo','like',"{$tipo}")
        //  ->where('asentamiento','like',"{$asentamiento}")
        //  ->paginate(10);
        //  
      
    }

}
