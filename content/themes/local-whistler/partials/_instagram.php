<?php

  $insta_clientID = "343abbbf57a344188580730806f2652d";
  $insta_count = "&count=6";
  // $insta_username =
  // $insta_userID = "https://api.instagram.com/v1/users/search?q=" . $username . "&client_id=" . $insta_clientID;
  $insta_userID = "527733053";

  function fetchData($url){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 20);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
  }

  $result = fetchData("https://api.instagram.com/v1/users/" .
            $insta_userID . "/media/recent/?client_id=" .
            $insta_clientID .
            $insta_count);

  $result = json_decode($result);

  ?>

  <?php foreach ($result->data as $post): ?>

    <?php $thumb = $post->images->thumbnail ?>

    <?php // print_r( $post ); ?>

    <li class="col-xs-6 col-sm-3 col-md-2 instagram__item">
      <a
        href="<?php echo $post->link; ?>"
        title="<?php echo $post->caption->text; ?>"
        target="_blank">
        <img
          src="<?php echo $thumb->url; ?>"
          alt="<?php echo $post->caption->text; ?>"
          class="thumb">
      </a>
    </li>

  <?php endforeach; ?>
