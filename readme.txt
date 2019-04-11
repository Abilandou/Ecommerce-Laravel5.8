  Some key points

  dbName: ecomdulfy
  dbUserName: dulfy
  dbPwd:dulfy1996

  If you encountered this problem 

     Illuminate\Database\QueryException  : SQLSTATE[42000]: Syntax error or access violation: 1071 Specified key was too long; max key length is 767 bytes (SQL: alter table `users` add unique `users_email_unique`(`email`))

 Do the following 
  call this at the top, of AppServiceProvider.php file
  use Illuminate\Support\Facades\Schema;

  Then add the following in boot() function.
  
  public function boot()
  {
      Schema::defaultStringLength(191);
  }


  Beginning from Tutorial 6

  In this part will create dashboard page of admin, set its header and footer that later on and finally reaches dashboard page from login page

  1) Layout Structure:- structuer is very important now that we will use for all pages of admin and for front as well later on, and that must be clear.
  First in layuts folder in views folder,
  create below folders:-
  i) adminLayout
  ii) frontLayout

  frontlayout folder contains all the common files like header, footer for front that we will see later on.
   
  adminLayout will contain common files for admin; so we will create head, footer for admin and store in this folder. 
  So, in adminLayout folder, we will create below files: 
  admin_design.blade.php(this will contain complete html design of admin,
  admin_design file will contain header, footer and sidebar)
  admin_header.blade.php(admin header part)
  admin_footer.blade.php(admin footer part)
  admin_sidebar.blade.php(admin sidebar part)

  Lets do this...

  2) Work on admin_design.blade.php
  Now we will copy dashboard file from matrix admin to this file and then include
   header, footer and sidebar pages

  Now cut header part and paste into admin_header.blade.php we created and include that header file like:
  @include('layouts.adminLayout.admin_header')
  In the same way, add content in other files; footer and sidebar and include them in admin_design file..

  So it must be clear now that admin_design file contains all common files that we have created.

  For main content, we will create another file dashboard.blade.php and keep it in 
  admin folder where we earlier kept admin_login.blade.php

  And for including dashboard.blade.php file, we will use below code:

  @yield('content')
  And in dashboard.blade.php, we will use like below

  @extends('layouts.adminLayout.admin_desing')
  @section('content')
  --- content will come---
  @endsection

  ok lets do..

  admin_sidebar.blade.php (admin sidebar part)

  3) Set css, js and copy into related folders:-

  Now we will set all CSS, JS and images and make sure all files are included in our laravel folders.

  4) Create Route for dashboard
  Route::get('/admin/dashboard', 'AdminController@dashboard');

  5) Create dashboard function/method in AdminController.php
  Time to debug inorder to make sure things work properly.

  ---------------------------------------------------------------------------------------------------

  Tutorial Number 7 Displaying error message on failure to login and logout from admin panel

  1) Display error message like invalid username or password if our login fails

  First in AdminController.php, in login function, return error message if login fails like below

  return redirect('/admin')->with('flash_message_error', 'Invalid Username or Password');

  Now in admin_login.blade.php, display error message

  Get some help from a good bootstrap flash message

  2) Now we will add logout functionality:-

  Add this in AdminController.php for logout and its route as well.. Lets see..

  Use Session; at top and add Session::flush(); to clear off all Sessions

  And then we redirect back to login page with success message.

  -----------------------------------------------------------------------------------------------------

  Part 8 of this tutorial series: 
  We are going to protect our admin routes. Now we will protect our dashbosrd route so that no one can access is without logging into admin.

  Now we will discus two approaches to protect our routes:-

  1) With Sessions
  2) With Middleware

  1)-- With Session:- First we will do with session. We will start admin session at the time of succesful login and then compare that to session variable in every admin function like in dashboard fucntion in our case. This approach is the simplest approach that we used in most cases. So first do with this way..

  In AdminController file, we will modify our login function. We will add adminSession at the time of Successful login.

  We will use Session::put method to add the session variable 

  Nw wil we compare this in dashboard fucntion to check if adminSession exist or not. If exist the we will do our dashboard tasks otherwise, it will redirect back to admin login.

  Success with first method check the second

  2) Middleware:- This is basically used for authentication in Laravel. So here we will use it for our Admin authentication, you can say protection

  We will add Route::group in our Route web.php and  that will contain all our admin routes that needs protection.

  Also, we need to make changes in RedirectifAuthenticated file of laravel from where we redirect to our login page. Lets go.. comment out the first approach.

  Needless to do things in functions now.

  ------------------------------------------------------------------------------------------------------

  Part 9 of This Tutorial.

  We will create settings page for our admin panel. In settings page, we will create password form from where admin can update password admin panel.

  1) Create settings.blade.php:- First create blade file for it We will create settings.blade file to
  dashboard.blade.php file that we have created earlier on.

  copy and paste all the included files from dashboard.blade.php to settings.blade.php, the main content will be taken from Matrix admin

  See we will copy the html part of form-validation.html page from matrix admin and then keep just 
  password fields. lets go.

  We will first copy all main content and then will remove unwanted data later on.

  2) Create Route:- Now we will update web.php with another Route for settings.blade.php
  Route::get('/admin/settings', 'AdminController@settings');

  We will keep this route in Route::group as well that we have create from middleware to protect it from unauthorized access.

  3) Create function:- Now we will create settings function in AdminController.php file

  4) Copy Javascript:- Now we will copy all required javascripts that is required to return validations.

  We will remove all unneccessary javascripts that are not required for now and will keep javascript for form-validation only

  In admin_design.blade.php file, remove all javascripts and add again from form-validations.html

  Also, check settings page will not open directly as we have added its route in Route::group Middleware.

  Now give link to settings at admin header

  Now we will update HTML of settings page. We will only keep passwords fields, rename them and will add Current Password field as well.

  All other forms have been removed except that of password update

  A new(current password) field has been added.

  Update file matrix.form_validation.js located in js folder in backend files.

  ------------------------------------------------------------------------------------------------------------

  Part 10 of this Tutorial

  We will check if our current Password id correct or not with Jquery/ajax in update password
  form that we have created in settings page of admin in our last tut
  1) Update matrix.form_validatio.js file

  First add jquery/ajax in js file and then keep modifying it later on

  When the user will enter its current password and move to new passwword then we will check current password is correct or not. In simple words, we will check on click of the new password and display message below current password field. We can also show side by side with 'keyup' event or some other event we can use in jquery as there are many but our main objective is to tell the user instantly that the current password he typed is currect or not.

  We have now written jquery/ajax code line(4 to 17 in matrix.form_validation.js) and on click 
  function we are passing current password to /admin/check-pwd URL.

  2) Update Web.php:-

  Now we will create route for checking password that we have passed via Ajav URL /admin/check-pwd

  3) Update AdminController.php file:-
  Now we will create chkPassword function where we will check if current password entered by the user is correct or not. We will return true or false message to Ajax to display the message on our form. 

  4) Update Settings.blade.php

  Now in settings file, in Password form, below current password field, we will add one span or div with id to display message that we return from Ajax. Like:- 
  <span id="chkPwd"></span>

  Now update Jquery function. We will heck true or false value in Ajax return to display the success
   or error message in chkPwd ID that we have just created

  Now true comes if we give correct password and false comes if we give incorrect password.

  Now add condition in ajax to display error or success message based on it.

  ----------------------------------------------------------------------------------------------------------

  Part 8 of this Tutorial.

  1) Update Settings.blade.php:- First update Password form with action and CSRF token.

  See action we added like action = "{{ url('/admin/update-pwd) }}" 

  2) Update web.php

  Now we will add Route forour update password form. This time we will both GET/POST method in route
  like below
  Route::match(['get', 'post'], '/admin/update-pwd', 'AdminController@updatePassword') 
   
  See, we have added thjis route in Route::group only so that no one can access it directly without login

  3) Update AdminController.php file:-
  Now add updatePassword function in which we will again check current password and if correct the we update it and return to settings page with success message otherwise we will display error message.

  See last time we have passed current password in ajax to check it is correct or not but this time we have checked in Laravel PHP function and updated new passqord if current password is correct.

  4) Update Settings.blade.php file again:

  Now we will display error or success message above password form like we have displayed in admin login form earlier.

  now it is possible to update admin password.

  We can also display the current password incorrect message instantly by using keyup jquery event on current_pwd id.

  -----------------------------------------------------------------------------------
  Tuto 12
  Every admin panel requires login, logout and update password features that we have covered earlier Part 1 to part 11

  And now the basic structure of the admin apnel canbe use any where.

  We start now with our ecomerce application by creating categories section in admin panel

  We will cover all CRUD operations; create, update and delete with Laravel

  We will create categories table with migrations, will write route for categories and make category pages in admin for add/edit/view and delte categories. So lets start with Add category functionality first.

  1) Create categories table:-##First of all create categories table with migration.
  We can also create categories table manually but we will follow Laravel standard by createing it with migration.

  So first run below command:-
  php artisan make:migration create_category_table

  Our migration file will be created. We will open and make changes in it.

  We will copy some code from users table and make changes in it according to our requirements.

  In category table, we need id, parent_id, category_name, description, url, status, fields so we will add all in  this migration file.

  Replace category with categories as we will make table with name 'categories'

  Now see we have given all columns and data types of categories table

  Now we will run command:-

  php artisan migrate 

  that will create categories table with all specified columns and data type.
  after running that check your database for categories table

  2) Create Controller:- Now we will create CategoryController.

  We will give below command:-

  php artisan make:controller CategoryController

  3) Create Model:- Now we will create Category model with below command:

  php artisan make:model Category

  4) Create Route:- Now we will create Route for Add Category in web.php file.

  We have given both GET, POST methods for our add-category route with function addCategory

  5) Create function:- Now will create addCategory function in CategoryController.

  6) Creat add_category.blade.php file:-

  First add actegories folder in views and then create add_category file.

  See we have created the function and blade file as well

  Now we will copy the form design from matrix admin template. You can create your own as well.

  But first we will also add admin design layout to our add category page.

  We will again copy form from form validation page od matrix admin.

  We will now add validation to category form in the same way we did with password form earlier


  7) Update addCategory function:= 
  Now we will update our add category function, insert the value to our categories table with new and save commands of Laravel


  ------------------------------------------------------------------------------------------------
  Tuto 13 Display categories

  Here we will display all categories with datatables Jquery. If you know about data tables then check copy datatables from matrix admin and edit, you can also create yours

  1) Update Admin Sidebar:- First we will update our admin sidebar so that it will be easier to navigate
  between add and view categories.

  2) Update Route:- 
  Now will add Route for view categories in web.php And this will use GET method only for creating
  this Route.
  Route::get('/admin/view_categories', 'CategoryController@viewCategories');

  3) Create function:-
  Now we will create this viewCategories function/method in CategoryController

  4) Create Blade file:-
  Now we will create view_categories.blade.php file and add admin design in it. And we will also copy datatable format from our matrix admin. Later on we will make it dynamic.
   
  Copy datatables from tables.html in Matrix admin template

  5)Update viewCategories function:- 
  We Will update our viewCategories function now to get all categories and then return them into our blade file.

  It is very easy in Laravel to get all records.
  $categories = Category::get();

  Simply use Model name with get to get all..
  Add another category and display all with a success message.

  7) Update addCategory function:-
  We have updated addCategory function by returning it to view categories with success mesage after adding the category

  return redirect('/admin/view_categories')->with('flash_message_success', 'Category added Successfully!');

  And in view_categories.blade.php file as well, we have displayed the success message.

  8) Add Datatables JS/CSS files:-

  We will add that in order to get all essential features of JS/CSS datatables.

  Start by updating admin_design.blade.php file. 

  Lets add Edit and Delete buttins from widget.html file from matrix admin design.


  -------------------------------------------------------------------------------------------------------

  Part 14

  Here we are going to edit the categories.
  We will create edit category page where all category data will be displayed that the admin can edit and save.

  Add Route
  First add route for edit category same lie we did for add category. But now we will also pass 
  category id in the Route.Using 
   Route::match(['get', 'post'], '/admin/edit_category/{id}', 'CategoryController@editCategory');

  We have passed category id in route with {id} at the end of edit category link 
  /admin/edit_category/{id}


  2) Add function:- 
  Now we will add editCategory function in CategoryController and return its view.

  In editCategory function as well we will pass $id as one of the parameters along with $request.

  3) Create Blade file:-

  Now create edit_category.blade.php file in categories folder under admin folder that is under view folder.

  Update edit category function for it to select the id of the category concerned.It values will be passed to the edit category form so that changes can be made.

  4) Edit editCategory function
  Now we will update editCategory function again to get the uodated category data and update in categories table and 
  then return ith success update message.

  ---------------------------------------------------------------------------------------------------------------------

  Part 14 


  Here we are going to add deletefunctionaly
  1) Crete Route:- First of all, create troute lie we used to create earlier as well. We will create GET, POST method route and will also pass id in it like {id} using
      Route::match(['get', 'post'], '/admin/delete_category/{id}', 'CategoryController@deleteCategory');


  2) Create deleteCategory function
  Add this function in CategoryController and also pass id in it so that we can delete category of that id.

  3) Update Delete Link in View Categries page. THen add the URL that we have given in Route simillar to edit 
  category link that we have given earlier. In both cases we are passing category id.

  4) Add Confirmation script
  Now quicly add confirmation Jquery script to ask admin to approve delete category.
  We will pass confirm function to as the admin for confirmation.

  -----------------------------------------------------------------------------------------------------------------
  pART 15
  Here we will add subcategories anfter adding main categories like  T-shirts, Shoes.
  Subcategories like 
  Formal T-shirts,
  Casual T-Shirts

  Formal Shoes
  Casual shoes
  ]1) Update addCategory function:- 
  First we will update addCategory function. We will create levels variable that will contain all the main categories having parent id as 0.
  2) Update add_category.blade.php:-
  Now we will update add category blade file with category Level select drop down. We will get all main categories in 
  foreach loop in select drop down.

  3) Update addCategory function again for inserttion of the parent_id into the database. We have selected parent_id in levels taht we will store in categories table.

  Now we can add sub category by selecting Main category in drop down. Like: for hairy black puppies, will we select Black
  puppies as main category.

  Lets also show Parent Id in View Categories blade file to make it more clear.

  Now if a categories id matches that of a parent Id, this means that the category with that parent id is subcategory of 
  the category id.

  Now update edit category form as well

  4) Update editCategory function:- 
  Now again create levels variable in editCategory function and return it to edit category blade file

  5) Update edit_category.blade.php:-

  Now add select drop down category Level in edit category blade as well. But here we pre-select the Main Category 
  that we have seleted at add category. For that, in foreeach loop, we will compare Parei=nt_id of selected category with all main categories id's

  See now, the initial category level is ininitially selected for edit.

  ----------------------------------------------------------------------------------------------------------------

  Part 16:

  We will start creating products section in admin panel. We will create products table with migration, will create product route, products Controller an Model and then will make all products pages lie add/edit and delete.

  And also wewill show all Categories in select drop down in Product Add/Edit form. So lets start creating 
  products table first .

  1)Create products table:-

  First of all create products table migration in the same way lie we have created categories table.
  So first run below command:- 

  php artisan make:migration create_products_table

  Our migration will be created

  Now products migration file have been created. We will add all products columns now lie id, category_id, product_name
  product_code, product_color, description, price, discount, image

  Now we have added all columns. For more details of data types, follow Laravel website by searching "Laravel Migrations"
  in Google
  Now run below command
  php artisan migrate
  Now products table has been created

  2) Create Controller

  Now we will create ProductsController with below command:-
  php artisan make:controller ProductsController

  3) Create Model 

   Now crate Products model with below command:-

  php artisan make:model Product

  4) Create Route:-
  Now create route for Add Product in web.php file.

  This route will have both GET?POST methods with add-product URL having addProduct function.

  5) Create function:-

  Now we will create addProduct function in ProductsController

  6) Create add_product.blade.php file

  First add "products" folder in resource/views/admin/products/add_product.blade.php

  File created. Now copy category bladefile into it and make required changes 

  now add all products attributes along side a category drop down to select product category


  Under Category select drop down, we will show all categories. We will now update addProduct function with categories 
  variable that will contain all main and sub categories in select options.

  Also add the header files:

  use Auth;
  use Session;
  use App\Category;
  use App\Product;

   

  Problem
  -------
  Not being able to show subcategories when trying to add products.





  -------------------------------------------------------------------------------------------------------
  Tutorial 18.
    Here we will add products to product table,
    we will also add validations to our add product form, and to dispaly Add/Edit links in sidebar
   
   1) Add in sidebar:-
   First of all, we will add Add/Edit product links in admin sidebar in the same way lie we did for categories earlier on.
   OPen admin_sidebar.php file and copy categories html make changes.


