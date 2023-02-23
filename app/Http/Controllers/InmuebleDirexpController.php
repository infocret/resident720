<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateInmuebleDirRequest;
use App\Http\Requests\UpdateInmuebleDirRequest;
use App\Repositories\InmuebleDirRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
// paar exportar a PDF
use Barryvdh\DomPDF\Facade as PDF;
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

class InmuebleDirexpController extends AppBaseController
{
    /** @var  InmuebleDirRepository */
    private $inmuebleDirexpRepository;

    public function __construct(
    	InmuebleDirRepository $inmuebleDirRepo,
    	countriesRepository $countriesRepo,
        CodPoRepository $codPoRepo,
        locationRepository $locationRepo)  
    {
        $this->inmuebleDirRepository = $inmuebleDirRepo;
        $this->countriesRepository = $countriesRepo;    // se agrego
        $this->codPoRepository = $codPoRepo;            // se agrego
        $this->locationRepository = $locationRepo;     // se agrego
    }

 /**     
     * Muestra direcciones de un inmueble
     *
     * @param Request $request
     * @return Response
     */
    public function inmubicacionesindex(Request $request,$inmuid)
    {
        //Request $request
        //$propertyexpid = Session('propertyexpid');
        //$this->InmuebleDirRepository->pushCriteria(new RequestCriteria($request));
        //$inmuDirs = $this->InmuebleDirRepository->all();
        $inmuDirs=$this->inmuebleDirRepository->gUbicaciones($inmuid);
        return view('inmueble_dirsexp.index')
            ->with('inmuDirs', $inmuDirs)
            ->with('inmuid',$inmuid);
    }

//*********************************************************************
 /**
     * Muestra los datos de una ubicacion de un inmueble
     *
     * @param  int $id
     *
     * @return Response
     */
    public function inmubicacionesshow($id,$inmuid)
    {        
        $inmuDir=$this->inmuebleDirRepository->gUbicacion($id);
        // convierte el array a una coleccion  y obtiene el primero debes agregar el name space
        // use Illuminate\Support\Collection as Collection;   
        //$inmuDir=Collection::make($inmuDir)->first();   
        //
        //head() - obtiene el primer elemento de un array                
        $inmuDir=head($inmuDir);        
        //dd($inmuDir);
        return view('inmueble_dirsexp.show')
        ->with('inmuDir', $inmuDir)
        ->with('inmuid',$inmuid);
    }


//*********************************************************************
 /**
     * Show the form for creating a new inmueble dir.
     *
     * @return Response
     */
    public function inmubicacionescreate($inmuid)
    {

        //$countries = $this->countriesRepository->all();
        $continentes = $this->countriesRepository->gContinentes();
        $paises= $this->countriesRepository->gPaises('América'); 
        $estados= $this->codPoRepository->gEstados('México');       
        $ciudades= $this->codPoRepository->gCiudades('Ciudad de México');    
        $municipios= $this->codPoRepository->gMunicipios('Ciudad de México');  
        $ubicaciones= $this->locationRepository->gUbicaciones();
        //$asentamientos= $this->codPoRepository->gAsentamientos();                 
        return view('inmueble_dirsexp.create')
        ->with('continentes', $continentes)
        ->with('paises', $paises)
        ->with('estados', $estados)
        ->with('ciudades', $ciudades)
        ->with('municipios', $municipios)
        ->with('ubicaciones', $ubicaciones)
        ->with('inmuid',$inmuid);
    }

//*********************************************************************
 /**
     * Store a newly created inmuebleDir in storage.
     *
     * @param CreateInmuebleDirRequest $request
     *
     * @return Response
     */
    public function inmubicacionesstore(CreateInmuebleDirRequest $request)
    {
        $input = $request->all();
        $inmuid =$request->input('inmueble_id') ;

        $inmuDir = $this->inmuebleDirRepository->create($input);

        Flash::success('Inmueble Dir saved successfully.');

        return redirect(route('inmubicaciones.index',$inmuid));
    }
//*********************************************************************
        /**
     * Show the form for editing the specified inmuebleDir.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function personaubicacionesedit($id,$inmuid)
    {
        $inmuDir = $this->inmuebleDirRepository->findWithoutFail($id);

        if (empty($inmuDir)) {
            Flash::error('Registro no encontrado');

            return redirect(route('inmubicaciones.index'));
        }
        // foreach ($continentes as $key => $value) {
        //     echo $key . ' => ' . $value . '<br>';
        // }
        // dd($inmuDir);               
        $CodPo = $this->codPoRepository->findWithoutFail($inmuDir->codpo_id);//"codpo_id" => 8752 
        $ubicaciones= $this->locationRepository->all()->where('nombre','<>','');
        $continentes = $this->countriesRepository->gContinentes()->toarray();        
        $cont = $this->countriesRepository->gContinente($inmuDir->pais); 
        $paises= $this->countriesRepository->gPaises2($cont);             
        $estados= $this->codPoRepository->gEstados2($inmuDir->pais);       
        $ciudades= $this->codPoRepository->gCiudades2($CodPo->estado);               
        $municipios= $this->codPoRepository->gMunicipios2($CodPo->ciudad);  
        $asentamientos= $this->codPoRepository->gAsentamientos3($CodPo->municipio);  
          
        return view('inmueble_dirsexp.edit')       
        ->with('inmuDir', $inmuDir)
        ->with('CodPo',$CodPo)
        ->with('ubicaciones', $ubicaciones)
        ->with('cont',$cont)
        ->with('continentes', $continentes)
        ->with('paises', $paises)
        ->with('estados', $estados)
        ->with('ciudades', $ciudades)
        ->with('municipios', $municipios)
        ->with('asentamientos',$asentamientos)
        ->with('inmuid',$inmuid);
        
    }

//*********************************************************************
  /**
     * Update the specified InmuebleDir in storage.
     *
     * @param  int              $id
     * @param UpdatePersonaDirRequest $request
     *
     * @return Response
     */
    public function inmubicacionesupdate($id, UpdateInmuebleDirRequest $request)
    {
        $inmuDir = $this->inmuebleDirRepository->findWithoutFail($id);

        if (empty($inmuDir)) {
            Flash::error('Registro no encontrado');

            return redirect(route('inmubicaciones.index'));
        }

        $inmuDir = $this->inmuebleDirRepository->update($request->all(), $id);
        $inmuid =$request->input('inmueble_id') ;
        Flash::success('Registro actualizado.');

        return redirect(route('inmubicaciones.index',$inmuid));
    }
//*********************************************************************

