{{ Form::open(['method'  => 'POST', 'route' => ['order.store']]) }}
<table class="order-form">
    <tbody>
    <tr>
        <th>{{ Form::label('User', null, ['class' => 'control-label']) }}</th>
        <td>{{ Form::select('user_id', $users) }}</td>
        <td rowspan="4" width="50%">
            @include('layout/notifications')
        </td>
    </tr>
    <tr>
        <th>{{ Form::label('Product', null, ['class' => 'control-label']) }}</th>
        <td>{{ Form::select('product_id', $products) }}</td>
    </tr>
    <tr>
        <th>Quantity</th>
        <td>{{ Form::number('quantity') }}</td>
    </tr>
    <tr>
        <th></th>
        <td>{{ Form::button('Add', array('type' => 'submit', 'class' => '')) }}</td>
    </tr>
    </tbody>
</table>
{{ Form::close() }}
