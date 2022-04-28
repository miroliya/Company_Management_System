@foreach ($allData as $singleData)
<tr id="table_id_{{ $singleData->id }}">
        <td>{{ $singleData->id }}</td>
        <td>{{ $singleData->working_days }}</td>
        <td>{{ $singleData->tax }}</td>
        <td>{{ $singleData->gross_salary }}</td>
    <td>
        <div class="btn-group">
            <a href="javascript:void(0)" id="edit-salary"
                data-id="{{ $singleData->id }}" class="btn btn-primary">
                Edit
            </a>
            <a href="javascript:void(0)" id="delete-salary"
                data-id="{{ $singleData->id }}" class="btn btn-danger">
                Delete
            </a>
        </div>
    </td>
</tr>
@endforeach