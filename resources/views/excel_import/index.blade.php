@extends('layout.app')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h6 mb-0 text-gray-800"><i class="fas fa-file-excel    "></i> Excel import</h1>
</div>
<div class="card mb-4 border-left-primary">
   
    <div class="card-body">
        <form id="submitform" action="{{route('import_parse')}}" method="POST">
            @csrf
            <div class="custom-file">
                <input type="file"  class="custom-file-input" name="excle" id="excle" required>
                <label class="custom-file-label" for="excle">Choose file...</label>
            </div>
            <div class="mt-2">
                <button class="btn btn-primary" type="submit"><samp class="submitspinner"></samp> Submit form</button>
            </div>
        </form>
        <div class="mt-3 importdata">
        </div>
    </div>
</div>
@push('script')
    <script>
        $('body').on('submit',  '#submitform', function(e){
            e.preventDefault();
            //call ajax
            $.ajax({
                url: $(this).attr('action'),
                data: new FormData(this),
                type: 'POST',
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function () {
                    $('.submitspinner').html('<i class="fa fa-spinner fa-spin"></i>');
                },
                success: function (data) {
                    document.getElementById("excle").value = "";
                    if (data.status == 400) {
                        $('.submitspinner').html('');
                    }
                    if (data.status == 200) {
                        $('.submitspinner').html('');
                        
                        $('.importdata').html(data.data);
                    }
                },
            });
        });


        $('body').on('submit',  '.excelsubmit', function(e){
            e.preventDefault();
            //call ajax
            $.ajax({
                url: $(this).attr('action'),
                data: new FormData(this),
                type: 'POST',
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function () {
                    $('.finalsubmitspinner').html('<i class="fa fa-spinner fa-spin"></i>');
                },
                success: function (data) {
                    if (data.status == 400) {
                        $('.finalsubmitspinner').html('');
                    }
                    if (data.status == 200) {
                        $('.finalsubmitspinner').html('');
                        $('.importdata').html('');
                    }
                },
            });
        });
    </script>
@endpush





    
@endsection