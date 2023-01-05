@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Restoranai</div>

                    <div class="card-body">

                        <form method="POST" action="{{ isset($restoran)?route('restoran.update',$restoran->id):route('restoran.store') }}">
                            @csrf

                            @if (isset($restoran))
                                @method('put')
                            @endif

                            <div class="mb-3">
                                <label class="form-label">Pavadinimas</label>
                                <input type="text" name="name" class="form-control" value="{{ isset($restoran)?$restoran->name:'' }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Miestas</label>
                                <input type="text" name="city" class="form-control"  value="{{ isset($restoran)?$restoran->city:'' }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Adresas</label>
                                <input type="text" name="address" class="form-control"  value="{{ isset($restoran)?$restoran->address:'' }}">
                            </div>
                            <button type="submit" class="btn btn-success">{{ isset($restoran)?'Išsaugoti':'Pridėti' }}</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
