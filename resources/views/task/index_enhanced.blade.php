@extends('master')

@section('css')
<link href="{{ asset('assets') }}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
<style>
    /* Custom Styles for Enhanced Missions Page */
    .stats-card {
        transition: all 0.3s ease;
        border-radius: 12px;
        overflow: hidden;
    }
    
    .stats-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }
    
    .stats-icon {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
    }
    
    .mission-card {
        border-radius: 12px;
        transition: all 0.3s ease;
        border: 1px solid #e4e6ef;
        margin-bottom: 20px;
    }
    
    .mission-card:hover {
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        transform: translateY(-2px);
    }
    
    .mission-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 20px;
        border-radius: 12px 12px 0 0;
    }
    
    .priority-badge {
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .status-badge {
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }
    
    .view-toggle {
        background: #f5f8fa;
        border-radius: 8px;
        padding: 5px;
    }
    
    .view-toggle .btn {
        border-radius: 6px;
        padding: 8px 20px;
        border: none;
    }
    
    .view-toggle .btn.active {
        background: white;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    
    .filter-section {
        background: #f9fafb;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 25px;
    }
    
    .mission-info-item {
        display: flex;
        align-items: center;
        margin-bottom: 12px;
        padding: 8px;
        background: #f8f9fa;
        border-radius: 6px;
    }
    
    .mission-info-item i {
        margin-right: 10px;
        color: #667eea;
        font-size: 18px;
    }
    
    a[aria-disabled="true"] {
        color: gray;
        pointer-events: none;
        text-decoration: none;
    }
    
    .enhanced-table tbody tr {
        transition: all 0.2s ease;
    }
    
    .enhanced-table tbody tr:hover {
        background-color: #f8f9fa;
        transform: scale(1.01);
    }
    
    .action-btn {
        padding: 8px 15px;
        border-radius: 6px;
        font-size: 13px;
        font-weight: 500;
        transition: all 0.2s ease;
    }
    
    .action-btn:hover {
        transform: scale(1.05);
    }
</style>
@endsection

@section('role_user', 'Hospital Account')
@section('main-title', 'Missions Management')
@section('sub-title', 'View & Manage All Missions')

@section('content')

{{-- Success/Error Messages --}}
@if (session('message'))
<div class="alert alert-success d-flex align-items-center p-5 mb-5" style="border-radius: 12px;">
    <i class="ki-duotone ki-shield-tick fs-2hx text-success me-4"><span class="path1"></span><span class="path2"></span></i>
    <div class="d-flex flex-column">
        <h4 class="mb-1 text-dark">Success!</h4>
        <span>{{ session('message') }}</span>
    </div>
</div>
@endif

@if (session('message_delete'))
<div class="alert alert-danger d-flex align-items-center p-5 mb-5" style="border-radius: 12px;">
    <i class="ki-duotone ki-shield-tick fs-2hx text-danger me-4"><span class="path1"></span><span class="path2"></span></i>
    <div class="d-flex flex-column">
        <h4 class="mb-1 text-dark">Deleted Successfully</h4>
        <span>{{ session('message_delete') }}</span>
    </div>
</div>
@endif

@if (session('message_edit'))
<div class="alert alert-info d-flex align-items-center p-5 mb-5" style="border-radius: 12px;">
    <i class="ki-duotone ki-shield-tick fs-2hx text-info me-4"><span class="path1"></span><span class="path2"></span></i>
    <div class="d-flex flex-column">
        <h4 class="mb-1 text-dark">Updated Successfully</h4>
        <span>{{ session('message_edit') }}</span>
    </div>
</div>
@endif

{{-- Statistics Cards --}}
<div class="row g-5 mb-8" id="statistics-section