    /**
     * Remove the specified InmuebleDir from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function inmubicacionesdestroy($id,$inmuid)
    {
        $inmuDir = $this->inmuebleDirRepository->findWithoutFail($id);

        if (empty($inmuDir)) {
            Flash::error('Registro no encontrado');

            return redirect(route('inmubicaciones.index'));
        }

        $this->inmuebleDirRepository->delete($id);

        Flash::success('Registro eliminado.');

        return redirect(route('inmubicaciones.index',$inmuid));
    }

//************************************************************************
/**
     * Exportalos datos de una ubicacion de un inmueble a un archivo PDF
     *
     * @param  int $id
     *
     * @return Response
     */
    public function inmubicacionespdfshow($id)
    {

        $inmuDir=$this->inmuebleDirRepository->gUbicacion($id);
                  
        $inmuDir=head($inmuDir);   
        //dd($inmuDir);
        //return view('personaubicaciones.showpdf')->with('inmuDir', $inmuDir);   
        //$pdf = PDF::loadView('personaubicaciones.showpdf');
       
        $pdf = PDF::loadView('inmueble_dirsexp.showpdf', compact('inmuDir'));
        return $pdf->download('inmubicacion.pdf');
    }

//************************************************************************
    /**
     * Exporta los datos de ubicaciones de una persona
     *
     * @param  int $id
     *
     * @return Response
     */
    public function inmubicacionesexcell(Request $request,$inmuid)
    {
    // Toma Variable de session con id de la persona
    $propertyexpid = $inmuid;//Session('propertyexpid');
    $propnomexp = "nombre";//Session('propnomexp');
    // Consulta todas las ubicaciones de la persona 
    $inmuDirs=$this->inmuebleDirRepository->gUbicacionesXLS( $propertyexpid);

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
    ->setDescription('Lista de ubicaciones de un inmueble.')
    ->setKeywords('Ubicaciones')
    ->setCategory('Lista de ubicaciones');

    $worksheet = $spreadsheet->getActiveSheet();

        $valor=$propnomexp;
        $cref='C2';
        $worksheet->getCell($cref)->setValue($valor);

    $i=4;
    foreach ($inmuDirs as $ub){
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
// 
//************************************************************************
//dd('saved');


// Rename worksheet
//$spreadsheet->getActiveSheet()->setTitle('Ubicaciones');
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
//$spreadsheet->setActiveSheetIndex(0);


// *********** Las siguientes  lineas gereran archivo para descargar *****************************
// Redirect output to a client’s web browser (Xls)
header('Content-Disposition: attachment;filename="imubicaciones.xlsx"');
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






}