@extends('layouts.admin')

@section('title')
    Store Dashboard
@endsection

@section('content')
<div
class="section-content section-dashboard-home"
data-aos="fade-up"
>
<div class="container-fluid">
  <div class="dashboard-heading">
    <h2 class="dashboard-title">Admin Dashboard</h2>
    <p class="dashboard-subtitle">Hello Admin</p>
  </div>
  <div class="dashboard-content">
    <div class="row">
      <div class="col-md-4">
        <div class="card mb-2">
          <div class="card-body">
            <div class="dashboard-card-title">User Count</div>
            <div class="dashboard-card-subtitle">{{ $customer }}</div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card mb-2">
          <div class="card-body">
            <div class="dashboard-card-title">Transaction Value</div>
            <div class="dashboard-card-subtitle">${{ $revenue }}</div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card mb-2">
          <div class="card-body">
            <div class="dashboard-card-title">Total Transaction</div>
            <div class="dashboard-card-subtitle">{{ $transaction }}</div>
          </div>
        </div>
      </div>
    </div>
    {{-- <div class="row mt-3">
      <div class="col-12 mt-2">
        <h5 class="mb-3">Recent Transactions</h5>
        <a
          href="/dashboard-transactions-details.html"
          class="card card-list d-block"
          ><div class="card-body">
            <div class="row">
              <div class="col-md-1">
                <img
                  src="/images/dashboard-icon-product-1.png"
                  alt=""
                />
              </div>
              <div class="col-md-4">Kaffu Chino</div>
              <div class="col-md-3">Angga Rizky</div>
              <div class="col-md-3">12 Januari 2020</div>
              <div class="col-md-1 d-none d-md-dblock">
                <img
                  src="/images/dashboard-right-arrow.svg"
                  alt=""
                />
              </div>
            </div></div
        ></a>
        <a
          href="/dashboard-transactions-details.html"
          class="card card-list d-block"
          ><div class="card-body">
            <div class="row">
              <div class="col-md-1">
                <img
                  src="/images/dashboard-icon-product-2.png"
                  alt=""
                />
              </div>
              <div class="col-md-4">Coffe</div>
              <div class="col-md-3">Angga Rizky</div>
              <div class="col-md-3">12 Januari 2020</div>
              <div class="col-md-1 d-none d-md-dblock">
                <img
                  src="/images/dashboard-right-arrow.svg"
                  alt=""
                />
              </div>
            </div></div
        ></a>
        <a
          href="/dashboard-transactions-details.html"
          class="card card-list d-block"
          ><div class="card-body">
            <div class="row">
              <div class="col-md-1">
                <img
                  src="/images/dashboard-icon-product-3.png"
                  alt=""
                />
              </div>
              <div class="col-md-4">Shirup Marzzan</div>
              <div class="col-md-3">Angga Rizky</div>
              <div class="col-md-3">12 Januari 2020</div>
              <div class="col-md-1 d-none d-md-dblock">
                <img
                  src="/images/dashboard-right-arrow.svg"
                  alt=""
                />
              </div>
            </div></div
        ></a>
      </div>
    </div> --}}
  </div>
</div>
</div>
@endsection