2) Add Validations:-
	Now we will add validations to our add product form.
Open matrix.form_validation.js file and add validations for form id 
add_product in the same way like we did for add_category form in earlier videos.

3) Update addProduc function:-

Now we will update addProduct function for getting all data from product form and save them into products table.


---------------------------------------------------------------------------------------------------
Part 19

Here we will add product image name in database and image itself in some folder in images.

We will resize the product image and then store in different folders.
We will create one products folder in images folder. And inside produts folder create 3 other folders

Small Folder having small product images
Medium folder having medium images
Large folder having large product images

So basically we are going to add original size of product image in Large folder and then we will resize it to mae medium as well as small

Suppose we have Large image of sixe 1200 x 1200 then we resize it to medium image of size 600 x 600 and small image of size 300x300

So for resizing images, we need to first install Intervention pacage of Laravel.

1) Install Intervention Pacage:-

For resizing images, we will install Intervention pacage by giving below command

php composer.phar require intervention/image(for linux)

composer.phar require intervention/image(for windows)

if you face problem with above command, run the following three commands in order and then re-run 
command to install package again.

2) Update add-product form:-

We need to add enctype = "multipart/form-data" in form and also we will give image id and name.

3)Add Validation for Image:-
In matrix.fomr_validation.js, add validation for image as well

4) Chec Intervention Pacage:-

Chec if Intervention package is installed or not in the composer.json file

5)Add headers
use illuminate\Support\Facades\Input;
use Image;

6) Create Images folders:-
We need to create products folder under images folder. And in products folder, we will create small, medium and large folders for storign images after resize.

7) Update addProduct function with upload Image code:- 
Now we are done resizing the image to small, large and medium. and stored in their respective
folders.


--------------------------------------------------------------------------------------------------
part 20, 
	We will display all productsin admin panel. We will create view-products blade file in which we 
will show all products in datatable as that for view category

1) Create Route:-
First of all create, GET route in web.php lie below:-

Route::get('/admin/view_products', 'ProductsController@viewProducts');

2) Create Function:-
Crate viewProducts function in ProductsController that will return to view_products blade file

3) Crate view_products blade file:-
Create view_products blade file in views/admin/products folder.

Add admin design to it and datatable layout that we can copy from matrix theme but we can even copy view categories blade file and make changes.

4) Update viewProducts function:-

Update viewProducts function to get all products to display in view_products blade file.

5) Show category name:-

We will show category name as well in view products blade file so that it give us more clarity about products that are located under which category.

 Update view_products.blade.php file and Add Category name in blade file


6) Show Product Images:-

We will show product images in products datatable


---------------------------------------------------------------------------------------------

Part 21

Here we are going to crate Modal Pop-up for showing complete product details of any particular product.

It is not possible to show complete product details in view products balde file itself so we will open Modal pop-up to show full details for the product.

1) Display View Link

Open widgets.html from Matrix Admin theme and copy publish tab and replace it to view link.

