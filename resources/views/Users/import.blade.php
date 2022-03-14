@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">import Excel</div>
                    <div class="card-body">
                        @if(session('status'))
                            <div class="alret alert-success" role="alert">
                                {{ session('status')  }}
                            </div>
                        @endif
                        @if(isset($errors)&& $errors->any())
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $item)
                                    {{ $item }}
                                @endforeach
                            </div>
                        @endif
                        @if(session()->has('failures'))
                            <table class="table table-danger">
                                <tr>
                                    <th>Row</th>
                                    <th>Atrr</th>
                                    <th>Err</th>
                                    <th>Val</th>
                                </tr>
                                @foreach(session()->get('failures') as $item)
                                    <tr>
                                        <td>{{$item->row()}}</td>
                                        <td>{{$item->attribute()}}</td>
                                        <td>
                                            <ul>
                                                @foreach($item->errors() as $it)
                                                    <li>{{$it}}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td>{{$item->values()[$item->attribute()]}}</td>
                                    </tr>
                                @endforeach

                            </table>
                            </div>
                        @endif
                        <form action="/users/import" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <input type="file" name="file"/>
                                <button type="submit" class="btn btn-primary">
                                    Import
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
