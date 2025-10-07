<?php

namespace App\Http\Controllers;

use App\Repositories\CandidatRepository;
use App\Repositories\CategorieRepository;
use App\Repositories\VoteRepository;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

     protected $candidatRepository;
     protected $categorieRepository;
     protected $voteRepository;
    public function __construct(CandidatRepository $candidatRepository,CategorieRepository $categorieRepository,
                                VoteRepository $voteRepository)
    {
        $this->middleware('auth')->except(['allCandidat','voter',"candidatByCategorie",'candidatByCategorieId']);
        $this->candidatRepository = $candidatRepository;
        $this->categorieRepository = $categorieRepository;
        $this->voteRepository  = $voteRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $nbCandidat = $this->candidatRepository->nbCandidat();
        $nbCategorie = $this->categorieRepository->nbCategorie();
        $nbVotes = $this->voteRepository->nbVote();
        $categories = $this->categorieRepository->allCategories();
        $rts = [];
        $categorie = null;
        return view('home',compact('nbCandidat','nbCategorie','nbVotes','categories','rts','categorie'));
    }
    public function allCandidat()
    {
        $candidats = $this->candidatRepository->getAll();
        //dd($candidats);
        $categories = $this->categorieRepository->getAll();
        $categorie_id = null;
         $nbVotes = $this->voteRepository->nbVote();
        return view('vote', compact("candidats","categories","categorie_id","nbVotes"));
    }

    public function voter(Request $request)
    {
        //$vote = $this->voteRepository->verifVote($request->candidat_id,$request->categorie_id,$request->ip());

        if(!empty($vote))
        {
            return redirect()->back()->withErrors(["error"=>"Vous avez déjà vote pour cette categorie"]);

        }
        else
        {

            $request->merge(["ip_adresse"=>$request->ip()]);
            $this->voteRepository->store($request->all());
            $candidat = $this->candidatRepository->getById($request->candidat_id);
            $candidat->votes += 1;
            $this->candidatRepository->updateVote($request->candidat_id,$candidat->votes);
            return redirect()->back()->with([ "success"=>"Vote vote est enregistrée avec succès"]);

        }

    }

     public function candidatByCategorie(Request $request)
    {
        $categorie_id = $request->categorie_id;
        if($request->categorie_id!="all")
        {
            $candidats = $this->candidatRepository->getByCategorie($request->categorie_id);
            $nbVotes = $this->voteRepository->nbVoteBcategorie($request->categorie_id);

        }
        else{
            $candidats = $this->candidatRepository->getAll();
            $nbVotes = $this->voteRepository->nbVote();

        }


        $categories = $this->categorieRepository->getAll();
        return view('vote', compact("candidats","categories","categorie_id","nbVotes"));
    }

    public function rtsByCategorie(Request $request)
    {
        $nbCandidat = $this->candidatRepository->nbCandidat();
        $nbCategorie = $this->categorieRepository->nbCategorie();
        $nbVotes = $this->voteRepository->nbVote();
        $categories = $this->categorieRepository->allCategories();
        $rts = $this->voteRepository->rtsCandidatByCategorie($request->categorie);
        //dd($rts);
         $categorie = null;
        foreach ($categories as $key => $value) {
            if($value->id == $request->categorie )
            {
                 $categorie = $value->nom;
            }
        }
        return view('home',compact('nbCandidat','nbCategorie','nbVotes','categories','rts','categorie'));
    }

    public function candidatByCategorieId($id)
    {
        $categorie_id = $id;

            $candidats = $this->candidatRepository->getByCategorie($id);


        $categories = $this->categorieRepository->getAll();
        $nbVotes = $this->voteRepository->nbVoteBcategorie($id);
        return view('vote', compact("candidats","categories","categorie_id","nbVotes"));
    }
}
