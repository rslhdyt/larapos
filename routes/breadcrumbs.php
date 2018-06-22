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
