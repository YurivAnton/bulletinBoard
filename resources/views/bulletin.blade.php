@extends('admin')

@if(!empty($table))
    @section('table')
        <table class="table table-striped table-bordered table-responsive">
            <thead>
                <th>ID</th>
                <th>Author</th>
                <th>Category</th>
                <th>Subcategory</th>
                <th>Text</th>
                <th>
                    <a href="/admin?bulletin=all&banned=1">
                        Status
                    </a>
                </th>
                <th>Edit</th>
            </thead>
            <tbody>
            @foreach($table as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->author }}</td>
                {{--{{ dump($item) }}--}}
                @foreach($subCategories as $subCategory)
                    @if($subCategory->id == $item->subcategory_id)
                        @foreach($categories as $category)
                            @if($category->id == $subCategory->category_id)
                                <td><a href="/admin?bulletin={{ $category->id }}">{{ $category->name }}</a></td>
                            @endif
                        @endforeach
                        <td><a href="/admin?bulletin={{ $subCategory->name }}">{{ $subCategory->name }}</a></td>
                    @endif
                @endforeach
                <td>{{ $item->text }}</td>
                <td>
                    @if($item->status == 1)
                    <a href="/admin?ban=0&bulletinId={{ $item->id }}">Confirmed</a>
                    @else
                    <a href="/admin?ban=1&bulletinId={{ $item->id }}">Need to confirm</a>
                    @endif
                </td>
                <td><a href="/admin?bulletin=edit-{{ $item->id }}">Edit</a></td>
            </tr>
            @endforeach
                </tbody>
            </table>
    @endsection
@endif

@if(!empty($form))
    @section('form')
        <form action="/add" method="get" role="form">
            <input type="hidden" name="editBulletinId" value="{{ $form->id }}">
            <div class="form-group">
                <label for="editName">Edit author name</label>
                <input type="text" name="editAuthor" id="editName" value="{{ $form->author }}" class="form-control">
            </div>
            @foreach($subCategories as $subCategory)
                @if($subCategory->id == $form->subcategory_id)
                    @foreach($categories as $category)
                        @if($category->id == $subCategory->id)
                        <div class="form-group">
                            <label for="category">Category</label>
                            <input type="text" name="category" id="category" value="{{ $category->name }}" class="form-control" disabled>
                        </div>
                        @endif
                    @endforeach
                    <div class="form-group">
                        <label for="subcategory">Subcategory</label>
                        <input type="text" name="subcategory" id="subcategory" value="{{ $subCategory->name }}" class="form-control" disabled>
                    </div>
                @endif
            @endforeach
            <select class="form-control" name="status">
                <option value="1">Approve</option>
                <option value="0">Reject</option>
            </select>
            <div class="form-group">
                <label for="editText">Edit text</label>
                <textarea type="text" name="editText" class="form-control" id="text">{{ $form->text }}</textarea>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-success">Confirm</button>
                </div>
            </div>
        </form>
    @endsection
@endif