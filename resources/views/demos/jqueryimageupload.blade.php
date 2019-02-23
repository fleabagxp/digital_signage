@extends('layouts.app')

@section('content')
<form method="POST" action="/demos/jquery-image-upload" enctype="multipart/form-data">
@csrf
<div class="row">
    <div class="form-group col-md-12">                   
        <div class="custom-file">
            <input type="file" name="slip" id="slip">                   
        </div>
        <button type="button" class="btn btn-primary btn-lg" id="left">{{__('หมุนซ้าย')}}</button>
        <button type="button" class="btn btn-primary btn-lg" id="right">{{__('หมุนขวา')}}</button>
    </div>
    <div class="form-group col-md-6 p-5 m-5">
        <input type="hidden" name="rotate" id="rotate" value="0">
        <img class="img-thumbnail" id="preview-img" src="{{ asset('images/noimage.jpg') }}" style="width: 100%">
    </div>
</div>
<div class="form-group text-center">
    <button type="submit" class="btn btn-primary btn-lg btn-block">{{__('บันทึก')}}</button>
</div>
</form>
@endsection

@section('customJS')
<script type="text/javascript" src="http://beneposto.pl/jqueryrotate/js/jQueryRotateCompressed.js"></script>
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#preview-img').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $('#slip').on('change',function(e){
            var fileName = e.target.files[0].name;
            readURL(this);
        });

        $(document).ready(function(){
            var value = 0

            $('#left').on('click',function(e){
                value -=90;
                $("#preview-img").rotate({ animateTo:value})
                $("#rotate").val(value)
            });

            $('#right').on('click',function(e){
                value +=90;
                $("#preview-img").rotate({ animateTo:value})
                $("#rotate").val(value)
            });
        });
    </script>
@endsection