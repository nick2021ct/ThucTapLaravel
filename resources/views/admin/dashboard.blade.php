@extends('admin.layouts.master')


@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="row page-title">
                <div class="col-sm-6">
                    <h3>Dashboard</h3>
                </div>

            </div>
        </div>
        <div class="container-fluid default-dashboard">
            <div class="row">


              <div class="col-sm-6 col-xl-6 text-center">
                <div class="card project-card">
                  <div class="card-header text-center">
                    <h4>Today</h4>
                  </div>
                  <div class="card-body d-flex flex-column justify-content-center align-items-center pt-0">
                    <h4>Amount: <span class="ms-1">{{ format_price($total_income_today) }}</span></h4>
                    <div class="row align-items-center justify-content-center w-100">
                      <div class="col-12 col-md-11 d-flex justify-content-center">
                        <ul class="list-unstyled d-flex justify-content-between w-100">
                          <li class="d-flex align-items-center">
                            <h5>{{ $pending_today }}<span class="font-light ms-1">Pending</span></h5>
                          </li>
                          <li class="d-flex align-items-center">
                            <h5>{{ $completed_today }}<span class="font-light ms-1">Completed</span></h5>
                          </li>
                          <li class="d-flex align-items-center">
                            <h5>{{ $canceled_today }}<span class="font-light ms-1">Canceled</span></h5>
                          </li>
                          <li class="d-flex align-items-center">
                            <h5>{{ $product_today }}<span class="font-light ms-1">Product Selled</span></h5>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-sm-6 col-xl-6 text-center">
                <div class="card project-card">
                  <div class="card-header text-center">
                    <h4>This Week</h4>
                  </div>
                  <div class="card-body d-flex flex-column justify-content-center align-items-center pt-0">
                    <h4>Amount: <span class="ms-1">{{ format_price($total_income_week) }}</span></h4>
                    <div class="row align-items-center justify-content-center w-100">
                      <div class="col-12 col-md-11 d-flex justify-content-center">
                        <ul class="list-unstyled d-flex justify-content-between w-100">
                          <li class="d-flex align-items-center">
                            <h5>{{ $pending_week }}<span class="font-light ms-1">Pending</span></h5>
                          </li>
                          <li class="d-flex align-items-center">
                            <h5>{{ $completed_week }}<span class="font-light ms-1">Completed</span></h5>
                          </li>
                          <li class="d-flex align-items-center">
                            <h5>{{ $canceled_week }}<span class="font-light ms-1">Canceled</span></h5>
                          </li>
                          <li class="d-flex align-items-center">
                            <h5>{{ $product_week }}<span class="font-light ms-1">Product Selled</span></h5>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
             
              <div class="col-sm-6 col-xl-6 text-center">
                <div class="card project-card">
                  <div class="card-header text-center">
                    <h4>This Month</h4>
                  </div>
                  <div class="card-body d-flex flex-column justify-content-center align-items-center pt-0">
                    <h4>Amount: <span class="ms-1">{{ format_price($total_income_month) }}</span></h4>
                    <div class="row align-items-center justify-content-center w-100">
                      <div class="col-12 col-md-11 d-flex justify-content-center">
                        <ul class="list-unstyled d-flex justify-content-between w-100">
                          <li class="d-flex align-items-center">
                            <h5>{{ $pending_month }}<span class="font-light ms-1">Pending</span></h5>
                          </li>
                          <li class="d-flex align-items-center">
                            <h5>{{ $completed_month }}<span class="font-light ms-1">Completed</span></h5>
                          </li>
                          <li class="d-flex align-items-center">
                            <h5>{{ $canceled_month }}<span class="font-light ms-1">Canceled</span></h5>
                          </li>
                          <li class="d-flex align-items-center">
                            <h5>{{ $product_month }}<span class="font-light ms-1">Product Selled</span></h5>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
             
              <div class="col-sm-6 col-xl-6 text-center">
                <div class="card project-card">
                  <div class="card-header text-center">
                    <h4>This Year</h4>
                  </div>
                  <div class="card-body d-flex flex-column justify-content-center align-items-center pt-0">
                    <h4>Amount: <span class="ms-1">{{ format_price($total_income_year) }}</span></h4>
                    <div class="row align-items-center justify-content-center w-100">
                      <div class="col-12 col-md-11 d-flex justify-content-center">
                        <ul class="list-unstyled d-flex justify-content-between w-100">
                          <li class="d-flex align-items-center">
                            <h5>{{ $pending_year }}<span class="font-light ms-1">Pending</span></h5>
                          </li>
                          <li class="d-flex align-items-center">
                            <h5>{{ $completed_year }}<span class="font-light ms-1">Completed</span></h5>
                          </li>
                          <li class="d-flex align-items-center">
                            <h5>{{ $canceled_year }}<span class="font-light ms-1">Canceled</span></h5>
                          </li>
                          <li class="d-flex align-items-center">
                            <h5>{{ $product_year }}<span class="font-light ms-1">Product Selled</span></h5>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

                <div class="col-md-6 col-xl-8">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h4>Best Seling Products</h4>
                            <br>
                            <form action="{{ route('admin.dashboard') }}" method="GET"
                                class="d-flex align-items-center justify-content-between">
                                <select class="form-select" id="selectDate" name="selectDate" style="width: 100px">
                                    <option value="all">All</option>
                                    <option value="today">Today</option>
                                    <option value="week">Week</option>
                                    <option value="month">Month</option>
                                    <option value="year">Year</option>
                                </select>

                                <div class="d-flex align-items-center gap-2" style="width: 250px">
                                    <span>Start date:</span>
                                    <input class="form-control flatpickr-input active" id="datetime-local1" type="text"
                                        name="start_date">
                                </div>

                                <div class="d-flex align-items-center gap-2" style="width: 250px">
                                    <span>End date:</span>
                                    <input class="form-control flatpickr-input active" id="datetime-local1" type="text"
                                        name="end_date">
                                </div>

                                <button type="submit" class="btn btn-primary">Select</button>
                            </form>
                        </div>

                        <br>

                        <div class="table-responsive">
                            <table class="table">
                                <thead class="text text-center">
                                    <tr>
                                        <th>Name</th>
                                        <th>Image</th>
                                        <th>Total sold</th>
                                        <th>Total income</th>
                                    </tr>
                                </thead>
                                <tbody class="text text-center">
                                    @foreach ($bestSellingProducts as $product)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    <div class="flex-shrink-0"><img
                                                            src="../assets/images/dashboard1/invest/01.jpg" alt="">
                                                    </div>
                                                    <div class="flex-grow-1"> <a href="user-profile.html">
                                                            <h6 class="f-w-500">{{ $product->name }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><img width="60px" src="{{ asset($product->thumb_image) }}" alt="">
                                            </td>
                                            <td>{{ $product->total_sold }}</td>
                                            <td>{{ format_price($product->total_income) }}</td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-xl-4">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h4>Orders Status</h4>
                        </div>
                        <br>
                        <div class="cart-body">
                            <canvas id="myChart"></canvas>

                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-xl-4">
                    <!-- Invoice menu-->
                    <div class="card">

                        <div class="card-body sale-product pt-0">
                            <div class="row">
                                <div class="col-5">
                                    <h5 class="f-w-500 mb-1 mt-2">Total Income</h5>
                                </div>

                            </div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Time</th>
                                        <th class="text text-start">Amount</th>
                                    </tr>
                                </thead>
                                <tbody class="text text-start">
                                    <tr>

                                        <td>Today</td>
                                        <td>{{ format_price($total_income_today) }}</td>

                                    </tr>
                                    <tr>
                                        <td>Week</td>
                                        <td>{{ format_price($total_income_week) }}</td>

                                    </tr>
                                    <tr>
                                        <td>Month</td>
                                        <td>{{ format_price($total_income_month) }}</td>

                                    </tr>
                                    <tr>
                                        <td>Year</td>
                                        <td>{{ format_price($total_income_year) }}</td>
                                    </tr>

                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-xl-4">
                    <!-- Invoice menu-->
                    <div class="card">

                        <div class="card-body sale-product pt-0">
                            <div class="row">
                                <div class="col-5">
                                    <h5 class="f-w-500 mb-1 mt-2">Orders</h5>
                                </div>

                            </div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Time</th>
                                        <th class="text text-center">Quantity</th>
                                    </tr>
                                </thead>
                                <tbody class="text text-start">
                                    <tr>

                                        <td>Today</td>
                                        <td class="text text-center">{{ count($order_today) }}</td>

                                    </tr>
                                    <tr>
                                        <td>Week</td>
                                        <td class="text text-center">{{ count($order_week) }}</td>

                                    </tr>
                                    <tr>
                                        <td>Month</td>
                                        <td class="text text-center">{{ count($order_month) }}</td>

                                    </tr>
                                    <tr>
                                        <td>Year</td>
                                        <td class="text text-center">{{ count($order_year) }}</td>
                                    </tr>

                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-xl-4">
                    <!-- Invoice menu-->
                    <div class="card">

                        <div class="card-body sale-product pt-0">
                            <div class="row">
                                <div class="col-5">
                                    <h5 class="f-w-500 mb-1 mt-2">Products selled</h5>
                                </div>

                            </div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Time</th>
                                        <th class="text text-center">Quantity</th>
                                    </tr>
                                </thead>
                                <tbody class="text text-start">
                                    <tr>

                                        <td>Today</td>
                                        <td class="text text-center">{{ $product_today }}</td>

                                    </tr>
                                    <tr>
                                        <td>Week</td>
                                        <td class="text text-center">{{ $product_week }}</td>

                                    </tr>
                                    <tr>
                                        <td>Month</td>
                                        <td class="text text-center">{{ $product_month }}</td>

                                    </tr>
                                    <tr>
                                        <td>Year</td>
                                        <td class="text text-center">{{ $product_year }}</td>
                                    </tr>

                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');

        var myPieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: {!! json_encode($labels) !!},
                datasets: [{
                    label: 'My Dataset',
                    data: {!! json_encode($data) !!},
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.6)',
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(255, 206, 86, 0.6)',
                        'rgba(75, 192, 192, 0.6)',
                        'rgba(153, 102, 255, 0.6)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw;
                            }
                        }
                    }
                }
            }
        });
    </script>
@endsection
