<?php

  // -------------------------------------------------------------------------- //
  // All actions are called at the top.
  // They should be self explanitory and in the order in which the functions
  // appear in the file.
  // --------------------------------------------------------------------------//

  // Add a custom controller
  add_filter('json_api_encode', 'json_api_encode_acf');


  // Add ACF fields to JSON API ---------------------------------------------- //

  function json_api_encode_acf($response)
  {
      if (isset($response['posts'])) {
          foreach ($response['posts'] as $post) {
              json_api_add_acf($post); // Add specs to each post
          }
      }
      else if (isset($response['post'])) {
          json_api_add_acf($response['post']); // Add a specs property
      }

      return $response;
  }

  function json_api_add_acf(&$post)
  {
      $post->acf = get_fields($post->id);
  }

?>
