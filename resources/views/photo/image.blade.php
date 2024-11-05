@extends('adm.layout.admin-index')
@section('title','Add:- Product')

@section('toast')
  @include('adm.widget.toast')
@endsection

@section('custom-js')


{{dd('add')}}
<script>
$('.category_parent_id').on('change', function() {
        var parent = $(this).find(':selected').val();
    // alert(parent);

        $.get( `{{url('api')}}/get/getPetaKacheri/`+parent, { category_parent_id: parent })
        .done(function( data ) {
          // alert(JSON.stringify(data));

        if(JSON.stringify(data.length) == 0){
            $('.sub_category_parent_id').html('<option>Sub Category</option>');
        }
        else{
                $('.sub_category_parent_id').empty();     
            $('.sub_category_parent_id').html('<option value="">Sub Category</option>');
            for(var i = 0 ; i < JSON.stringify(data.length); i++){  
                $('.sub_category_parent_id').append('<option value='+JSON.stringify(data[i].id)+'>'+ data[i].name +'</option>')
            }
        }
    });
    $('.category_id').val(parent);

    });


    $('.sub_category_parent_id').on('change', function() {
        var parent = $(this).find(':selected').val();

        $.get( `{{url('api')}}/get/getDepartment/`+parent, { sub_category_parent_id: parent })
        .done(function( data ) {
          // alert(JSON.stringify(data));

        if(JSON.stringify(data.length) == 0){
            $('.subcategory2_id').html('<option>Select Sub Category2</option>');
        }
        else{
                $('.subcategory2_id').empty();     
            $('.subcategory2_id').html('<option value="">Select Sub Category2</option>');
            for(var i = 0 ; i < JSON.stringify(data.length); i++){  
                $('.subcategory2_id').append('<option value='+JSON.stringify(data[i].id)+'>'+ data[i].name +'</option>')
            }
        }
    });
    
    $('.category_id').val(parent);
       
    });
    
    $('.subcategory2_id').on('change', function() {
        var parent = $(this).find(':selected').val();
        $('.category_id').val(parent);
       
    });

    
    
$(".listing").addClass( "menu-is-opening menu-open");
$(".listing a").addClass( "active-menu");

</script>

    <script>
       var dataCounter = 1;
        $('.add-more').click(function () { 
          // alert('text');

         var imageBlockCode = $('.image-container').html();

         dataCounter = Number(dataCounter) + 1;


          var data = ` 
        <div class="row col-sm-12 p-0 image-block mb-3">
            <div class="col-sm-4">
                <input type="file" class="image" name="image[]"   accept="image/png,image/jpeg,image/webp">
            </div>

            <div class="col-sm-4">
                <input type="text" class="form-control title" name="title[]" placeholder="Title">
            </div>

            <div class="col-sm-4 p-0">
                <input type="text" class="form-control alt" name="alt[]" placeholder="Alt Text">
            </div>
        </div>

        `;

          $('.res').append(data);
          
        });


async function updateProductImage(e) {
  e.preventDefault();

  alert('test'+e.target.image_alt.value);

  const formData = new FormData();
  formData.append('image_alt', e.target.image_alt.value);
  formData.append('image_title', e.target.image_title.value);

  axios.post(GLOBAL.API + 'media/update-product-image', formData)
  .then(res => {
    if(res.data == 'success'){
      alert('1');
      toastr.success('Product Image Added...')
        getMedias();
        console.log('done');  
    }
    else if(res.data == 'not-exists'){
      alert('0');

        console.log('file Already deleted');
    }
  })
}

$(".update-form").submit(function(e) {
    e.preventDefault(); // prevent actual form submit
    var form = $(this);
    var url = form.attr('action'); //get submit url [replace url here if desired]
    $.ajax({
         type: "POST",
         url: url,
         data: form.serialize(), // serializes form input
         success: function(data){
             console.log(data);
             
          toastr.success('Product Image Added...')
         }
    });

});

$(".btnDelete").click(function(e) {
    var url = $(this).attr('data-url');
    var el = $(this);
    $.ajax({
        type: "GET",
        url: url,
        success: function(result) {
            
            el.closest('.update-form').remove().slideUp(1000);

            
        },
        error: function(result) {
            alert('error');
        }
    });
});

    </script>

@endsection
@section('content')



