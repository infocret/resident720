  <?php 

  public function listadof(Request $request)
    {
        // Usando Fluent Query Builder
        
        //traer todo de una tabla
        $codPos = \DB::table('cod_pos')->get();

        //usar un select para campos especificos
        $codPos = \DB::table('cod_pos')       
        -> select(['cod_pos.cp','cod_pos.ciudad']) 
        ->get();
        
        // filtrar busqueda  
        $codPos = \DB::table('cod_pos')
        -> select('*')                  
        ->where ('ciudad','=','Ciudad de México')
        ->get();

        //Filtrar por varios campos
         $codPos = \DB::table('cod_pos')
         -> select('*')          
        ->where ('ciudad','=','Ciudad de México')
        ->where ('cp','like','%085%')
        ->orderBy('cp','ASC')
        ->paginate(6);


        // ordenar consulta
        $codPos = \DB::table('cod_pos')
        -> select('*')                  
        ->where ('ciudad','=','Ciudad de México')
        ->orderBy('cp','ASC')
        ->get();

        // paginar consulta
        $codPos = \DB::table('cod_pos')
        -> select('*')                  
        ->where ('ciudad','=','Ciudad de México')
        ->orderBy('cp','ASC')
        ->paginate(6);

   // Hacer join de consulta
        $codPos = \DB::table('cod_pos')
        -> select('*')                  
        ->where ('ciudad','=','Ciudad de México')
        ->orderBy('cp','ASC')
        ->join('tablaexterna','campollaveforanea','=','tabla.campo')
        ->get();

        //Mostrar resultados
        dd($codPos);
 
     public function listadoo(Request $request)
    {
        // Usando ORM se debe agregar el espacio de nombres del modelo ej: use App\Models\codPo;
        
        // extraer el primer registro 
       $codPos=codPo::first();
       // paginar
        $codPos=codPo::paginate(6);

        // Aplicar filtro y paginar
        $codPos=codPo::where('ciudad', 'Ciudad de México')
        ->paginate(6);

        $codPos=codPo::where('ciudad','like', '%Ciudad%')
        ->paginate(6
            // Filtrar con dos campos
         $codPos=codPo::where('ciudad','like', '%Ciudad%')
        ->where('cp','like', '%085%')
        ->paginate(6);

        //Usando un SCOPE el scope debe estar en el modelo ejemplo abajo
          $codPos=codPo::Cp('08500')
        ->paginate(6);

        $codPos=codPo::Ciudad('Ciudad de México')
        ->paginate(6);

         $codPos=codPo::Filtra('%085%','%ciuda%')
        ->orderBy('municipio','DESC')
        ->paginate(6);

        //ordenando consulta
         $codPos=codPo::Ciudad('Ciudad de México')
         ->orderBy('cp','DESC')
        ->paginate(6);


         dd($codPos);
        
          return view('cod_pos.index')
          ->with('codPos', $codPos);
    }



    //Ejemplo de scope ene l modelo
     public function scopeCp($query,$cp)
    {
        //dd($query);
        $query->where('cp','=',$cp);

    }

      public function scopeCiudad($query,$ciudad)
    {
        //dd($query);
        $query->where('ciudad','=',$ciudad);
    }

    public function scopeFiltra($query,$cp,$ciudad)
    {
        //dd($query);
        $query->where('cp','like',$cp)
        ->where('ciudad','like',$ciudad);;
    }
 
//Ejemplo de uso llamado de funcion en repository
$codPos = $this->codPoRepository->filtrado('08500','Ciudad de México');     

//Codigo en repository
  public function filtrado($cp,$ciudad)
    {

        return codPo::where('ciudad','like', '%Ciudad%')
         ->where('cp','like', '%085%')
         ->paginate(6);
    }



//Comprobar si una variable esta delarada y tiene algun valor
if (isset($_POST['campo1']) && !empty($_POST['campo1'])) {
   // Resto de código
}

// ***************** Codigo que se probo en el index de codPoController.php


         



         //$cp="%{$request->cp}%";
         
        //dd($cp);
        //$this->codPoRepository->pushCriteria(new RequestCriteria($request));
        
        // $codPos = $this->codPoRepository->all();
        // 
        //$codPos = $this->codPoRepository->paginate(15);
        // JB: Se quito el all() se sustituyo por paginate(30), 
        // lo demas se agrego en la vista cod_pos/table.blade.php
          

          //Usando funcion de baserepository - falla la paginacion en render
            //$codPos = $this->codPoRepository->findWhere([
              //Las condiciones van en un array
               //'cp'=>'08500',  // Condicion default cp=08500
              // ['cp','like','%08500%´']  // Condicion personalizada  entre []
           //]);

            
            

        //$codPos = $this->codPoRepository->findByField('municipio','Iztacalco');     

        
        // USando funcion en repository codPoRepository.php
        //$codPos = $this->codPoRepository->filtrado('08500','Ciudad de México');     
   
          //dd($codPos);
        
      // $codPos=codPo::cp($request->get('cp'))-orderBy('cp','DESC')-paginate(6);
      //   dd($codPos);
      //   
        //return view('cod_pos.index')
        //  ->with('codPos', $codPos);   

}
