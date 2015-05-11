<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="api">
    <title>Lastest tweets about MICA ( ；´Д｀)</title>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/main.css">
    <link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700|PT+Sans+Caption:400,700' rel='stylesheet' type='text/css'>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  </head>  
  <body>    
    <?php
      date_default_timezone_set('UTC');

      require_once('TwitterAPIExchange.php');
      $settings = array(
        'oauth_access_token' => "240600657-ZFuByrEgOk2BVmLoOVWTtUK32yJvoGm6hQ4SS9et",
        'oauth_access_token_secret' => "cYNKKI70jnGFp1BSFY83qvcO40mtOqMHsBp3H1pLM81o6",
        'consumer_key' => "HiVPn9IsNUrGDcBSfNjbnF6Ky",
        'consumer_secret' => "UNWyjcpSiSdrwrmMK94qhoTJWy07Wme6kck0E3B3OfvnywgbZq"
      );

      $url = "https://api.twitter.com/1.1/search/tweets.json";

      $requestMethod = "GET";
      $getfield = "?q=MICA+OR+%23MICA+OR+%23MICAgradshow+OR+%23MICAGD+OR+%23micagrad+OR+@mica+OR+@mica_gd+OR+@mica_alumni+OR+@mica_news&count=100&lang=en&geocode=39.307646,-76.621553,500km&result_type=recent";

      $twitter = new TwitterAPIExchange($settings);
      $string = json_decode($twitter->setGetfield($getfield)
      ->buildOauth($url, $requestMethod)
      ->performRequest(),$assoc = TRUE);

      if($string["errors"][0]["message"] != "") {
        echo "<h3>Sorry, there was a problem.</h3><p>Twitter returned the following error message:</p><p><em>".$string[errors][0]["message"]."</em></p>";exit();
      }

//      echo "<pre>";
//      print_r($string);
//      echo "</pre><br />";
    ?>
    <div class="bodyContainer">
      <div class="mediaCon">
        <div class="maxWrapper">
          <h1 class="headline">Lastest tweets<br>about MICA<br>( ；´Д｀)</h1>
          <ul class="mediaList">
            <?php
              if (isset($item['user']['screen_name'])) {
                $screen_name = $item['user']['screen_name'];
              }
              foreach($string as $items) {
                foreach($items as $item) {
                  //echo '<code>'.count($items).'</code>';
                  
                  if (isset($item['user']['profile_image_url'])) {
                    $profile_image_url = $item['user']['profile_image_url'];
                  }                  
                  if (isset($item['entities']['urls']['0']['expanded_url'])) {
                    $expanded_url = $item['entities']['urls']['0']['expanded_url'];
                  }
                  if (isset($item['user']['screen_name'])) {
                    $screen_name = $item['user']['screen_name'];
                    $profile_url = 'https://twitter.com/' . $item['user']['screen_name'];
                  }
                  if (isset($item['id'])) {
                    $id = $item['id'];
                    $post_url = 'https://twitter.com/' . $item['user']['screen_name'] . '/status/' . $id;
                  }
                  if (isset($item['source'])) {
                    if ($item['source'] === '<a href="http://instagram.com" rel="nofollow">Instagram</a>') {
                      $url_icon = '<i class="fa fa-instagram"></i>';
                    } else if ($item['source'] === '<a href="http://twitter.com" rel="nofollow">Twitter Web Client</a>') {
                      $url_icon = '<i class="fa fa-twitter"></i>';
                    } else if ($item['source'] === '<a href="http://twitter.com/download/iphone" rel="nofollow">Twitter for iPhone</a>') {
                      $url_icon = '<i class="fa fa-twitter"></i>';
                    } else if ($item['source'] === '<a href="http://foursquare.com" rel="nofollow">Foursquare</a>') {
                      $url_icon = '<i class="fa fa-foursquare"></i>';
                    } else {
                      $url_icon = '<i class="fa fa-link"></i>';
                    }
                  }
                  if (isset($item['text'])) {
                    $text = $item['text'];
                    $patterns = '/\b(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?/';
                    $replacements = '';
                    $newphrase = preg_replace($patterns, $replacements, $text);
                    $patterns = ' (Maryland Institute College of Art)';
                    $text = str_replace(" (Maryland Institute College of Art)", "", $newphrase);
                  }
                  if (isset($item['created_at'])) {
                    $created_at = date("D d M Y h:ia", strtotime($item['created_at']));
                  }

                  $html = '<li class="media">';
                  $html .= '<h1>' . $text . '<a href="'. $expanded_url .'">' . $url_icon . '</a>' . '</h1>';
                  $html .= '<div class="mediaWrap">';
                  $html .= '<div class="imgBox">';
                  $html .= '<a href="'.$profile_url.'">';
                  $html .= '<img src="'. $profile_image_url .'" />';
                  $html .= '</a>';
                  $html .= '</div>';
                  $html .= '<div class="textBox">';
                  $html .= '<a href="'. $profile_url .'"><h3>'. $screen_name .'</h3></a>';
                  $html .= '<h5 class="caption"><a href="' . $post_url . '"><i class="fa fa-clock-o"></i>' . $created_at . '</a></h5>';
                  $html .= '</div>';
                  $html .= '</div>';
                  $html .= '</li>';
                  
                  if (isset($item['text'])) {
                    echo $html;    
                  }
                }
              }
            ?>
          </ul>
        </div>
      </div>
      <footer class="mainFooter">
        <p><i class="fa fa-twitter"></i>MICA</p>
      </footer>
    </div>
  </body>
</html>