<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Manage Photos</h1>
          </div>
          
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Home</a></li>
              <li class="breadcrumb-item active">Manage Photos</li>
              <a href="{{route('admin.category.create')}}" class="btn btn-success btn-sm ml-2"><i class="fa fa-plus" aria-hidden="true"></i>
                &nbsp;&nbsp;Manage Sub Category </a>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="card card-default">
        

          <div class="card-body">
            <div class="form-horizontal row">
            
            <div class="col-md-12"  style="
                        background: whitesmoke;
                        padding: 10px !important;
                    ">
                 
                  <div class="form-group row">
                     
                    <div class="col-sm-4">
                        <label  class="text-dark" for="product_name">Sub Category</label>
                        <input type="text" class="form-control category_parent_id"
                        
                        value="{{getParentCategory($product->category_id)['subcategory']->name}}" disabled>
                     </div>

                    <div class="col-sm-4">
                        <label  class="text-dark" for="product_name">Main Category</label>
                        <input type="text" class="form-control category_parent_id"
                        value="{{getParentCategory($product->category_id)['category']->name}}" disabled>
                     </div>

                   <input type="hidden" name="old_image" value="{{$product->image}}">
                  <input type="hidden" class="media_id" value="{{$product->id}}">
                  
                  <input type="hidden" class="image_type" value="product">
                     
                    <!-- <input type="text" class="form-control category_parent_id"
                     value="{{getParentCategory($product->category_id)['category']->name}}" disabled> -->
                    

                    
                    <div class="col-sm-4">
                    <!-- <input type="text" class="form-control category_parent_id"
                     value="{{getParentCategory($product->category_id)['subcategory']->name}}" disabled> -->

                    </div>
                  </div>
                  
                  <input type="hidden" name="category_id" class="category_id" 
                    value="@if(old('category_id')) {{old('category_id')}} @else 0 @endif"> 

                   
    <form action={{route('upload.multiple-image')}} method="post" enctype="multipart/form-data">

      <div class="image-container col-sm-9 p-0">
      <h5 class="text-danger">Upload Photos</h5>
        <div class="row image-block col-sm-12 mb-3 p-0" style="position: relative;
    align-items: center;
">
        
                  <input type="hidden" name="media_id" value="{{$product->id}}">
                  
                  <input type="hidden" name="image_type" value="product">

            <div class="col-sm-4">
                <input type="file" class="image" name="image[]"   accept="image/png,image/jpeg,image/webp">
            </div>

            <div class="col-sm-4">
                <input type="text" class="form-control title" name="title[]" placeholder="Title">
            </div>

            <div class="col-sm-4 p-0">
                <input type="text" class="form-control alt" name="alt[]" placeholder="Alt Text">
            </div>

        
        </div>

          <div class="res">

          </div>
        </div>


            <div class="col-sm-9 pt-1" style="min-height:40px">

              <button class="btn btn-dark btn-sm pull-right mx-2" type="submit" 
              style="font-size: 15px;padding: 1px 10px;vertical-align: middle;">
              <i class="fa fa-upload" aria-hidden="true"></i>&nbsp;&nbsp; Start Upload</button>

              <button type="button" class="add-more btn btn-primary btn-sm pull-right" 
                style="font-size: 15px;padding: 1px 10px;vertical-align: middle;">
                <i class="fa fa-plus" aria-hidden="true"></i> &nbsp;&nbsp;Add More
              </button>

          </div>

<hr/>
</div>


        
</form>
        

</div>



          <div class="form-horizontal row text-center mb-3 text-center" style="
                  background: #dedede;
                  position: relative;display: flex;align-items: center;">

              <div class="col-sm-3">
                <strong>Photo</strong>
              </div>

              <div class="col-sm-3">
               <strong>title</strong>
              </div>

              <div class="col-sm-3">
               <strong>Alt Text</strong>
              </div>

              <div class="col-sm-3">
               <strong>Action</strong>
              </div>

            </div>

        <div class="row">
          @foreach(getProductImages($product->id, 0 , 'DESC') as $image)

          <form class="col-sm-12 update-form" action="{{route('update.multiple-image-field', $image->id)}}"
           method="post" id="{{$image->id}}">

          @csrf
              <div class="row  col-sm-12 mb-3 text-center selected-images" style="">
                <div class="col-sm-3">
                  <img src="{{url('')}}/web/media/sm/{{$image->image}}" width="200"/>
                </div>

                <div class="col-sm-3">
                    <input type="text" class="form-control form-control-sm title" name="title" value="{{$image->image_title}}" 
                    placeholder="Title" required>
                </div>

                <div class="col-sm-3">
                    <input type="text" class="form-control form-control-sm alt" name="alt" placeholder="Alt Text"  value="{{$image->image_alt}}" 
                     required>
                </div>

                  <div class="col-sm-3">
                  
                    <button type="save" class="btnUpload btn btn-success btn-sm mr-2" 
                      style="font-size: 15px;padding: 1px 10px;vertical-align: middle;">
                      <i class="fa fa-plus" aria-hidden="true"></i> &nbsp;&nbsp;Update Field
                    </button>
                  
                    <a class="btnDelete btn btn-danger btn-sm mr-2" data-url="{{url('api')}}/media/media-delete/{{$image->id}}"
                      style="font-size: 15px;padding: 1px 10px;vertical-align: middle;">
                      <i class="fa fa-plus" aria-hidden="true"></i> &nbsp;&nbsp;Delete
                    </a>
                    
                  </div>

                </div>

            </form>

            @endforeach


              </div>
              </div>
              </div>
        </div>


      </div>
    </section>
  </div>

  @endsection
