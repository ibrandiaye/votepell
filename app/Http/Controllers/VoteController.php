<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use App\Repositories\VoteRepository;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    protected $voteRepository;

    public function __construct(VoteRepository $voteRepository)
    {
        $this->middleware('auth');
        $this->voteRepository = $voteRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $votes = $this->voteRepository->getWithRelations();
        //dd($votes);
        return view('vote.index',compact('votes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('vote.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
        'nom' => 'required',
        'badge_color' => 'required',
        ], );



        $vote = $this->voteRepository->store($request->all());
        return redirect('vote');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vote = $this->voteRepository->getById($id);
        return view('vote.show',compact('vote'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vote = $this->voteRepository->getById($id);
        return view('vote.edit',compact('vote'));
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

        $this->voteRepository->update($id, $request->all());
        return redirect('vote');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->voteRepository->destroy($id);
        return redirect('vote');
    }

    public function rtsGroupByCategorie()
    {
        $rtsGroupByCategories = $this->voteRepository->rtsGroupByCategorie();
        return view("vote.rts",compact("rtsGroupByCategories"));
    }
}
