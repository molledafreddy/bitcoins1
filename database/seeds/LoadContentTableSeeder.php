<?php

use Illuminate\Database\Seeder;
use App\ContentType;
use App\LoadContent;
class LoadContentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      LoadContent::create([
       'id' => 1,
       'status' => 1, 
       'template' => '<html>
       <head>
       <title></title>
       </head>
       <body>
       <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean nibh sapien, rutrum in mauris et, laoreet aliquet odio. Quisque id lorem tincidunt, malesuada magna sed, sollicitudin ex. Pellentesque vitae interdum velit. Donec bibendum ipsum neque, at consequat metus dignissim in. Proin vel nisi dui. Mauris sed augue nec erat feugiat hendrerit in at lacus. Proin vitae ornare metus. Nam rhoncus vehicula mauris, eget viverra lectus sodales ut. Phasellus diam justo, tincidunt eget ullamcorper id, eleifend sit amet quam. Suspendisse id cursus nunc, in luctus nulla. Curabitur mollis interdum risus ut dapibus. Mauris eget metus orci.</p>

       <p>Interdum et malesuada fames ac ante ipsum primis in faucibus. Aenean condimentum pretium ipsum, sed venenatis libero dapibus vitae. In hac habitasse platea dictumst. Etiam quis augue commodo, aliquam risus in, placerat augue. Cras suscipit at felis nec tincidunt. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Proin finibus purus quam.</p>

       <p>Vivamus tempor a nisi sit amet vestibulum. Nunc efficitur non tortor et efficitur. Praesent eget pretium metus, faucibus gravida lorem. Ut varius, urna aliquet auctor fringilla, erat ipsum auctor tellus, eget ultrices est ligula non nisi. Cras id volutpat leo. Fusce condimentum, velit quis bibendum auctor, lectus nibh dapibus arcu, eu varius dui odio suscipit ante. Vestibulum porta enim eu interdum iaculis. Integer id vestibulum turpis, ac lobortis purus. Sed lacinia vehicula leo, ac ullamcorper dolor porttitor ut. Pellentesque mollis ut dui id dapibus. Aenean eleifend quam libero, at dignissim augue accumsan id. Pellentesque fringilla bibendum lacinia. Ut porttitor metus est, sit amet interdum neque tincidunt et. Maecenas nibh purus, pellentesque ut est et, aliquet convallis eros. Nunc commodo turpis sapien, quis feugiat tortor mollis id.</p>
       </body>
       </html>',
       'content_type_id' => 1
       
     ]);

      LoadContent::create([
        'id' => 2,
        'status' => 1, 
        'template' => '<html>
        <head>
        <title></title>
        </head>
        <body>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean nibh sapien, rutrum in mauris et, laoreet aliquet odio. Quisque id lorem tincidunt, malesuada magna sed, sollicitudin ex. Pellentesque vitae interdum velit. Donec bibendum ipsum neque, at consequat metus dignissim in. Proin vel nisi dui. Mauris sed augue nec erat feugiat hendrerit in at lacus. Proin vitae ornare metus. Nam rhoncus vehicula mauris, eget viverra lectus sodales ut. Phasellus diam justo, tincidunt eget ullamcorper id, eleifend sit amet quam. Suspendisse id cursus nunc, in luctus nulla. Curabitur mollis interdum risus ut dapibus. Mauris eget metus orci.</p>

        <p>Interdum et malesuada fames ac ante ipsum primis in faucibus. Aenean condimentum pretium ipsum, sed venenatis libero dapibus vitae. In hac habitasse platea dictumst. Etiam quis augue commodo, aliquam risus in, placerat augue. Cras suscipit at felis nec tincidunt. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Proin finibus purus quam.</p>

        <p>Vivamus tempor a nisi sit amet vestibulum. Nunc efficitur non tortor et efficitur. Praesent eget pretium metus, faucibus gravida lorem. Ut varius, urna aliquet auctor fringilla, erat ipsum auctor tellus, eget ultrices est ligula non nisi. Cras id volutpat leo. Fusce condimentum, velit quis bibendum auctor, lectus nibh dapibus arcu, eu varius dui odio suscipit ante. Vestibulum porta enim eu interdum iaculis. Integer id vestibulum turpis, ac lobortis purus. Sed lacinia vehicula leo, ac ullamcorper dolor porttitor ut. Pellentesque mollis ut dui id dapibus. Aenean eleifend quam libero, at dignissim augue accumsan id. Pellentesque fringilla bibendum lacinia. Ut porttitor metus est, sit amet interdum neque tincidunt et. Maecenas nibh purus, pellentesque ut est et, aliquet convallis eros. Nunc commodo turpis sapien, quis feugiat tortor mollis id.</p>
        </body>
        </html>',
        'content_type_id' => 2
        
      ]);

      LoadContent::create([
        'id' => 3,
        'status' => 1, 
        'template' => '<html>
        <head>
        <title></title>
        </head>
        <body>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean nibh sapien, rutrum in mauris et, laoreet aliquet odio. Quisque id lorem tincidunt, malesuada magna sed, sollicitudin ex. Pellentesque vitae interdum velit. Donec bibendum ipsum neque, at consequat metus dignissim in. Proin vel nisi dui. Mauris sed augue nec erat feugiat hendrerit in at lacus. Proin vitae ornare metus. Nam rhoncus vehicula mauris, eget viverra lectus sodales ut. Phasellus diam justo, tincidunt eget ullamcorper id, eleifend sit amet quam. Suspendisse id cursus nunc, in luctus nulla. Curabitur mollis interdum risus ut dapibus. Mauris eget metus orci.</p>

        <p>Interdum et malesuada fames ac ante ipsum primis in faucibus. Aenean condimentum pretium ipsum, sed venenatis libero dapibus vitae. In hac habitasse platea dictumst. Etiam quis augue commodo, aliquam risus in, placerat augue. Cras suscipit at felis nec tincidunt. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Proin finibus purus quam.</p>

        <p>Vivamus tempor a nisi sit amet vestibulum. Nunc efficitur non tortor et efficitur. Praesent eget pretium metus, faucibus gravida lorem. Ut varius, urna aliquet auctor fringilla, erat ipsum auctor tellus, eget ultrices est ligula non nisi. Cras id volutpat leo. Fusce condimentum, velit quis bibendum auctor, lectus nibh dapibus arcu, eu varius dui odio suscipit ante. Vestibulum porta enim eu interdum iaculis. Integer id vestibulum turpis, ac lobortis purus. Sed lacinia vehicula leo, ac ullamcorper dolor porttitor ut. Pellentesque mollis ut dui id dapibus. Aenean eleifend quam libero, at dignissim augue accumsan id. Pellentesque fringilla bibendum lacinia. Ut porttitor metus est, sit amet interdum neque tincidunt et. Maecenas nibh purus, pellentesque ut est et, aliquet convallis eros. Nunc commodo turpis sapien, quis feugiat tortor mollis id.</p>
        </body>
        </html>',
        'content_type_id' => 3
        
      ]);

      LoadContent::create([
        'id' => 4,
        'status' => 1, 
        'template' => '<html>
        <head>
        <title></title>
        </head>
        <body>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean nibh sapien, rutrum in mauris et, laoreet aliquet odio. Quisque id lorem tincidunt, malesuada magna sed, sollicitudin ex. Pellentesque vitae interdum velit. Donec bibendum ipsum neque, at consequat metus dignissim in. Proin vel nisi dui. Mauris sed augue nec erat feugiat hendrerit in at lacus. Proin vitae ornare metus. Nam rhoncus vehicula mauris, eget viverra lectus sodales ut. Phasellus diam justo, tincidunt eget ullamcorper id, eleifend sit amet quam. Suspendisse id cursus nunc, in luctus nulla. Curabitur mollis interdum risus ut dapibus. Mauris eget metus orci.</p>

        <p>Interdum et malesuada fames ac ante ipsum primis in faucibus. Aenean condimentum pretium ipsum, sed venenatis libero dapibus vitae. In hac habitasse platea dictumst. Etiam quis augue commodo, aliquam risus in, placerat augue. Cras suscipit at felis nec tincidunt. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Proin finibus purus quam.</p>

        <p>Vivamus tempor a nisi sit amet vestibulum. Nunc efficitur non tortor et efficitur. Praesent eget pretium metus, faucibus gravida lorem. Ut varius, urna aliquet auctor fringilla, erat ipsum auctor tellus, eget ultrices est ligula non nisi. Cras id volutpat leo. Fusce condimentum, velit quis bibendum auctor, lectus nibh dapibus arcu, eu varius dui odio suscipit ante. Vestibulum porta enim eu interdum iaculis. Integer id vestibulum turpis, ac lobortis purus. Sed lacinia vehicula leo, ac ullamcorper dolor porttitor ut. Pellentesque mollis ut dui id dapibus. Aenean eleifend quam libero, at dignissim augue accumsan id. Pellentesque fringilla bibendum lacinia. Ut porttitor metus est, sit amet interdum neque tincidunt et. Maecenas nibh purus, pellentesque ut est et, aliquet convallis eros. Nunc commodo turpis sapien, quis feugiat tortor mollis id.</p>
        </body>
        </html>',
        'content_type_id' => 4
        
      ]);

      LoadContent::create([
        'id' => 5,
        'status' => 1, 
        'template' => '<html>
        <head>
        <title></title>
        </head>
        <body>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean nibh sapien, rutrum in mauris et, laoreet aliquet odio. Quisque id lorem tincidunt, malesuada magna sed, sollicitudin ex. Pellentesque vitae interdum velit. Donec bibendum ipsum neque, at consequat metus dignissim in. Proin vel nisi dui. Mauris sed augue nec erat feugiat hendrerit in at lacus. Proin vitae ornare metus. Nam rhoncus vehicula mauris, eget viverra lectus sodales ut. Phasellus diam justo, tincidunt eget ullamcorper id, eleifend sit amet quam. Suspendisse id cursus nunc, in luctus nulla. Curabitur mollis interdum risus ut dapibus. Mauris eget metus orci.</p>

        <p>Interdum et malesuada fames ac ante ipsum primis in faucibus. Aenean condimentum pretium ipsum, sed venenatis libero dapibus vitae. In hac habitasse platea dictumst. Etiam quis augue commodo, aliquam risus in, placerat augue. Cras suscipit at felis nec tincidunt. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Proin finibus purus quam.</p>

        <p>Vivamus tempor a nisi sit amet vestibulum. Nunc efficitur non tortor et efficitur. Praesent eget pretium metus, faucibus gravida lorem. Ut varius, urna aliquet auctor fringilla, erat ipsum auctor tellus, eget ultrices est ligula non nisi. Cras id volutpat leo. Fusce condimentum, velit quis bibendum auctor, lectus nibh dapibus arcu, eu varius dui odio suscipit ante. Vestibulum porta enim eu interdum iaculis. Integer id vestibulum turpis, ac lobortis purus. Sed lacinia vehicula leo, ac ullamcorper dolor porttitor ut. Pellentesque mollis ut dui id dapibus. Aenean eleifend quam libero, at dignissim augue accumsan id. Pellentesque fringilla bibendum lacinia. Ut porttitor metus est, sit amet interdum neque tincidunt et. Maecenas nibh purus, pellentesque ut est et, aliquet convallis eros. Nunc commodo turpis sapien, quis feugiat tortor mollis id.</p>
        </body>
        </html>',
        'content_type_id' => 5
        
      ]);

    }
  }
