@extends("layouts.template")
@section('title', 'Ma Todo List')
@section('sidebar')
    <div class="container-fluid" id="sidebar">

        <div class="row h-100">
            <nav class="col-md-2 d-none d-md-block sidebar sidebarBC">
                <div class="sidebar-sticky">
                    <h2>
                        <a class="nav-link" href="/">
                            <span data-feather="home"></span>
                            Theme
                        </a>
                    </h2>

                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <span data-feather="file"></span>
                            <a class="nav-link" href="/liste">
                                Tous
                            </a>
                        </li>

                        @forelse ($themes as $theme)
                            <li class="nav-item d-flex">
                                <a class="nav-link" href="{{ route('listeParTheme', ['theme' => $theme->nom]) }}">
                                    <span data-feather="file"></span>
                                    {{ $theme->nom }}
                                </a>
                            </li>

                        @empty

                        @endforelse
                        <li class="nav-item">
                            <span data-feather="file"></span>

                            <a class="nav-link" href="">
                                <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalTheme">
                                    <i class="fa fa-plus-square" aria-hidden="true"></i>
                                    Ajouter thème
                                </a>
                            </a>
                        </li>

                        <li class="nav-item">
                            <span data-feather="file"></span>

                            <a class="nav-link" href="">
                                <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalThemeSupprimer">
                                    <i class="fa fa-times" aria-hidden="true"></i>
                                    Supprimer thème
                                </a>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        @endsection
        @section('content')
            <div class="container">
                <div class="card mt-4">
                    <div class="card-body">
                        <!-- Ajouter une note -->
                        <a href="liste/add" role="button" class="btn btn-primary mb-3" data-toggle="modal"
                            data-target="#exampleModal">Ajouter une note</a>
                        <!-- Liste -->
                        @if (Session::has('message'))
                            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">
                                {{ Session::get('message') }}</p>
                        @endif
                        <ul class="list-group">
                            @forelse ($todos as $todo)
                                <li class="list-group-item  {{ $todo->important ? 'important' : '' }} {{ $todo->termine ? 'terminer' : 'encours' }} ">
                                    @if($todo->important)
                                    <i class="fa fa-exclamation icons btn btn-danger btn-sm importantIcon"></i>
                                    @endif
                                    <form id="formUpdate{{$todo->ID}}" action="{{ route('update', ['id' => $todo->ID]) }}"
                                        method="POST">
                                        @csrf
                                        <input type="text" name="noteTexte" id="textNote{{ $todo->ID }}"
                                            class="inputClear" id="{{ $todo->ID }}" value="{{ $todo->texte }} "
                                            disabled />
                                        </form>

                                    <!-- Action à ajouter pour Terminer et supprimer -->
                                    <div class="float-right">
                                        <div id="options" class="d-flex hidden">

                                            <form action="{{ route('termine', ['id' => $todo->ID]) }}" method="post"
                                                class="mx-2">
                                                @csrf
                                                <button class="fa fa-check-square-o icons btn btn-success btn-sm">
                                                </button>
                                            </form>
                                            <form action="{{ route('important', ['id' => $todo->ID]) }}" method="post"
                                                class="mx-2">
                                                @csrf
                                                <button class="fa fa-exclamation icons btn btn-warning btn-sm">
                                                </button>
                                            </form>
                                            <form action="" class="mx-2">
                                                @csrf
                                                <a class="fa fa-pencil icons btn btn-primary btn-sm"
                                                    onclick="setEditable({{ $todo->ID }})"></a>
                                            </form>
                                            
                                            <form action="{{ route('delete', ['id' => $todo->ID]) }}" method="post"
                                                class="mx-2">
                                                @csrf
                                                <button class="fa fa-trash-o icons btn btn-danger btn-sm">
                                                </button>
                                            </form>
                                            
                                            
                                        </div>
                                        <button class="btn btn-Success" id="validateButton{{ $todo->ID }}"
                                            style="float:right; display:none;"
                                            onclick="UpdateNote({{ $todo->ID }})">Validé</button>

                                </li>
                            @empty
                                <li class="list-group-item text-center">C'est vide !</li>
                            @endforelse
                        </ul>
                        
                    </div>
                </div>
            </div>

            <!-- Modal Note -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container">
                                <form method="POST" action="{{ route('store') }}" id="formNote">
                                    @csrf
                                    <div class="form-group">
                                        <label for="noteInput">Saisir une note :</label>
                                        <input type="text" class="form-control" id="noteInput" aria-describedby="noteHelp"
                                            placeholder="Votre note" name="texte">
                                        <small id="text" class="form-text text-muted">Vos Notes sont privées</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Theme</label>
                                        <select class="form-control" id="exampleFormControlSelect1" name="theme">
                                            @forelse ($themes as $theme)
                                                <option value="{{ $theme->nom }}">{{ $theme->nom }}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                    
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck2" name="important">
                                        <label class="form-check-label mb-3" for="importantCheck">Important ?</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1" name="termine">
                                        <label class="form-check-label mb-3" for="termineCheck">Termine ?</label>
                                    </div>
                                    
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="$('#formNote').submit();">Save
                                changes</button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Modal theme --}}
            <div class="modal fade" id="modalTheme" tabindex="-1" aria-labelledby="modalTheme" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container">
                                <form method="POST" action="{{ route('addTheme') }}" id="formTheme">
                                    @csrf
                                    <div class="form-group">
                                        <label for="noteInput">Nom du theme : </label>
                                        <input type="text" class="form-control" id="noteInput" aria-describedby="noteHelp"
                                            placeholder="nom" name="nomTheme">
                                        <small id="text" class="form-text text-muted">Il ne peux y avoir qu'un seul nom par
                                            theme</small>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="$('#formNote').submit();">Save
                                changes</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="modalThemeSupprimer" tabindex="-1" aria-labelledby="modalTheme"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container">
                                <form method="POST" action="{{ route('deleteTheme') }}" id="formTheme">
                                    @csrf
                                    <div class="form-group">
                                        <label for="noteInput">Nom du theme à supprimer : </label>
                                        <select name="nomTheme" id="" class="form-control">
                                            @forelse ($themes as $theme)
                                                <option value="{{ $theme->nom }}">{{ $theme->nom }}</option>
                                            @empty
                                            @endforelse
                                        </select>

                                    </div>

                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="$('#formNote').submit();">Save
                                changes</button>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                function setEditable(id) {
                    $("#textNote" + id).removeAttr("disabled");
                    console.log("#textNote" + id);
                    $("#validateButton" + id).css("display", "initial")
                }

                function UpdateNote(id) {
                    $("#" + id).attr("contenteditable", 'false');
                    $("#validateButton").css("display", "none");
                    $("#formUpdate"+id).submit();

                }
                $(".list-group-item").mouseenter(function() {
                    $(this).find("#options").css({
                        opacity: 0.0,
                        visibility: "visible"
                    }).animate({
                        opacity: 1.0
                    }, 200);

                });
                $(".list-group-item").mouseleave(function() {
                    $(this).find("#options").animate({
                        opacity: 0.0
                    }, 200, function() {
                        $(this).css({
                            visibility: "hidden"
                        });
                    });
                });
            </script>
        @endsection
