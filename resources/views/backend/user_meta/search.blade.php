@foreach ($allData as $singleData)
<tr id="table_id_{{ $singleData->id }}">
    <td>{{ $singleData->id }}</td>
        <td>{{ $singleData->join_date }}</td>
        <td>{{ $singleData->designation }}</td>
        <td>{{ $singleData->salary }}</td>
        <td>{{ $singleData->status == 0 ? "Inactive" : "Active"}}</td>
    <td>
        <div class="btn-group">
            <a href="javascript:void(0)" id="edit-meta"
                data-id="{{ $singleData->id }}" class="btn btn-primary">
                Edit
            </a>
            <a href="javascript:void(0)" id="delete-meta"
                data-id="{{ $singleData->id }}" class="btn btn-danger">
                Delete
            </a>
        </div>
    </td>
</tr>
@endforeach