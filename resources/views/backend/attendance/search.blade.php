@foreach ($allData as $singleData)
<tr id="table_id_{{ $singleData->id }}">
        <td>{{ $singleData->id }}</td>
        <td>{{ $singleData->date }}</td>
        <td>{{ $singleData->username }}</td>
        <td>{{ $singleData->in }}</td>
        <td>{{ $singleData->out }}</td>
        <td>{{ $singleData->attendance == 0 ? "Absent" : "Present"}}</td>
    <td>
        <div class="btn-group">
            <a href="javascript:void(0)" id="edit-attendance"
                data-id="{{ $singleData->id }}" class="btn btn-primary">
                Edit
            </a>
            <a href="javascript:void(0)" id="delete-attendance"
                data-id="{{ $singleData->id }}" class="btn btn-danger">
                Delete
            </a>
        </div>
    </td>
</tr>
@endforeach