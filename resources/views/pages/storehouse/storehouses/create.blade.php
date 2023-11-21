@extends('layouts.app')

@section('full-content')
    <div class="row ">
        <div class="col-md-12 panel panel-default">

            <form class="row panel-body" action="{{ route('storehouse.storehouses.store') }}" method="POST" >
                @csrf

                <div class="col-md-12 row">
                    <div class="col-md-12">
                        <label>{{ __('attributes.name') }}</label>
                        <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
                    </div>

                    <div class="col-md-12 mt-3">
                        <label>{{ __('attributes.address') }}</label>
                        <textarea name="address" class="form-control">{{ old('address') }}</textarea>
                    </div>

                    <div class="col-md-12 row">
                        <div class="col-md-2 mt-3">
                            <button type="submit" class="btn btn-success form-control">
                                {{ __('base.create') }}
                            </button>
                        </div>
                        <div class="col-md-2 mt-3">
                            <a href="{{ route('storehouse.storehouses.index') }}" class="btn btn-warning form-control">
                                {{ __('nav.back') }}
                            </a>
                        </div>
                    </div>

                </div>

            </form>

        </div>
    </div>
@endsection
