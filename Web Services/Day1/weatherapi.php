<html>
<div>
    <?php
    ini_set('memory_limit', '-1');
    $string = file_get_contents("city.list.json");
    $json_cities = json_decode($string, true);
    if (isset($_POST['submit'])) {
        $apikey = "fb6a7bbcf44decaa6cc65c540f36b923";
        $cityid = $_POST['city'];
        $apiUrl = "https://api.openweathermap.org/data/2.5/weather?id=".$cityid."&APPID=".$apikey;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        $response = curl_exec($ch);
        curl_close($ch);
        $data = json_decode($response,true);
        $currentTime = time();
        var_dump($data);
    }
    
    ?>
</div>
<h2>Weather Forecast</h2>
<form method="post">
    <select name="city" id="city">
        <option value="360542">EG>>Al Qurayn</option>
        <option value="361495">EG>>Al Ayyat</option>
        <option value="362882">EG>>Abu al Matamir</option>
    </select>
    <input type="submit" name="submit" value="Get Weather">
</form>

</html>