<?php


function fetch_new_stories($opts){
  global $api_instance;

  $fetched_stories = [];
  $stories = NULL;

  while (is_null($stories) || count($stories) > 0) {
    try {
      $result = $api_instance->listStories($opts);
    } catch (Exception $e) {
      $code = $e->getResponseObject()->getErrors()[0]->getStatus();

      if ($code == '429'){
        print_r("Usage limit are exceeded. Wating for 30 seconds...\n");
        sleep(30);
        continue;
      }
    }

    $stories = $result->getStories();
    $fetched_stories = array_merge($fetched_stories, $stories);
    $opts['cursor'] = $result->getNextPageCursor();

    print_r("Fetched " . count($stories) .
      " stories. Total story count so far: " . count($fetched_stories) . "\n");
  }

  return $fetched_stories;
}


// Configure API key authorization: app_id
Aylien\NewsApi\Configuration::getDefaultConfiguration()->setApiKey('X-AYLIEN-NewsAPI-Application-ID', '0a762ce9');

// Configure API key authorization: app_key
Aylien\NewsApi\Configuration::getDefaultConfiguration()->setApiKey('X-AYLIEN-NewsAPI-Application-Key', 'aa119038ef52eef4cbdff96ef724dc6f');

$api_instance = new Aylien\NewsApi\Api\DefaultApi();

$params = array(
  'published_at_start' => 'NOW-1HOUR',
  'published_at_end' => 'NOW',
  'language' => ['en'],
  'categories_taxonomy' => 'iab-qag',
  'categories_id' => ['IAB17'],
  'per_page' => 16
);

$stories = fetch_new_stories($params);

print_r("************\n");
print('Fetched ' . count($stories) .
  " stories which are in English, are about Sports and were published between 1 hour ago and now\n");
?>
