@extends('layout.default')

@section('content')
    <h3 class="text-center"> {{ trans('Users') }} </h3>
    <div class="container">
        <a href="{{ route('logout') }}" class="btn btn-danger pull-right"> {{ trans('Logout') }} </a>
        <div clas="row">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">{{ trans('Name') }}</th>
                        <th scope="col">{{ trans('Email') }}</th>
                        <th scope="col">{{ trans('Position') }}</th>
                        <th scope="col">{{ trans('Status') }}</th>
                        <th scope="col">{{ trans('Created On') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @if(! $users->isEmpty())
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->user_information->position ?? 'N/A' }}</td>
                                <td>{{ $user->user_information->status ?? 'N/A' }}</td>
                                <td>{{ $user->created_at }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4"> {{ trans('No Record Found') }} </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    <div class="text-center"> {{ $users->links() }} </div>
@stop
