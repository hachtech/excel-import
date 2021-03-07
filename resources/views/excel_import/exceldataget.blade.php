<form action="{{route('import_process')}}" class="excelsubmit" method="POST">
    @csrf
    <input type="hidden" name="csv_data_file_id" value="{{ $csv_data_file->id }}">
    <table class="table table-striped">
        <tr>
            @foreach ($csv_data[0] as $key => $value)
                <td>
                    <select class="form-control" name="fields[{{$key}}]">
                        @foreach (config('app.db_fields') as $db_field)
                            <option value="{{$db_field}}" @if ($key == $db_field) selected  @endif> {{$db_field}}</option>
                        @endforeach
                    </select>
                </td>
            @endforeach
        </tr>
        @foreach ($csv_data as $row)
            <tr>
            @foreach ($row as $key => $value)
                <td>{{ $value }}</td>
            @endforeach
            </tr>
        @endforeach
    </table>

    <button type="submit" class="btn btn-primary finalsubmitbutton">
        <samp class="finalsubmitspinner"></samp> Import Data
    </button>
</form>