2) Copy Modal Scripts
Open interface.html, copy popover.js script to admin_design.blade.php file 

3) Update view link

Now we will update view link to open pop up

Add Product Id with #myModal so that we can open seperate pop up for every product.

-----------------------------------------------------------------------------------------

Part 22.

Here we will add edit product blade file from where we will edit product details.

1) Create Route.
We Will create GET/POST route with Product Id that we will pass via Route
    Route::match(['get', 'post'], '/admin/edit_product/{id}', 'ProductsController@editProduct');

2) Create Function:-

We will create editProduct function in ProductsController and also pass $id in that function so tht we can get the product details of that particular product id.

With id of product, we will get all product details and will show in blade file

3) Create edit_product.blade.php file
Now create edit product blade file in products folder under admin folder in views. And we can simply copy add product blade file content into this edit blade file and make changes here.

4update edit product

5) Add Validations
Add validation for edit_product form in matrix.form_validations.js file. And remove image validations for the time beign. We can simply copy add Product validations and paste for 
edit product.

--------------------------------------------------------------------------------------------------------

Part 23

We are going to show, update and delete product image in edit product blade file itself.

1) Show Product Image:-
First of all, we will show product image in edit product blade file so tht we can chec our current product image is correct or not,. And if it is not fine, then you can simply update it.

Open edit_product blade file and add image src to display the product image.

We will do some formatting to display product image in edit product form.

2) Update Product Image:-
We will add one hidden field in edit_product blade file which we will pass current product image name.

Now in editProduct function we can wriete upload image script or we can also copy the script from
addProduct function and mae required changes.

If we upload new image from edit product form then if part will wor and new image 
will get upload otherwise we will pic current_image name again from form. In both cases,
 we will update $file that can have current image or new image name.

Problems with image edit.



3) Delete Product Image:-

In last step, we are going to delete product image.

i) Create Route:
We need to create GET Route and also pass current product id so that we can delete the
 product image of that product id.
    Route::get('/admin/delete_product_image/{id}', 'ProductsController@deleteProductImage');


ii) Create Function:
Now create deleteProductImage function in ProductsController and pass $id as parameter
 so that we can write query to delete product image by product id

We are going to update image as empty in products table.

iii) Update edit_product blade file
Add delete link with image from where we will call delete image route 

Also add condition to only show product image if image is not empty.  

 
----------------------------------------------------------------------------------------------------------

Part 24

First add delete functionality to products, then use "SweetAlert" Javascript Library used for creating elegant alert messages.
So lets start with delete functionality for products.

1) Create Route:-
Create GET route for deleting products with Product Id.

Route::get('/admin/delete_product/{id}', 'ProductsController@deleteProduct');

2) Create Function:-

Create deleteProduct function in PorductsController to delete the product. And we will also pass $id as parameter so that we can delete the product of that id.

3) Update view_products.blade.php

We need to add delete link/route that we have just created.
href="{{ url('admin/delete_product/'.$product->id) }}"

4) Delete Product Confirmation Box:-
Now add delete confirmation box so that every time if we delete any product, it will first 
as us to confirm only then it will delete to avoid any ind of mitakes.

1) Simple JavaScript Alert

2) Sweet Alert Javascript Library

1) Simple Javascript Alert: Add delProduct id to delete product link and then we will 
create delProduct function in javascript to add simple confirm alert.

Open matrix.form_validation file and add delProduct clikc function

2) SweetAlert Javascript Library
Searc in Google for it We will copy js and css for SweetAlert. We can either 
use CDN paths directly or save the files and store at our end.

Open admin_design.blade.php file and add js and css CDN paths.

Open view_products blade file and add some attributes to it like rel, rel1

First add rel and pass product id in it as $product->id

Now add rel1 and pass content "delete_product" in it.

And disable href and add class "deleteRecord" to delete link.

Now open matrix.form_validations file and add Jquery script there with SweetAlert

Disable simple alert for delProduct event Jquery script.

You can get help from https://sweetalert2.github.io/

Recap:-

1) Add CSS and JS:- https://cdnjs.com/libraries/sweetalert/1.1.3

2) Add rel, rel1 to delete product link
3) Replace href with "javascript:" and add class "deleteRecord"

4) Disable delProduct Jquery Script

5) Add deleteRecodr JQuery script with Swal(SweetAlert)



------------------------------------------------------------------------------------------------

Part 25

We will continue implementing SweetAlert for categories section

In last video, we have done for products. So we will follow same steps for categories

1) Copy CSS & JS Files

Search for SweetAlert and copy CDN paths

2) Update view_categories.blade.php File 

In categories blade file, we will add some attributes to the delete link:-

rel = "{{$category->id}}"

rel1 = delete_category (in case of products, we need to use delete_product)

href = javascript:

We need to disable href link and delCat

3) Update matrix.form_validations.js File 

Disable hasic javascript alert script and then SweetAlert will start woring.

We need no to write SweetAlert code again as we are passing Route itself in rel1 so that nothing
more required. rel1 in delete product link pics delete_product and in delete category link 
 picks delete_category.


 In the next video, we will start woring on products attributes like size, price, stock
 Any of the product can have many sizes like small, medium, large etc. and their prices and stock
can also differ.

So we will maintain all these attributes in section that we are going to start from next video


------------------------------------------------------------------------------------------------------------------------
Part 26:

We will start woring on product attributes like size, stoc, prices and sku for the product

Sku = stock keeping unit

Test Product -TP01

SkU          Size     Price      Stock
TP01-S       small    100         10
TP01-M       Medium   1100        15
TP01-L       Large    1200        10

All these things we used to called attributes and we need to store all of them in products_attributes table

So in products_attributes table, we need columns like id, product_id, sku, size, price, stock,
created_at, updated_at

We will use migration to create product_attributes table

Products table stores all the main product information like its id, price is the
 main price that we used to display at listing page but in detail page price comes from attributes
table according to size.

Price may vary according to size and all such attributes we will store in products_attributes table

1) Create products_table (With migration)

php artisan make:migration create_products_attributes_table

add the other attributes

And now run below commmand php artisan migrate

See now, our products_attributes table has been created,


2) Create Model

Now we will create model for products_attributes table lie below:

php artisan make:model ProductAttribute

3) Create Route
Now we will create Route for add_attribute with GET/POST method and with Product Id
    Route::match(['get', 'post'], 'admin/add_attribute/{id}', 'ProductsController@addAttributes');


4) Create Function

Now we will create addAttributes function in ProductsController and will also pass product id as parameter and it will return to add_attribute blade file.

We need to create add_attributes blade file under views/admin/products
And then we will add admin design to it. We will copy from add products blade file and make 
changes there.

Add Products Attributes blade file has come now,
In the next video we are going to add Product Attributs form to ass Sku, sizes, prices and stock


--------------------------------------------------------------------------------------------------

Part 27

We will continue woring on products attributes. Our main focus in this video will be on 2 things:-

1) Show product Information

2) Add Product Attribute Form:- Add Multiple fields/Remove

1) Show information
1.1) Update attribute function.

Fetch Product details from product id and return to blade file to show product information 
in add attributes blade file

1.2) Update add_attribute.blade.php

Show Product Name, Product Coce and Product Color in add attributes blade file by 
doing some formatting


1.3) Update view_products.blade.php

We will insert "ADD" link in view products blade file so that we can open add attributes
blade file for tht product. 


 2) Now create Add/Remove ind of functionality in JQUERY so tht we can add multiple 
attributes like multiple sizes, stock, price, and sku

2.1) Search Google:-
We can search "add remove fileds dynamically in jquery" in Google and find some 
script that can help us.

https://www.codexworld/add-remove-input-fields-dynamically-using-jquery/

We are going to update the code to show multiple fields.

2.2) Update matrix.form_validations.js

Copy Jquery script to our js file

2.3) Update add_attributes blade file

Add all attributes fields and Add/Remove link in add_attributes blade file.

We need to update both add_attribute blade file and matric.form_validations.js. So please watch it what I do..

3) Update addAttribute function

We need to update Attribute function in ProductsController.

We will get all attributes submitted in addAttribute function and then later on will save it to
products_attributes table.


-----------------------------------------------------------------------------------------------------

Part 28

Continue woring on products attributes. And we are going to store products attributes in table
 "prodcuts_table" from our add attribute form.
Update addAttributes function:-

We are going to save all attributes in addAttributes function in foreach loop


2) Update eader
Also do not forget to add headers at top of ProductsController
use App\ProductsAttribute;

3) Update add_attributes.blade.php

We need to add product_id as hidden field to pass to addAttributes function
 and save it to products_attributes table


----------------------------------------------------------------------------------------------------

Part 29

Continue woring on product attributes,
Show product attributes tht have added earlier in add attributes blade file. 
And we are going to use relationships for this. And then we will also add validations

1) Show Product Attributes:-
We need to show product attributes as well after adding them in Products Attributes blade file

1.1) Update Product Model

We will update our product Model to add hasMany relation.
hasMany relation = One to many, one product having multiple attributes.

To Learn more about relationships, please study from Laravel website.
https://laravel.com;docs/5.6/eloquent-relationships

https://laravel.com;docs/5.6/eloquent-relationships#one-to-many

1 Product -> 4 Attributes
One can have Many

1.2) Update addAttribute function

We will add attributes relation/function to our query to add attributes to product array/json data.


Simply add with('attributes') in query to show products Attributes as well

1.3) Update add_attributes blade file 

Now update add attributes blade file to show all attributes. We will use datatables to show attributes same for products.

Simply copy View Products datatable

2) Add Validations to the primary attributes fields so tht the one list/row of attribute must be added.

Use simple HTML5 validations by adding required all input fields making the 
sure the form containing the inputs does not have novalidate="novalidate", if it has remove it.



---------------------------------------------------------------------------------------------------------

Part 30

Delete Product attributes using sweet alerts(already done)


2) Update add_attributes blade file:-

We will update delete link in add attributes blade file.

