@extends('admin.main')

@section('content')

    <div class="app-main__inner">
        <div class="page-title-actions mb-4">
            <button type="button" class="btn btn-primary btn-create" data-route="{{ route('singer.create') }}" data-toggle="modal"
                    data-target="#formSubmit">
                <span class="btn-icon-wrapper pr-2 opacity-7">
                    <i class="fa fa-plus fa-w-20"></i>
                </span>
                Create
            </button>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <x-alert/>
                    <div class="card-header">
                    </div>

                    <div class="table-responsive" data-table="{{route('singer.get')}}">

                    </div>

                </div>
            </div>
        </div>
    </div>

    <x-modal/>
@endsection

@section('js')
    <script src="{{ asset('template/admin/js/admin/base.js') }}"></script>
@endsection
