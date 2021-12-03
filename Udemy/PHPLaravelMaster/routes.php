<?php

use App\Country;
use App\Photo;
use App\Post;
use App\Role;
use App\Tag;
use App\User;
use Carbon\Carbon;



/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


//
//Route::get('/about', function () {
//
//
//    return "Hi about page";
//
//
//});
//
//
//Route::get('/contact', function () {
//
//
//    return "hi I am contact";
//
//
//});
//
//Route::get('/post/{id}/{name}', function($id, $name){
//
//
//    return "This is post number ". $id . " " . $name;
//
//
//
//});
//
//Route::get('admin/posts/example', array('as'=>'admin.home' ,function(){
//
//    $url = route('admin.home');
//
//
//    return "this url is ". $url;
//
//}));



//Route::get('/post/{id}', 'PostsController@index');




//Route::resource('posts', 'PostsController');


//
//Route::get('/contact', 'PostsController@contact');
//
//
//
//Route::get('post/{id}/{name}/{password}', 'PostsController@show_post');



/*
|--------------------------------------------------------------------------
| DATABASE Raw SQL Queries
|--------------------------------------------------------------------------
*/


//
//Route::get('/insert', function(){
//
//
//   DB::insert('insert into posts(title, content) values(?, ?)', ['Laravel is awesome with Edwin', 'Laravel is the best thing that has happened to PHP, PERIOD']);
//
//
//
//});


//Route::get('/read', function() {
//
//
//
//   $results = DB::select('select * from posts where id = ?', [1]);
//
//
//   return var_dump($results);
//
//
////   foreach($results as $post){
////
////
////      return $post->title;
////
////
////   }
//
//
//});

//
//Route::get('/update', function(){
//
//
//
//   $updated = DB::update('update posts set title = "Update title" where id = ?', [1]);
//
//
//
//   return $updated;
//
//
//
//});



//Route::get('/delete', function(){
//
//
//
//   $deleted = DB::delete('delete from posts where id = ?', [1]);
//
//
//
//   return $deleted;
//
//
//
//
//});

//



/*
|--------------------------------------------------------------------------
| ELOQUENT
|--------------------------------------------------------------------------
*/


//Route::get('/read', function(){
//
//
//
//   $posts = Post::all();
//
//
//
//   foreach($posts as $post) {
//
//      return $post->title;
//
//
//   }
//
//
//
//});



//Route::get('/find', function(){
//
//
//
//   $post = Post::find(2);
//
//
//   return $post->title;



//   foreach($posts as $post) {
//
//      return $post->title;
//
//
//   }


//
//});



//Route::get('/findwhere', function(){
//
//
//
//   $posts = Post::where('id', 3)->orderBy('id', 'desc')->take(1)->get();
//
//
//   return  $posts;
//
//
//
//
//});


//
//Route::get('/findmore', function(){
//
//
//
////   $posts = Post::findOrFail(1);
////
////
////   return $posts;
////
//
//
//   $posts = Post::where('users_count', '<', 50)->firstOrFail();
//
//
//
//});



//
//Route::get('/basicinsert', function(){
//
//
//   $post = new Post;
//
//
//   $post->title = 'New Eloquent title insert';
//   $post->content = 'Wow eloquent is really cool, look at this content';
//
//   $post->save();
//
//
//
//
//});
//

//
//Route::get('/basicinsert2', function(){
//
//
//   $post = Post::find(2);
//
//
//   $post->title = 'New Eloquent title insert 2';
//   $post->content = 'Wow eloquent is really cool, look at this content 2';
//
//   $post->save();
//
//
//
//
//});


//
//Route::get('/create', function(){
//
//
//
//   Post::create(['title'=>'the create method 2', 'content'=>'WOW I\'am learning a lot with Edwin Diaz 2']);
//
//
//
//
//});



//Route::get('/update', function(){
//
//
//
//   Post::where('id', 2)->where('is_admin', 0)->update(['title'=>'NEW PHP TITLE', 'content'=>'I love my instructor Edwin']);
//
//
//
//
//});


//
//Route::get('/delete', function(){
//
//
//   $post = Post::find(4);
//
//
//   $post->delete();
//
//
//
//});

//Route::get('/delete2', function(){
//
//
//   Post::destroy([4,5]);
//
//
////   Post::where('is_admin', 0)->delete();
//
//
//
//});



//Route::get('/softdelete', function(){
//
//
//
//   Post::find(2)->delete();
//
//
//
//});

