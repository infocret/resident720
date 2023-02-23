<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePersonaDirRequest;
use App\Http\Requests\UpdatePersonaDirRequest;
use App\Repositories\PersonaDirRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
// paar exportar a PDF
use Barryvdh\DomPDF\Facade as PDF;
//use Maatwebsite\Excel\Facades\Excel;   // ya no se usara para exportar a excell se usara PHPOffice
// para convertir a colleccion un array
use Illuminate\Support\Collection as Collection;  
// Para exportar a excell con PHPOffice
use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
// para el create y edit llena combos de continente y pais
use App\Repositories\countriesRepository;   
// para create y edit llena combos de ciudad, estado, municipio , asentamiento
use App\Repositories\CodPoRepository; 
// para create y edit llena combo para seleccionar ubicacion 
use App\Repositories\locationRepository;      


class PersonaDirController extends AppBaseController
{
    /** @var  PersonaDirRepository */
    private $personaDirRepository;

    public function __construct(
        PersonaDirRepository $personaDirRepo,
        countriesRepository $countriesRepo,
        CodPoRepository $codPoRepo,
        locationRepository $locationRepo)
    {
        $this->personaDirRepository = $personaDirRepo;
        $this->countriesRepository = $countriesRepo;    // se agrego
        $this->codPoRepository = $codPoRepo;            // se agrego
        $this->locationRepository = $locationRepo;     // se agrego
    }
/*************************************************************************************************
    /**
     * Display a listing of the PersonaDir.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->personaDirRepository->pushCriteria(new RequestCriteria($request));
        $personaDirs = $this->personaDirRepository->all();
        return view('persona_dirs.index')
            ->with('personaDirs', $personaDirs);
    }


  /**
     * personaubicacionesindex
     * Muestra direcciones de una persona
     *
     * @param Request $request
     * @return Response
     */
    public function personaubicacionesindex(Request $request)
    {
        $personaexpid = Session('personaexpid');

        //$this->personaDirRepository->pushCriteria(new RequestCriteria($request));
        //$personaDirs = $this->personaDirRepository->all();
        $personaDirs=$this->personaDirRepository->gUbicaciones($personaexpid);
        //$PersonaDirsB=$this->personaDirRepository->gPubicaciones($personaexpid);


        //dd($personaDirs);
        return view('personaubicaciones.index')
            ->with('personaDirs', $personaDirs);
    }

/*************************************************************************************************

    /**
     * Show the form for creating a new PersonaDir.
     *
     * @return Response
     */
    public function create()
    {
        return view('persona_dirs.create');
    }
  /**
     * Show the form for creating a new PersonaDir.
     *
     * @return Response
     */
    public function personaubicacionescreate()
    {

        //$countries = $this->countriesRepository->all();
        $continentes = $this->countriesRepository->gContinentes();
        $paises= $this->countriesRepository->gPaises('América'); 
        $estados= $this->codPoRepository->gEstados('México');       
        $ciudades= $this->codPoRepository->gCiudades('Ciudad de México');    
        $municipios= $this->codPoRepository->gMunicipios('Ciudad de México');  
        $ubicaciones= $this->locationRepository->gUbicaciones();
        //dd($municipios);
        //$asentamientos= $this->codPoRepository->gAsentamientos();                 
        return view('personaubicaciones.create')
        ->with('continentes', $continentes)
        ->with('paises', $paises)
        ->with('estados', $estados)
        ->with('ciudades', $ciudades)
        ->with('municipios', $municipios)
        ->with('ubicaciones', $ubicaciones);
    }


//*************************************************************************************************


    /**
     * Store a newly created PersonaDir in storage.
     *
     * @param CreatePersonaDirRequest $request
     *
     * @return Response
     */
    public function store(CreatePersonaDirRequest $request)
    {
        $input = $request->all();

        $personaDir = $this->personaDirRepository->create($input);

        Flash::success('Persona Dir saved successfully.');

        return redirect(route('personaDirs.index'));
    }

    /**
     * Store a newly created PersonaDir in storage.
     *
     * @param CreatePersonaDirRequest $request
     *
     * @return Response
     */
    public function personaubicacionestore(CreatePersonaDirRequest $request)
    {
        $input = $request->all();

        $personaDir = $this->personaDirRepository->create($input);

        Flash::success('Persona Dir saved successfully.');

        return redirect(route('personaubicaciones.index'));
    }

/*************************************************************************************************

    /**
     * Display the specified PersonaDir.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $personaDir = $this->personaDirRepository->findWithoutFail($id);

        if (empty($personaDir)) {
            Flash::error('Persona Dir not found');

            return redirect(route('personaDirs.index'));
        }

        return view('persona_dirs.show')->with('personaDir', $personaDir);
    }
    /**
     * Muestra los datos de una ubicacion de una persona
     *
     * @param  int $id
     *
     * @return Response
     */
    public function personaubicacionesshow($id)
    {
       
        // $personaDir = $this->personaDirRepository->findWithoutFail($id);

        // if (empty($personaDir)) {
        //     Flash::error('Persona Dir not found');

        //     return redirect(route('personaubicaciones.index'));
        // }
        
        $personaDir=$this->personaDirRepository->gUbicacion( $id);
        // convierte el array a una coleccion  y obtiene el primero debes agregar el name space
        // use Illuminate\Support\Collection as Collection;   
        //$personaDir=Collection::make($personaDir)->first();   
        //
        //head() - obtiene el primer elemento de un array                
        $personaDir=head($personaDir);
        //dd(head($personaDir));   
        //dd($personaDir);
        return view('personaubicaciones.show')->with('personaDir', $personaDir);
    }

//*************************************************************************************

