<div class="card">
    <div class="card-header">
        <h3 class="mb-0">Your Orders</h3>
    </div>
    <div class="card-body" style="width: 126%">
        <div class="table-responsive">
            <table class="table" >
                <thead>
                    <tr>
                        <th>Sl</th>
                        <th>Date</th>
                        <th>Payment</th>
                        <th>Total</th>
                        <th>Invoice</th>
                        <th>Status</th>
                        <th colspan="2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $key => $order)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$order->order_date}}</td>
                            <td>{{$order->payment_type}}</td>
                            <td>${{$order->ammount}}</td>
                            <td>{{$order->invoice_number}}</td>
                            <td>
                                @if ($order->status == 'Pending')       
                                    <span class="badge rounded-pill bg-warning">Pending</span>
                                @elseif($order->status == 'Confirmed')
                                    <span class="badge rounded-pill bg-info">Confirmed</span>
                                @elseif($order->status == 'Processing')
                                    <span class="badge rounded-pill bg-warning">Processing</span>
                                @elseif($order->status == 'Canceled')
                                    <span class="badge rounded-pill bg-danger">Canceled</span>
                                @elseif($order->status == 'Delivered')
                                    <span class="badge rounded-pill bg-success">Delivered</span>
                                @endif
                            </td>
                            <td><a href="{{route('order.details',$order->id)}}" class="btn-sm btn-info"><i class="fa-regular fa-eye"></i></a></td>
                            <td><a href="{{route('order.pdf.download',$order->id)}}" class="btn-sm btn-danger"><i class="fa-solid fa-receipt"></i></a></td>
                        </tr>
                    @endforeach
                    
                   
                </tbody>
            </table>
        </div>
    </div>
</div>