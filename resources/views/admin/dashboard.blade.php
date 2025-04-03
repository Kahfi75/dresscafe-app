@extends('admin.layouts.app')

@section('content')

<div class="container">
    <h2 class="dashboard-title">Dashboard Admin</h2>

    <!-- Stats Cards -->
    <div class="stats-cards">
        
        <!-- Total Penjualan Bulan Ini -->
        <div class="stats-card">
            <div class="card-header">
                <p class="card-title">Total Penjualan Bulan Ini</p>
                <p class="card-value">Rp {{ number_format(5000000, 0, ',', '.') }}</p> <!-- Dummy Data -->
            </div>
            <div class="card-icon">
                <!-- Icon bisa ditambahkan di sini -->
            </div>
        </div>

        <!-- Total Order Hari Ini -->
        <div class="stats-card">
            <div class="card-header">
                <p class="card-title">Total Order Hari Ini</p>
                <p class="card-value">20</p> <!-- Dummy Data -->
            </div>
            <div class="card-icon">
                <!-- Icon bisa ditambahkan di sini -->
            </div>
        </div>

        <!-- Total Pelanggan -->
        <div class="stats-card">
            <div class="card-header">
                <p class="card-title">Total Pelanggan</p>
                <p class="card-value">150</p> <!-- Dummy Data -->
            </div>
            <div class="card-icon">
                <!-- Icon bisa ditambahkan di sini -->
            </div>
        </div>
    </div>
</div>

@endsection
