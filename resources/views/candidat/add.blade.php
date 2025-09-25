{{-- \resources\views\permissions\create.blade.php --}}
@extends('welcome')

@section('title', '| Enregister Candidat')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="btn-group float-right">

                        <ol class="breadcrumb hide-phone p-0 m-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" >ACCUEIL</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('candidat.index') }}" >Ajouter un candidat</a></li>

                        </ol>
                    </div>
                    Gestion Vote PELL

                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <form action="{{ route('candidat.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
             <div class="card">
                        <div class="card-header ">
                            <div class="text-center">
                                FORMULAIRE D'ENREGISTREMENT D'UN CANDIDAT
                            </div>

                            </div>
                            <div class="card-body">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                @if ($message = Session::get('licence'))
                                    <div class="alert alert-danger">
                                        <p>{{ $message }}</p>
                                    </div>
                                @endif

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Nom </label>
                                            <input type="text" name="nom"  value="{{ old('nom') }}" class="form-control"required>
                                        </div>
                                    </div>
                                      <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Titre Projet</label>
                                            <input type="text" name="description"  value="{{ old('description') }}" class="form-control"required>
                                        </div>
                                    </div>
                         <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Image</label>
                                            <input type="file" name="photo"  value="{{ old('photo') }}" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Categorie</label>
                                        <select class="form-control" name="categorie_id" required="">
                                            <option value="">Selectionner</option>
                                            @foreach ($categories as $categorie )
                                                <option value="{{ $categorie->id }}" {{old('categorie_id')==$categorie->id ? "selected" : '' }} >{{  $categorie->nom }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Resume </label>
                                                <textarea id="elm1" type="text" name="resume"   class="summernote form-control" >
                                                    {{ old('resume') }}
                                                </textarea>
                                            </div>
                                        </div>


                                </div>
                                <br>
                                <div class="row float-right ">

                                    <button type="submit" class="btn btn-primary btn btn-lg "  onclick="this.disabled=true; this.form.submit();"> Sauvegarer</button>

                                </div>
                            </div>

                            </div>

            </form>

@endsection

@section('script')
<script>
     $('.summernote').summernote({
        airMode: true
        });
</script>

@endsection
{{-- @section('script')
<script>
       url_app = '{{ config('app.url') }}';
    $("#salle_id").change(function () {
    var salle_id =  $("#salle_id").children("option:selected").val();
   // $(".salle").val(salle_id);
   // $(".departement").val("");
    $(".commune").val("");
    $("#departement_id").empty();
    $("#commune_id").empty();
        var departement = "<option value=''>Veuillez selectionner</option>";
        $.ajax({
            type:'GET',
            url:url_app+'/departement/by/salle/'+salle_id,
            data:'_token = <?php echo csrf_token() ?>',
            success:function(data) {

                $.each(data,function(index,row){
                    //alert(row.nomd);
                    departement +="<option value="+row.id+">"+row.nom+"</option>";

                });

                $("#departement_id").append(departement);
            }
        });
    });
    $("#departement_id").change(function () {
        var departement_id =  $("#departement_id").children("option:selected").val();
      //  $(".departement").val(departement_id);
       // $(".commune").val("");
       $("#arrondissement_id").empty();
            var arrondissement = "<option value=''>Veuillez selectionner</option>";
            $.ajax({
                type:'GET',
                url:url_app+'/arrondissement/by/departement/'+departement_id,
                data:'_token = <?php echo csrf_token() ?>',
                success:function(data) {

                    $.each(data,function(index,row){
                        //alert(row.nomd);
                        arrondissement +="<option value="+row.id+">"+row.nom+"</option>";

                    });

                    $("#arrondissement_id").append(arrondissement);
                }
            });
        });




</script>
@endsection
 --}}
