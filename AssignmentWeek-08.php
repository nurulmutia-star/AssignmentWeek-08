<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Shopping Cart Test</title>
</head>
<body>

<h1>Items available</h1>

<form action="AssignmentWeek-08.php" method="post">

    <table>
        <tr>
            <th>Item</th>
            <th>Quantity</th>
        </tr>

        <tr>
            <td>Apples</td>
            <td><input type="text" name="apples" size="2"></td>
        </tr>

        <tr>
            <td>Bananas</td>
            <td><input type="text" name="bananas" size="2"></td>
        </tr>
    </table>

    <input type="submit" value="Click to add to cart">

</form>

<br>

<?php

// Add Apples to Cart
if (isset($_POST['apples'])) {

    if (is_numeric($_POST['apples']) && $_POST['apples'] > 0) {

        if (isset($_SESSION['cart']['apples'])) {
            $_SESSION['cart']['apples'] += $_POST['apples'];
        } else {
            $_SESSION['cart']['apples'] = $_POST['apples'];
        }
    }
}

// Add Bananas to Cart
if (isset($_POST['bananas'])) {

    if (is_numeric($_POST['bananas']) && $_POST['bananas'] > 0) {

        if (isset($_SESSION['cart']['bananas'])) {
            $_SESSION['cart']['bananas'] += $_POST['bananas'];
        } else {
            $_SESSION['cart']['bananas'] = $_POST['bananas'];
        }
    }
}

// Remove one quantity from Cart
if (isset($_POST['remove'])) {

    $item = $_POST['remove'];

    if (isset($_SESSION['cart'][$item])) {

        $_SESSION['cart'][$item]--;

        if ($_SESSION['cart'][$item] <= 0) {
            unset($_SESSION['cart'][$item]);
        }
    }
}

?>

<fieldset style="width:300px">

    <legend>Your Shopping Cart</legend>

    <?php

    if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {

        $_SESSION['cart'] = array();

        echo "Your shopping cart is empty";

    } else {

        echo "<form action='AssignmentWeek-08.php' method='post'>";

        echo "<table>";

        echo "<tr>
                <th>Item</th>
                <th>Quantity</th>
                <th></th>
              </tr>";

        foreach ($_SESSION['cart'] as $key => $value) {

            echo "<tr>
                    <td>$key</td>
                    <td>$value</td>
                    <td>
                        <button type='submit' name='remove' value='$key'>
                            Remove
                        </button>
                    </td>
                  </tr>";
        }

        echo "</table>";

        echo "</form>";
    }

    ?>

</fieldset>

</body>
</html>
