<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatemaillistRequest;
use App\Http\Requests\UpdatemaillistRequest;
use App\Repositories\maillistRepository;
use App\Repositories\inmuebleRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class correolistcController extends AppBaseController
{
    /** @var  maillistRepository */
    private $maillistRepository;

    public function __construct(
        maillistRepository $maillistRepo,
        inmuebleRepository $inmuebleRepo)
    {
        $this->maillistRepository = $maillistRepo;
        $this->inmuebleRepository = $inmuebleRepo;
    }

    /**
     * Display a listing of the maillist.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request,$inmuid)
    {
        $this->maillistRepository->pushCriteria(new RequestCriteria($request));
        $maillists = $this->maillistRepository->gEmailList($inmuid);
        //dd($maillists);
        return view('condomcorreos.index')
            ->with('maillists', $maillists)
            ->with('inmuid', $inmuid);
    }

    /**
     * Show the form for creating a new maillist.
     *
     * @return Response
     */
    public function create($inmuid)
    {
        $unidades=$this->inmuebleRepository->gselUnidades($inmuid);
        //dd($unidades);
        //$unids =array();
        // "parent_property" => 7
        // "id" => 9
        // "inmuebletipo_id" => 2
        // "ident" => "189101"
        // "nombre" => "101"
        // "descripcion" => "Departamento 101 Vista Sol"

        // foreach ($unidades as $unidad){        
        //     array_push($unids,"'".$unidad->id."'" => $unidad->ident); 
        // }
        //  dd($unids);
        return view('condomcorreos.create')
        ->with('inmuid', $inmuid)
        ->with('unidades', $unidades);
       
    }

    /**
     * Store a newly created maillist in storage.
     *
     * @param CreatemaillistRequest $request
     *
     * @return Response
     */
    public function store(CreatemaillistRequest $request)
    {
        $input = $request->all();
        $inmuid =$request->input('condom_id') ;
        //dd($inmuid);
        $maillist = $this->maillistRepository->create($input);

        Flash::success('Correo agregado corretamente.');

        return redirect(route('correolist.index',$inmuid));
    }

    /**
     * Display the specified maillist.
     *
     * @param  int $id
     *
     * @return Response
     */
    // public function show($id)
    // {
    //     $maillist = $this->maillistRepository->findWithoutFail($id);

    //     if (empty($maillist)) {
    //         Flash::error('Maillist not found');

    //         return redirect(route('condomcorreos.index'));
    //     }

    //     return view('condomcorreos.show')->with('maillist', $maillist);
    // }

    /**
     * Show the form for editing the specified maillist.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id,$inmuid)
    {
        $maillist = $this->maillistRepository->findWithoutFail($id);

        if (empty($maillist)) {
            Flash::error('Correo no localizado');

            return redirect(route('condomcorreos.index',$inmuid));
        }

        return view('condomcorreos.edit')
        ->with('maillist', $maillist)
        ->with('inmuid', $inmuid)
        ;
    }

    /**
     * Update the specified maillist in storage.
     *
     * @param  int              $id
     * @param UpdatemaillistRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatemaillistRequest $request,$inmuid)
    {
        $maillist = $this->maillistRepository->findWithoutFail($id);

        if (empty($maillist)) {
            Flash::error('Correo no localizado');

            return redirect(route('correolist.index',$inmuid));
        }

        $maillist = $this->maillistRepository->update($request->all(), $id);

        Flash::success('Correo actualizado correctamente.');

        return redirect(route('correolist.index',$inmuid));
    }

    /**
     * Remove the specified maillist from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id,$inmuid)
    {
        $maillist = $this->maillistRepository->findWithoutFail($id);

        if (empty($maillist)) {
            Flash::error('Correo no localizado');

            return redirect(route('correolist.index'));
        }

        $this->maillistRepository->delete($id);

        Flash::success('Correo eliminado correctamente.');

        return redirect(route('correolist.index',$inmuid));
    }
}
