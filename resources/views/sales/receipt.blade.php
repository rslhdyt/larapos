<!DOCTYPE html>
<html>
<head>
    <title>Receipt</title>
</head>
<body onload="window.print()">
    <table>
        <tr>
            <td colspan="3" align="center">Nama Toko</td>
        </tr>
        <tr>
            <td colspan="3" align="center">Alamat</td>
        </tr>

        <tr>
            <td colspan="3" align="center">&nbsp;</td>
        </tr>

        <tr>
            <td colspan="2">{{ $sale->created_at->format('d F Y H:i') }}</td>
            <td align="right">{{ $sale->cashier->name }}</td>
        </tr>
        <tr>
            <td colspan="2">{{ $sale->invoice_no }}</td>
            <td align="right">{{ $sale->customer->name }}</td>
        </tr>

        <tr>
            <td colspan="3" align="center">&nbsp;</td>
        </tr>

        @foreach($sale->items as $item)
            <tr>
                <td colspan="3">{{ $item->product->name }}</td>
            </tr>
            <tr>
                <td colspan="2">{{ $item->quantity }} x {{ $item->price }}</td>
                <td align="right">{{ $item->quantity * $item->price }}</td>
            </tr>
        @endforeach

        <tr>
            <td colspan="3" align="center">&nbsp;</td>
        </tr>

        <tr>
            <td colspan="2" align="left">Subtotal</td>
            <td align="right">{{ $sale->subtotal }}</td>
        </tr>

        <tr>
            <td colspan="2" align="left">Tax ({{ $sale->tax_percentage }} %)</td>
            <td align="right">{{ $sale->tax }}</td>
        </tr>

        <tr>
            <td colspan="2" align="left">Total</td>
            <td align="right">{{ ($sale->subtotal + $sale->tax) }}</td>
        </tr>

        <tr>
            <td colspan="3" align="center">&nbsp;</td>
        </tr>

        <tr>
            <td colspan="3" align="center">Thank you for comming</td>
        </tr>
    </table>
</body>
</html>