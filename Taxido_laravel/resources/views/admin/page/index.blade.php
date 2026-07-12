@extends('admin.layouts.master')
@section('title', __('static.pages.pages'))
@section('content')
    <div class="contentbox">
        <div class="inside">
            <div class="contentbox-title">
                <div class="contentbox-subtitle">
                    <h3>{{ __('static.pages.pages') }}</h3>
                    <div class="subtitle-button-group">
                        @can('page.create')
                            <button class="add-spinner btn btn-outline" data-url="{{ route('admin.page.create') }}" wire:navigate>
                                <i class="ri-add-line"></i> {{ __('static.pages.add_new') }}
                            </button>
                        @endcan
                        @can('page.index')
                        @if($tableConfig['total'] > 0)
                            <button class="btn btn-outline" data-bs-toggle="modal" data-bs-target="#exportModal">
                                <i class="ri-download-line"></i> {{ __('static.export.export') }}
                            </button>
                        @endif
                        @endcan
                        @can('page.create')
                            <button class="btn btn-outline" data-bs-toggle="modal" data-bs-target="#importModal"
                                id="importButton" data-model="page">
                                <i class="ri-upload-line"></i> {{ __('static.import.import') }}
                            </button>
                        @endcan
                    </div>
                </div>
            </div>
            <div class="page-table">
                <livewire:admin.⚡table-component
                    :columns="$tableConfig['columns']"
                    :data="$tableConfig['data']"
                    :filters="$tableConfig['filters']"
                    :actions="$tableConfig['actions']"
                    :total="$tableConfig['total']"
                    :bulkactions="$tableConfig['bulkactions']"
                    :action-buttons="$tableConfig['actionButtons']"
                    :modal-action-buttons="$tableConfig['modalActionButtons']"
                    :search="true"
                    :show-checkbox="true" />
            </div>
        </div>
    </div>
@endsection