We will add rel, rel1, href and class to delete link

rel= "{{ $attribute->id }}"
rel1 = "delete_attribute"
href = "javascript:"
class="btn btn-danger btn-mini deleteRecord"

3) Create Route:-

Now create GET route with delete_attribute having attribute id
    Route::get('/admin/delete_attribute/{id}', 'ProductsController@deleteProductAttribute');

4) Create function:-
Now create deleteProductAttribute function in ProductsController file to delete the attribute
and also add parameter id to the function.


---------------------------------------------------------------------------------------------------------------

Part 31.

We will first clear unwanted items from our admin panel then will download some free ecommerce
template and will start working on front end.

1) Clear Unwanted items from admin panel:-

OPen admin_sidebar.blade.php and remove all unwanted items.

Open admin_header.blade.php and remove unwanted data from there also

2) Download free E-shop Template:-

You can search any free e-shopper template online and download it and then open below link
https://www.free-css.com/free-css-templates/page203/e-shopper

Download from this site


3) Understand the E-shop Structure
Index/Listing -> Product Detail -> Shopping Cart -> Checout -> Order Review ->
 Confirmation/Payment

4) coppy CSS, Js, Images and Fonts:-

Copy all these from e-shopper template to our Laravel project

4.1) Copy CSS Files:-
First copy css files to \public\css\frontend_css

4.2) Copy Js Files to
\public\js\frontend_js

4.3) Copy Images:-
\public\images\frontend_images


4.4) Copy Fonts:- to 
\public\fonts\frontend_fonts

5) Create Common files:-
Now create common blade files lie header, footer, front design.

We will crate front_design blade file that will have header, footer and middle content that is
dynamic
we need to create files
front_design.blade.php
front_header.blade.php
front_footer.blade.php

We need to create all these 3 files under below path:-
\resources\views\layouts\frontLayout

6) Create Controller

We Will create IndexController that we will use for our index page.
Run below command to create IndexController

php artisan make:controller IndexController

7) Crate Route

We will create GET Route for our index blade file
Route::get('/', 'IndexController@index');


8) Create Function 

create index function and return it to index blade file

9) Creat index blade file under folder only


-------------------------------------------------------------------------------------------------------

Part  Part 31

1) Update front_design file
Copy content from index.html from E-shooper template downloaded

 Open front_header and cut header part from front_design and add to front_header. We are going to include front_header in front_design in place of header html part.
Do thesame for footer as well.

2) Update index.blade.php

Add front_design to index blade file like below
@extends('layouts.frontLayout.front_design')
@section('content')

---copy content from front_design ----

<section> </section>--
<section> </section>--

3) Set paths for CSS/JS/Images/Fonts Files

 Now update for CSS/JS/Images/Fonts in front design blade file.

Also update paths in index.blade.php file.
@endsection


--------------------------------------------------------------------------------------------------------------------

Part 33

We are going to show our products in home page in ascending order by default. And then we will show in descending order, means last added products will be shown at the top and then we will show
products in ramdom order

We will update index function in IndexController.php to get all products
 from products table and then return to the index file means our home page
$productsAll = Product::get();

By default, it will pick the records that are products in ascending order like 1,2,3 and so on.

2) Add Header :-
We need to include model so add below header at the top of IndexController.php file:-

use App\Product;

3) Update index.blade.php:-

We will update our home page i.e. index blade file to show all products under Featured Items box

We will add foreach loop and show all products within it.


4) Show Products in Descending Order:-

$productsAll = Product::orderBy('id', 'DESC')->get();

5) Show products in Random order.


----------------------------------------------------------------------------------------------------------------

Part 34

Display Categories and subcategories at left sidebar of home page

There are 2 ways of doing this task:-

1) Basic Approach (Without Relations)

2) Advance Approach (With Relations) (Recommended)


1) Basic Approach (Without Relations):-

1.1) Update index function:-
We need to update index function in IndexController.php file to get all 
categories and subcategories. We will later store them in one variable and return that variable
to show all categories and sub categories at home page.

1.2) Update Header:-

Update IndexController.php fie with below header:-

Use App\Category;

Now see we are getting all categories and sub categories
And now we will create one variable in which we will add all these categories 
and subcategories with html that we are using to display at home page.

Open index.blade.php file and get html content of categories from it and display in variables.


1.4) Update index.blade.php file 

Now remove html part and simply add categories_menu variable that we have
 generated in index fucntion



-----------------------------------------------------------------------------------------------
Part 35 

Here we will delete products images from their folders.

We are storing our images in folders lie below

Small images in small folder
Medium in medium folder
Large in large folder.

we want to delete the products images from these folders located at these paths

We will update deleteProductImage function in ProductsController.php file to delete 
the product image from its folder

We have been able to delete product images from folders.



----------------------------------------------------------------------------------------------------

Part 36

Show product detail page and also also remove unwanted data from listing_category page

1) Remove unwanted data from listing_category page
 
Remove brand part of HTML, Price Range HTML and Recommended


2) Create Route:-

We will create GET route with product id like below:-

Route::get('product/{id}', 'ProductsController@product');

3) Create Function:-

We will now create product function in ProductsController with parameter 
id so that we can retrieve individual product

4) Create detail.blade.php

Now create detail blade file in products folder under views folder similer to listing_category. simply add headers and footers copy this from productdetail page of eshopper


5) Update listing_category.blade.php file
We need to update links of products at listing_category blade file so that 
user can reach detail page after clicking on them.


------------------------------------------------------------------------------------------
Part 37

Add product attribute to product detail page. The product will come according to the
 size provided by the user. We will use Ajax as well to change the product price that is 
based on its size

1) Update product function:-
Update product function in ProductsController file. Add attributes relation to productDetails
Query so that we can get attributes as well along with product details.
   $productDetails = Product::with('attributes')->where('id', $id)->first();


2) Update detail.blade.php file:-

 Now update product detail blade file to show sizes drop down that we will do with
 foreach loop

3) Write jquery/Ajax in main.js file:-

 We are going to write this Jquery/Ajax script so that we can get price according to its size.

Here we have 3 different sizes that have seperat prices 
Small = 2200
Medium = 2400
Large = 500

4) Create Route:-

Now we will create route with URL /get-product-price so that we can get the product attribute 
price specific size

5) Create function getProductPrice

Create function getProductPrice in ProductsController where we will get the product attribute
price by product id and its size wi return its price.

6) Update detail blade file :-
Add id getPrice to Product price like span id="getPrice"> ${{ $productDetails->price }}</span>




-------------------------------------------------------------------------------------------------
Part 38

Continue working on detail page

We can add below tabs in Product detail page:-

 i) Description (Dynamic will come from admin)

 ii) Material & care (Dynamic will come from admin)

 iii) Delivery options (static)

 So we will wor on product tabs and left categories in this session

  1) Add "care" column in products table

	Add care column in products table so that we can use this column in Add/Edit product
 2) Update add_product.blade.php:-

Add "Material and Care" field in add product blade file similar to Description field.

  3) Update addProduct function:-
   Update addProduct function in ProductsController so that we can add care column to insert 
   data in it from add product form. and update everything that concerns Material & care

 6) Update Product detail page:-

 Update detail.blade.php file to make the tabs dynamic as explained earlier.
 We are going to make Description and Material $ Care dynamic and Delivery options static

 7) Create front_side.blade.php file at path
	
   \resource\views\layouts\frontLayout

  This we will create so that we can have common file for our Categories menu at left sidebar
   and it will be easier for us to make changes in One common file

-------------------------------------------------------------------------------------------------

 Part 39

Continue woring on product detail page to resolve attribute issues
And we will correct the path for font awesome icons.

 1) Resolving Attributes Issues :-

  1.1) Prevent duplicate SUk's:- 
  We can't add duplicate SkU's for any of our product.
    Update addAttribute function in ProductsController.php

 1.2) Prevent duplicate sizes for 1 product:-
	Update addAttribute function in ProductsController.php
 
 2) Correct Path for Font awesome.
	OPen font-awesome.min.css file:-

	Replace ../fonts/ with /fonts/frontend_fonts/
     
	
-----------------------------------------------------------------------------------------------------
	Part 40
	We will work back on admin panel. We will create one Product Alternate Images section from
	we can add seperate images for our product. And we can display those images in our product
	detail page.
	
	1) Update view-products blade file:-
	
	First of all, update view-products blade file to show seperate tab for add images.

	
	2) Create Route:-
		Create GET route for add images with id in web.php file.
		
	3) Create Function:-
	
		Create addImage function in ProductsController with parameter id and we will return
		its view to add images blade file.
		
	4) Create add_images.blade.php file similar to attribute blade file and make 
	changes there.
	
	5) Create Products_images table
		id, product_id, image, created_at, updated_at
		
	6) Create Model
	
		Create Model with ProductImage with below command:-
		php artisan make:model ProductsImage
		
	7) Update add_images blade file:-
	
	Update image field so that it can add multiple images at the same time in 
	add_images.blade.php file.
	<input name="image[]" required type="file" multiple="multiple"  >
	
	8) Update addAlternateImages function
	
		Now update addAlternateImages function so that we can post data to add multiple images
		to our folders; small, medium and large after resizing and can also add to 
		our products_images table.
		
	9) Update Header statements
		Add below header statements for ProductsImage Model
			Use App\ProductsImage;
			
			
--------------------------------------------------------------------------------------------------------

	Part 40
	
	COntinue Working on Products Alternate Images. In last video, we have added products
	 alt images in product_image table as well as products folders; small, large and
	  medium. This time we are going to display all product alt images in its blade file 
	  and will also do delete functionality with SweetAlert once again.
	  
	  1) Update addAlternateImage function:-
	  		Update addAlternateImages function in ProductsController.php file to get
	  		 all the alternate images of the product.
	  
	  2) Update add_images.blade.php file:-
	  
	  	Now update add images blade file so that we can display all products images 
	  	in foreach loop.
	  	
	  3) Delete alternate product images
	  		Add delete url in add_images blade file so id, rel, rel1 similar to 
	  		delete products		 			
				
	 4) Create Route:-
	 	Create GET Route for delete product alt images
	 	  Route::get('/admin/delete_alt_image/{id}', 'ProductsController@deleteAltImage');
	 	  
	 5) Create FUnction deleteAltImage
	 
	 
	 
	 
	 
