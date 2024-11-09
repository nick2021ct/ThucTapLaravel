@extends('user.dashboard.layouts.master')

@section('content')
      <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9  ms-auto">
          <div class="dashboard_content">
            <h3><i class="fas fa-list-ul"></i> order</h3>
            <div class="wsus__dashboard_order">
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th class="package">ID</th>
                      <th class="e_date">Expired Date</th>
                      <th class="price">Total</th>
                      <th class="method">Payment Method</th>
                      <th class="tr_id">Order code</th>
                      <th class="p_date">Status</th>
                      <th class="status">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($orders as $order)
                    <tr>
                        <td class="package">{{ $order->id }}</td>
                        <td class="e_date">{{ $order->created_at }}</td>
                        <td class="price">{{ format_price($order->total) }}</td>
                        <td class="method">{{ $order->payment_method }}</td>
                        <td class="tr_id">{{ $order->order_code }}</td>
                        <td class="p_date"><span class="badge bg-success">{{ $order->status }}</span></td>
                        <td class="status"><a href="{{ route('order_history.detail',$order->id) }}">view</a></td>
                      </tr>
                    @endforeach
                 
                   
                 
                  </tbody>
                </table>
              </div>
              <div id="pagination">
                <nav aria-label="Page navigation example">
                  <ul class="pagination">
                    <li class="page-item">
                      <a class="page-link" href="#" aria-label="Previous">
                        <i class="fas fa-chevron-left"></i>
                      </a>
                    </li>
                    <li class="page-item"><a class="page-link page_active" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                    <li class="page-item">
                      <a class="page-link" href="#" aria-label="Next">
                        <i class="fas fa-chevron-right"></i>
                      </a>
                    </li>
                  </ul>
                </nav>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection