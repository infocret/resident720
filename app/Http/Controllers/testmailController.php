<?php

namespace App\Http\Controllers;

// use App\Http\Requests\CreatemaillistRequest;
// use App\Http\Requests\UpdatemaillistRequest;
// use App\Repositories\maillistRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;   // Fachada Mail

use App\Mail\DemoEmail;                // Llamada a Clase  DemoEmail (Maileable) HTML

use App\Mail\DemorecipEmail;           // Llamada a Clase  RECIBO DemoEmail (Maileable) HTML

use App\Mail\DemoMd;                    // Llamada a Clase  DemoMd (MarkDown)

use \Milon\Barcode\DNS1D;
use \Milon\Barcode\DNS2D;   

// use Flash;
// use Prettus\Repository\Criteria\RequestCriteria;
// use Response;

class testmailController extends AppBaseController
{
    /** @var  maillistRepository */
    // private $maillistRepository;

    // public function __construct(maillistRepository $maillistRepo)
    // {
    //     $this->maillistRepository = $maillistRepo;
    // }

//******************************************************************************************************

public function index(Request $request)   {
        
    return view('emails.index');
}

public function send1(Request $request)
{
    //dd($request->tfrom);

    //Crea el objeto que se usara para la informacion y envio de correo (from,name,to,subject)
    $datmail = new \stdClass();
        $datmail->sfrom = $request->tfrom;
        $datmail->name = $request->tname;
        $datmail->sto = $request->tto;
        $datmail->subj = $request->tsub;
    
    // obtiene valor de objeto cuya key es sfrom
    //dd($datmail->sfrom);
    
    // Crea array que se usara para la informacion y envio de correo (from,name,to,subject)
    // $datmail = array(
    //     "sfrom" => $request->tfrom,
    //     "name"  => $request->tname,
    //     "sto"   => $request->tto,
    //     "subj"  => $request->tsub
    // );
    
    // obtiene el valor de el array asociativo cuya llave es 'sfrom'
    //dd($datmail['sfrom']);  

    //Crea array que pasa variables de datos a la vista que arma el cuerpo o contenido del correo
   $dattext=array(
        "sfrom"  => $request->tfrom,
        "dato1" => $request->tmsg,
        "dato2" => "InfoCret"
    );

    // obtiene el valor de el array asociativo cuya llave es 'sfrom'
    //dd($dattext['sfrom']);  

    // envia el correo usando el objeto $dattext
    Mail::send ('emails.test',$dattext, function($message) use($datmail) {
    $message->from($datmail->sfrom,$datmail->name);
    $message->to($datmail->sto);
    $message->subject($datmail->subj);
        });

    // envia el correo usando el array $dattext
    // Mail::send ('emails.test',$dattext, function($message) use($datmail) {
    // $message->from($datmail['sfrom'],$datmail['name']);
    // $message->to($datmail['sto']);
    // $message->subject($datmail['subj']);
    //     });

    return "correo enviado!";
}
//******************************************************************************************************
    public function index2(Request $request)   {
        
        return view('emails.index2');
    }


    public function send2(Request $request)
    {        

    //dd($request->tfrom);

    //Crea el objeto que se usara para la informacion y envio de correo (from,name,to,subject)
    $datmail = new \stdClass();
        $datmail->sfrom = $request->tfrom;
        $datmail->sname = $request->tname;
        $datmail->sto = $request->tto;
        $datmail->subj = $request->tsub;
        $datmail->smsg = $request->tmsg;
        $datmail->dat1 = "InfoCret";
    
    // obtiene valor de objeto cuya key es sfrom
    //dd($datmail->sfrom);
    
        Mail::to($datmail->sto)->send(new DemoEmail($datmail));

        return "correo enviado!";

    }
//******************************************************************************************************
    public function index3(Request $request)   {
        
        return view('emails.index3');
    }

