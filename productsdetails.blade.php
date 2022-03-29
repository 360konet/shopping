<!DOCTYPE html>
<html>
@include('frontend.header')

<body>
    <div class="py-3 mb-4 shadow-sm bg-warning border-top">
        <div class="conatiner">
            <h6 class="mb-0"> Category/{{$products->category->name}}/{{$products->name}}</h6>
</div>
</div>

    <div class="container">
        <div class="row">
<div class="card mb-3  product_data" style="max-width: 540px;">
  <div class="row g-0">
    <div class="col-md-4">
      <img src="{{asset('assets/upload/products/' .$products->image)}}" class="img-fluid rounded-start" alt="...">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title">{{$products->name}}</h5>
        <p class="card-text">{{$products->description}}.</p>
        <label><s>{{$products->original_price}}</s></label><br>
        <label>{{$products->selling_price}}</label>
         <br>
         @if($products->qty > 0)
         <label class="badge bg-success">In Stock</label>
         @else
         <label class="badges bg-danger">Out of Stock</lable>
         @endif
         <div class="row mt-2">
             <div class="col-md-2">
               <input type="hidden" value="{{$products->id}}" class="prod_id">
                 <label for="Quantity">Quantity</label>
                 <div class="input-group text-center mb-3">
                     <button class="input-group-text decrement-btn">-</button>
                     <input type="text" name="quantity"  class="form-control qty-input text-center" value="1">
                     <button class="input-group-text increment-btn">+</button>
</div>
<div class="col-md-10">
</div>
<button type="button" class="btn btn-warning">Add to wish List<i class="fa fa-heart"></i></button>
<button type="button" class="btn btn-success addToCartBtn"> Add to cart<i class="fa fa-cart"></i></button>
        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
      </div>
    </div>
  </div>
</div>
      </div>
      </div>

      <script>
          $(document).ready(function (){
                   
            $('.addToCartBtn').click(function (e){
                e.preventDefault();
                var product_id = $(this).closest('.product_data').find('.prod_id').val();
                var product_qty = $(this).closest('.product_data').find('.qty-input').val();
               
                $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

                $.ajax({
                  method: "POST",
                  url: "/add-to cart",
                  data: {
                    'product_id': product_id,
                    'product_qty': product_qty,
                  },
                  success: function (response){
                     alert(response.status);
                  }
                });
            });

              $('.increment-btn').click(function (e){
                  e.preventDefault();
                  var inc_value = $('.qty-input').val();
                   var value = parseInt(inc_value, 10);
                   value = isNaN(value) ? 0 :value;
                   if(value < 10){
                       value++;
                       $('.qty-input').val(value);
                   }
              });

              $('.decrement-btn').click(function (e){
                  e.preventDefault();
                  var dec_value = $('.qty-input').val();
                   var value = parseInt(dec_value, 10);
                   value = isNaN(value) ? 0 :value;
                   if(value > 1){
                       value--;
                       $('.qty-input').val(value);
                   }
              });
          });
          </script>
</body>
</html>