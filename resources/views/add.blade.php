@extends('admin')

@section('form')
    <form action="/add" method="get" role="form">
        @if(empty($addSub))
            <div class="form-group">
                <label for="categoryName">Type new category name</label>
                <input type="text" name="newCategoryName" id="categoryName" class="form-control">
            </div>
        @else
            <div class="form-group">
                <label for="categoryName">Select category</label>
                <select class="form-control" name="oldCategory">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="categoryName">Or type new category name</label>
                <input type="text" name="newCategory" id="categoryName" class="form-control">
            </div>
            <div class="form-group">
                <label for="subCategoryName">Type new subCategory name</label>
                <input type="text" name="newSubCategoryName" id="subCategoryName" class="form-control">
            </div>
        @endif
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-success">Confirm</button>
            </div>
        </div>
    </form>
@endsection