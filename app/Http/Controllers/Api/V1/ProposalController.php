<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProposalRequest;
use App\Http\Requests\UpdateProposalRequest;
use App\Http\Resources\V1\ProposalResource;
use App\Jobs\UpdatingProposal;
use App\Models\Proposal;
use Illuminate\Support\Facades\Redis;

class ProposalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ProposalResource::collection(Proposal::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProposalRequest $request)
    {
        $proposal = Proposal::create($request->all());
        UpdatingProposal::dispatch($proposal);
        return new ProposalResource($proposal);
    }

    /**
     * Display the specified resource.
     */
    public function show(Proposal $proposal)
    {
        return new ProposalResource($proposal);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProposalRequest $request, Proposal $proposal)
    {
        $proposal->update($request->all());
        return new ProposalResource($proposal);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Proposal $proposal)
    {
        $proposal->delete();
        return response() -> json([
            "message"=> "Proposal deleted"
        ]);
    }
}
