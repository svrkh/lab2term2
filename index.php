
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MongoDB</title>
    <script src="localstorage.js">  
    </script>
</head>
<body>
<?php include "conn.php"?>
<p>Вариант 0. КИУКИ-19-4, Смирнов Владислав</p>
<form action="" method="get">
    <p><strong> Информация о книгах издательства: </strong>
            <select name="publisher" id="publisher" onchange="_1()">
                <?php
                    $publisher = $collection->distinct("publisher");
                    foreach ($publisher as $document) {
                        echo "<option>$document</option>";
                    }
                ?>
            </select>
        <button>ОК</button>
    </p>
</form>
<form action="" method="get">
<p><strong>Информация о книгах, журналах, газетах, опубликованных за указанный период:</strong>
        <select name="year_min" id="year_min"onchange="_2()">
            <?php
            $year_min = $collection->distinct("year");
            foreach ($year_min as $document) {
                echo "<option>$document</option>";
            }
            ?>
        </select>
        <select name="year_max" id="year_max" onchange="_2()">
            <?php
                $year_max = $collection->distinct("year");
                foreach ($year_max as $document) {
                    echo "<option>$document</option>";
                }
            ?>
        </select>
    <button>ОК</button>
</p>
</form>
<form action="" method="get">
<p><strong> Вывести информацию о книгах автора: </strong>
        <select name="author" id="author" onchange="_3()">
            <?php
                $author = $collection->distinct("author");
                foreach ($author as $document) {
                    echo "<option>$document</option>";
                }
            ?>
        </select>
    <button>ОК</button>
</p>
</form>

<?php
    if(isset($_GET['publisher'])){
    $publisher = $_GET['publisher'];
    $literate = "Book";
    $cursor = $collection->find( 
        [
            'publisher' => $publisher,
            'literate' => $literate
        ]
    );
    $result = "Таблица первого запроса: <table border=1> <tr><th>Вид и название</th><th>Автор</th><th>Издательство</th><th>Год выпуска</th></tr>";
    foreach ($cursor as $document) {
     $title = $document['title'];
     $author = $document['author'];
     $publisher = $document['publisher'];
     $year =  $document['year'];
     $result .= "<tr><td> $title</td><td>$author</td><td>$publisher</td><td>$year</td></tr>";
    }
    $result .= "</table>";
    echo $result;
    echo "<script> localStorage.setItem('$publisher', '$result'); </script>";
}
if(isset($_GET['year_min']) && isset($_GET['year_max'])){
 $year_min = $_GET['year_min'];
   $year_max = $_GET['year_max'];

   $cursor = $collection->find(array('year' => array('$gte'=> (int)$year_min, '$lte' => (int)$year_max)));
   $result = "Таблица второго запроса: <table border=1> <tr><th>Вид и название</th><th>Автор</th><th>Издательство</th><th>Год выпуска</th></tr>";
   foreach ($cursor as $document) {
    $title = $document['title'];
    $author = $document['author'];
    $publisher = $document['publisher'];
    $year =  $document['year'];
    $result .= "<tr><td> $title</td><td>$author</td><td>$publisher</td><td>$year</td></tr>";
   }
   $result .= "</table>";
   echo $result;
   echo "<script> localStorage.setItem('$year_min&$year_max', '$result'); </script>";
}
if(isset($_GET['author'])){
    $author = $_GET['author'];
    $literate = "Book";
    $cursor = $collection->find( 
        [
            'author' => $author,
            'literate' => $literate
        ]
    );
    $result = "Таблица третьего запроса: <table border=1> <tr><th>Книга</th><th>Автор</th><th>Издательство</th><th>Год выпуска</th></tr>";
    foreach ($cursor as $document) {
        $title = $document['title'];
    $author = $document['author'];
    $publisher = $document['publisher'];
    $year =  $document['year'];
    $result .= "<tr><td> $title</td><td>$author</td><td>$publisher</td><td>$year</td></tr>";
    }
    $result .= "</table>";
    echo $result;
    echo "<script> localStorage.setItem('$author', '$result'); </script>";
}
?>
<h4>LocalStorage</h4>
<div id="res"></div>
</body>
</html>