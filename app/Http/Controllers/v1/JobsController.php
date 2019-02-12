<?php

namespace App\Http\Controllers\v1;

use App\Http\Requests\JobCreateRequest;
use App\Http\Requests\JobUpdateRequest;
use App\Repositories\v1\JobsRepositories;
use App\Http\Controllers\Controller;
use App\Repositories\v1\SubscriptionRepositories;

class JobsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(JobsRepositories::GetAll());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JobCreateRequest $request)
    {
        return response()->json(JobsRepositories::Create($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(JobsRepositories::GetById($id)->first());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(JobUpdateRequest $request, $id)
    {
        return response()->json(JobsRepositories::Upadate($request->all(), $id)->first());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return response()->json(JobsRepositories::Delete($id));
    }

    public function subscription($job_id, $candidate_id)
    {
        return SubscriptionRepositories::subscription($candidate_id, $job_id)
            ? response()->json('success')
            : response()->json('error')
        ;
    }
}
