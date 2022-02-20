@extends('admin')

    @section('form')
        <form action="/edit" method="get" role="form">
            <input type="hidden" name="{{ $form['hidden'] }}" value="{{ $form['id'] }}">
            <div class="form-group">
                <label for="name">Type new user name</label>
                <input type="text" name="name" id="name" value="{{ $form['name'] }}" class="form-control">
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-success">Confirm</button>
                </div>
            </div>
        </form>
    @endsection