@extends('layouts.app')

@section('content')

<div class="container">

<h1>Edit Category</h1>

<form
action="{{ route('admin.categories.update',$category) }}"
method="POST">

@csrf
@method('PUT')

<div class="mb-3">

<label>Name</label>

<input
type="text"
name="name"
value="{{ $category->name }}"
class="form-control"
required>

</div>
<div class="mb-3">
    <label>Description</label>

    <textarea
        name="description"
        class="form-control"
        rows="4"
    >{{ $category->description }}</textarea>
</div>
<button class="btn btn-primary">

Update

</button>

</form>

</div>

@endsection