    /**
     * Exporta los datos de ubicaciones de una persona
     *
     * @param  int $id
     *
     * @return Response
     */
    public function personaubicacionesexcell(Request $request)
    {
    // Toma Variable de session con id de la persona
    $personaexpid = Session('personaexpid');
    $personaname = Session('nomexp');
    // Consulta todas las ubicaciones de la persona 
    $personaDirs=$this->personaDirRepository->gUbicacionesXLS( $personaexpid);

// Lik: https://phpspreadsheet.readthedocs.io/en/develop/topics/
// reading-and-writing-to-file/#generating-excel-files-from-templates-read-modify-write
// Link samples: https://github.com/PHPOffice/PhpSpreadsheet/tree/develop/samples/Basic

// Crear nuevo objeto  Spreadsheet 
//$spreadsheet = new Spreadsheet();
 
// Abrir un archivo o template

//Esta ruta es relativa y funciono perfectamente en local y hostinger ojo con la "/" 
//  xlstemplates/Ubicaciones_template.xlsx
$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load(
env('FOLDER_XLSTEMPLATES').'/Ubicaciones_template.xlsx');



// Establecer propiedades del documento
$spreadsheet->getProperties()->setCreator('InfoCret')
    ->setLastModifiedBy('InfoCret')
    ->setTitle('Kali Ubicaciones')
    ->setSubject('Ubicaciones de una persona')
    ->setDescription('Lista de ubicaciones de una persona.')
    ->setKeywords('Ubicaciones')
    ->setCategory('Lista de ubicaciones');

    $worksheet = $spreadsheet->getActiveSheet();

        $valor=$personaname;
        $cref='C2';
        $worksheet->getCell($cref)->setValue($valor);

    $i=4;
    foreach ($personaDirs as $ub){
    //    // echo $ub->dir;        
        $valor=$ub->nombre;
        $cref='A'.$i;        
        $worksheet->getCell($cref)->setValue($valor);

        $valor=$ub->dir;
        $cref='B'.$i;        
        $worksheet->getCell($cref)->setValue($valor);

        $valor=$ub->linkmapa;
        $cref='C'.$i;        
        $worksheet->getCell($cref)->setValue($valor);
        //$worksheet->getCell('A1')->setValue('John');
        $i=$i+1;
        $valor='Referencia1:';
        $cref='A'.$i;        
        $worksheet->getCell($cref)->setValue($valor);    

        $valor=$ub->referencia1;
        $cref='B'.$i;        
        $worksheet->getCell($cref)->setValue($valor);
    
        $i=$i+1;
        $valor='Referencia2:';
        $cref='A'.$i;        
        $worksheet->getCell($cref)->setValue($valor);    

        $valor=$ub->referencia2;
        $cref='B'.$i;        
        $worksheet->getCell($cref)->setValue($valor);

        $i=$i+1;
        $valor='Observaciones:';
        $cref='A'.$i;        
        $worksheet->getCell($cref)->setValue($valor);    

        $valor=$ub->observaciones;
        $cref='B'.$i;        
        $worksheet->getCell($cref)->setValue($valor);



        $i=$i+2; // $i++;   
     };
        $i=$i+3; // $i++;   
        $valor='Copyright © 2018 InfoCret. All rights reserved';
        $cref='B'.$i;        
        $worksheet->getCell($cref)->setValue($valor);

// *********** Las siguientes 2 lineas guardan el archivo en una carpeta del servidos ********
//$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
//$writer->save('C:\laragon\www\testc1\public\xlstemplates\write.xlsx');
// *******************************************************************************************
//dd('saved');


// Rename worksheet
//$spreadsheet->getActiveSheet()->setTitle('Ubicaciones');
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
//$spreadsheet->setActiveSheetIndex(0);


// *********** Las siguientes  lineas gereran archivo para descargar *****************************
// Redirect output to a client’s web browser (Xls)
header('Content-Disposition: attachment;filename="ubicaciones.xlsx"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
 header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
 header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
 header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
 header('Pragma: public'); // HTTP/1.0

 $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
 $writer->save('php://output');

    }



//*****************************************************************************************

  /**
     * Exportalos datos de una ubicacion de una persona a un archivo PDF
     *
     * @param  int $id
     *
     * @return Response
     */
    public function personaubicacionespdfshow($id)
    {

        $personaDir=$this->personaDirRepository->gUbicacion( $id);
                  
        $personaDir=head($personaDir);   

        //return view('personaubicaciones.showpdf')->with('personaDir', $personaDir);   
        //$pdf = PDF::loadView('personaubicaciones.showpdf');
       
        $pdf = PDF::loadView('personaubicaciones.showpdf', compact('personaDir'));
        return $pdf->download('ubicacion.pdf');
    }


/*************************************************************************************************
    /**
     * Show the form for editing the specified PersonaDir.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $personaDir = $this->personaDirRepository->findWithoutFail($id);

        if (empty($personaDir)) {
            Flash::error('Persona Dir not found');

            return redirect(route('personaDirs.index'));
        }

        return view('persona_dirs.edit')->with('personaDir', $personaDir);
    }

        /**
     * Show the form for editing the specified PersonaDir.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function personaubicacionesedit($id)
    {
        $personaDir = $this->personaDirRepository->findWithoutFail($id);

        if (empty($personaDir)) {
            Flash::error('Registro no encontrado');

            return redirect(route('personaubicaciones.index'));
        }
        // foreach ($continentes as $key => $value) {
        //     echo $key . ' => ' . $value . '<br>';
        // }
        // dd($personaDir);               
        $CodPo = $this->codPoRepository->findWithoutFail($personaDir->codpo_id);//"codpo_id" => 8752 
        $ubicaciones= $this->locationRepository->all()->where('nombre','<>','');
        $continentes = $this->countriesRepository->gContinentes()->toarray();        
        $cont = $this->countriesRepository->gContinente($personaDir->pais); 
        $paises= $this->countriesRepository->gPaises2($cont);             
        $estados= $this->codPoRepository->gEstados2($personaDir->pais);       
        $ciudades= $this->codPoRepository->gCiudades2($CodPo->estado);               
        $municipios= $this->codPoRepository->gMunicipios2($CodPo->ciudad);  
        $asentamientos= $this->codPoRepository->gAsentamientos3($CodPo->municipio);  
          
        return view('personaubicaciones.edit')       
        ->with('personaDir', $personaDir)
        ->with('CodPo',$CodPo)
        ->with('ubicaciones', $ubicaciones)
        ->with('cont',$cont)
        ->with('continentes', $continentes)
        ->with('paises', $paises)
        ->with('estados', $estados)
        ->with('ciudades', $ciudades)
        ->with('municipios', $municipios)
        ->with('asentamientos',$asentamientos);
        
    }

/*************************************************************************************************
    /**
     * Update the specified PersonaDir in storage.
     *
     * @param  int              $id
     * @param UpdatePersonaDirRequest $request
     *
     * @return Response
     */
    public function personaubicacionesupdate($id, UpdatePersonaDirRequest $request)
    {
        $personaDir = $this->personaDirRepository->findWithoutFail($id);

        if (empty($personaDir)) {
            Flash::error('Registro no encontrado');

            return redirect(route('personaubicaciones.index'));
        }

        $personaDir = $this->personaDirRepository->update($request->all(), $id);
//dd($personaDir);
        Flash::success('Registro actualizado.');

        return redirect(route('personaubicaciones.index'));
    }
  /**
     * Update the specified PersonaDir in storage.
     *
     * @param  int              $id
     * @param UpdatePersonaDirRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePersonaDirRequest $request)
    {
        $personaDir = $this->personaDirRepository->findWithoutFail($id);

        if (empty($personaDir)) {
            Flash::error('Persona Dir not found');

            return redirect(route('personaDirs.index'));
        }

        $personaDir = $this->personaDirRepository->update($request->all(), $id);

        Flash::success('Persona Dir updated successfully.');

        return redirect(route('personaDirs.index'));
    }

/*************************************************************************************************

    /**
     * Remove the specified PersonaDir from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function personaubicacionesdestroy($id)
    {
        $personaDir = $this->personaDirRepository->findWithoutFail($id);

        if (empty($personaDir)) {
            Flash::error('Persona Dir not found');

            return redirect(route('personaubicaciones.index'));
        }

        $this->personaDirRepository->delete($id);

        Flash::success('Persona Dir deleted successfully.');

        return redirect(route('personaubicaciones.index'));
    }



    /**
     * Remove the specified PersonaDir from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $personaDir = $this->personaDirRepository->findWithoutFail($id);

        if (empty($personaDir)) {
            Flash::error('Persona Dir not found');

            return redirect(route('personaDirs.index'));
        }

        $this->personaDirRepository->delete($id);

        Flash::success('Persona Dir deleted successfully.');

        return redirect(route('personaDirs.index'));
    }

/*************************************************************************************************

    /**
     * Muestra ubicaciones de una persona.
     *
     * @param  int $id      // Recibe el id de la persona
     *
     * @return Response     // Array de ubicaciones
     */
    // public function getUbicaciones($id)
    // {

    //     $ubicaciones = $this->personaDirRepository->gUbicaciones($id);

    //     if (empty($ubicaciones)) {
    //         Flash::error('No se encontraron ubicaciones para esta persona');

    //         return redirect(route('personaubicaciones.index'));
    //     }

    //     return view('personaubicaciones.index')->with('ubicaciones', $ubicaciones);
    // }    
}