//Route::get('/readsoftdelete', function(){
//
//
////
////   $post = Post::find(1);
////
////   return $post;
//
////   $post = Post::withTrashed()->where('is_admin', 0)->get();
////
////   return $post;
//
//
////   $post = Post::onlyTrashed()->where('is_admin', 0 )->get();
////
////   return $post;
//
//
//
//
//});
//

//Route::get('/restore', function(){
//
//
//
//   Post::withTrashed()->where('is_admin', 0)->restore();
//
//
//
//
//});
//

//Route::get('/forcedelete', function(){
//
//
//   Post::onlyTrashed()->where('is_admin', 0)->forceDelete();
//
//
//});


/*
|--------------------------------------------------------------------------
| ELOQUENT Relationships
|--------------------------------------------------------------------------
*/




// One to One relationship
//
//Route::get('/user/{id}/post', function($id){
//
//
//   return User::find($id)->post->content;
//
//
//
//});


//Route::get('/post/{id}/user', function($id){
//
//
//
//   return Post::find($id)->user->name;
//
//
//
//
//});
//

// One to Many relationship

//Route::get('/posts', function(){
//
//
//   $user = User::find(1);
//
//   foreach($user->posts as $post) {
//
//      echo $post->title . "<br>";
//
//   }
//
//
//
//});


// Many to Many relationship


//Route::get('/user/{id}/role', function($id){
//
//
//    $user = User::find($id)->roles()->orderBy('id', 'desc')->get();
//
//
//    return $user;



//    foreach($user->roles as $role){
//
//        return $role->name;
//
//
//    }


//
//});


// Accessing the intermediate table / pivot



//Route::get('user/pivot', function(){
//
//
//    $user = User::find(1);
//
//
//    foreach($user->roles as $role){
//
//        return $role->pivot->created_at;
//
//    }
//
//
//});
//
//
//
//Route::get('/user/country', function(){
//
//
//  $country =  Country::find(4);
//
//   foreach($country->posts as $post) {
//
//       return $post->title;
//   }
//
//
//});



// Polymorphic Relations



//Route::get('user/photos', function(){
//
//
//    $user = User::find(1);
//
//
//        foreach($user->photos as $photo) {
//
//
//            return $photo->path;
//
//
//        }
//
//
//});


//Route::get('post/{id}/photos', function($id){
//
//
//    $post = Post::find($id);
//
//
//    foreach($post->photos as $photo) {
//
//
//        echo $photo->path . "<br>";
//
//
//    }
//
//
//});
//

//
//Route::get('photo/{id}/post', function($id){
//
//
//  $photo =  Photo::findOrFail($id);
//
//    return $photo->imageable;
//
//
//
//
//});


// Polymorphic Many to Many

//
//Route::get('/post/tag', function(){
//
//    $post = Post::find(1);
//
//
//    foreach($post->tags as $tag){
//
//        echo $tag->name;
//
//
//    }
//
//
//});

//
//    Route::get('/tag/post', function(){
//
//
//        $tag = Tag::find(2);
//
//        foreach($tag->posts as $post){
//
//
//            return  $post->title;
//
//
//        }
//
//
//    });
//


/*
|--------------------------------------------------------------------------
| Crud Application
|--------------------------------------------------------------------------
|
*/

//
//
//Route::group(['middleware'=>'web'], function(){
//
//
//
//
//
//
//
//  Route::resource('/posts', 'PostsController');
//
//
//
//
//  Route::get('/dates', function(){
//
//
//    $date = new DateTime('+1 week');
//
//
//    echo $date->format('m-d-Y');
//
//
//    echo '<br>';
//
//
//    echo Carbon::now()->addDays(10)->diffForHumans();
//
//
//    echo '<br>';
//
//
//    echo Carbon::now()->subMonths(5)->diffForHumans();
//
//    echo '<br>';
//
//
//    echo Carbon::now()->yesterday();
//
//
//    echo '<br>';
//
//
//
//
//  });
//
//
//
//
//  Route::get('/getname', function(){
//
//
//    $user = User::find(1);
//
//
//    echo $user->name;
//
//
//
//
//  });
//
//
//  Route::get('/setname', function(){
//
//
//    $user = User::find(1);
//
//
//    $user->name = "william";
//
//    $user->save();
//
//
//
//
//  });
//
//
//
//
//
//
//
//
//
//});
//



























/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

//Route::group(['middleware' => ['web']], function () {
//
//
//
//
//
//});