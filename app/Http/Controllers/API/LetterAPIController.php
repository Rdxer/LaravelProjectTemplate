<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateLetterAPIRequest;
use App\Http\Requests\API\UpdateLetterAPIRequest;
use App\Models\Letter;
use App\Repositories\LetterRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class LetterController
 * @package App\Http\Controllers\API
 */

class LetterAPIController extends AppBaseController
{
    /** @var  LetterRepository */
    private $letterRepository;

    public function __construct(LetterRepository $letterRepo)
    {
        $this->letterRepository = $letterRepo;
    }

    /**
     * Display a listing of the Letter.
     * GET|HEAD /letters
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->letterRepository->pushCriteria(new RequestCriteria($request));
        $this->letterRepository->pushCriteria(new LimitOffsetCriteria($request));
        $letters = $this->letterRepository->all();

        return $this->sendResponse($letters->toArray(), 'Letters retrieved successfully');
    }

    /**
     * Store a newly created Letter in storage.
     * POST /letters
     *
     * @param CreateLetterAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateLetterAPIRequest $request)
    {
        $input = $request->all();

        $letters = $this->letterRepository->create($input);

        return $this->sendResponse($letters->toArray(), 'Letter saved successfully');
    }

    /**
     * Display the specified Letter.
     * GET|HEAD /letters/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Letter $letter */
        $letter = $this->letterRepository->findWithoutFail($id);

        if (empty($letter)) {
            return $this->sendError('Letter not found');
        }

        return $this->sendResponse($letter->toArray(), 'Letter retrieved successfully');
    }

    /**
     * Update the specified Letter in storage.
     * PUT/PATCH /letters/{id}
     *
     * @param  int $id
     * @param UpdateLetterAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateLetterAPIRequest $request)
    {
        $input = $request->all();

        /** @var Letter $letter */
        $letter = $this->letterRepository->findWithoutFail($id);

        if (empty($letter)) {
            return $this->sendError('Letter not found');
        }

        $letter = $this->letterRepository->update($input, $id);

        return $this->sendResponse($letter->toArray(), 'Letter updated successfully');
    }

    /**
     * Remove the specified Letter from storage.
     * DELETE /letters/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Letter $letter */
        $letter = $this->letterRepository->findWithoutFail($id);

        if (empty($letter)) {
            return $this->sendError('Letter not found');
        }

        $letter->delete();

        return $this->sendResponse($id, 'Letter deleted successfully');
    }
}
