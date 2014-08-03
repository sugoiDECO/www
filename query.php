<?php
require_once("twitteroauth/twitteroauth.php");
require_once("Cache/Lite.php");

define("CACHE_NAME", "twitter2");
define("SEARCH_KEYWORD", "#すごい災害訓練");
define("IMAGE_ONCE", false);

function getTweets($parameters) {
    $consumerKey = 'pkpMROlW96MPmWk6NjS7byduR';
    $consumerSecret = '62eNJxpyqKTGcrEPeFeOlPK8fKZKW9gfl0XipOat4QcG8Z5l7s';
    $accessToken = '2543200088-adQZeoIwMNdgSHh7sQ8YIN1FnPQWCCTZndQ9F1i';
    $accessTokenSecret = 'KEBoCLbEiBaGACcQhQ4boVMQzgavNRvMdIuOKtQFbcDWv';
    $twObj = new TwitterOAuth($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);
    return $twObj->OAuthRequest('https://api.twitter.com/1.1/search/tweets.json', 'GET', $parameters);
}

function cache_test($parameters) {
    $option = array(
        "cacheDir" => "/tmp/",
        "lifeTime" => 60    // キャッシュの期限1分
    );
    $cache = new Cache_Lite($option);
    $cache_id = CACHE_NAME;

    if ($json = $cache->get($cache_id)) {
        return $json;
    } else {
        $json = getTweets($parameters);
        $cache->save($json, $cache_id);
        return $json;
    }
}

function convertTweets($data) {
    $tweets = array();
    if (isset($data) && empty($data->errors)) {
        foreach ($data->statuses as $status) {
            $images = array();
            // twitter
            if (!empty($status->entities->media)) {
                foreach ($status->entities->media as $media) {
                    $image = array();
                    $image['url'] = $media->url;
                    $image['image_url'] = $media->media_url;

                    if (!empty($image)) {
                        $images[] = (object)$image;
                    }
                }
            }
            // external
            if (!empty($status->entities->urls)) {
                foreach ($status->entities->urls as $url) {
                    $image = array();
                    // twitpic
                    if (strpos($url->expanded_url, 'twitpic') != 0) {
                        $image['url'] = $url->url;
                        $image['image_url'] = str_replace('twitpic.com/', 'twitpic.com/show/full/', $url->expanded_url);
                    }
                    // twipple
                    else if (strpos($url->expanded_url, 'twipple') != 0) {
                        $image['url'] = $url->url;
                        $image['image_url'] = str_replace('twipple.jp/', 'twipple.jp/show/large/', $url->expanded_url);
                    }
                    // photozou
                    else if (strpos($url->expanded_url, 'photozou') != 0) {
                        $image['url'] = $url->url;
                        $image['image_url'] = preg_replace('/photozou.jp\/photo\/show\/[0-9]*\//', 'photozou.jp/p/img/', $url->expanded_url);
                    }
                    // instagram
                    else if (strpos($url->expanded_url, 'instagram.com/p/') != 0) {
                        $instaurl = 'http://api.instagram.com/oembed?url='.$url->expanded_url;
                        $instajson = file_get_contents($instaurl);
                        $json = json_decode($instajson);
                        $image['url'] = $url->url;
                        $image['image_url'] = $json->url;
                    }
                    // other
                    else {
                    }

                    if (!empty($image)) {
                        $images[] = (object)$image;
                    }
                }
            }

            if (!empty($images)) {
                $tweets[] = (object)array(
                    'text' => $status->text,
                    'user' => $status->user,
                    'images' => $images,
                    'created_at' => $status->created_at
                );
            }
        }
    }
    return $tweets;
}

$parameters = array(
                "q" => rawurlencode(SEARCH_KEYWORD),
                "result_type" => "recent",
                "count" => 100,
                "include_entities" => true
            );

$json = cache_test($parameters);
$data = json_decode($json);
$tweets = convertTweets($data);

$resultImages = array();
if (!empty($tweets)) {
    foreach ($tweets as $tweet) {
        foreach ($tweet->images as $image) {
            $user = (object)array(
                'username' => $tweet->user->name,
                'avatar_url' => $tweet->user->profile_image_url,
            );
            $resultImages[] = (object)array(
                'user' => $user,
                'message' => $tweet->text,
                'url' => $image->url,
                'imgurl' => $image->image_url
            );
            if (IMAGE_ONCE) {
                break;
            }
        }
    }
}

$output = array('images' => $resultImages);

header('Content-Type: application/json; charset=utf-8');
echo json_encode($output);
die;
