@foreach ($allData as $singleData)
<tr id="table_id_{{ $singleData->id }}">
    <td>{{ $singleData->id }}</td>
        <td>{{ $singleData->name }}</td>
        <td>{{ $singleData->status == 0 ? "Inactive" : "Active"}}</td>
    <td>
        <div class="btn-group">
            <a href="javascript:void(0)" id="edit-department"
                data-id="{{ $singleData->id }}" class="btn btn-primary">
                Edit
            </a>
            <a href="javascript:void(0)" id="delete-department"
                data-id="{{ $singleData->id }}" class="btn btn-danger">
                Delete
            </a>
        </div>
    </td>
</tr>
@endforeach