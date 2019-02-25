<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Product_category;
use \Gumlet\ImageResize;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;  
use File;
class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     //  echo "test";
        return view('product.product');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

  

   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function getProduct($id){
      
        $product = DB::table('products')
        ->where('id', $id)
        ->first();
        echo json_encode($product);
    }

    public function getCategory($id){
      
        $product = DB::table('product_categories')
        ->where('id', $id)
        ->first();
        echo json_encode($product);
    }    
    

    public function store(Request $request)
    {
          
        $request->validate([
            'product_name'=>'required',
            'product_price'=> 'required|integer',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
            
          ]);
   
     $new_path = "";   
     $product_id = "";
     $delete_picture = "";
      if($request->get('product_id') != ""){
            $product_id = $request->get('product_id');
            $product_data = \App\Product::where('id', $product_id)->first();
             if($product_data){
                    $delete_picture = $product_data->picture_path;
                }
                else{
                    return redirect('/')->with('error', 'Product ID : '.$product_id.' is empty .');
                }
    }
      if ($request->hasFile('image')) {

            $path = public_path('img/products');

            if($product_id != ""){
              $id = $product_id;
            }
            else{
              $id = $this->getID();
            }
            
            $imageName = $id."_".date('d_m_Y').'.'.$request->image->getClientOriginalExtension();

              if($delete_picture != ""){
                  if(File::exists($path."/".$delete_picture)) {
                      unlink($path."/".$delete_picture);
                  }
                 
              }
   
            if (!$request->image->move($path, $imageName)) {
              
                return redirect('/')->with('error', 'Error saving the file.');
            }
            $data['path'] = $path;
            $data['name'] = $id."_".date('d_m_Y');
            $data['extension'] = $request->image->getClientOriginalExtension();
            $new_img = $this->imageResize($data);
            
            $new_path = asset('img/products')."/".$new_img; 
        }

         

     if($request->get('product_form_type') == 'add'){
            $product = new Product([
                'category_id' => $request->get('category'),
                'product_name' => $request->get('product_name'),
                'price'=> $request->get('product_price'),
                'picture_path' => $new_img
          
          ]);
            
          $product->save();

          return redirect('/')->with('success', 'Product has been added');

      }
      else{
       //echo"<pre>";print_r($product);

        $product = \App\Product::find($product_id);

        $product->category_id = $request->get('category');
        $product->product_name = $request->get('product_name');
        $product->price = $request->get('product_price');
        if ($request->hasFile('image')) {
            $product->picture_path = $new_img;
        }

        $product->save();
      
        return redirect('/')->with('success', 'Product has been updated');

      }


    }

    public function category(Request $request){


       $request->validate([
        'category_add'=>'required'
      ]);


       if($request->get('category_form_type') == 'add'){
            $category = new Product_category([
                'category_name' => $request->get('category_add')
            ]);
            $text = 'added.';
        }
        else{

            $category_id = $request->get('category_id');

            $category = \App\Product_category::find($category_id);
            $category->category_name = $request->get('category_add');

            $text = 'updated.';
        }   
            $category->save();
       
      return redirect('/')->with('success', 'Category has been '.$text);
    }

    public function delCategory($id){
      
        $category = \App\Product_category::find($id);
        if($category->delete()){
            return "success";
        }
        else{
            return "error";
        }


    }

    public function delProduct($id){
      $path = public_path('img/products');
      $delete_picture = "";
      $product_data = \App\Product::where('id', $id)->first();
      if($product_data){
             $delete_picture = $product_data->picture_path;
        }

      if($delete_picture != ""){
                if(File::exists($path."/".$delete_picture)) {
                    unlink($path."/".$delete_picture);
                }
               
            }
     
        $product = \App\Product::find($id);
        if($product->delete()){
            return "success";
        }
        else{
            return "error";
        }


    }

    public function imageResize($data){
       
        try{

            $path = $data['path']."/".$data['name'].".".$data['extension'];
            $new_file = $data['path']."/".$data['name']."_Resize.".$data['extension'];
            $image = new ImageResize($path);
            $image->resizeToBestFit(250, 250);
            $image->save($new_file); 

           unlink($path);
           return $data['name']."_Resize.".$data['extension'];
           
        } catch (ImageResizeException $e) {
           // return "" . $e->getMessage();
            return redirect('/')->with('success', 'Something went wrong. ');
        }
      

       
    }

    public function getID(){
        $product = DB::table('products')->orderBy('id', 'desc')->first();
        return isset($product)?($product->id)+1:1;

    }

    public function getCategorylist(){

        $category = DB::table('product_categories')->select('id as id', 'category_name as text')->get();
        echo json_encode($category);
    }

   

    public function categoryDatatable(){
        $category = DB::table('product_categories')->get();

        if($category->isNotEmpty()){
            foreach($category as $categorys){
                $array['DT_RowId'] = $categorys->id;
                $array['created_at'] = '<div class="text-xs-center">'.$categorys->created_at.'</div>';
                $array['category_name'] = '<div class="text-xs-left">'.$categorys->category_name.'</div>';   
                $array['option'] = '<div class="text-xs-center"><a href="#" onclick="edit_category(\''.$categorys->id.'\');"><i class="far fa-edit"></i></a>&nbsp;';
                $array['option'] .= '<a href="#" onclick="delete_category(\''.$categorys->id.'\');"><i class="fas fa-trash-alt"></i></i></a></div>';
                $data['aaData'][] = $array;

            }
        }
        else{
             $array['DT_RowId'] = null;
             $array['created_at'] = null;
             $array['category_name'] = 'ไม่มีข้อมูล';   
             $array['option'] = null;

             $data['aaData'][] = $array;
        }

        echo json_encode($data);
    }

    public function productDatatable(){
        $product = DB::table('products')
        ->leftJoin('product_categories', 'products.category_id', '=', 'product_categories.id')
        ->select('*','products.id as product_id')
        ->get();

        if($product->isNotEmpty()){
            $default_picture = asset('img')."/no-img-preview.png"; ;
            foreach($product as $products){
                $array['DT_RowId'] = $products->product_id;
                $array['created_at'] = '<div class="text-xs-center">'.$products->created_at.'</div>';
                if($products->picture_path != ""){
                    $array['image'] = '<div class="text-xs-left"><img class="img-thumbnail" src="'.asset('img')."/products/".$products->picture_path.'"  ></div>';   
                }
                else{
                    $array['image'] = '<div class="text-xs-left"><img src="'.$default_picture.'"  height="100" width="100"></div>';   
                    
                }
                $array['category'] = '<div class="text-xs-left">'.$products->category_name.'</div>';   
                $array['product_name'] = '<div class="text-xs-left">'.$products->product_name.'</div>';   
                $array['price'] = '<div class="text-xs-center">'.$products->price.'</div>';  
                $array['option'] = '<div class="text-xs-center"><a href="#" onclick="edit_product(\''.$products->product_id.'\');"><i class="far fa-edit"></i></a>&nbsp;';
                $array['option'] .= '<a href="#" onclick="delete_product(\''.$products->product_id.'\');"><i class="fas fa-trash-alt"></i></i></a></div>';
                $data['aaData'][] = $array;

            }
        }
        else{
             $array['DT_RowId'] = null;
             $array['created_at'] = null;
             $array['image'] = null;
             $array['category'] = null;
             $array['product_name'] = 'ไม่มีข้อมูล';   
             $array['price'] = null;
            
             $array['option'] = null;

             $data['aaData'][] = $array;
        }

        echo json_encode($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

}
