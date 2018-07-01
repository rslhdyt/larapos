<ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
        <a class="nav-link" href="index.html">
        <i class="fa fa-fw fa-dashboard"></i>
        <span class="nav-link-text">Dashboard</span>
        </a>
    </li>
    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Sales">
        <a class="nav-link" href="{{ route('sales.create') }}">
            <i class="fa fa-fw fa-shopping-cart"></i>
            <span class="nav-link-text">Sales</span>
        </a>
    </li>
    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Inventory">
        <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-building-o"></i>
            <span class="nav-link-text">Inventory</span>
        </a>
        <ul class="sidenav-second-level collapse" id="collapseComponents">
            <li>
                <a href="{{ route('receivings.index') }}">Receiving</a>
            </li>
            <li>
                <a href="{{ route('adjustments.index') }}">Adjustment</a>
            </li>
            <li>
                <a href="{{ route('product-stocks.index') }}">Product Stocks</a>
            </li>
        </ul>
    </li>
    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Master">
        <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapse-master" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-gear"></i>
            <span class="nav-link-text">Master</span>
        </a>
        <ul class="sidenav-second-level collapse" id="collapse-master">
            <li>
                <a href="{{ route('products.index') }}">Products</a>
            </li>
            <li>
                <a href="{{ route('suppliers.index') }}">Suppliers</a>
            </li>
            <li>
                <a href="{{ route('customers.index') }}">Customers</a>
            </li>
            <li>
                <a href="{{ route('unit-of-measures.index') }}">Unit Of Measures</a>
            </li>
        </ul>
    </li>
    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Users">
        <a class="nav-link" href="{{ route('users.index') }}">
            <i class="fa fa-fw fa-user-o"></i>
            <span class="nav-link-text">Users</span>
        </a>
    </li>
    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Link">
        <a class="nav-link" href="{{ route('settings.edit') }}">
            <i class="fa fa-fw fa-link"></i>
            <span class="nav-link-text">Settings</span>
        </a>
    </li>
</ul>