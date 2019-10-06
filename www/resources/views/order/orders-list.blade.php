<? /** @var $orders \App\Order[] */ ?>

<table>
    <thead>
    <tr>
        <th>User</th>
        <th>Product</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Total</th>
        <th>Date</th>
        <th colspan="2">Actions</th>
    </tr>
    </thead>
    <tbody>
    @foreach($orders as $order)
        <tr>
            <td>{{ $order->user->name }}</td>
            <td>{{ $order->product->name }}</td>
            <td>{{ $order->product->price }}</td>
            <td>{{ $order->quantity }}</td>
            <td>{{ $order->total }}</td>
            <td>{{ $order->created_at->format('Y-m-d H:i:s') }}</td>
            <td>
                <a href="{{ url('order/' . $order->id . '/edit/') }}">Edit</a>
            </td>
            <td>
                {{ Form::open(['method'  => 'DELETE', 'route' => ['order.destroy', $order->id]]) }}
                {{ Form::button('Delete', array('type' => 'submit', 'class' => 'action-delete')) }}
                {{ Form::close() }}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
</div>
</section>
