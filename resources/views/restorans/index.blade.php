@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Restoranai</div>

                    <div class="card-body">
                        @can('admin')
                        <a href="{{ route('restoran.create') }}" class="btn btn-success">Pridėti naują</a>
                        @endcan
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Pavadinimas</th>
                                <th>Adresas</th>
                                <th>Miestas</th>
                                <th></th>
                                <th colspan="2">Veiksmai</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($restorans as $restoran)
                                <tr>
                                    <td>{{ $restoran->name }}</td>
                                    <td>{{ $restoran->address }}</td>
                                    <td>{{ $restoran->city }}</td>

                                    <td>
                                        <a href="{{ route('restoranProducts',$restoran->id) }}" class="btn btn-success">Prekės</a>
                                    </td>
                                    <td>
                                        @can('admin')
                                        <a href="{{ route('restoran.edit', $restoran->id) }}" class="btn btn-success">Redaguoti</a>
                                        @endcan
                                    </td>
                                    <td>
                                        <form method="post" action="{{ route('restoran.destroy', $restoran->id) }}">
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
