<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
    <h1>{{ $role == "admin" ? "Order Admin Email" : "Order Email"}}</h1>

    @if ($role == 'admin')
        <p>
            User name: {{ $order->user->name }}<br>
            User email: {{ $order->user->email }}<br>
            User address: {{ $order->user->address }}<br>
        </p>
    @endif
    
    
    <table border="1">
        <thead>
            <td>STT</td>
            <td>Product Name</td>
            <td>Price</td>
            <td>Quantity</td>
            <td>Total</td>
        </thead>
        @php
            $total = 0;
        @endphp
        @foreach ($order->order_items as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->product_name }}</td>
                <td>{{ $item->product_price }}</td>
                <td>{{ $item->product_qty }}</td>
                <td>{{ $item->product_price * $item->product_qty}}</td>
            </tr>
            @php
                $total += $item->product_price * $item->product_qty;
            @endphp
        @endforeach
        <tr><td colspan="5">Total: {{ $total }}</td></tr>
    </table>
</body>
</html>