--------------------------------------------------------------------------------------------------------
	Part 41.
	
	show alternate images on product detail page.
	
	1) Update product function
		First update product function in ProductsController to get all the product 
		alternate images of specific prouct

	2) Update detail.blade.php 
		Now update detail blade file to display product alternate images.
		
	3) Update main.js file:- 
		Now we will write jquery script to replace main image with alternate image onclick
		
	First add class "changeImage" with img attribute in detail blade file where we are 
	viewing alternate images.
	
	Also add class "mainImage" with img attribute to the main product image
	
	
	
--------------------------------------------------------------------------------------------------------
	Part 42
	
		Implementation of Image Zoom in detail page. using jquery zoom plugin.
		
		1) Search & Download Easy Zoom from Google:-
		
			https://i-like-robots.github.io/EasyZoom/
			
		2) Delete Unwanted Content/Zooms
		
		We will now remove all unwanted content from the plugin and eep only the neccessary.
				
	3) Add CSS/JS Files:-
	
	Copy all the neccessary css and js files. to their respective frontend folders			

  4) Update front_design.blade.php
  We need to include both js/css files at front design blade file alogn with other js/css
  files.
  
  5) Update main.js
  
  Now add other script provided by easyzoom to end of main.js file.
  
  6) Update detail.blade.php file
  
   Now we will embed css from with Thumbnails images code from index.html to our detail blade
   code.
   
  7) Update main.css
   Find .view-product img in main.css and comment it out.

 
----------------------------------------------------------------------------------------------------------

	Part 45
	Edit products attributes
	
	1) Update add_attributes.blade.php File:-
	
	First update add attributes blade file. We will add form and mae price stock input fields
	 with update button so that we can update them anytime we want.
	 
	2) Create Route:-
	
	Create GET/POST route for edit_attributes with id in web.php:-
	
	3) Create editAttributes function:-
	
	Now create editAttributes function in ProductsController so that we can 
	update the attributes stock and price. 
	
----------------------------------------------------------------------------------------------------------
	
	Part 46
	
	Work on stock. We will hide Add to Cart if total stock is zero same too for a particular
	size if it stocks is zero.
	
	1) Update product function:-
	We will calculate total stock of all product attributes in product function of 
	 ProductController and return
	 that to our detail blade file.
	 If total stock is zero then we will disable "Add to cart" button and display 
	 "Out of stock" 
	 
	2) Update detail.blade.php file:-
	
	Now update detail blade file and add condition with total_stock available. If total_stock
	is greater than 0 only then we will show add to cart
	
	3) Update getProductPrice function:- 
	
	Now we will update getProductPrice function in ProductsController so that we can 
	get the stock of every attribute in the same way like we used to get the price of
	 every attribute.
	 
	 4) Update main.js 
	   Now we will update jquery script that we have written for change of size for
	    displaying different price. Now we will also get stock of every size and if stock
	    is 0 then we will hide "Add to cart" button from jquery and will display Available
	    as "Out of stock"
	    
	    Add id "cartButton" for "Add to cart" button so that we can hide it if stok is 0
	    Add, add id "Availability" in span so that we can change wording to Out of Stock
	    
---------------------------------------------------------------------------------------------------------

	Part 47 
		Continue working on products detail page. 
		We will show all products of thesame categories.


	1) Update product function:-
	 First we will update product function in ProductsController in which we will create
	 $relatedProducts variable for getting all the other products of the same category.
	 And the main product we will not show under recommended items.

	2) Integrate Array chunk:- We need to integrate array chunk so that we can display 3
	 products at one go in foreach loop.
	 
	 Please follow below link for clarity.
	 htt:://laraveldaily.com/laravel-blade-foreach-trick-splitting-results-chunks/
	 
	 3) Update detail.blade.php file:- 
	 	Now update detail blade file and add foreach loop with chunk having 3 so that 3
	 	 products can come in foreach at one time.
	 	 
	 
	 
-----------------------------------------------------------------------------------------------------

	Part 47.
		Enable, disable products.(Publish/Unpublish)
		
	1) Update products table
		Add 'status' column in products table with datatype tynyint and its value as 1. And 
		we are going to set its default value as 1.
		
	2) Update add_product.blade.php file:-
	Now we will add enable checkbox in add product blade file.
	
	3) Update addProduct function:-
	
	Now update addProduct function in ProductsController to save the status value. 
	We will save the status value as 1 for enabled and 0 for disable.
	
	4) Update edit_product.blade.php file 
	  Now we will add enable checbox in edit product blade file.
	  
	5) Update editProduct function:-
		Now we will update editProduct function in ProductsController to update the value of
		status column once again that has been seen by enable checbox
		
	6) Update index function:-
		Update indexfunction in IndexController and add where  status condtion is 1 to 
		show only enabled products.
		Simply add below syntax to show only enabled products.
		->where('status',1)	 
		
	7) Now update products function in ProductsController to show products having 
	status 1			 	  

	8) Update product function in ProductsController so that if someone opens lin of disabled
	 product it shows a 404 page


--------------------------------------------------------------------------------------------------
   Part 50
   
   Work on shooping cart
   Create cart table and will make addcart form in detail page so that we can add products to 
   cart every time when we click on Add to Cart button

	1) Create cart table:-
	First of all, we will create cart table and this time we will use Migration for it.
	
	You can learn how to use migration from
	https://www.youtube.com/watch?v=hSqcobPhX6c&list-PLLUtELdNs27aIRraTsa5Li3iZiXYMa2I
	
	So create the table with below columns:-
	id int
	product_id int
	product_name varchar(255)
	product_code varchar(255)
	product_color varchar(255)
	size         varchar(255)
	price   double
	quantity  int 
	user_email  varchar(255)
	session_id varchar(255)
	created_at    datetime
	updated_at  timestamp
	
	so first we will run below command to create migration file:-
	
	php artisan make:migration create_cart_table

	edit create_cart_table.php file to add all the required fields above
	then do php artisan migrate.
	
   2) Update detail.blade.php file.
   
   Now we will update detail file with addtoCart form where we will pass product details to 	cart table
   
   3) Create Route:-
   
   Now we will create GET/POST route in web.php file for addtocart so thatwe can pass the
    product details to function to store in cart table.	


  4) Create addtocart function: 
     creae addtocart function in ProductsController to get the product details and insert 
     in dart table

  5) Update main.js:-
    Now update selSize jquery function in main.js file so that we can send updated price to
     product attribute whenever user tries to add product to cart. 	
     
  6) Update addtocart function 
  
  Now we will update addtocart function to finally insert the product details in cart
   table.   
   
   7) Update headers add use DB
   
   
   
  -----------------------------------------------------------------------------------------------
  Part 51 
  Create shopping cart page and show cart items tht have added from product detail page 
  
  1) Create cart.blade.php file
  
  First of all, create cart.blade.php file in products folder where we have already created
  detail and listing_category blade files
  
  Add frontend header and footers
  Coppy content from shopping cart of eshopper template. and tae relevant content.
  
  2) Create Route:-
  
  Now we will create GET/POST route for cart blade file in web.php 
  
  Route::match(['get', 'post'], '/cart', 'ProductsController@cart');
	
	
 3) Create Function :-
 
 Now create "cart" function in ProductsController so that we can get products from "cart"
 table and return them to "cart" page.
 
 4) Update "addtocart" Function
  Update it so that after adding the part into "cart" table, user will automatically redirect
   to cart.blade.php file that we have created recently.
   
   We need to create session_id variable to store the particular session of the user into
    cart table.
    
    $session_id = str_random(40);
    And we have assigned Session variable to session_id
    
    Sessio::put('session_id', $session_id);
    
    5) Update "cart" Function
    
     Now we will add query to get all products from cart table according to user session that
     we have saved in addcart.
     
     
     6) Update cart.blade.php file
     Add foreach loop to show all cart items in cart blade file lie we have done in video
    
		
------------------------------------------------------------------------------------------------------------------------------------------------

	Part 52.
	Continue woring on shopping cart process, show product images in cart and also wor on delete functionality of cart items/products
	
	write query to save product image to card
	
	1) Update "cart " function
	get images of the product in cart and return them to blade file of cart.
	
	2) Update cart.blade.php file
	
	Now we will add image in our cart blade file by giving the image path with image name
	 that we have got from the cart function.
	 
	3) Create Route:-
	
	We are going to create GET route in web.php file for deleteing cart items like below
	
	Route::get('/cart/delete_product/{id}', 'ProductsController@deleteCartProduct');   	
	
	4) Update cart.blade.php file:-
	
	Now add the link for deleteing cart items.	
     
  
    {{ url('/cart/delete_product/'.$cart->id) }}
    
    5) Create deleteCartProduct function:-
    
    Create deleteCartProduct function with id as parameter so that we can delete cart item
     from that id and return to cart page with success message of deletion. 



----------------------------------------------------------------------------------------------------
	Part 53.
	Continue woring on shopping cart
	
	Update product quantity of cart items and remove duplicate cart item of thesame size and
	 color.
	 
	1) Create Route:-
	
	we will create GET route for updating quantity. We will pass product id and quantity that
	is either +1 or -1:-
	
	Route::get('/cart/update_quantity/{id}/{quantity}',
	 'ProductsController@updateCartQuantity');
	 
	2) Update cart.blade.php file:-
	
	Now we will update cart blade file with + and - links to update quantity.
	
	
	We will add link for + and - according to that.
	
	
	3) Create updateCartQuantity function:-
	We will now create updateCartQuantity function in ProductsController and pass id and 
	quantity to increment/decrement quantity of the cart item.
	
	In Laravel 5.6, we can use increment and decrement functions
	For more details follow laravel documentation
	
	Now prevent duplicate cart items
	
	4) Update addtocart function:-
	update addtocart function in ProductsController.php to chec if item with same size already
	exist and that particular session already exists, if yes display a message
	
	5) Update detail.blade.php
	
	Now add error message alert box in detail blade file that we will show every time when
	 product already exists on cart.
	 
	 