 public function send3(Request $request)
    {       

    //dd($request->tfrom);

    //Crea el objeto o clase que se usara para la informacion y envio de correo (from,name,to,subject)
    $datmail = new \stdClass();
        $datmail->sfrom = $request->tfrom;
        $datmail->sname = $request->tname;
        $datmail->sto = $request->tto;
        $datmail->subj = $request->tsub;
        $datmail->smsg = $request->tmsg;
        $datmail->dat1 = "InfoCret";

        //dd($datmail);
    
    // obtiene valor de objeto cuya key es sfrom
    //dd($datmail->sfrom);    
  
        Mail::to($datmail->sto)
            //->cc('julio_buendia@yahoo.com.mx')
            //->bcc('OtrocorreoQcorreo.com')
            ->send(new DemoMd($datmail));

        return "correo enviado!";
    }

//******************************************************************************************************
 
    public function index4(Request $request)   {
        
        return view('emails.index4');
    }


    public function send4(Request $request)
    {        

    //dd($request->tfrom);

    //Crea el objeto que se usara para la informacion y envio de correo (from,name,to,subject)
    $datmail = new \stdClass();
        $datmail->sfrom = $request->tfrom;
        $datmail->sname = $request->tname;
        $datmail->sto = $request->tto;
        $datmail->subj = $request->tsub;
        $datmail->smsg = $request->tmsg;
        $datmail->dat1 = "InfoCret";
    
    // obtiene valor de objeto cuya key es sfrom
    //dd($datmail->sfrom);
    
        Mail::to($datmail->sto)->send(new DemorecipEmail($datmail));

        return "correo enviado!";

    }
//******************************************************************************************************
    public function barcode(Request $request)   {
        // $barra = new DNS1D();

        return view('emails.barcode');
        //->with('barra', $barra);
    }




    // /**
    //  * Show the form for creating a new maillist.
    //  *
    //  * @return Response
    //  */
    // public function create()
    // {
    //     return view('maillists.create');
    // }

    // /**
    //  * Store a newly created maillist in storage.
    //  *
    //  * @param CreatemaillistRequest $request
    //  *
    //  * @return Response
    //  */
    // public function store(CreatemaillistRequest $request)
    // {
    //     $input = $request->all();

    //     $maillist = $this->maillistRepository->create($input);

    //     Flash::success('Maillist saved successfully.');

    //     return redirect(route('maillists.index'));
    // }

    // /**
    //  * Display the specified maillist.
    //  *
    //  * @param  int $id
    //  *
    //  * @return Response
    //  */
    // public function show($id)
    // {
    //     $maillist = $this->maillistRepository->findWithoutFail($id);

    //     if (empty($maillist)) {
    //         Flash::error('Maillist not found');

    //         return redirect(route('maillists.index'));
    //     }

    //     return view('maillists.show')->with('maillist', $maillist);
    // }

    // /**
    //  * Show the form for editing the specified maillist.
    //  *
    //  * @param  int $id
    //  *
    //  * @return Response
    //  */
    // public function edit($id)
    // {
    //     $maillist = $this->maillistRepository->findWithoutFail($id);

    //     if (empty($maillist)) {
    //         Flash::error('Maillist not found');

    //         return redirect(route('maillists.index'));
    //     }

    //     return view('maillists.edit')->with('maillist', $maillist);
    // }

    // /**
    //  * Update the specified maillist in storage.
    //  *
    //  * @param  int              $id
    //  * @param UpdatemaillistRequest $request
    //  *
    //  * @return Response
    //  */
    // public function update($id, UpdatemaillistRequest $request)
    // {
    //     $maillist = $this->maillistRepository->findWithoutFail($id);

    //     if (empty($maillist)) {
    //         Flash::error('Maillist not found');

    //         return redirect(route('maillists.index'));
    //     }

    //     $maillist = $this->maillistRepository->update($request->all(), $id);

    //     Flash::success('Maillist updated successfully.');

    //     return redirect(route('maillists.index'));
    // }

    // /**
    //  * Remove the specified maillist from storage.
    //  *
    //  * @param  int $id
    //  *
    //  * @return Response
    //  */
    // public function destroy($id)
    // {
    //     $maillist = $this->maillistRepository->findWithoutFail($id);

    //     if (empty($maillist)) {
    //         Flash::error('Maillist not found');

    //         return redirect(route('maillists.index'));
    //     }

    //     $this->maillistRepository->delete($id);

    //     Flash::success('Maillist deleted successfully.');

    //     return redirect(route('maillists.index'));
    // }
}
