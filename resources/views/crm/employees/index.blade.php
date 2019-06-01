@extends('layouts.base')

@section('caption', 'List of employees')

@section('title', 'List of employees')

@section('lyric', '')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- will be used to show any messages -->
            @if(session()->has('message_success'))
                <div class="alert alert-success">
                    <strong>Well done!</strong> {{ session()->get('message_success') }}
                </div>
            @elseif(session()->has('message_danger'))
                <div class="alert alert-danger">
                    <strong>Danger!</strong> {{ session()->get('message_danger') }}
                </div>
            @endif
            <a href="{{ URL::to('employees/form/create') }}">
                <button type="button" class="btn btn-primary btn active">Add employees</button>
            </a>
            <br><br>
            <!-- Advanced Tables -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-code-fork" aria-hidden="true"></i> List of employees
                </div>
                <div class="panel-body">
                    <div class="table">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example" data-sortable>
                            <thead>
                            <tr>
                                <th class="text-center">Full name</th>
                                <th class="text-center">Phone</th>
                                <th class="text-center">Email address</th>
                                <th class="text-center">Job</th>
                                <th class="text-center">Assigned client</th>
                                <th class="text-center">Status</th>
                                <th class="text-center" style="width:150px">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($employees as $key => $value)
                                <tr class="odd gradeX">
                                    <td class="text-center">{{ $value->full_name }}</td>
                                    <td class="text-center">{{ $value->phone }}</td>
                                    <td class="text-center">{{ $value->email }}</td>
                                    <td class="text-center">{{ $value->job }}</td>
                                    <td class="text-center"><a
                                                href="{{ URL::to('clients/view/' . $value->client->id) }}">{{ $value->client->full_name }}</a>
                                    </td>
                                    <td class="text-center">
                                            @if($value->is_active == TRUE)
                                                <label class="switch">
                                                    <input type="checkbox"
                                                           onchange='window.location.assign("{{ URL::to('employees/set-active/' . $value->id . '/0') }}")' checked>
                                                    <span class="slider"></span>
                                                </label>
                                            @else
                                                <label class="switch">
                                                    <input type="checkbox"
                                                           onchange='window.location.assign("{{ URL::to('employees/set-active/' . $value->id . '/1') }}")'>
                                                    <span class="slider"></span>
                                                </label>
                                            @endif
                                    </td>
                                    <td class="text-right">
                                        <a class="btn btn-success" href="{{ URL::to('employees/view/' . $value->id) }}" ><i class="fa fa-eye" aria-hidden="true"></i></a>
                                        <a class="btn btn-warning" href="{{ URL::to('employees/form/update/' . $value->id) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {!! $employeesPaginate->render() !!}

                </div>
            </div>
            <!--End Advanced Tables -->
        </div>
    </div>
@endsection