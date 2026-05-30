<?php
include_once __DIR__ . "/api.php";



// Getts the topALbum of paramore
$url = "http://ws.audioscrobbler.com/2.0/?method=artist.gettopalbums&artist=" . urlencode($artist) . "&api_key=$apiKey&format=json&limit=40";


// Gets the data
$response = file_get_contents($url);

// Parses it into json
$data = json_decode($response, true);


// Retrives only necessary info, will be used to display all albulms on allRelease.php
$albums = $data["topalbums"]["album"] ?? [];

$officialAlbum = ["brand new eyes", "Paramore", "After Laughter", "All We Know Is Falling", "This Is Why", "Riot"];

// Will be used to display officialAlbums on album.php and also on tracks.php 
$filteredAlbums = [];

// Filters official albums
foreach ($albums as $album) {
    if (in_array($album["name"], $officialAlbum)) {
        if ($album["name"] === "Riot") {
            $album["name"] = "Riot!";
        }

        // Another API call to get description per official Album
        $urlDesc = "https://ws.audioscrobbler.com/2.0/?method=album.getinfo&api_key=$apiKey&artist=$artist&album=" . urlencode($album["name"]) . "&format=json";
        $responseDesc = file_get_contents($urlDesc);
        $resData = json_decode($responseDesc, true);
        $trackDetails = [];

        // Retrieves the track name and track duration
        if (isset($resData["album"]["tracks"]["track"])) {
            foreach ($resData["album"]["tracks"]["track"] as $track) {
                $trackDetails[] = [
                    "trackName" => $track["name"],
                    "trackDuration" => $track["duration"]
                ];
            }
        }




        // Stores it
        $filteredAlbums[] = [
            "name" => $album["name"],
            "image" => $album["image"][3]["#text"],
            "about" => $resData["album"]["wiki"]["summary"],
            "year" => $resData["album"]["wiki"]["published"],
            "playCount" => $resData["album"]["playcount"],
            "trackDetails" => $trackDetails

        ];
    }
}
