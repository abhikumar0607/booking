@extends('admin.layouts.master')
@section('content')
<section class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h1>Edit Banner Detail</h1>
         </div>
      </div>
   </div>
</section>
<section class="content">
   <div class="row">
      <div class="col-md-12">
         <div class="card card-secondary">
            <div class="card-body">              
               <form action="{{ route('admin.update.banner',$banner_detail->id) }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="card-body">
                     <div class="form-group left-box-rw-row">
                        <label for="inputpagename">Page Banner Name</label> 
                        <select name="page_name" id="page_name" class="form-control">
                           <option value="home" {{ $banner_detail->page_name == 'home' ? 'selected' : '' }}>Home Page</option>
                           <option value="home_top_offer_banner_1" {{ $banner_detail->page_name == 'home_top_offer_banner_1' ? 'selected' : '' }}>Home Page Top Offer Banner 1</option>
                           <option value="home_top_offer_banner_2" {{ $banner_detail->page_name == 'home_top_offer_banner_2' ? 'selected' : '' }}>Home Page Top Offer Banner 2</option>
                           <option value="home_top_offer_banner_3" {{ $banner_detail->page_name == 'home_top_offer_banner_3' ? 'selected' : '' }}>Home Page Top Offer Banner 3</option>
                           <option value="home_top_offer_banner_4" {{ $banner_detail->page_name == 'home_top_offer_banner_4' ? 'selected' : '' }}>Home Page Top Offer Banner 4</option>
                           <option value="home_gift_card_banner_1" {{ $banner_detail->page_name == 'home_gift_card_banner_1' ? 'selected' : '' }}>Home Page Gift Card Banner 1</option>
                           <option value="home_gift_card_banner_2" {{ $banner_detail->page_name == 'home_gift_card_banner_2' ? 'selected' : '' }}>Home Page Gift Card Banner 2</option>
                           <option value="home_gift_card_banner_3" {{ $banner_detail->page_name == 'home_gift_card_banner_3' ? 'selected' : '' }}>Home Page Gift Card Banner 3</option>
                           <option value="home_gift_card_banner_4" {{ $banner_detail->page_name == 'home_gift_card_banner_4' ? 'selected' : '' }}>Home Page Gift Card Banner 4</option>
                           <option value="shop" {{ $banner_detail->page_name == 'shop' ? 'selected' : '' }}>Shop Page</option>
                           <option value="about_us" {{ $banner_detail->page_name == 'about_us' ? 'selected' : '' }}>About us Page</option>
                           <option value="buy_eGift_card" {{ $banner_detail->page_name == 'buy_eGift_card' ? 'selected' : '' }}>Buy eGift Card Page</option>
                           <option value="foundation" {{ $banner_detail->page_name == 'foundation' ? 'selected' : '' }}>Foundation Page</option>
                           <option value="all_categories" {{ $banner_detail->page_name == 'all_categories' ? 'selected' : '' }}>All Categories Page</option>
                           <option value="all_brands" {{ $banner_detail->page_name == 'all_brands' ? 'selected' : '' }}>All Brands Page</option>
                           <option value="corporate_business" {{ $banner_detail->page_name == 'corporate_business' ? 'selected' : '' }}>Corporate Business Page</option>
                        </select>
                     </div>
                     <div class="form-group right-box-rw-row">
                        <label for="logo">Large Banner (3440)</label>
                        <div class="input-group">
                           <div class="custom-file">
                              <input type="file" name="large_banner" class="custom-file-input" id="large_banner">
                              <label class="custom-file-label" for="large_banner">Choose Image</label>
                           </div>
                        </div>
                        <img alt="{{ $banner_detail->large_banner }}" src="{{ url('public/uploads/banners/'.$banner_detail->large_banner) }}" height="50px" width="50px">
                     </div>
                     <div class="form-group left-box-rw-row">
                        <label for="logo">Main Banner (1920)</label>
                        <div class="input-group">
                           <div class="custom-file">
                              <input type="file" name="main_banner" class="custom-file-input" id="main_banner">
                              <label class="custom-file-label" for="main_banner">Choose Image</label>
                           </div>
                        </div>
                        <img alt="{{ $banner_detail->main_banner }}" src="{{ url('public/uploads/banners/'.$banner_detail->main_banner) }}" height="50px" width="50px">
                     </div>                     
                     <div class="form-group right-box-rw-row">
                        <label for="logo">Mobile Banner</label>
                        <div class="input-group">
                           <div class="custom-file">
                              <input type="file" name="small_banner" class="custom-file-input" id="small_banner">
                              <label class="custom-file-label" for="small_banner">Choose Image</label>
                           </div>
                        </div>
                        <img alt="{{ $banner_detail->small_banner }}" src="{{ url('public/uploads/banners/'.$banner_detail->small_banner) }}" height="50px" width="50px">
                     </div>
                     <div class="form-group left-box-rw-row">
                        <label for="inputStatus">Status</label>
                        <select name="status" id="status" class="form-control">
                           <option value="Active" {{ $banner_detail->status == 'Active' ? 'selected' : '' }}>Active</option>
                           <option value="Suspend" {{ $banner_detail->status == 'Suspend' ? 'selected' : '' }}>Pending</option>
                        </select>
                     </div>
                     <div class="form-group right-box-rw-row">
                        <label for="link_of_banner">Link Of Banner</label> 
                        <input type="text" name="link_of_banner" class="form-control" id="link_of_banner" value="{{ $banner_detail->link_of_banner }}">
                     </div>
                     <div class="form-check full-box-btn">
                        <input type="submit" class="btn btn-primary" name="submit" value="Save">
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</section>
</div>
@endsection