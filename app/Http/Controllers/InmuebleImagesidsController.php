<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateInmuebleImagesidsRequest;
use App\Http\Requests\UpdateInmuebleImagesidsRequest;
use App\Repositories\InmuebleImagesidsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class InmuebleImagesidsController extends AppBaseController
{
    /** @var  InmuebleImagesidsRepository */
    private $inmuebleImagesidsRepository;

    public function __construct(InmuebleImagesidsRepository $inmuebleImagesidsRepo)
    {
        $this->inmuebleImagesidsRepository = $inmuebleImagesidsRepo;
    }

    /**
     * Display a listing of the InmuebleImagesids.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->inmuebleImagesidsRepository->pushCriteria(new RequestCriteria($request));
        $inmuebleImagesids = $this->inmuebleImagesidsRepository->all();

        return view('inmueble_imagesids.index')
            ->with('inmuebleImagesids', $inmuebleImagesids);
    }

    /**
     * Show the form for creating a new InmuebleImagesids.
     *
     * @return Response
     */
    public function create()
    {
        return view('inmueble_imagesids.create');
    }

    /**
     * Store a newly created InmuebleImagesids in storage.
     *
     * @param CreateInmuebleImagesidsRequest $request
     *
     * @return Response
     */
    public function store(CreateInmuebleImagesidsRequest $request)
    {
        $input = $request->all();

        $inmuebleImagesids = $this->inmuebleImagesidsRepository->create($input);

        Flash::success('Inmueble Imagesids saved successfully.');

        return redirect(route('inmuebleImagesids.index'));
    }

    /**
     * Display the specified InmuebleImagesids.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $inmuebleImagesids = $this->inmuebleImagesidsRepository->findWithoutFail($id);

        if (empty($inmuebleImagesids)) {
            Flash::error('Inmueble Imagesids not found');

            return redirect(route('inmuebleImagesids.index'));
        }

        return view('inmueble_imagesids.show')->with('inmuebleImagesids', $inmuebleImagesids);
    }

    /**
     * Show the form for editing the specified InmuebleImagesids.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $inmuebleImagesids = $this->inmuebleImagesidsRepository->findWithoutFail($id);

        if (empty($inmuebleImagesids)) {
            Flash::error('Inmueble Imagesids not found');

            return redirect(route('inmuebleImagesids.index'));
        }

        return view('inmueble_imagesids.edit')->with('inmuebleImagesids', $inmuebleImagesids);
    }

    /**
     * Update the specified InmuebleImagesids in storage.
     *
     * @param  int              $id
     * @param UpdateInmuebleImagesidsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateInmuebleImagesidsRequest $request)
    {
        $inmuebleImagesids = $this->inmuebleImagesidsRepository->findWithoutFail($id);

        if (empty($inmuebleImagesids)) {
            Flash::error('Inmueble Imagesids not found');

            return redirect(route('inmuebleImagesids.index'));
        }

        $inmuebleImagesids = $this->inmuebleImagesidsRepository->update($request->all(), $id);

        Flash::success('Inmueble Imagesids updated successfully.');

        return redirect(route('inmuebleImagesids.index'));
    }

    /**
     * Remove the specified InmuebleImagesids from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $inmuebleImagesids = $this->inmuebleImagesidsRepository->findWithoutFail($id);

        if (empty($inmuebleImagesids)) {
            Flash::error('Inmueble Imagesids not found');

            return redirect(route('inmuebleImagesids.index'));
        }
        
        $deletefile = 'box/'.env('FOLDER_IMGINMU').'/'.$inmuebleImagesids->filename; 

        $this->inmuebleImagesidsRepository->delete($id);

        if (file_exists($deletefile)) {
            
                if (unlink($deletefile)) {
                    Flash::success(
                    'Se elimino el registro y el archivo de imagen.');
                }
                else{                  
                
                    Flash::success(
                    'Se elimino el registro, NO se elimino archivo cargado:'.$deletefile);
               }   
            }
        else{
             Flash::success(
                'Se elimino el registro. NO se encontro archivo:'.$deletefile);
        }

       // Flash::success('Inmueble Imagesids deleted successfully.');

        return redirect(route('inmuebleImagesids.index'));
    }
}