-----------------------------------------------------------------------------------------------

  Part 54
  
  Continue working on shopping cart.Check stock of product while updating in cart.
  And for that, make some changes in addtocart and updateCart functions. And later show
  cart total and remove unwanted data from shopping cart page.
  
  1) Update addtocart function
  First update to add product sku in cart table instead of product code.
  
  2) Update updateCartQuantity function
    check if stock is updated by user in cart is available or not. Check with sku of that
    product to get the stock from products attributes table and compare it with the stock
    demanded by the user.
    
  3) Upadte cart.blade.php file 
    show background behind error message and we will show cart total as well. 
    Remove unwanted data.	  
	



--------------------------------------------------------------------------------------------------------------------------------
	
	Part 55	
	
	Display "Apply coupon code" feature at shopping cart page. And also we will add its
	module in admin panel Add/ View coupons

	First creats "coupons" table with Migration then will add coupon module in damin oane,

	1) Create "coupons" table:-

	First create "coupons" table with migrations with below command 
	php artisan make:migration create_coupons_table
	
	add below columns to migration created
	$table->string('coupon_code');
	$table->integer('amount');
	$table->string('amount_type');
	$table->date('expiry_date');
	$table->tinyInteger('status');
	
	After adding all columns, we will run below command:-
	
	php artisan migrate   , This will create the coupon table in mysql server.
	
	
	2) Create "Coupon" MOdel:-
	 run below command to create model
	 
	 php artisan make:model Coupon
	 
	 3) Create coupons controller
	 	php artisan make:controller CouponsController
	 
	4) Create Route:-
	
		Now we will create GET/POST route in web.php for add coupon form.
		
		Route::match(['get', 'post'], 'admin/add_coupon', 'CouponsController@addCoupon');
		
	5) Create addCoupon fucntion in CouponsController
	
	6) Create add_coupon.blade.php file:-
	
	Now we will create coupons folder in admin folder to add the add_coupon file.. Here we
	 willintegrate add coupon form.
	 
	 Now add admin design to this file same as done for others
	 
	 7) Update admin_sidebar blade file to add copon modul there as well 
	
	
	
	
------------------------------------------------------------------------------------------------------------------------------------------

	Part 56.
	
	Continue working on coupon code functionality. We will add jquery date picker
	also add HTML 5 validation for copon code form and finally save to coupons table
	
	1) Update admin_design.blade.php file:-
	Search google for jquery date picker
	
	add JS/CSS scripts from this source code to admin design blade file and will give the
	expiry_date id to datepicker.
	
	2) Update add_coupon.blade.php file:-
	(Add HTML5 validations)
	
	Now we will add HTML5 validations to our add coupon form that is really easy and fast
	to integrate.
	
	3) For Coupon code, we will allow the user to enter coupon of legth between 5 to 15
	alphanumeric code.
	
	We will use minLength and maxLength HTML 5 validation script.
	 minlength="5" maxlength="15"
	 
	 Update type for amount as number 
	 
	 3) Update addCoupon function
	 Now we will update addCoupon function to get all the coupon details from user and 
	 store them in coupon table.
	 
	 
	 
	 ----------------------------------------------------------------------------------------
	 
	 Part 57
	 
	 Continue working on coupon code functionality in admin panel. This time work on view
	 coupon code in admin panel
	 
	 1) Create Route 
	 	Create GET route for view coupons in web.php
	 	
	 	Route::get('admin/view_coupons', 'CouponsController@viewCoupon');
	 
	 2)Create viewCoupon function:- in CouponsController.php file.
	 
	 3) Create view_coupons.blade.php file 
	  create this file in resource/views/admin/coupons 
	  
	  copy view products and edit.
	  
	 4) Update viewCoupon function
	 write query to get all coupons and return to blade file.
	 
	 5) Update view_coupons.blade.php file:-
	 
	 add foreach loop to show all coupons.
	 
	
	
------------------------------------------------------------------------------------------------------------

	Part 58 
	Edit coupons
	
	1) Create edit route:-
	
	Create GET/POST route for eidt passing the {id} to editCoupon function in web.php 
	
	Route::match(['get', 'post'], 'admin/edit_coupon/{id}', 'CouponsController@editCoupon');
	
	2) Create editCoupon function:-
	pass in id as the parameter so that you can fetch the coupon you want to edit by id.
	 
	
	3) Create edit_coupon.blade.php file:-
	
	create coupon edit file
	
	4) Update editCoupon function:-
	
	Now we will update editCoupon function to get the coupon data in POST method and update
	 all data accordingly.
	
	
	
-------------------------------------------------------------------------------------------------------------------------------

	Part 59. 
	Delete Coupon Code.
	
	
--------------------------------------------------------------------------------------------

	Part 60
	
	Work on shopping cart page at frontend. Display coupon code field with apply button 
	at shopping cart page. If user apply incorrect coupon code it will show error otherwise
	 other checks will be performed.
	 
	1) Update cart.blade.php 
	 Update cart page to display coupon field along with apply button. 	
		
	
	2) Create Route:-
	Now create a POST route for applying coupon like below:-
	
		Route::post('/cart/apply-coupon', 'ProductsController@applyCoupon'); 
		
	3) Update Header Statements :-
	
		add header to include coupon model in our ProductsController.
		
	4) Create applyCoupon fucntion:-
	
	Now create applyCoupon function where we will chec if coupon is correct or not.
	
	
	
----------------------------------------------------------------------------------------------------------

	Part 61
	
	Continue working on cart page and check all conditions for the coupon code, active/inactive expiry
	 date of the coupon.We will show sub total and grand total as well. And Grand total will 
	 contain amount deducting coupon discount from sub total.
	 
	1) Update applyCoupon function:-
	
	We will update applyCoupon function in ProductsController and we will add further checks to see if
	coupon is valid or not.
	
	2) Update cart.blade.php file to show coupon discount. If correct coupon entered by the user.
	We will show subtotal, Discount and Grand total if the coupon is correct.
	

-------------------------------------------------------------------------------------------------------------

	Part 62
	
	Resolve coupon code functionality, then work on home page dynamic section. like banners
	
	Coupon Issue: Right now if you update the cart after applying the percentage coupon then the
	 discount amount never updates so we are going to forget our coupon amount and code session so that 
	 every time user needs to apply coupon when cart updates.
	 
	 1) Update ProductsController
	 
	 	Update few functions that updates our shopping cart like update quantity, delete cart item or
	 	 add cart item.
	 	 
	 	 i) Update addtoCart function:-
	 	 First update cart function by forgetting the session of Coupon code and coupon discount like
	 	 below
	 	 
	 	 Session::forget('CouponAmount');
	 	 Session::forget('CouponCode');    	
	 	 
	 	 ii) Update updateCartQuantity function and forget below sessions:- 
	 	 
	 	 Session::forget('CouponAmount');
	 	 Session::forget('CouponCode'); 
	 	 
	 	 iii) Update deleteCartProduct function and forget below sessions:- 
	 	 
	 	 Session::forget('CouponAmount');
	 	 Session::forget('CouponCode'); 
	 	 
	 	 ------------------------------------------
	 	 Work on Home page banners and update that in admin panel.
	 	 Search for dummy banners for our home page. and open below link
	 	 
	 	 https://dummyimage.com/
	 	 
	 	 
--------------------------------------------------------------------------------------------------------

	Part 63
	Make banners dynamic
	
	1) Create Banners table manually without using migrations.
	
	create the following columns   
	
	id, image, title, link, status, created_at, updated_at
	
	2) Update admin_sidebar.blade.php file
	
	Add Banners section to admin sidebar.	 	 
	
	3) Create BannersController:-
	
	php artisan make:controller BannersController
	
	Create Banner model 
	php artisan make:model Banner
	
	4) Create Route
	
	Route::match(['get', 'psot'], '/admin/add_banner', 'BannersController@addBanner');
	
	5) Create Function:-
	
	create addBanner function in BannersController
	
	6) create add_banner.blade.php
	
	
	
------------------------------------------------------------------------------------------------

    Part 64
    
    Work on edit and view banner
    
    1) Create Route:-
    Create GET route for view banners in web.php file like below:-
    
    Route::get('admin/view_banners', 'BannersController@viewBanners');
	
	2) Create function:-
	 Create viewBanners function in BannersController to return all banners.
	 
	 Edit banners functionality
	  First create Route:-
	  
	  We will create GET/POST route for editing banner
	  
	  Route::match(['get', 'post'], '/admin/edit_banner/{id}',
	         'BannersController@editBanner');
	         
	         
	3) Create editBanner function.
		Create edit_banner.blade.php file
		
		
		
-------------------------------------------------------------------------------------------------

	Part 65
	complete edit banner and delete banners and then show them on home page.
	   
	
	1) Update edit banner function.      
	
	 Wor now on delete Banner
	 
	 2) Create Route:-
	     Route::get('/admin/delete_banner/{id}', 'BannersController@deleteProduct');
	     
	3) Add deleteBanner function in BannersController.
	
	Now show banner images on home page by editing index.blade.php file. and 
	 index function of IndexController inorder to get all the banner images and send to
	 index.blade.php file to be displayed at the front page.
	 
	 
	 
