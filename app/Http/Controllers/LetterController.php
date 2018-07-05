<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateLetterRequest;
use App\Http\Requests\UpdateLetterRequest;
use App\Repositories\LetterRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class LetterController extends AppBaseController
{
    /** @var  LetterRepository */
    private $letterRepository;

    public function __construct(LetterRepository $letterRepo)
    {
        $this->letterRepository = $letterRepo;
    }

    /**
     * Display a listing of the Letter.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->letterRepository->pushCriteria(new RequestCriteria($request));
        $letters = $this->letterRepository->all();

        return view('letters.index')
            ->with('letters', $letters);
    }

    /**
     * Show the form for creating a new Letter.
     *
     * @return Response
     */
    public function create()
    {
        return view('letters.create');
    }

    /**
     * Store a newly created Letter in storage.
     *
     * @param CreateLetterRequest $request
     *
     * @return Response
     */
    public function store(CreateLetterRequest $request)
    {
        $input = $request->all();

        $letter = $this->letterRepository->create($input);

        Flash::success('Letter saved successfully.');

        return redirect(route('letters.index'));
    }

    /**
     * Display the specified Letter.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $letter = $this->letterRepository->findWithoutFail($id);

        if (empty($letter)) {
            Flash::error('Letter not found');

            return redirect(route('letters.index'));
        }

        return view('letters.show')->with('letter', $letter);
    }

    /**
     * Show the form for editing the specified Letter.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $letter = $this->letterRepository->findWithoutFail($id);

        if (empty($letter)) {
            Flash::error('Letter not found');

            return redirect(route('letters.index'));
        }

        return view('letters.edit')->with('letter', $letter);
    }

    /**
     * Update the specified Letter in storage.
     *
     * @param  int              $id
     * @param UpdateLetterRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateLetterRequest $request)
    {
        $letter = $this->letterRepository->findWithoutFail($id);

        if (empty($letter)) {
            Flash::error('Letter not found');

            return redirect(route('letters.index'));
        }

        $letter = $this->letterRepository->update($request->all(), $id);

        Flash::success('Letter updated successfully.');

        return redirect(route('letters.index'));
    }

    /**
     * Remove the specified Letter from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $letter = $this->letterRepository->findWithoutFail($id);

        if (empty($letter)) {
            Flash::error('Letter not found');

            return redirect(route('letters.index'));
        }

        $this->letterRepository->delete($id);

        Flash::success('Letter deleted successfully.');

        return redirect(route('letters.index'));
    }
}
