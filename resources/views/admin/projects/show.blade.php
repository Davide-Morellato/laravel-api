@extends('layouts.app')

@section('content')
<section class="py-5">
    <div class="container ">
        <div class="row">
            <table class="table table-striped">
                <thead>
                    <tr class="text-center">
                        <th scope="col" class="p-2 text-primary">Name Project</th>
                        <th scope="col" class="p-2 text-primary">Slug</th>
                        <th scope="col" class="p-2 text-primary">Type</th>
                        <th scope="col" class="p-2 text-primary">Techs</th>
                        <th scope="col" class="p-2 text-primary">GitHub Link</th>
                        <th scope="col" class="p-2 text-primary">Description</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="text-center">
                        <th scope="row" class="p-3">{{$project->name_project}}</th>
                        <th class="p-3">{{$project->slug}}</th>
                        <!-- <td class="p-3">{{optional($project->type)->name}}</td> --> <!-- MODO CONTRATTO -->
                        <td class="p-3">{{$project->type ? $project->type->name : '--'}}</td>
                        <td class="p-3">
                            <ul class="list-unstyled">
                                @foreach($project->technologies as $technology)
                                <li>
                                    {{$technology->name}}
                                </li>
                                @endforeach
                            </ul>
                        </td>
                        <td class="p-3">{{$project->url_github}}</td>
                        <td class="p-3">{!! $project->description !!}</td>

                    </tr>
                </tbody>
            </table>
        </div>

        <div class="container">
            <div class="row">
                <ul>
                    <!-- Stampo in pagina la lista di altri link in base al tipo escludendo lo stesso aperto in dettaglio-->
                    @if($project->type !== null)
                        @foreach($project->type->projects as $related_project)
                            @if($related_project->name_project !== $project->name_project)
                            <li>
                                <a href="{{route('admin.projects.show', $related_project)}}">{{$related_project->name_project}}</a>
                            </li>
                            @endif
                        @endforeach
                    @else
                        <li>
                            <p>
                                This Project hasn't related types.
                            </p>
                        </li>
                    @endif
                </ul>
            </div>
        </div>

        <div class="py-3 d-flex justify-content-evenly">
            <a href="{{route('admin.projects.edit', $project)}}" class="mt-4 btn btn-success text-light fw-bold px-3">Edit</a>
            <form action="{{route('admin.projects.destroy', $project)}}" method="POST" onsubmit="return deleteFunction()">
                @csrf
                @method('DELETE')

                <button class="mt-4 btn btn-danger text-dark fw-bold">Delete</button>
            </form>
        </div>
        <div class="d-flex justify-content-center py-5">
            <a href="{{route('admin.projects.index', $project)}}" class="text-decoration-none text-danger fw-bold">Back to the Future</a>
        </div>
    </div>
</section>



<script>
    function deleteFunction() {

        const del = confirm("Sei sicuro?");

        if (!del) {
            return false;
        }
    }
</script>

@endsection