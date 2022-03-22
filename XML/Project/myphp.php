<?php
session_start();
$i=0;
//Create DOMDocument
$xml = new DOMDocument();
// Load XML file
$xml->load("myxml.xml");
$rootTag = $xml->getElementsByTagName('document')->item(0);
$data = $xml->createElement('data');

// Insert:
if (isset($_POST['insert'])) {
    // Set Data into XML file and creating elements:
    $name = $xml->createElement("name", $_POST['name']);
    $email = $xml->createElement("email", $_POST['email']);
    $phone = $xml->createElement("phone", $_POST['phone']);
    $address = $xml->createElement("address", $_POST['address']);
    // Append child elements"name-email-phone-address" to parent element"data":
    $data->appendChild($name);
    $data->appendChild($email);
    $data->appendChild($phone);
    $data->appendChild($address);
    $rootTag->appendChild($data);
    $xml->save("myxml.xml");
}
//Delete by Name:
if (isset($_POST['delete'])) {
    $dataElement =  $xml->getElementsByTagName("data");
    $nameElement = $xml->getElementsByTagName("name")->item(0)->nodeValue;
    $name = isset($_POST['searchName']);
    foreach ($dataElement as $deleElement) {
        if (($nameElement) == $name) {
            $deleElement->parentNode->removeChild($deleElement);
        }
    }
    $xml->save("myxml.xml");
}

//Search by name:
if (isset($_POST['search'])) 
{
    $xml = simplexml_load_file("myxml.xml");
    //Convert XML object into a JSON:-
    $objJsonDocument = json_encode($xml);
    //TO generate an array:-
    $arrOutput = json_decode($objJsonDocument, TRUE);
    foreach ($arrOutput['data'] as $Element) 
    {
        if ($Element['name'] == $_POST['searchName']) 
        {
            echo '<div class="table">';
            echo "<table>";
            echo "<tr>";
            echo "<td>" . $Element['name'] . "</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td>" . $Element['email'] . "</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td>" . $Element['phone'] . "</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td>" . $Element['address'] . "</td>";
            echo "</tr>";
            echo "</table>";
            echo '</div>';
            break;
        }       
    }            
}

if(isset($_POST['next']))
{
    $employees[] = simplexml_load_file('myxml.xml');
    if (isset($_SESSION['id'])) {
        $_SESSION['id'] = $_SESSION['id'] + 1;
        if ($_SESSION['id'] < count($employees[0]->data)) {
            $i = $_SESSION['id'];
        } else {
            $i = count($employees[0]->data)-1;
            $_SESSION['id'] = count($employees[0]->data)-1;
        }
    } else {
        $i++;
        $_SESSION['id'] = $i;
    }
    echo '<div class="search">';
        echo $employees[0]->data[$i]->name."<br>";
        echo $employees[0]->data[$i]->email."<br>";
        echo $employees[0]->data[$i]->phone."<br>";
        echo $employees[0]->data[$i]->address."<br>";
    echo '</div>';   
}

if(isset($_POST['prev']))
{
    $employees[] = simplexml_load_file('myxml.xml');
    if ($_SESSION['id'] <= 0) {
        $i = 0;
        $_SESSION['id'] = $i;
    } else {
        $_SESSION['id'] = $_SESSION['id'] - 1;
        $i = $_SESSION['id'];
    }
    echo '<div class="search">';
        echo $employees[0]->data[$i]->name."<br>";
        echo $employees[0]->data[$i]->email."<br>";
        echo $employees[0]->data[$i]->phone."<br>";
        echo $employees[0]->data[$i]->address."<br>";
    echo '</div>';  
}
        
//Update by Name:
if (isset($_POST['update'])) {
    $xml     = simplexml_load_file("myxml.xml");
    foreach ($xml->data as $Element) {
        if ($Element->name == $_POST['searchName']) {
            $Element->name = $_POST['name'];
            $Element->email = $_POST['email'];
            $Element->phone = $_POST['phone'];
            $Element->address = $_POST['address'];
            break;
        }
    }
    $xml->saveXml("myxml.xml");
}
?>
<html>

<head>
    <title>XML Project</title>
    <style>
        body {
            margin: 0;
            width: 100vw;
            height: 100vh;
            background: #ecf0f3;
            display: flex;
            align-items: center;
            text-align: center;
            justify-content: center;
            place-items: center;
            overflow: hidden;
            font-family: 'Times New Roman', Times, serif;
        }

        .container {
            position: relative;
            width: 350px;
            height: 600px;
            border-radius: 20px;
            padding: 40px;
            box-sizing: border-box;
            background: #ecf0f3;
            box-shadow: 14px 14px 20px #cbced1, -14px -14px 20px white;
        }

        input[type=text] {
            display: block;
            width: 100%;
            padding: 0;
            border: none;
            outline: none;
            box-sizing: border-box;
        }

        input[type=text]::placeholder {
            color: gray;
        }

        input[type=text] {
            background: #ecf0f3;
            padding: 10px;
            padding-left: 20px;
            height: 50px;
            font-size: 14px;
            border-radius: 50px;
            box-shadow: inset 6px 6px 6px #cbced1, inset -6px -6px 6px white;
        }

        input[type=submit] {
            background-color: darkgrey;
            width: 80px;
            padding: 10px;
            font-size: 14px;
            border-radius: 50px;
            height: 50px;
            border-width: 0px;
            margin: 3px;
        }

        .table {
            position: absolute;
            left: 1000px;
            background-color: darkgrey;
            padding: 10px;
            font-size: 14px;
            height: 200px;
            width: 300px;
            border-width: 0px;
            box-shadow: inset 6px 6px 6px #cbced1, inset -6px -6px 6px white;
        }
        .search {
            position: absolute;
            left: 1000px;
            background-color: darkgrey;
            padding: 10px;
            font-size: 17px;
            height: 200px;
            width: 300px;
            border-width: 0px;
            box-shadow: inset 6px 6px 6px #cbced1, inset -6px -6px 6px white;
            text-align: left;
        }
    </style>
</head>

<body>
    <div class="container">
        <form method="post">
            <label for="name">Name:</label><br>
            <input type="text" id="name" name="name"><br>

            <label for="email">Email:</label><br>
            <input type="text" id="email" name="email"><br>

            <label for="phone">Phone:</label><br>
            <input type="text" id="phone" name="phone"><br>

            <label for="address">Address:</label><br>
            <input type="text" id="address" name="address"><br>
            <!-- Buttons -->
            <input type="submit" name="prev" value="Previous">
            <input type="submit" name="insert" value="Insert">
            <input type="submit" name="next" value="Next"><br> 
            <input type="text" id="searchName" name="searchName" placeholder="Search/Update/Delete by Name"><br>
            <input type="submit" name="search" value="Search">
            <input type="submit" name="update" value="Update">
            <input type="submit" name="delete" value="Delete">
        </form>
    </div>
</body>

</html>