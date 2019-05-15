<?php
    function outputOrderRow($file, $title, $quantity, $price) {
        echo "<tr>";
        echo "<td><img src='./images/books/tinysquare/".$file."'></td><td class=\"mdl-data-table__cell--non-numeric\">".$title."</td><td>".$quantity."</td><td>$".number_format($price,2)."</td><td>$".number_format($price*$quantity,2,".","")."</td>";
        echo "</tr>";
    }
?>