

 $(document).ready(function() {
 // /  console.log("test");
 base_url = window.location.origin;


/* Datatable Product*/
     table_product = $('#product_table').DataTable({
      aaSorting: [[ 2, 'desc' ]],
      bProcessing: true,
      order: [[ 0, "desc" ]],
      sAjaxSource: base_url+'/getproductTable',
      aLengthMenu: false,
      bLengthChange: false,
      autoWidth: false,
      iDisplayLength: 10,
      aoColumns: [
      //  {mData: 'checkbox'},
        {mData: 'created_at'},
        {mData: 'image'},
        {mData: 'category'},
        {mData: 'product_name'},
        {mData: 'price'},
        {mData: 'option'},
       
           ],
    
         dom: 'Bfrtip',
        buttons: [
            {
                text: 'Add Product',
                action: function ( e, dt, node, config ) {
                      $("#product_modal").modal('toggle');   
                }
            }
        ]
    });

/* Datatable Category*/
      table_category= $('#category_table').DataTable({
      aaSorting: [[ 2, 'desc' ]],
      bProcessing: true,
      order: [[ 0, "desc" ]],
      sAjaxSource: base_url+'/getcategoryTable',
      aLengthMenu: false,
      bLengthChange: false,
      autoWidth: false,
      iDisplayLength: 10,
      aoColumns: [
      //  {mData: 'checkbox'},
        {mData: 'created_at'},
        {mData: 'category_name'},
        {mData: 'option'},
       
           ],
    
         dom: 'Bfrtip',
        buttons: [
            {
                text: 'Add Category',
                action: function ( e, dt, node, config ) {
                      $("#category_modal").modal('toggle');   
                }
            }
        ]
    });
    

/* Category List JSON*/
      var json_category = function () {
          var tmp = null;
          $.ajax({
              'async': false,
              'type': "GET",
              'global': false,
              'dataType': 'html',
              'url': "/getcategorylist",
              'success': function (data) {
                var myArray = JSON.parse(data);
                  tmp = myArray;
              }
          });
          return tmp;
      }();

/* Category List*/
    $("#category_list").select2({
          placeholder: "Category" ,
          data:json_category,
          maximumSelectionLength: 2
    })

/*Call function show image example*/
    $("#image").change(function () {
        readURL(this);
    });

  /*Clear Modal*/
 $('#product_modal').on('hidden.bs.modal', function () {
      $('#product_name').val('');  
      $('#product_price').val('0');       
      $('#image').val('');       
      $('#image_upload_preview').val('');           
      $('#image_upload_preview').attr('src', base_url+"/img/no-img-preview.png");  
         
        });
   });



/* Show Example Image*/
  function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#image_upload_preview').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    function edit_product(id) {

      $("#product_modal").modal('toggle');   
      $("#product_form_type").val('edit');  
     

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
          $.ajax({
                    type:'ajax',
                    method:'get',
                    url: base_url+"/getproduct/"+id,
                 
                    dataType:'json',
                  success:function (result){
                       
                      //console.log(result);
                      $('#category_list').val(result.category_id).trigger('change.select2');
                      $("#product_name").val(result.product_name);
                      $("#product_id").val(result.id);
                      $("#product_price").val(result.price);

                      if(result.picture_path != ''){
                        $("#image_upload_preview").attr('src',base_url+"/img/products/"+result.picture_path);
                      }  
                      else{
                         $("#image_upload_preview").attr('src',base_url+"/img/no-img-preview.png");
                        
                      }
                  },
                  error: function (data, textStatus, errorThrown) {
                    console.log(data);
                  },
                });
    }

  function edit_category(id){
      $("#category_modal").modal('toggle');   
      $("#category_form_type").val('edit');  
     
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
          $.ajax({
                    type:'ajax',
                    method:'get',
                    url: base_url+"/getcategory/"+id,
                 
                    dataType:'json',
                  success:function (result){
                       
                     
                      $("#category_add").val(result.category_name);
                      $("#category_id").val(result.id);
                   

                     
                  },
                  error: function (data, textStatus, errorThrown) {
                    console.log(data);
                  },
                });
  }


  function delete_category(id){
    //table_category.row('#12').remove().draw(); 
bootbox.confirm({
            
        message: "Are you sure ?",
       
        buttons: {
        confirm: {
            label: '<i class="fa fa-check"></i> Confirm',
            className: 'btn-success'
        },
        cancel: {
            label: '<i class="fa fa-times"></i> Cancel',
            className: 'btn-danger'
        }   
    },
    callback: function (conf) {
            $.ajax({
                          type:'ajax',
                          method:'get',
                          url: base_url+"/deletecategory/"+id,
                        //  dataType:'json',
                        success:function (result){
                             //console.log(result);
                          if(result == 'success'){
                             bootbox.alert({
                                message: "Category has been deleted!",
                                size: 'small'
                            });

                            table_category.row('#'+id).remove().draw();  
                          }
                          else{
                              bootbox.alert({
                                message: "Something wrong!",
                                size: 'small'
                            });
                          }
                        },
                        error: function (data, textStatus, errorThrown) {
                          console.log(data);
                        },
                      });

                }
});
           
  }

   function delete_product(id){
    //table_category.row('#12').remove().draw(); 
bootbox.confirm({
            
        message: "Are you sure ?",
       
        buttons: {
        confirm: {
            label: '<i class="fa fa-check"></i> Confirm',
            className: 'btn-success'
        },
        cancel: {
            label: '<i class="fa fa-times"></i> Cancel',
            className: 'btn-danger'
        }   
    },
    callback: function (conf) {
            $.ajax({
                          type:'ajax',
                          method:'get',
                          url: base_url+"/deleteproduct/"+id,
                        //  dataType:'json',
                        success:function (result){
                             console.log(result);
                         /* if(result == 'success'){
                             bootbox.alert({
                                message: "Category has been deleted!",
                                size: 'small'
                            });

                            table_category.row('#'+id).remove().draw();  
                          }
                          else{
                              bootbox.alert({
                                message: "Something wrong!",
                                size: 'small'
                            });
                          }
                          */
                        },
                        error: function (data, textStatus, errorThrown) {
                          console.log(data);
                        },
                      });

                }
});
           
  }