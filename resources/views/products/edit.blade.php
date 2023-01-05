@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Patiekalai</div>

                    <div class="card-body">

                        <form method="POST" action="{{ isset($product)?route('products.update',$product->id):route('products.store') }}">
                            @csrf

                            @if (isset($product))
                                @method('put')
                            @endif

                            <div class="mb-3">
                                <label class="form-label">Pavadinimas</label>
                                <input type="text" name="name" class="form-control @error ('name') is-invalid @enderror" value="{{ isset($product)?$product->name:'' }}">
                                @error('name')
                                @foreach( $errors->get('name') as $error)
                                    <div class="alert alert-danger"> {{ $error }} </div>
                                @endforeach
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Kiekis</label>
                                <input type="text" name="quantity" class="form-control"  value="{{ isset($product)?$product->quantity:'' }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Kaina</label>
                                <input type="text" name="price" class="form-control"  value="{{ isset($product)?$product->price:'' }}">
                            </div>
{{--                            <div class="mb-3">--}}
{{--                                <label class="form-label" >Nuotrauka</label>--}}
{{--                                <input type="text" name="picture" class="form-control" value="{{ isset($product)?$product->picture:'' }}">--}}
{{--                            </div>--}}
                            <div class="mb-3">
                                <label for="" class="form-label mx-2">Nuotrauka</label>
                                <input type="file" class="form-control" name="picture" value="{{ isset($product)?$product->picture:'' }}">
                            </div>
                            <div class="mb-3">
                                <select name="restoran_id" class="form-select">
                                    @foreach($restorans as $restoran)
                                        <option  value="{{$restoran->id}}" {{ isset($product)&&($restoran->id==$product->restoran_id)?'selected':'' }} > {{ $restoran->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if(auth()->user('admin')->can('edit'))
                                <button type="submit" class="btn btn-success">{{ isset($product)?'Išsaugoti':'Pridėti' }}</button>
                            @endif

                            @can('admin')
                                <button type="submit" class="btn btn-success">{{ isset($product)?'Išsaugoti':'Pridėti' }}</button>
                            @endcan

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
