@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Produktai</div>

                    <div class="card-body">

                        @can('admin')
                            <a href="{{ route('products.create') }}" class="btn btn-success">Pridėti naują</a>
                        @endcan


                        <table class="table">
                            <thead>
                            <tr>
                                <th>Pavadinimas</th>
                                <th>Kiekis</th>
                                <th>Kaina</th>
                                <th>Nuotrauka</th>
                                <th>Restoranas</th>
                                <th colspan="2">Veiksmai</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->quantity }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td> <img src="{{ $product->picture }}" style=" width: 200px; height: 120px;"> </td>
                                    <td>{{ $product->restoran->name }}</td>
                                    <td>
                                        @can('admin')
                                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-success">Redaguoti</a>
                                        @endcan

                                    </td>
                                    <td>
                                        <form method="post" action="{{ route('products.destroy', $product->id) }}">
                                            @csrf
                                            @method('delete')
                                            @can('admin')
                                            <button  class="btn btn-danger">Ištrinti</button>
                                            @endcan
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
