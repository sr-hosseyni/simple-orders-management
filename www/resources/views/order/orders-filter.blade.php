{{ Form::open(['method'  => 'GET', 'route' => ['order.index']]) }}
<table class="order-form">
    <tbody>
    <tr>
        <td>
            {{
            Form::select('filters[created_at]', [
                0 => 'all time',
                7 => 'Last 7 days',
                1 => 'Today'
            ], $filters['created_at'])
        }}</td>
        <td>{{ Form::text('filters[keyword]', $filters['keyword'], ['placeholder' => 'enter search term']) }}</td>
        <td>{{ Form::button('Search', array('type' => 'submit', 'class' => '')) }}</td>
    </tr>
    </tbody>
</table>
{{ Form::close() }}
