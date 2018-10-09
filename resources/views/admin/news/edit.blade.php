<script>
    var deletedIds = [];
    function deleteImage(imageId)
    {
        //var fd = new FormData(document.getElementById("updateCyber"));
        //fd.append('deletedImages[]',imageId);
        deletedIds.push(imageId);
        var oldValue = $('#deletedImages').val();
        $('#deletedImages').attr("value",deletedIds.join(', '));
        $('#'+imageId).remove();
    }
</script>


@extends('layouts.app')


@section('content')
    <div class="row" style="padding-top: 6%">
        <div class="col-md-offset-1 col-md-10 col-xs-12">
            <div class="box box-primary">

                <div class="box-header with-border">
                    <h3 class="box-title">
                        تعديل {{$new->name}}
                    </h3>
                </div>

                <form method="post" action="{{url('admin/news/'.$new->id)}}" enctype="multipart/form-data">
                    {{csrf_field()}}
                    {{method_field('PUT')}}
                    <div class="box-body">

                        <div class="col-xs-12 cus-12">
                            <div class="form-group form-ar">
                                <label for="name">العنوان *</label>
                                <input type="text" class="form-control" id="name"  name="tittle" style="width: 100%" value="{{ $new->name }}">
                            </div>
                        </div>

                        <div class="col-xs-12 cus-12">
                            <div class="form-group form-ar">
                                <label for="name">التفاصيل *</label>

                                <textarea class="text" name="message">
                                    {{$new->description}}
                                </textarea>
                            </div>
                        </div>

                    </div>


                    <div class="col-md-6 col-xs-12 cus-12">
                        <div class="form-group reli">
                            <label for="image">ارفع الصور </label>
                            <input type="file" id="gallery-photo-add" class="upload-hidden" name="images[]"
                                   multiple accept="jpg, gif, png" value="{{url('uploads/')}}.1508533048aqar-test.png"/>
                            <button class="btn btn-default upload">
                                رفع
                            </button>

                            <input type="hidden" name="deletedImages[]" id="deletedImages" />

                            <div class="gallery">
                                @foreach($new->news_images as $image)
                                    <div style="position: relative;display: inline-block" id="{{$image->id}}">
                                        <img src="{{url('uploads/' . $image->img_url)}}" style="width: 100px;height: 100px">
                                        <button type="button" class="delete-btn" value="{{$image->id}}" onclick="deleteImage(this.value)" style="position: absolute;top: 0;right: 0;z-index: 99999">
                                            X
                                        </button>
                                    </div>

                                @endforeach
                            </div>
                        </div>
                    </div>



                    <div class="box-footer" style="text-align: left">
                        <div class="col-xs-12">
                            <button class="btn btn-primary " type="submit">
                                        <span>
                                                تعديل
                                            </span>
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection


