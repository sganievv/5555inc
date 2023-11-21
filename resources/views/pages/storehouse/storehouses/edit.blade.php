@extends('layouts.app')

@section('full-content')
    <div class="row ">
        <div class="col-md-12 panel panel-default">

            <form class="row panel-body" action="{{ route('storehouse.storehouses.update', $storehouse->getId()) }}" method="POST" >
                @csrf
                @method('PUT')

                <div class="col-md-12 row">
                    <div class="col-md-12">
                        <label>{{ __('attributes.name') }}</label>
                        <input type="text" name="name" class="form-control" required value="{{ $storehouse->getName() }}">
                    </div>

                    <div class="col-md-12 mt-3">
                        <label>{{ __('attributes.address') }}</label>
                        <textarea name="address" class="form-control">{{ $storehouse->getAddress() }}</textarea>
                    </div>

                    <div class="col-md-12 row">
                        <div class="col-md-2 mt-3">
                            <button type="submit" class="btn btn-primary form-control">
                                {{ __('base.save') }}
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
