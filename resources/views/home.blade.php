@extends('welcome')

@section("css")
<style>
     .card-container {
            margin: 20px auto;

            transition: all 0.3s ease;
        }

        .expandable-card {
            cursor: pointer;
            transition: all 0.3s ease;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .expandable-card.expanded {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            width: 100%;
            height: 100%;
            z-index: 1050;
            margin: 0;
            border-radius: 0;
            overflow-y: auto;
        }

        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0,0,0,0.5);
            z-index: 1040;
        }

        .expanded .card-body {
            padding: 2rem;
        }

        .close-btn {
            position: absolute;
            top: 15px;
            right: 15px;
            z-index: 1060;
            display: none;
        }

        .expanded .close-btn {
            display: block;
        }
</style>
@endsection
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="btn-group float-right">
                    <ol class="breadcrumb hide-phone p-0 m-0">
                        <li class="breadcrumb-item"><a href="#">Zoter</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
                <h4 class="page-title">Dashboard</h4>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-row">
                        <div class="col-3 align-self-center">
                            <div class="round">
                                <i class="mdi mdi-eye"></i>
                            </div>
                        </div>
                        <div class="col-9 align-self-center text-right">
                            <div class="m-l-10">
                                <h5 class="mt-0">{{ $nbCategorie }}</h5>
                                <p class="mb-0 text-muted">Nombre Categories {{-- <span class="badge bg-soft-success"><i class="mdi mdi-arrow-up"></i>2.35%</span> --}}</p>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="progress mt-3" style="height:3px;">
                        <div class="progress-bar  bg-success" role="progressbar" style="width: 35%;" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                    </div> --}}
                </div><!--end card-body-->
            </div><!--end card-->
        </div><!--end col-->

        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-row">
                        <div class="col-3 align-self-center">
                            <div class="round">
                                <i class="mdi mdi-account-multiple-plus"></i>
                            </div>
                        </div>
                        <div class="col-9 text-right align-self-center">
                            <div class="m-l-10 ">
                                <h5 class="mt-0">{{ $nbCandidat }}</h5>
                                <p class="mb-0 text-muted">Nombre de candidats</p>
                            </div>
                        </div>
                    </div>
                  {{--   <div class="progress mt-3" style="height:3px;">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 48%;" aria-valuenow="48" aria-valuemin="0" aria-valuemax="100"></div>
                    </div> --}}
                </div><!--end card-body-->
            </div><!--end card-->
        </div><!--end col-->

        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="search-type-arrow"></div>
                    <div class="d-flex flex-row">
                        <div class="col-3 align-self-center">
                            <div class="round ">
                                <i class="mdi mdi-cart"></i>
                            </div>
                        </div>
                        <div class="col-9 align-self-center text-right">
                            <div class="m-l-10 ">
                                <h5 class="mt-0">{{ $nbVotes }}</h5>
                                <p class="mb-0 text-muted">Nombre de votes</p>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="progress mt-3" style="height:3px;">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 61%;" aria-valuenow="61" aria-valuemin="0" aria-valuemax="100"></div>
                    </div> --}}
                </div><!--end card-body-->
            </div><!--end card-->
        </div><!--end col-->


    </div><!--end row-->
    <div class="row">
        <div class="col-lg-12">
             <div class="card">
                <div class="card-body">
                    <form action="{{ route('rtsByCategorie') }}" method="POST">
                        @csrf
                        <div class="input-group mb-3">
                            <select class="form-control form-control-lg select2" name="categorie" required>
                                <option value="">Rechercher par groupes d’affinités ou thématiques ...</option>
                                @foreach($categories as $key => $value)
                                    <option value="{{ $value->id }}">{{ $value->nom }} </option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-primary" type="button">
                                <i class="fas fa-search"></i> Rechercher
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
   {{--   <div class="row">

         <div class="card-container">
            <div class="card expandable-card">
                <button class="btn btn-danger close-btn">× Fermer</button>
                <div class="card-body">
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>

    </div> --}}
    <div class="row">
        <div class="col-sm-12">
            <div class="card-container">
                <div class="card expandable-card">
                        <button class="btn btn-danger close-btn">× Fermer</button>

                        <div class="card-body">
                             <br><h5 class="text-center">{{ $categorie }}</h5>
                            <div  id="bar-chart" >
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection

@section("script")
  <!--Morris Chart-->
    <script src="{{ asset('assets/plugins/morris/morris.min.js') }} "></script>
    <script src="{{ asset('assets/plugins/raphael/raphael-min.js') }} "></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>

        // A $( document ).ready() block.
$( document ).ready(function() {
     const ctx = document.getElementById('myChart');
        let donne = [];
        let label = [];
        var coloR = [];
        var morischart = [];

        var dynamicColors = function() {
            var r = Math.floor(Math.random() * 255);
            var g = Math.floor(Math.random() * 255);
            var b = Math.floor(Math.random() * 255);
            var e = 1;
            return "rgba(" + r + "," + g + "," + b + ","+e + ")";
        };
        @foreach ($rts as $rt )
            donne.push({{ $rt->votes }});
            label.push('{{ $rt->nom }}');
            morischart.push({a:{{ $rt->votes }}, b : '{{ $rt->nom }}  ({{ $rt->votes }} voix)'});
            coloR.push(dynamicColors());
        @endforeach
        //console.log(morischart);
        new Chart(ctx, {
            type: 'bar',
            data: {
            labels: label,
            datasets: [{
                label: 'Nombre de voix obtenues',
                data: donne,
                borderWidth: 1,
                backgroundColor: coloR,
                borderColor: coloR,

            }]
            },
            options: {
            scales: {
                y: {
                beginAtZero: true
                }
            },
            plugins: {
            legend: {
                display: true,
                position: 'top',


            }
        }
            }
        });
     var data = morischart,
    config = {
      data: morischart,
      xkey: 'b',
      ykeys: ['a'],
      labels: ['Total voix'],
      fillOpacity: 0.6,
      hideHover: 'auto',
      behaveLikeLine: true,
      resize: true,
      pointFillColors:['#ffffff'],
      pointStrokeColors: ['black'],
      lineColors:['gray','red']
  };

config.element = 'bar-chart';
Morris.Bar(config);
});

document.addEventListener('DOMContentLoaded', function() {
            const card = document.querySelector('.expandable-card');
            const overlay = document.querySelector('.overlay');
            const closeBtn = document.querySelector('.close-btn');
            const expandedContent = document.querySelector('.expanded-content');

            card.addEventListener('click', function(e) {
                // Ne pas agrandir si on clique sur le bouton de fermeture ou un lien
                if (e.target.classList.contains('close-btn') || e.target.tagName === 'A') {
                    return;
                }

                card.classList.add('expanded');
                overlay.style.display = 'block';
                expandedContent.style.display = 'block';
                document.body.style.overflow = 'hidden';
            });

            closeBtn.addEventListener('click', function() {
                card.classList.remove('expanded');
                overlay.style.display = 'none';
                expandedContent.style.display = 'none';
                document.body.style.overflow = 'auto';

                // Faire défiler jusqu'à la position originale de la carte
                card.scrollIntoView({ behavior: 'smooth' });
            });
        });
</script>
@endsection