-------------------------------------------------------------------------------------------------

	Part 66
	
	Add User Login/signup validate with jquery validation to user registration form
	Check for user email if it exists or not then display error message if not exists.
	First do the check with php and with jquery.
	
	1) Update login_register function
	
	First we are going to update login_register functio to add check if user already
	 exists  
	 
	2) Update login_register.blade.php file
	Show error message in login register blade file.
	
	Now do validation with jquery. add jquery validate file ie.
	jquery.validate.js from backend_js to frontend_js and then include this file in 
	front_design.blade.php
	
	3) Update front_design.blade.php file
	
	include this jquery.validate.js file in front_design.blade.php file
	
	
	4) Update main.js file:-
	
	Now update main.js file to add jquery validation to our register form to add
	 validations for name, email and password.
	 
	 Search google for jquery validation rules and messages.
	 
	 Add validation to email with remote function/keyword that we will ue to call route and
	  function to check wether user already exists
	  
	  add below code in email validation to remotely check for email validity.
	  
	   remote: "check-email"
	   
	   
	   6) Create Route:-
	   Now we must create route to verify email to see if user already exists or not 
	   Route::match(['get', 'post'], '/check-email','UsersController@checkEmail');
	
	    7) Create checkEmail function in UsersController to perform the logic.
	    	
-----------------------------------------------------------------------------------------

  		Part 67. 
  	
  	Update admin panel by showing active module on sidebar highlighted background.
  	
  	1) Update admin_sidebar.blade.php file:-
  	
  	Add active class to module which one we select and we also need to show it by adding
  	 below style.
  	 
  	 style = "display:block;"
  	 
  	 add class="active"
  	 
  	 Find current url in laravel. 
  	 Search for https://laravel.com/docs/5.6/urls
  	 and use this code snippet
  	 
  	 echo url()->current();
  	 
  	 
  	 Pattern Matching in PHP (preg match)


-------------------------------------------------------------------------------------------

	Part 68.
	
	
	Continue working on user profile
	
	1) Search Google:-
		Search google foe "free jquery password plugin"
		https://www.jquery.net/tags.php?/Password/
		So many available in our case we have choosen Visual Password Strength Indicator For
		Jquery Passstrength.js
	
	2)Download it and copy scripts to our project.
	
	  i) copy passtrength.js file to our js folder
	  
	  ii) copy css too.
	  
	  iii) Copy image too(eye.svg)
	  
	3) Update front_design.blade.php file 
	
	 Now include js/css in front design blade file that we have copied
	 
	 
	4) Update main.js file
	add some jquery scripts like below   
	
	$(document).ready(function($) {
        $('#myPassword').passtrength({
          minChars: 4,
          passwordToggle: true,
		  tooltip: true,
		  eyeImage: "/images/frontend_images/eye.svg"
        });
      });
      
     5) Update login_register.blade.php file:-
       Add id="myPassword" for password input field.
       
       
  ---------------------------------------------------------------------------------------
  
  Part 69
  
  Add user to users table
  we will add user and redirect them to cart page with Account and Logout links at header
  Add changes to to route and functions so that we can seperate login and register form.
  
  1) Update we.php file
    i) Update login-register route with GET method only in place of GET/POST
    
	//User login/register route.
	Route::get('/login_register','UsersController@userLoginRegister');
	
	ii) Create user-register route with POST method only where user will register from 
	register function.
	
	Route::post('/user_register', 'UsersController@register');


	2) Update UsersController file :-
	
	i) Create userLoginRegister function in which  we will simply return the user to
	login_register.blade file.
	
	ii) Update register function with request data that submitted from the user register
	 form and then into the users table and redirect to cart page after Auth::Attempt.


	While adding user into users table, we need to bcrypt the password to hide for
	security reasons https://laravel.com/docs/5.6/hashing
	
	Now use Auth::attempt to log the user into the website and redirect user to cart page.
	
	
	3) Update Header Statements:-
	
	Add below header at top of UsersController file
	
	
	4) Update front_header.blade.php file
	
	Now update front header to show Account and Logout links whenever user is logged in
	 otherwise we will show Login link only.
	
	use Auth::check() to check wether the user has logged in or not. If Auth::check() is 
	empty, it means the user has not logged in.
	
	5) Create Route (Logout):-
	
	Now create GET route for users logout in web.php 
	
	Route::get('/user_logout', 'UsersController@logout');
	
	6) Create Logout function:-
	
	Now create logout function in UsersController to logout the user and loguot the Auth
	function as well.
	
	Auth::logout();
    
    We will logout the user with the above statement and redirect to home page.
	
	
	
	
------------------------------------------------------------------------------------------

 	Part 70
 	Users who want to place order needs to have an account to login to.
 	Ad jquery validation to login form same as that for register form.
 	
 	1) Update login form in login register blade file and give email and password fields
 	that the user can enter and able to login.
 	
 	2) Update main.js file (Jquery validations):-
 		Update jquery validation same as that for register form.
 		
 	3) Create Route:-
 	Now create POST route for login in web.php
 	
 	Route::post('user_login', 'UsersController@login');
 	
 	4) Create "login" function:-
 	
 	 Now will create "login" function in UsrsController file where we will compare user
 	 email and password tht user entered in login form with Auth::attempt and if email
 	 login details is valid then user can redirect to cart page otherwise Invalid Useremail
 	 or password.
 	 
 	 
 	 
---------------------------------------------------------------------------------------------
 	 
 	Part 71
  		Prevent access to user profile without login
  		
  		1) Create Route for Account Page.
  		Route::match(['get', 'post'], 'account', 'UsersController@account');
  		
  		2) Create account function in UsersController.php file
  		
  		
  		3) Create account.blade.php file.
  		
  		Prevent access to account unless user is logged in do this by creating middle ware.
  		
  		4) Create "Frontlogin" Middleware:-
  		
  		php artisan make:middleware Frontlogin	
  		
  		5) Update "Frontlogin" Middleware:-
  		
  		Add below condition in handle function :-
  		
  			 if(empty(Session::has('frontSession'))){
            	return redirect('/login_register');
        	  }
        	  
        6) Update login and register functions:-
        
        Now start frontSession every time when user login or registers.
        
        Add below Session after Auth::attempt in both login and register functions
        
            Session::put('frontSession', $data['email']);
            
        7) Update kernel.php file:- located at /app/http folder under 
            protected $routeMiddleware  like below:-
        
        	 'frontlogin' => \App\Http\Middleware\Frontlogin::class,

	   8) Update web.php file 
	   
	   	Add account route in Frontlogin Middleware in web.php file. And all other routes
	   	 that we will do in the future and that require user to login first.
	   	 
	   9) Update UsersController with Session at header
	   
	   		use Session;
	   		
	   10) Update logout function in UsersController:-
	   
	   We need to forget frontSession in logout function as well 
	   
	   
	   
	   
-------------------------------------------------------------------------------------------
	Part 72.
	
	User Account, Import countries.
	add columns to user table and show the update account form so that user can update his
	 complete details.
	 
	 1) Update users table:- (Manually from php myadmin).
	 	Add columns to users table such as address, city, state, country, pincode,
             mobile,
	 	
	 2) Import countries table:-
	 
	   Now we will search Google for "countries mysql"

       Add open below url
	https://github.com/raramuridesign/mysql-country-list/blob/master/
          mysql-country-list.sql

	Simply copy and paste mysql code from the above url to your database sql code section.
	Rename app_countries table to countries.

	3) Create Country Model.
		Use below code in terminal
		php artisan make:model Country
	
	4) Update account.blade.php file:-
	
	 Update account blade file and all fields that we have recently added.
	 
	 5) Update "acount" function:-
	 get all countries from countries table that we created and return to account blade file
	 
	 6) Add appropriate headers.
	 
	 7) Update acount.blade.php file:-
	  Add foreact loop to get all countries in select country field.
	  
	 8) Update "account" function:-
	 
	 	Now Update "account" function in UsersController once again to get all user details
	 	 of particular user so that we can return the user details account blade to prefilled
	 	  all user details here. After that also allow the user to update other columns as
	 	   well 
	
	9) Update account.blade.php file to get name of user initially when the user registered.
	
	
	
	
------------------------------------------------------------------------------------------------

	Part 73.
	Wor on account page, add jquery validations
	
	1) Update account.blade.php file:-
	
		Get all values from db and fill in the input fields.
		
		
	2) Update account function:-
	
	Now we will update account function in UsersController so that we can get all values in 
	post method and update in users table matching with user_id. 
	
	
	
	3) Update main.js file:-
	 Ad validation to update form.
	 
	 
	 
---------------------------------------------------------------------------------------------

	Part 74
	Work on update password form, ahow fields like current password correct or not
	
	1) Update account.blade.php file:-
	
	2) Update main.js file to validate inputs.
	
		Add jquery function in main.js file tttt will check whether current password is
		correct or not via ajax/route/function.
		
	3) Create Route:- 
		Create POST route for checking current password 
		
		Route::get('/check_user_password', 'UsersController@checkUserPassword');	
		
	4) Create "checkUserPassword" function in UsersController file to check whether current
	 password is correct or not. If correct send true if not send false.	
	
	5) Resolve 419 Error : For resolving this take below steps
	
	 i) Add Below meta statement in front_header blade file.
	 
	 	    <meta name="author" content="{{ csrf_token() }}">
	 	    
	 ii) Update jquery function in main.js file with:-
	 
	 	headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			
			
	6) Update Headers statement
	
	 Add below header statement in UsersController
	 use Illuminate\Support\Facades\Hash;
	 
	 7) Update main.js file
	 We need to update our jquery function once again to set another id in response that 
	 depends upon true or false response.
	 
	 If rsponse is false then we will display Incorrect Password and if response is true 
	 display Correct password and its value we are going to display under current password
	 field.
	 
	 8) Update account.blade.php file:-
	  update account blade file with id="checkPwd" in span.
			
			
-------------------------------------------------------------------------------------------

 	Part 75
 	Jquery validation to update password.
 	And finally create a function to update password.
			
   1) Create Route:-
     Create the post route in web.php file for updating user password and we call the 
     "updatePassword" function.
     
     Route::post('/update_user_password', 'UsersController@updateUserPassword');
     
    2) Create "updateUserPassword" function in UsersController.php file to handle update
    password.
    
    
