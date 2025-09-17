<?php

namespace App\Http\Controllers;

use App\Models\Candidat;
use App\Repositories\CandidatRepository;
use App\Repositories\CategorieRepository;
use Illuminate\Http\Request;

class CandidatController extends Controller
{
    protected $candidatRepository;
    protected $categorieRepository;
    public function __construct(CandidatRepository $candidatRepository,CategorieRepository $categorieRepository)
    {
        $this->candidatRepository = $candidatRepository;
        $this->categorieRepository = $categorieRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $candidats = $this->candidatRepository->getAll();
        return view('candidat.index',compact('candidats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->categorieRepository->getAll();
        return view ('candidat.add',compact("categories"));
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
        'description' => 'required',
        'categorie_id' => 'required',
        'photo' => 'required',
        ], );
        if($request->photo)
        {
            $imageName = time().'.'.$request->photo->extension();
            $request->photo->move(public_path('photo'), $imageName);
            $request->merge(['image'=>$imageName]);
        }


        $candidat = $this->candidatRepository->store($request->all());
        return redirect('candidat');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $candidat = $this->candidatRepository->getById($id);
        return view('candidat.show',compact('candidat'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $candidat = $this->candidatRepository->getById($id);
         $categories = $this->categorieRepository->getAll();
        return view('candidat.edit',compact('candidat','categories'));
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
         if($request->photo)
        {
            $imageName = time().'.'.$request->photo->extension();
            $request->photo->move(public_path('photo'), $imageName);
            $request->merge(['image'=>$imageName]);
        }
        $this->candidatRepository->update($id, $request->all());
        return redirect('candidat');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->candidatRepository->destroy($id);
        return redirect('candidat');
    }
}
