@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i> {{ $pageTitle }}</h1>
        </div>
    </div>
    @include('admin.partials.flash')
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="tile">
                <h3 class="tile-title">{{ $subTitle }}</h3>
                <form action="{{ route('admin.ingredients.store') }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="poster_id" value="99999">
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="name">Имя на сайте <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name" value="{{ old('name') }}"/>
                            @error('name') {{ $message }} @enderror
                        </div>
                        <div class="form-group">
                            <label for="spot">Заведение <span class="m-l-5 text-danger"> *</span></label>
                            <select id=spot class="form-control custom-select mt-15 @error('parent_id') is-invalid @enderror" name="spot_id">
                                <option value="0">Выберите заведение</option>
                                @foreach($spots as $spot)
                                    <option value="{{ $spot->id }}"> {{ $spot->name }} </option>
                                @endforeach
                            </select>
                            @error('parent_id') {{ $message }} @enderror
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" id="status" name="status"/>Отображать в меню
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Сохранить Ингредиент</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.ingredients.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Отмена</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
