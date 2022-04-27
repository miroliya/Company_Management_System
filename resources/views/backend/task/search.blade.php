@foreach ($allData as $singleData)
<tr id="table_id_{{ $singleData->id }}">
    <td>{{ $singleData->id }}</td>
        <td>{{ $singleData->title }}</td>
        <td>{{ $singleData->start_date }}</td>
        <td>{{ $singleData->end_date }}</td>
        <td>{{ $singleData->description }}</td>
        <td>{{ $singleData->status == 0 ? "Inactive" : "Active"}}</td>
    <td>
        <div class="btn-group">
            <a href="javascript:void(0)" id="edit-user"
                data-id="{{ $singleData->id }}" class="btn btn-primary">
                Edit
            </a>
            <a href="javascript:void(0)" id="delete-user"
                data-id="{{ $singleData->id }}" class="btn btn-danger">
                Delete
            </a>
        </div>
    </td>
</tr>
@endforeach