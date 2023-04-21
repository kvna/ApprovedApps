<!DOCTYPE html>
<html>
<head>
    <title>Product List</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="container">
    <h1 class="logo">Approved Applications Store</h1>

    <button id="show-popup">Show Popup</button>
	<div class="popup" id="popup-form">
		<h2>Popup Form</h2>
		<form action="#" method="post">
			<label for="name">Name:</label>
			<input type="text" name="name" id="name">

			<label for="email">Email:</label>
			<input type="email" name="email" id="email">

			<label for="message">Message:</label>
			<textarea name="message" id="message" rows="5"></textarea>

			<button type="submit">Send</button>
		</form>
		<button id="hide-popup">Close</button>
	</div>
    

<?php
    // Load the JSON data
    $json = file_get_contents('products.json');
    $products = json_decode($json, true);



    // Define an array to store the grouped data
$groupedData = array();

// Loop through each entry in the data array
foreach ($products as $entry) {
  // Get the license type for the current entry
  $licenseType = $entry['License Type'];
  
  // Check if the license type is already a key in the grouped data array
  if (!array_key_exists($licenseType, $groupedData)) {
    // If not, create a new empty array for this license type
    $groupedData[$licenseType] = array();
  }
  
  // Add the current entry to the array for the appropriate license type
  array_push($groupedData[$licenseType], $entry);
}



// Loop through each license type in the grouped data array
foreach ($groupedData as $licenseType => $entries) {
  // Output a heading for the license type
  echo '<h2>' . $licenseType . '</h2>';
  
  // Loop through each entry in the array for this license type
  foreach ($entries as $entry) {
    // Output the entry details
    echo '<div class="product">';
    echo '<img src="' . $entry['Image'] . '" style="width: 300px;">';
    echo '<h3>' . $entry['Software Name'] . ' - ' . $entry['Version'] . '</h3>';
    echo '<p>' . $entry['License Type'] . '</p>';
    echo '<button>Add to Cart</button>';
    echo '</div>';
  }
}

    // Loop through each product and display it on the page
    foreach ($products as $product) {
        // Get the product details
        $name = $product['Software Name'];
        $version = $product['Version'];
        $license = $product['License Type'];
        $image = $product['Image'];

        // Display the product card
        echo '<div class="product-card">';
        echo '<img src="' . $image . '" style="width: 300px;">';
        echo '<h2>' . $name . '</h2>';
        echo '<p>Version: ' . $version . '</p>';
        echo '<p>License Type: ' . $license . '</p>';
        echo '<button class="form-popup" id="myForm">Request</button>';
        echo '</div>';
    }



echo '<form action="/submit-form.php" method="POST" class="form-container">';
echo '<h2>Add to Cart</h2>';
echo '<label for="name"><b>Name</b></label>';
echo '<input type="text" placeholder="Enter your name" name="name" required>';

echo '<label for="email"><b>Email</b></label>';
echo '<input type="email" placeholder="Enter your email" name="email" required>';

echo '<label for="software"><b>Software</b></label>';
echo '<input type="text" placeholder="Enter software name" name="software" readonly>';

echo '<label for="pcname"><b>PC Name</b></label>';
echo '<input type="text" placeholder="Enter PC name" name="pcname" required>';

echo '<button type="submit" class="btn">Add to Cart</button>';
echo '<button type="button" class="btn cancel" onclick="closeForm()">Cancel</button>';
echo '</form>';
echo '</div>';

?>
</div>

<script>
    // Get all product cards
    var productCards = document.querySelectorAll('.product-card');

    // Check the number of product cards displayed and update the CSS accordingly
    function updateProductCardWidth() {
        var numCards = productCards.length;
        if (numCards <= 3) {
            // Set default width for 3 cards per row
            productCards.forEach(function(card) {
                card.style.width = 'calc(100% / 5 - 20px)';
            });
        } else if (numCards <= 6) {
            // Set width for 2 cards per row
            productCards.forEach(function(card) {
                card.style.width = 'calc(100% / 5 - 20px)';
            });
        } else {
            // Set full width for 1 card per row
            productCards.forEach(function(card) {
                card.style.width = '300px';
            });
        }

        // Get the add to cart button
var addToCartBtn = document.querySelector('.add-to-cart-btn');

// Get the form popup
var formPopup = document.getElementById('myForm');

// Get the software name
var softwareName = addToCartBtn.getAttribute('data-name');

// Open the form popup when the add to cart button is clicked
addToCartBtn.addEventListener('click', function() {
  // Set the software name in the form
  formPopup.querySelector('input[name="software"]').value = softwareName;
  
  // Show the form popup
  formPopup.style.display = 'block';
});

// Close the form popup when the cancel button is clicked
formPopup.querySelector('.cancel').addEventListener('click', function() {
  formPopup.style.display = 'none';
});

// Close the form popup when the user clicks outside of it
window.addEventListener('click', function(event) {
  if (event.target == formPopup) {
    formPopup.style.display = 'none';
  }
});

    }

    // Call the update function on page load and window resize
    window.addEventListener('load', updateProductCardWidth);
    window.addEventListener('resize', updateProductCardWidth);

    var showPopupBtn = document.getElementById('show-popup');
		var hidePopupBtn = document.getElementById('hide-popup');
		var popupForm = document.getElementById('popup-form');

		showPopupBtn.addEventListener('click', function() {
			popupForm.style.display = 'block';
		});

		hidePopupBtn.addEventListener('click', function() {
			popupForm.style.display = 'none';
		});
</script>

</body>
</html>
