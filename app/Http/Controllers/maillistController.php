<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatemaillistRequest;
use App\Http\Requests\UpdatemaillistRequest;
use App\Repositories\maillistRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class maillistController extends AppBaseController
{
    /** @var  maillistRepository */
    private $maillistRepository;

    public function __construct(maillistRepository $maillistRepo)
    {
        $this->maillistRepository = $maillistRepo;
    }

    /**
     * Display a listing of the maillist.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->maillistRepository->pushCriteria(new RequestCriteria($request));
        $maillists = $this->maillistRepository->all();

        return view('maillists.index')
            ->with('maillists', $maillists);
    }

    /**
     * Show the form for creating a new maillist.
     *
     * @return Response
     */
    public function create()
    {
        return view('maillists.create');
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

        $maillist = $this->maillistRepository->create($input);

        Flash::success('Maillist saved successfully.');

        return redirect(route('maillists.index'));
    }

    /**
     * Display the specified maillist.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $maillist = $this->maillistRepository->findWithoutFail($id);

        if (empty($maillist)) {
            Flash::error('Maillist not found');

            return redirect(route('maillists.index'));
        }

        return view('maillists.show')->with('maillist', $maillist);
    }

    /**
     * Show the form for editing the specified maillist.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $maillist = $this->maillistRepository->findWithoutFail($id);

        if (empty($maillist)) {
            Flash::error('Maillist not found');

            return redirect(route('maillists.index'));
        }

        return view('maillists.edit')->with('maillist', $maillist);
    }

    /**
     * Update the specified maillist in storage.
     *
     * @param  int              $id
     * @param UpdatemaillistRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatemaillistRequest $request)
    {
        $maillist = $this->maillistRepository->findWithoutFail($id);

        if (empty($maillist)) {
            Flash::error('Maillist not found');

            return redirect(route('maillists.index'));
        }

        $maillist = $this->maillistRepository->update($request->all(), $id);

        Flash::success('Maillist updated successfully.');

        return redirect(route('maillists.index'));
    }

    /**
     * Remove the specified maillist from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $maillist = $this->maillistRepository->findWithoutFail($id);

        if (empty($maillist)) {
            Flash::error('Maillist not found');

            return redirect(route('maillists.index'));
        }

        $this->maillistRepository->delete($id);

        Flash::success('Maillist deleted successfully.');

        return redirect(route('maillists.index'));
    }
}