--------------------------------------------------------------------------------------------- 
			
	 
	Part 76 
	Upgrade to laravel 5.7
	
	Migrate our ecom project from laravel 5.6 to 5.7 so that we can use all essential
	features
	
	Follow the steps below.	 		
	
	1) New Laravel 5.7 Installation
	 Install 5.7 
	 
	 Create new laravel project after installaling 5.7
	 
	 
	 
-----------------------------------------------------------------------------------------------

	Part 77
	Work on checkout page. Start adding Billing/Shipping Address that the user needs to
	fill while placing order.
	
	Create checkout.blade.php file that contains billing/shipping addresses and second one is 
	order_review.blade.php file from where you can review your order and select a payment method.
	
	1) Update cart.blade.php file.
	
		Update check button to link to checkout page.
		
	2) Create Route:-
	
	Create GET/POST route for checkout page
	    Route::match(['get', 'post'], 'checkout', 'ProductsController@checkout');
	3) Create "checkout" function.
	
	4) Create checkout.blade.php file:- inside products folder.
	
	
-----------------------------------------------------------------------------------------------------------

	Part 78.
	
	Continue on working on checkout page. First work on billing form and display all user data in billing form
	if user already has such data. We will create a shipping address table
	
	1) Update "Checkout" function:-
		First Update checkout function in ProductsController to get user details and return to checkout page to 
		display in the billing form.
		
	2) Update Checkout.blade.php file to insert user values to inputs.
	
	3) Update Checkout function to return countries and return that in blade file
	
	
	
	
----------------------------------------------------------------------------------------------------------------

	Part 79
	
	 Continue working on checkout page
	 Work this time on delivery address form, create one table ie delivery_addresses to save the delivery
	  address from that table. Also, we will work on shipping Address same as billing Address functionality so 
	  that it will save user's time when both addresses are same.
	  
	1) Create delivery_addresses table(Manually).
	Create this table with below columns.
	id, user_id, user_email, name, address, city,state, pincode, country, mobile, created_at and updated_at
	
	
	2) Create Model DeliveryAddress
	
	php artisan make:model DeliveryAddress
	
	3) Update main.js file:-
	
	Add jquery to copy billing address to shipping address when shipping address is same as billing address.
	
	 We need to update Shipping Address form with id and name for all fields.
	
   
 ---------------------------------------------------------------------------------------------------------------


	Part 80
	
	Continue working on checkout page, save billing address and shipping address in users table and
	 delivery_address table
	And if user already added his delivery_address then we are going to show it in checkout page like we are
	 showing user address
	in billing form.	
	
	1) Update checkout.blade.php file
	 Update checkout form with csrf_field()
	 
	2) Update checkout in ProductsController and add if condition with post method where we are going to update
	billing and shipping order.
	
	 First validate all fields. 
	 
	3) Update Checkout function:-
	
	 Update checkout function to update users table  with billing formand delivery_addresses table with
	 shipping form.
	
	3) Update checkout.blade.php file:-
	
	Show shipping address as well in shipping form in checkout page after adding it.
	
	
------------------------------------------------------------------------------------------------------------

 	Part 81.
 	
 	Start working on order review page / payment page that will have billing/shipping details, order items
 	and payment methods.
 	
 	1) Update Checkout function in ProductsController so that we can update usr email in cart table when
 	  user adds product to cart
 	  
 	  
 	2) Create Route:- Create GET/POST route for order review page in web.php file
 	
 		Route::match(['get', 'post'], '/order_review', 'ProductsController@orderReview');  
 	
 	3) Create "orderReview" function:-
 	   Create this function in ProductsController file
 	   
 	   
 	 4) Now create order_review.blade.php file:- in products folder and include front design as for 
 	 more blade files 
 	 
 	 50 Update checkout function again to redirect user to order review page. 
	
	
-------------------------------------------------------------------------------------------------------------

   Part 82
   
   Continue Working on order review page and this time show  cart items and payment methods that we are going
   to use
   
   1) Update order_review.blade.php file:- 
   	Copy order review design from eshopper.
   	
   2) Update orderReview function now to get all cart ite,s from cart table and return those items from oreder
    review blade file	
	
  3) Update review_order.blade.php file:-
  
  Update order review blade file to show the cart items in foreach loop like we did in cart blade file.
  
  
 -----------------------------------------------------------------------------------------------------------
 
 	Part 83
 	
 	Continue working on order review page. Calculate and show sub-total, discount amount and grand total
 	in oreder review page along with the payment methods
 	
 	Resolve some issues first.
 	
 	1) Update database.php file:- Remove the problem of field does not have a default value.
 	To do this, just update strict as false under mysql array in database.php file located at config folder. 
  
  	'strict' => false,
  	
  	2) Update Checkout function
  	
  	Update checkout function in ProductsController to declear $shippingDetails varable as array so that 
  	Undefined variable error will not come as shown.
  	$shippingDetails = array();
  	
  	3) Update Checkout.blade.php file
  	
  	Add condition with all user and shipping fields so that if the variables are empty the value will not come
  	
  	4) Update order_review.blade.php file:-
  	 Do some calculations to find subtotal, discount and grand total
  	 
  	 
  -------------------------------------------------------------------------------------------------------------
  	 
  	Part 84
  	
  	Continue working on review order page, this time we will add payment methods like COD and Paypal along 
  	with the place order button.
  	
  	1) Update review_order.blade.php file:-
  	
  	 Add payment form inwhich we will add payment methods with radio buttons so that user select a payment 
  	 method at a time.
  	 
  	 2) Update main.js file:-
  	 
  	 	Add select payment method function to alert the user if payment method is not selected.	 
  
  	
  	3) Create Route:-
  	
  	Now create GET/POST route for place-order in web.php
  	
  		Route::match(['get', 'post'], '/place_order', 'ProductsController@placeOrder');
  	
  	4) Create placeOrder function:- in ProductsController and get print the form data in post method.
  	
  	 We are sending grand total and payment method for now, also send coupon code and coupon amount later on.
  	 
  	 
  	 
 ------------------------------------------------------------------------------------------------------------
 
 	Part 85
 	
 		Work on order placement process. For placing orders either from COD or Paypal, we need to create orders tables to
 		insert the orders details into them so that admin and user can view order details anytime they want.
 		
 		Now create 2 tables
 		1) orders table
 			This will contain delivery details, coupon/ shipping details, grand total and other main information
 			
 			Create this table with the following columns
 			id, user_id, user_email, name, address, city, state, pincode, country, mobile, shipping_charges, 
 			coupon_code, coupon_amount, order_status, payment_method, grand_total, created_at, updated_at
 			
 		2) Create orders_products table
 			This will contain ordered products data that the user going to order
 			Create this table with below columns
 			
 			id int(11)
 			order_id int(11)
 			user_id int(11)
 			product_id int(11)
 			product_code varchar(255)
 			product_name varchar(255)
 			product_size varchar(255)
 			product_price float
 			product_quantity int(11)
 			created_at datetime
 			updated_at TIMESTAMP
 			
 		
 		
 ------------------------------------------------------------------------------------------------------------------------
 
 	Part 86
 	
 	Continue working on order placement process. We are going to insert orders details in orders and orders_products
 	table th we have created in last video
 	
 	First, create models for both tables and then update placeOrder function as well
 	
 	 Update orders_products table by adding products_color.
 	 
   1) Create Order Model :-
   
    Create Order Model for orders table by running below artisan command:-
    
    php artisan make:model Order
    
   2) Creat OrdersProduct Model: -
    php artisan make:model OrdersProduct 	 
    
    
    3) Please update cart function to sort out one issue, when user is logged in, the we will get the products from cart
     table after comparing his user_email otherwise we will use his session_id.
     
     if(Auth::check()){
            $user_email = Auth::user()->email;
            $userCart = DB::table('carts')->where(['user_email'=>$user_email])->get();
        }else{
            $session_id = Session::get('session_id');
            $userCart = DB::table('carts')->where(['session_id'=>$session_id])->get();

        }
        
    
    
   4) Update placeOrder function (save orders table details):-
  
   	We need to update placeOrder function in ProductsController to save orders detail in orders table in post method.  
   	
   	We need to get shipping details from delivery_addresses table and save in orders table as well.
 	
   5) Update placeorder function:-
   
    Add condition for coupon_code and coupon_amount if they are empty.
    
    
    Update applycoupon function
    
    Update another issue while applying percentage coupons. So pleae update applyCoupon function to update $userCart.
    when user is logged in from user_email when user is logged in otherwise from session_id.
    
    Replace 
    	$userCart = DB::table('carts')->where(['session_id' => $session_id])->get();
    with
    	if(Auth::check()){
            $user_email = Auth::user()->email;
            $userCart = DB::table('carts')->where(['user_email'=>$user_email])->get();
        }else{
            $session_id = Session::get('session_id');
            $userCart = DB::table('carts')->where(['session_id'=>$session_id])->get();
        }
    
 ---------------------------------------------------------------------------------------------------------------------
 
 	Part 87 
 	
 	Save ordered products in orders_products table means that the products the user is going to order
 	
 	1) Update plcaeOrder function in ProductsController once again and save orders_products detail in 
 	orders_products table.
 	
 	Use foreach loop and pick all products from the cart table that the user has added earlier and save 
 	them one by one in orders_products table.
 	
 	After saving orders details, we require to save order_id in orders_products table and that we will 
 	get from below syntax
 	
 	$order_id = DB::getPdo()->lastInsertId(); 
 	
 	
 ---------------------------------------------------------------------------------------------------------
 
 	Part 88
 	
 	First update thanks function in products controller inorder to delete cart items after user finish placing
 	order. This will be done based on the user email.
 	
 	To view all user orders, add hasMany relationship in Order model
 	
 	 	
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	

