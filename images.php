<!DOCTYPE html>
<html>
  <head>
    <title>squirrels</title>
    <link rel="stylesheet" href="placeSquirrel.css">
    <link rel="stylesheet" href="http://twitter.github.com/bootstrap/assets/css/bootstrap.css">
  </head>
  <body>
    <div class="container"> 
    <div class="row">
      <div class="span12">
        <h1><a href="index.html">place squirrel</a></h1>
        <p>I've chosen a dozen photographs from Flickr that are licensed under the Creative Commons using its search engine. If by chance I've picked one of your images, and you'd prefer that I hadn't, then drop me an email and we'll get it fixed. It's worth noting that I consider this non-commercial use.</p>
        <p>If you use any of them, then you must also provide the correct attribution. Specific images can be requested by including the image's character in your URL,</p>
        <p class="reverse">
         <b>thusly: </b> <span class="example">http://davstott.me.uk/squirrel/f/300/400</span><br>
        </p>
      </div>
    </div>
    <div class="row">
    <?php
      $squirrels = file_get_contents('./squirrels.json');
      $squirrels = json_decode($squirrels, true);
      $n = 1;
      foreach ($squirrels as $i => $squirrel) {
        if (($n % 3) == 0) {
          print('</div><div class="row">');
        } 

        print('<div class="span3">');
        print('<h2>' . $i . '</h2>');
        print('<a href="' . $squirrel['authorUrl'] . '">');
        print('<img alt="' . $squirrel['desc']  . '"  src="' . str_replace('_z.jpg', '_t.jpg', $squirrel['url']) . '"></a><br>');
        print($squirrel['name'] . ' by <a href="' . $squirrel['authorUrl'] . '">' . $squirrel['author'] . '</a><br>');
        //todo: this better and in more detail. 
        print('<a href="' . $squirrel['cc'] . '">Some rights reserved</a>');
        print('</div>');
        $n++;
      }
    ?>
    </div>
    </div> 
  </body>
</html>
