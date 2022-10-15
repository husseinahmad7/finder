@extends('layouts.app')
@section('title')
    Create order
@endsection
@section('content')
<header class="text-center">
    <h2 class="text-2xl font-bold uppercase mb-1">Create an Order</h2>
</header>
<fieldset class="container">
    <legend class="mb-4">Post an order to find something</legend>
  <form method="POST" action="{{ route('orders.store')}}" enctype="multipart/form-data">
    @csrf

    <div class="mb-6">
      <label for="title" class="form-label inline-block text-lg mb-2">Title</label>
      <input type="text" class="form-control border rounded p-2" name="title"
        placeholder="Example: A fridge" value="{{old('title')}}" />

      @error('title')
      <p class="invalid-feedback mt-1">{{$message}}</p>
      @enderror
    </div>

    <div class="mb-6">
      <label for="description" class="form-label text-lg mb-2">description</label>
      <textarea class="z-depth-1 border form-control rounded p-2" name="description" placeholder="looks like what">{{old('description')}}</textarea>

      @error('description')
      <p class="invalid-feedback mt-1">{{$message}}</p>
      @enderror
    </div>
    <div class="mb-6">
      <label for="address" class="form-label text-lg mb-2">address</label>
      <input type="text" class="border form-control rounded p-2" name="address"
        placeholder="Example: Remote, Damas, etc" value="{{old('address')}}" />

      @error('address')
      <p class="invalid-feedback mt-1">{{$message}}</p>
      @enderror
    </div>

    <div class="mb-6">
      <label for="contact" class="form-label text-lg mb-2">
        Contact
      </label>
      <input type="text" class="border rounded p-2 form-control" name="contact" placeholder="any contacting information" value="{{old('contact')}}" />

      @error('contact')
      <p class="invalid-feedback mt-1">{{$message}}</p>
      @enderror
    </div>

    <div class="mb-6">
      <label for="tags" class="form-label text-lg mb-2">
        Tags (Comma Separated)
      </label>
      <input type="text" class="border form-control rounded p-2" name="tags"
        placeholder="Example:Laptop,Course,TV,etc" value="{{old('tags')}}" />

      @error('tags')
      <p class="invalid-feedback mt-1">{{$message}}</p>
      @enderror
    </div>

    <div class="mb-6">
      <label for="pictue" class="form-label text-lg mb-2">
        picture
      </label>
      <input type="file" class="border form-control rounded p-2" name="picture" />

      @error('picture')
      <p class="invalid-feedback mt-1">{{$message}}</p>
      @enderror
    </div>

    <div class="mb-6">
      <button class="btn btn-primary text-white rounded py-2 px-4" @disabled($errors->isNotEmpty())>
        Create Order
      </button>

      <a href="/" class="text-black ml-4"> Back </a>
    </div>
  </form>
</fieldset>
@endsection
