<?php

// Dashboard
Breadcrumbs::register('dashboard.index', function ($breadcrumbs) {
    $breadcrumbs->push('Dashboard', route('dashboard.index'));
});

// Supplier
Breadcrumbs::register('products.index', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard.index');
    $breadcrumbs->push('Products', route('products.index'));
});

Breadcrumbs::register('products.trash', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard.index');
    $breadcrumbs->push('Trashed Products', route('products.trash'));
});

Breadcrumbs::register('products.create', function ($breadcrumbs) {
    $breadcrumbs->parent('products.index');
    $breadcrumbs->push('Create', route('products.create'));
});

Breadcrumbs::register('products.show', function ($breadcrumbs, $product) {
    $breadcrumbs->parent('products.index');
    $breadcrumbs->push('Show', route('products.show', $product));
});

Breadcrumbs::register('products.edit', function ($breadcrumbs, $product) {
    $breadcrumbs->parent('products.index');
    $breadcrumbs->push('Edit', route('products.edit', $product));
});

// Supplier
Breadcrumbs::register('suppliers.index', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard.index');
    $breadcrumbs->push('Suppliers', route('suppliers.index'));
});

Breadcrumbs::register('suppliers.trash', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard.index');
    $breadcrumbs->push('Trashed Suppliers', route('suppliers.trash'));
});

Breadcrumbs::register('suppliers.create', function ($breadcrumbs) {
    $breadcrumbs->parent('suppliers.index');
    $breadcrumbs->push('Create', route('suppliers.create'));
});

Breadcrumbs::register('suppliers.show', function ($breadcrumbs, $supplier) {
    $breadcrumbs->parent('suppliers.index');
    $breadcrumbs->push('Show', route('suppliers.show', $supplier));
});

Breadcrumbs::register('suppliers.edit', function ($breadcrumbs, $supplier) {
    $breadcrumbs->parent('suppliers.index');
    $breadcrumbs->push('Edit', route('suppliers.edit', $supplier));
});

// Customer
Breadcrumbs::register('customers.index', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard.index');
    $breadcrumbs->push('Customers', route('customers.index'));
});

Breadcrumbs::register('customers.trash', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard.index');
    $breadcrumbs->push('Trashed Customers', route('customers.trash'));
});

Breadcrumbs::register('customers.create', function ($breadcrumbs) {
    $breadcrumbs->parent('customers.index');
    $breadcrumbs->push('Create', route('customers.create'));
});

Breadcrumbs::register('customers.show', function ($breadcrumbs, $customer) {
    $breadcrumbs->parent('customers.index');
    $breadcrumbs->push('Show', route('customers.show', $customer));
});

Breadcrumbs::register('customers.edit', function ($breadcrumbs, $customer) {
    $breadcrumbs->parent('customers.index');
    $breadcrumbs->push('Edit', route('customers.edit', $customer));
});

// Unit of Measure
Breadcrumbs::register('unit-of-measures.index', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard.index');
    $breadcrumbs->push('Unit of Measures', route('unit-of-measures.index'));
});

Breadcrumbs::register('unit-of-measures.trash', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard.index');
    $breadcrumbs->push('Trashed Unit of Measures', route('unit-of-measures.trash'));
});

Breadcrumbs::register('unit-of-measures.create', function ($breadcrumbs) {
    $breadcrumbs->parent('unit-of-measures.index');
    $breadcrumbs->push('Create', route('unit-of-measures.create'));
});

Breadcrumbs::register('unit-of-measures.show', function ($breadcrumbs, $unitOfMeasure) {
    $breadcrumbs->parent('unit-of-measures.index');
    $breadcrumbs->push('Show', route('unit-of-measures.show', $unitOfMeasure));
});

Breadcrumbs::register('unit-of-measures.edit', function ($breadcrumbs, $unitOfMeasure) {
    $breadcrumbs->parent('unit-of-measures.index');
    $breadcrumbs->push('Edit', route('unit-of-measures.edit', $unitOfMeasure));
});

// User
Breadcrumbs::register('users.index', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard.index');
    $breadcrumbs->push('Users', route('users.index'));
});

Breadcrumbs::register('users.trash', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard.index');
    $breadcrumbs->push('Trashed Users', route('users.trash'));
});

Breadcrumbs::register('users.create', function ($breadcrumbs) {
    $breadcrumbs->parent('users.index');
    $breadcrumbs->push('Create', route('users.create'));
});

Breadcrumbs::register('users.show', function ($breadcrumbs, $user) {
    $breadcrumbs->parent('users.index');
    $breadcrumbs->push('Show', route('users.show', $user));
});

Breadcrumbs::register('users.edit', function ($breadcrumbs, $user) {
    $breadcrumbs->parent('users.index');
    $breadcrumbs->push('Edit', route('users.edit', $user));
});

// Receiving
Breadcrumbs::register('receivings.index', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard.index');
    $breadcrumbs->push('Receivings', route('receivings.index'));
});

Breadcrumbs::register('receivings.create', function ($breadcrumbs) {
    $breadcrumbs->parent('receivings.index');
    $breadcrumbs->push('Create', route('receivings.create'));
});

Breadcrumbs::register('receivings.show', function ($breadcrumbs, $receiving) {
    $breadcrumbs->parent('receivings.index');
    $breadcrumbs->push('Show', route('receivings.show', $receiving));
});

Breadcrumbs::register('receivings.edit', function ($breadcrumbs, $receiving) {
    $breadcrumbs->parent('receivings.index');
    $breadcrumbs->push('Edit', route('receivings.edit', $receiving));
});

// Adjustment
Breadcrumbs::register('adjustments.index', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard.index');
    $breadcrumbs->push('Adjustments', route('adjustments.index'));
});

Breadcrumbs::register('adjustments.create', function ($breadcrumbs) {
    $breadcrumbs->parent('adjustments.index');
    $breadcrumbs->push('Create', route('adjustments.create'));
});

Breadcrumbs::register('adjustments.show', function ($breadcrumbs, $adjustment) {
    $breadcrumbs->parent('adjustments.index');
    $breadcrumbs->push('Show', route('adjustments.show', $adjustment));
});

Breadcrumbs::register('adjustments.edit', function ($breadcrumbs, $adjustment) {
    $breadcrumbs->parent('adjustments.index');
    $breadcrumbs->push('Edit', route('adjustments.edit', $adjustment));
});

// Sales
Breadcrumbs::register('sales.create', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard.index');
    $breadcrumbs->push('Create', route('sales.create'));
});

// Sales
Breadcrumbs::register('product-stocks.index', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard.index');
    $breadcrumbs->push('Product Stocks', route('product-stocks.index'));
});
