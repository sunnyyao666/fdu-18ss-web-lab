<?php
try {
    $pdo = new PDO("mysql:host=localhost;dbname=travel", 'root', 'sunny000720');
} catch (PDOException $e) {
    die("Error!:" . $e->getMessage() . "<br/>");
}
$continents = $pdo->query("select * from continents")->fetchAll(PDO::FETCH_ASSOC);
$countries = $pdo->query("select * from countries")->fetchAll(PDO::FETCH_ASSOC);
$images = $pdo->query("select * from imagedetails")->fetchAll(PDO::FETCH_ASSOC);
if (isset($_GET['submit']))
    if (($_GET['country'] <> '0') & ($_GET['continent'] <> "0"))
        $images = $pdo->query("select * from imagedetails where CountryCodeISO='" . $_GET['country'] . "' and ContinentCode='" . $_GET['continent'] . "'")->fetchAll(PDO::FETCH_ASSOC);
    else if (($_GET['country'] == '0') & ($_GET['continent'] <> "0")) $images = $pdo->query("select * from imagedetails where ContinentCode='" . $_GET['continent'] . "'")->fetchAll(PDO::FETCH_ASSOC);
    else if ($_GET['country'] <> '0') $images = $pdo->query("select * from imagedetails where CountryCodeISO='" . $_GET['country'] . "'")->fetchAll(PDO::FETCH_ASSOC);
    else $images = $pdo->query("select * from imagedetails")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Lab11</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="css/bootstrap.min.css"/>


    <link rel="stylesheet" href="css/captions.css"/>
    <link rel="stylesheet" href="css/bootstrap-theme.css"/>

</head>

<body>
<?php include 'header.inc.php'; ?>


<!-- Page Content -->
<main class="container">
    <div class="panel panel-default">
        <div class="panel-heading">Filters</div>
        <div class="panel-body">
            <form action="./Lab11.php" method="get" class="form-horizontal">
                <div class="form-inline">
                    <select name="continent" class="form-control">
                        <option value="0">Select Continent</option>
                        <?php
                        foreach ($continents as $continent) echo '<option value=' . $continent['ContinentCode'] . '>' . $continent['ContinentName'] . '</option>';
                        ?>
                    </select>

                    <select name="country" class="form-control">
                        <option value="0">Select Country</option>
                        <?php
                        foreach ($countries as $country) echo '<option value=' . $country['ISO'] . '>' . $country['CountryName'] . '</option>';
                        ?>
                    </select>
                    <input type="text" placeholder="Search title" class="form-control" name=title>
                    <button type="submit" class="btn btn-primary" name="submit">Filter</button>
                </div>
            </form>

        </div>
    </div>


    <ul class="caption-style-2">
        <?php
        foreach ($images as $image)
            echo <<<EOF
               <li>
                      <a href="detail.php?id={$image['ImageID']}" class="img-responsive">
                      	<img src="images/square-medium/{$image['Path']}" alt="{$image['Title']}">
                      	<div class="caption">
                      		<div class="blur">
                      		</div>
                      		<div class="caption-text">
                      			<h1>{$image['Title']}</h1>
                      		</div>
                      	</div>
                      </a>
         </li>
EOF;
        ?>
    </ul>


</main>

<footer>
    <div class="container-fluid">
        <div class="row final">
            <p>Copyright &copy; 2017 Creative Commons ShareAlike</p>
            <p><a href="#">Home</a> / <a href="#">About</a> / <a href="#">Contact</a> / <a href="#">Browse</a></p>
        </div>
    </div>


</footer>


<script src="https://code.jquery.com/jquery-2.2.4.min.js"
        integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
        integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
        crossorigin="anonymous"></script>
</body>

</html>