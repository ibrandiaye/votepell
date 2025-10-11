@extends('welcome')
@section('title', '| categorie')


@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="btn-group float-right">

                                <ol class="breadcrumb hide-phone p-0 m-0">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}" >ACCUEIL</a></li>
                                <li class="breadcrumb-item active ">LISTE DES CATEGORIES</li>

                                </ol>
                            </div>
                              Gestion Vote PELL

                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    @if ($message = Session::get('error'))
        <div class="alert alert-danger">
            <p>{{ $message }}</p>
        </div>
    @endif


    @if ($errors->has('licence'))
        <div class="alert alert-danger">
            {!!  $errors->first('licence') !!} . <a href="{{route('indexCategorie')}}"><u>Merci de renouveler votre licence pour pouvoir continuer</u></a>
        </div>
    @endif

<div class="col-12">
    <div class="card ">
        <div class="card-header">
            LISTE DES CATEGORIES
            <div class="float-right">
                <a href="{{ route('categorie.create') }}" class="btn btn-primary">Ajouter un categorie</a>
            </div>
        </div>
            <div class="card-body">

                <table id="datatable-buttons" class="table table-bordered table-responsive-md table-striped text-center">
                    <thead>
                        <tr>


                            <th>Categorie </th>

                            <th>Votants</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($rtsGroupByCategories as $categorie)
                        <tr>
                            <td>{{ $categorie->nom }}</td>
                            <td>{{ $categorie->votes}}</td>


                        </tr>
                        @endforeach

                    </tbody>
                </table>

            </div>
    </div>
</div>

@endsection
