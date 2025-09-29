<?php
namespace App\Repositories;

use App\Models\Vote;
use Illuminate\Support\Facades\DB;

class VoteRepository extends RessourceRepository{

    public function __construct(Vote $vote)
    {
        $this->model = $vote;
    }

    public function verifVote($candidat_id,$categorie_id,$ip)
    {
        return DB::table("votes")
        ->join("candidats","votes.candidat_id","=","candidats.id")
        ->select("votes.*")
        ->where("votes.ip_adresse",$ip)
      //  ->where("votes.candidat_id",$candidat_id)
        ->where("candidats.categorie_id",$categorie_id)
        ->first();

    }
    public function nbVote()
    {
        return DB::table("votes")->count();
    }
    public function getWithRelations()
    {
        return DB::table("votes")
        ->join("candidats","votes.candidat_id","=","candidats.id")
        ->join("categories","candidats.categorie_id","=","categories.id")
        ->select("votes.*","candidats.image","categories.nom as categorie","candidats.nom as candidat")

        ->get();

    }
    public function getWithRelationsByCandidat($candidat)
    {
        return DB::table("votes")
        ->join("candidats","votes.candidat_id","=","candidats.id")
        ->join("categories","candidats.categorie_id","=","categories.id")
        ->select("votes.*","candidats.image","categories.nom as categorie")
        ->where("votes.candidat_id",$candidat)
        ->get();

    }
    public function getWithRelationsByCategorie($categorie)
    {
        return DB::table("votes")
        ->join("candidats","votes.candidat_id","=","candidats.id")
        ->join("categories","candidats.categorie_id","=","categories.id")
        ->select("votes.*","candidats.image","categories.nom as categorie")
        ->where("candidats.categorie_id",$categorie)
        ->get();

    }
    public function rtsCandidatByCategorie($categorie)
    {
        return DB::table("votes")
        ->join("candidats","votes.candidat_id","=","candidats.id")
        ->select("candidats.nom","candidats.image",DB::raw('count(votes.id) as votes'))
        ->where("candidats.categorie_id",$categorie)
        ->groupBy("candidats.nom","candidats.image")
        ->get();

    }

}
