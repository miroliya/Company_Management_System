@foreach ($allData as $singleData)
<tr id="table_id_{{ $singleData->id }}">
        <td>{{ $singleData->id }}</td>
        <td>{{ $singleData->leave_type }}</td>
        <td>{{ $singleData->date_from }}</td>
        <td>{{ $singleData->date_to }}</td>
        <td>{{ $singleData->reason }}</td>
        <td>{{ $singleData->is_approved == 0 ? "Rejected" : "Approved"}}</td>
        <td>{{ $singleData->status == 0 ? "Inactive" : "Active"}}</td>
    <td>
        <div class="btn-group">
            <a href="javascript:void(0)" id="edit-leave"
                data-id="{{ $singleData->id }}" class="btn btn-primary">
                Edit
            </a>
            <a href="javascript:void(0)" id="delete-leave"
                data-id="{{ $singleData->id }}" class="btn btn-danger">
                Delete
            </a>
        </div>
    </td>
</tr>
@endforeach