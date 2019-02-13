<?php

namespace App\Http\Controllers\v1;

use App\Http\Requests\CandidatesCreateRequest;
use App\Http\Requests\CandidatesLoginRequest;
use App\Repositories\v1\CandidatesRepositories;
use App\Repositories\v1\SubscriptionRepositories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CandidatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(CandidatesRepositories::GetAll());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CandidatesCreateRequest $request)
    {
        return response()->json(CandidatesRepositories::Create($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(CandidatesRepositories::GetById($id)->first());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return response()->json(CandidatesRepositories::Upadate($request->all(), $id)->first());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return response()->json(CandidatesRepositories::Delete($id));
    }

    public function getAllSubscriptionByCandidates(Request $request)
    {
        $candidates = CandidatesRepositories::GetById($request->get('candidates_id'))->first();
        $subscription = SubscriptionRepositories::getAllSubscriptionByCandidatesId($request->get('candidates_id'));
        return ['candidates' => $candidates, 'subscription' => $subscription];
    }

    public function login(CandidatesLoginRequest $request)
    {
        $Token = CandidatesRepositories::Login($request->get('email'),$request->get('password'));
        return $Token !== null
            ? response()->json((string) $Token)
            : response()->json("unauthorized",401)
        ;
    }


    public function showCandidate(Request $request)
    {
        return response()->json(CandidatesRepositories::GetById($request->get('candidates_id'))->first());
    }

    public function updateCandidate(Request $request)
    {
        return response()->json(CandidatesRepositories::Upadate($request->except('candidates_id'),$request->get('candidates_id'))->first());
    }

}
