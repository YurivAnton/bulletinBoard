@extends('admin')

@if(!empty($table))
    @section('table')
        <table class="table table-striped table-bordered table-responsive">
            <thead>
            <th>ID</th>
            <th>Name</th>
            <th>
                <a href="/admin?user=all&banned=1">
                    Banned
                </a>
            </th>
            <th>Email</th>
            <th>Edit</th>
            <th>Show all bulletins</th>
            </thead>
            <tbody>
            @foreach($table as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td>
                        @if($item->banned == 0)
                            <a href="/admin?ban=1&userId={{ $item->id }}">Ban</a>
                        @else
                            <a href="/admin?ban=0&userId={{ $item->id }}">Cancel</a>
                        @endif
                    </td>
                    <td>{{ $item->email }}</td>
                    <td><a href="/admin?user={{ $item->name }}">Edit</a></td>
                    <td><a href="/admin?bulletin=all">All bulletins</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endsection
@endif

@if(!empty($form))
    @section('form')
        <form action="/add" method="get" role="form">
            <input type="hidden" name="editUserId" value="{{ $form->id }}">
            <div class="form-group">
                <label for="editName">Type new user name</label>
                <input type="text" name="editName" id="editName" value="{{ $form->name }}" class="form-control">
            </div>
            <select class="form-control" name="banned">
                <option value="0">Not ban</option>
                <option value="1">Ban</option>
            </select>

            <div class="form-group">
                <label for="editEmail">Type new email</label>
                <input type="email" name="editEmail" id="editEmail" value="{{ $form->email }}" class="form-control">
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-success">Confirm</button>
                </div>
            </div>
        </form>
    @endsection
@endif