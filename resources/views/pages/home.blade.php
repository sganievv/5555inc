@extends('layouts.app')

@section('full-content')
    <div class="row">
        <div class="col-md-12">
            <h5>
                {{ __('constants.welcome', ['name' => auth()->user()->getName() ]) }}
            </h5>
        </div>
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-body row text-center">
                    @if(view()->exists(sprintf('components.menu.%s', auth()->user()->getRole())))
                        @include('components.menu.'.auth()->user()->getRole())
                    @endif

                    <div class="col-md-12 mt-3">
                        <a href="{{ route('user.logout') }}" class="btn btn-lg btn-danger" style="width: 100%">
                            {{ __('nav.logout') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
