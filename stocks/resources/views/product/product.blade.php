
@extends('layouts.app')
@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
  .dt-buttons.btn-group{
        padding: 5px 5px 5px 0;
  }
  .select2.select2-container{
    width: 100% !important;
  }

 .fa-trash-alt{
  color:#c31717;
 }

</style>


<div class="container">

<div class="card uper">
 


  <div class="card-header">
   Admin
  </div>
  <div class="card-body">
 @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div><br />
  @endif

  @if(session()->get('error'))
    <div class="alert alert-danger">
      {{ session()->get('error') }}  
    </div><br />
  @endif


<div class="row pageorderedit">
    <div class="col-sm-12">
  
    <div class="row form-group">
       <div class="col-sm-12">

<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#product" role="tab" aria-controls="pills-home" aria-selected="true">Product</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#category" role="tab" aria-controls="pills-profile" aria-selected="false">Category</a>
  </li>
 
</ul>
  </div>
    </div>

        <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="product" role="tabpanel" aria-labelledby="pills-home-tab">
        <div class="row form-group">
                       <div class="col-sm-12">
                        
                          <div class="row">
                        
                           
                           <div class="col-sm-12">
                                    
                                    <div class="datatableToolBar">
                                                <div class="table-responsive">
                                                  <table  class="table" id="product_table">
                                                    <thead>
                                                      <tr>
                                                        <th>Created At</th>
                                                        <th>Image</th>
                                                        <th>Category</th>
                                                        <th>Product</th>
                                                        <th>Price</th>
                                                        <th>Option</th>
                                                      </tr>
                                                    </thead>
                                                  </table>

                                                </div>
                                                
                                                    <!-- Modal -->
                                    
                                    </div>
                         
                              </div>    
                        </div>
                       
                      </div>    
              </div>
         </div>
        
        

         
        <div class="tab-pane fade show" id="category" role="tabpanel" aria-labelledby="pills-home-tab">
        <div class="row form-group">
                       <div class="col-sm-12">
                        
                          <div class="row">
                        
                           
                           <div class="col-sm-12">
                                    
                                    <div class="datatableToolBar">
                                                <div class="table-responsive">
                                                  <table  class="table" id="category_table">
                                                    <thead>
                                                      <tr>
                                                        <th>Created At</th>
                                                        <th>Category</th>                           
                                                        <th>Option</th>
                                                      </tr>
                                                    </thead>
                                                  </table>

                                                </div>
                                                
                                                    <!-- Modal -->
                                    
                                    </div>
                         
                              </div>    
                        </div>
                       
                      </div>    
              </div>
         </div>
         </div>
        
           

           
      </div>
    </div>
  </div>
</div>

</div>

<!--viewproduct-->

 <div class="modal fade" id="product_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="width:650px !important">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" style="display: inline;">Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="{{url('store')}}" enctype="multipart/form-data" >
        @csrf
      <div class="modal-body">
    
       <div class="form-group" >
                       
           <div class="col-sm-12">
            
              
            <div class="form-group row">
                    <label for="contact_name" class="col-sm-3 form-control-label">Category </label> 
                  <div class="col-sm-9">
                     <select class="form-control" id="category_list" name="category">
                    
                     </select>
                  </div>    
              </div>  
            <div class="form-group row">
                    <label for="contact_name" class="col-sm-3 form-control-label">Product </label> 
                  <div class="col-sm-9">
                    <input type="text" name="product_name" class="form-control" id="product_name" placeholder="Product Name" required>
                  </div>    
              </div>
               <div class="form-group row">
                    <label for="contact_name" class="col-sm-3 form-control-label">Price </label> 
                  <div class="col-sm-4">
                      <input type="number" min="0" name="product_price" class="form-control" id="product_price" value="1" placeholder="Price" required>
                  </div>    
              </div>
               <div class="form-group row">
                    <label for="contact_name" class="col-sm-3 form-control-label">Picture </label> 
                  <div class="col-sm-6">
                      <input type="file"  class="form-control" id="image" name="image" size="20" >
                     <img id="image_upload_preview" class="img-fluid img-thumbnail" src="{{asset('img/no-img-preview.png')}}" alt="your image" />
                  </div>    
              </div>
            </div>       
                        
                
            </div>
     
      </div>
      
  
     
      <div class="modal-footer">
        <input type="hidden" name="product_form_type" id="product_form_type" value="add">
        <input type="hidden" name="product_id" id="product_id" value="">
        <button type="submit" class="btn btn-primary"  id="submit-all" >Submit</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
     
      </div>
        </form>
    </div>
  </div>
</div>


<!--viewcategory-->

 <div class="modal fade" id="category_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="width:650px !important">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" style="display: inline;">Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="{{url('category')}}" enctype="multipart/form-data" >
        @csrf
      <div class="modal-body">
    
       <div class="form-group" >
                       
           <div class="col-sm-12">
            
              
            <div class="form-group row">
                    <label for="contact_name" class="col-sm-3 form-control-label">Category </label> 
                  <div class="col-sm-9">
                    <input type="text" name="category_add" id="category_add" class="form-control" placeholder="Category" required="">
                  </div>    
              </div>  
        
            </div>       
                        
                
            </div>
     
      </div>
      
  
     
      <div class="modal-footer">
        <input type="hidden" id="category_form_type" name="category_form_type" value="add">
        <input type="hidden" id="category_id" name="category_id" value="add">
         <button type="submit" class="btn btn-primary"  id="submit-all" >Submit</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
     
      </div>
        </form>
    </div>
  </div>
</div>
@endsection


@section('page-script')
 <script type="text/javascript" src="{!! asset('js/list.js') !!}"></script>
@stop