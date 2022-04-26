@foreach ($employee as $singleData)
<tr id="table_id_{{ $singleData->id }}">
    <td>{{ $singleData->id }}</td>
        <td>{{ $singleData->name }}</td>
        <td> <img style="width: 50px;" src="{{ url('./image/' . $singleData->image )}} "/></td>
        <td>{{ $singleData->phone }}</td>
        <td>{{ $singleData->gender == 0 ? "Male" : "Female" }}</td>
        <td>{{ round($singleData->age) }}</td>
        <td>{{ $singleData->user_status == 0 ? "Inactive" : "Active"}}</td>
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