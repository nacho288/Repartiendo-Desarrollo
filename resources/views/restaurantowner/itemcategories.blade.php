@extends('admin.layouts.master')
@section("title") {{__('storeDashboard.mcpPageTitle')}}
@endsection
@section('content')
<div class="page-header">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><i class="icon-circle-right2 mr-2"></i>
                <span class="font-weight-bold mr-2">{{__('storeDashboard.total')}}</span>
                <span class="badge badge-primary badge-pill animated flipInX">{{ $count }}</span>
            </h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
        <div class="header-elements d-none py-0 mb-3 mb-md-0">
            <div class="breadcrumb">
                <button type="button" class="btn btn-secondary btn-labeled btn-labeled-left"
                    data-toggle="modal" data-target="#addNewItemCategory">
                <b><i class="icon-plus2"></i></b>
                {{__('storeDashboard.mcpAddNewCatBtn')}}
                </button>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>{{__('storeDashboard.mcpTableCatId')}}</th>
                            <th>{{__('storeDashboard.mcpTableName')}}</th>
                            <th>{{__('storeDashboard.mcpTableNOI')}}</th>
                            <th>{{__('storeDashboard.mcpTableStatus')}}</th>
                            <th>{{__('storeDashboard.mcpTableCA')}}</th>
                            <th class="text-center"><i class="
                                icon-circle-down2"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($itemCategories as $itemCategory)
                        <tr>
                            <td>{{ $itemCategory->id }}</td>
                            <td>{{ $itemCategory->name }}</td>
                            <td>{{ $itemCategory->items_count}}</td>
                            <td><span class="badge badge-flat border-grey-800 text-default text-capitalize">@if($itemCategory->is_enabled) {{ __('storeDashboard.mcpEnabled')}} @else {{ __('storeDashboard.mcpDisabled')}} @endif</span></td>
                            <td>{{ $itemCategory->created_at->diffForHumans() }}</td>
                            <td class="text-center">
                                @if($itemCategory->is_enabled)
                                <a href="{{ route('restaurant.disableCategory', $itemCategory->id) }}" class="badge badge-primary badge-icon ml-1" data-popup="tooltip" title="{{__('storeDashboard.mcpToolTipDisableCat')}}" data-placement="bottom"> <i class="icon-switch2"></i> </a>
                                @else
                                <a href="{{ route('restaurant.disableCategory', $itemCategory->id) }}" class="badge badge-danger badge-icon ml-1" data-popup="tooltip" title="{{__('storeDashboard.mcpToolTipEnableCat')}}" data-placement="bottom"> <i class="icon-switch2"></i> </a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div id="addNewItemCategory" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><span class="font-weight-bold">{{__('storeDashboard.mcpModalTitle')}}</span></h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="{{ route('restaurant.createItemCategory') }}" method="POST">
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">{{__('storeDashboard.mcpModalLabelName')}}:</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control form-control-lg" name="name"
                                placeholder="{{__('storeDashboard.mcpModalPlaceHolderName')}}" required>
                        </div>
                    </div>
                    @csrf
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">
                        {{__('storeDashboard.save')}}
                        <i class="icon-database-insert ml-1"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection