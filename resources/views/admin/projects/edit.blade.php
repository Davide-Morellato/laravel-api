@extends('layouts.app')

@section('content')
<section class="py-5">
    <div class="container w-50 m-auto">
        <form action="{{route('admin.projects.update', $project)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name_project" class="form-label fw-bold">Name Project</label>
                <input type="text" name="name_project" class="form-control" id="name_project" placeholder="Insert the name project" value="{{old('name_project', $project->name_project)}}">
            </div>
            <div class="mb-3">
                <label for="slug" class="form-label fw-bold">Slug</label>
                <input type="text" name="slug" class="form-control" id="slug" placeholder="Insert the name project" value="{{old('slug', $project->slug)}}">
            </div>
            <div class="mb-3">
                <label for="type_id" class="form-label fw-bold d-block">Type</label>
                <select name="type_id" id="type_id">
                    <option value="">--Select Type--</option>
                    @foreach($types as $type)
                    <option @selected( $type->id == old('type_id', $project->type_id)) value="{{$type->id}}">{{$type->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4 d-flex gap-4">
                <span class="fw-bold"> Select Tech: </span>
                @foreach($technologies as $technology)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="technologies[]" value="{{$technology->id}}" id="tech-{{$technology->id}}" @checked(in_array($technology->id, old('technologies', $project->technologies->pluck('id')->all())))>
                    <label class="form-check-label" for="tech-{{$technology->id}}">
                        {{$technology->name}}
                    </label>
                </div>
                @endforeach
            </div>
            <div class="mb-3">
                <label for="url_github" class="form-label fw-bold">Link Git</label>
                <input type="text" name="url_github" class="form-control" id="url_github" placeholder="Insert the url git" value="{{old('url_github', $project->url_github)}}">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label fw-bold">Description</label>
                <textarea type="text" name="description" class="form-control" id="description" placeholder="Describe your project" rows="8" value="{{old('description', $project->description)}}">
            </textarea>
            </div>
            <div class="d-flex justify-content-evenly pt-3">
                <button type="submit" class="btn btn-primary fw-bold">Save</button>
                <a href="{{route('admin.projects.index')}}" class="btn btn-warning text-primary fw-bold">Back to the Future</a>
            </div>
        </form>

        <div class="my-4 centered w-25">
            @if ( $errors->any() )
            <div class="alert alert-danger op-90">
                <ul>
                    @foreach($errors->all() as $error)
                    <li>
                        {{ $error }}
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
    </div>
</section>

@endsection