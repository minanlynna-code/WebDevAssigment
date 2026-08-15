@extends('layouts.app')

@section('title', 'Manage Categories')

@section('content')

<div class="container admin-page">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2>Manage Categories</h2>

        <a
            href="{{ route('admin.categories.create') }}"
            class="btn btn-success"
        >
            + Add Category
        </a>

    </div>

    @if(session('success'))

        <div class="alert alert-success">
            {{ session('success') }}
        </div>

    @endif

    <table class="table table-bordered table-hover align-middle">

        <thead class="table-dark">

            <tr>

                <th width="70">ID</th>

                <th>Name</th>

                <th>Description</th>

                <th width="220">Actions</th>

            </tr>

        </thead>

        <tbody>

            @forelse($categories as $category)

                <tr>

                    <td>{{ $category->id }}</td>

                    <td>{{ $category->name }}</td>

                    <td>
                        {{ $category->description ?? '-' }}
                    </td>

                    <td>

                        <a
                            href="{{ route('admin.categories.edit', $category) }}"
                            class="btn btn-warning btn-sm"
                        >
                            Edit
                        </a>

                        <form
                            action="{{ route('admin.categories.destroy', $category) }}"
                            method="POST"
                            class="d-inline"
                        >
                            @csrf
                            @method('DELETE')

                            <button
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Delete this category?')"
                            >
                                Delete
                            </button>

                        </form>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="4" class="text-center">
                        No categories found.
                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>

</div>

@endsection