<ul class="nav navbar-nav">
@if (!Auth::guest())
    <li><a href="{{ url('customers') }}">Customers</a></li>
    <li><a href="{{ url('suppliers') }}">Suppliers</a></li>
    <li><a href="{{ url('products') }}">Products</a></li>
@endif
</ul>