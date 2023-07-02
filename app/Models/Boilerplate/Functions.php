<?php

namespace App\Models\Boilerplate;

use Illuminate\Database\Eloquent\Model;
use Exception;

class Functions extends Model
{
    public static function insertOrUpdate(array $rows){
        $table = \DB::getTablePrefix().with(new ChatbotQuestion)->getTable();

        $first = reset($rows);

        $columns = implode( ',',
            array_map( function( $value ) { return "$value"; } , array_keys($first) )
        );

        $values = implode( ',', array_map( function( $row ) {
                return '('.implode( ',',
                    array_map( function( $value ) { return '"'.str_replace('"', '""', $value).'"'; } , $row )
                ).')';
            } , $rows )
        );

        $updates = implode( ',',
            array_map( function( $value ) { return "$value = VALUES($value)"; } , array_keys($first) )
        );

        $sql = "INSERT INTO {$table}({$columns}) VALUES {$values}";
        //dd($sql);
        return \DB::statement( $sql );
    }

    public static function insertOrUpdateDuplicateIgnore(array $rows, $modelName)
    {


        $table = \DB::getTablePrefix() . with($modelName)->getTable();
        $first = reset($rows);
        $columns = implode(
            ',',
            array_map(function ($value) {
                return "$value";
            }, array_keys($first))
        );

        $values = implode(
            ',',
            array_map(function ($row) {
                return '(' . implode(
                    ',',
                    array_map(function ($value) {
                        return '"' . str_replace('"', '""', $value) . '"';
                    }, $row)
                ) . ')';
            }, $rows)
        );

        $updates = implode(
            ',',
            array_map(function ($value) {
                return "$value = VALUES($value)";
            }, array_keys($first))
        );

        $sql = "INSERT INTO {$table}({$columns}) VALUES {$values} ON DUPLICATE KEY UPDATE {$updates}";
        return \DB::statement($sql);
    }

    public static function getSiteUrl(){
        return sprintf(
            "%s://%s%s",
            isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
            $_SERVER['SERVER_NAME'],
            $_SERVER['REQUEST_URI']
        );
    }

    public static function getSiteBaseUrl(){
        return sprintf(
            "%s://%s",
            isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
            $_SERVER['SERVER_NAME']
        );
    }

    public static function getDistance($zip1, $zip2, $unit){
        $response = ['error' => false, 'distance' => '', 'message' => ''];
        try {
            $first_lat = self::getLatlongOfZipCode($zip1);
            if($first_lat && $first_lat['error'] == true){
                $response['error'] = true;
                throw new Exception('Please enter valid zipcode.');
            }else{
                $first_lat = $first_lat['data'];
            }

            //find second zip code
            $next_lat = self::getLatlongOfZipCode($zip2);
            if($next_lat && $next_lat['error'] == true){
                $response['error'] = true;
                throw new Exception('Please enter valid zipcode.');
            }else{
                $next_lat = $next_lat['data'];
            }

            //if lat long empty for both then continue it - do not make error -> true
            if(empty($next_lat) || empty($first_lat)){
                throw new Exception('Data not found.');
            }

            /* $first_lat = ['lat' => '23.0446', 'lng' => '72.6683'];
            $next_lat = ['lat' => '23.0287', 'lng' => '72.6332']; */
            $lat1 = $first_lat['lat'];
            $lon1 = $first_lat['lng'];
            $lat2 = $next_lat['lat'];
            $lon2 = $next_lat['lng'];
            $theta= $lon1-$lon2;
            $dist = sin(deg2rad( (double) $lat1 )) * sin(deg2rad( (double) $lat2)) + cos(deg2rad( (double) $lat1 ))
                    * cos(deg2rad( (double) $lat2)) * cos(deg2rad( (double) $theta ));
            $dist = acos($dist);
            $dist = rad2deg($dist);
            $miles = $dist * 60 * 1.1515;
            $miles = $dist * 60 * 1.1515 * 1.609344;

            //dd($unit, $miles, $miles * 1.609344, $miles * 0.8684);
            if ($unit == "km"){
                $response['distance'] = ($miles * 1.609344);
            }else if ($unit == "miles"){
                $response['distance'] = ($miles * 0.8684);
            }else{
                $response['distance'] = $miles;
            }
        } catch (Exception $e) {
            $response['message'] = $e->getMessage();
        }
        return $response;
    }

    public static function getLatlongOfZipCode($zip){
        $response = ['error' => false, 'data' => ''];

        $url = "https://maps.googleapis.com/maps/api/geocode/json?address=" . urlencode($zip) . "&key=AIzaSyAEx1AuPVHHJVdbV1zND9stPk0a0zAFsKk";
        $result_string = file_get_contents($url);
        $result = json_decode($result_string, true);
        /* echo "<pre>";
        print_r([$url, $result]);
        exit(0); */
        if(isset($result['results'])){
            if(count($result['results']) > 0){
                $result1[]=$result['results'][0];
                $result2[]=$result1[0]['geometry'];
                $result3[]=$result2[0]['location'];
                $response['data'] = $result3[0];
            }else{
                $response['error'] = true;
            }
        }
        return $response;
    }

    public static function containsIllegalChars($testString) {
        static $MsgAry1 = array("@","!","#","$","%", "^", "&", "*", "(", ")","<", "?", "/", "|", "}", "{", "~", ":", "]");
        $foundCount = 0;
        str_ireplace($MsgAry1, '', $testString, $foundCount);
        return $foundCount > 0;
    }
}
