<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RetroComp</title>
    <link rel="stylesheet" href="style3.css">

</head>
<body>
<div class="navbar">
    <a href="home.php#Home" class="tablink" onclick="openPage('Home'); return false;" id="defaultOpen">Home</a>
    <a href="home.php#Store" class="tablink" onclick="openPage('Store'); return false;">Store</a>
    <a href="home.php#Contact" class="tablink" onclick="openPage('Contact'); return false;">Contact</a>
    <a href="home.php#About" class="tablink" onclick="openPage('About'); return false;">About</a>
</div>


    <div class="content">
        <div id="Home" class="tabcontent">
        <h1>
    Welcome to 
    <span style="color: #ff0000; letter-spacing: -0.3em;">R</span>
    <span style="color: #ff8000; letter-spacing: -0.3em;">e</span>
    <span style="color: #ffff00; letter-spacing: -0.3em;">t</span>
    <span style="color: #00ff00; letter-spacing: -0.3em;">r</span>
    <span style="color: #0000ff; letter-spacing: -0.3em;">o</span>
    <span style="color: #4b0082; letter-spacing: -0.3em;">C</span>
    <span style="color: #9400d3; letter-spacing: -0.3em;">o</span>
    <span style="color: #ff0000; letter-spacing: -0.3em;">m</span>
    <span style="color: #ff8000; letter-spacing: -0.3em;">p</span>
    .
</h1>
<!-- Welkom text met RetroComp in verschillende kleuren per letter met -0.3em letter spacing -->



            <p>Discover stuff your grandpa might have used.</p>
            <h2>Featured Products of today:</h2>
            <!-- Featured products init database -->
            <div class="product-grid">
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "root";
                $dbname = "film_database";

                $conn = new mysqli($servername, $username, $password, $dbname);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                    # error as database niet wil werken
                }

                $sql = "SELECT id, afbeelding_url, titel, prijs FROM films WHERE id BETWEEN 1 AND 3"; # Selecteer de eerste 3 devices
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo '<div class="product-box">';
                        echo '<a href="detail.php?id=' . $row["id"] . '">';
                        echo '<img src="' . $row["afbeelding_url"] . '" alt="' . $row["titel"] . '">';
                        echo '<h4>' . $row["titel"] . '</h4>';
                        echo '<p>' . "$". $row["prijs"] . '</p>';
                        echo '</a>';
                        echo '</div>';
                        # init devices met afbeelding, titel en prijs
                    };
                } else {
                    echo "No featured products available.";
                    # error als er geen featured products zijn
                }



                $conn->close();
                ?>
            </div>
        </div>
                <!-- store tab tab met featured products -->
        <div id="Store" class="tabcontent">
            <h2>Retro Store</h2>
            <div class="product-grid">
                <?php
                                    # init database met alle devices

                $conn = new mysqli($servername, $username, $password, $dbname);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT id, afbeelding_url, titel, prijs FROM films";
                $result = $conn->query($sql);
                

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo '<div class="product-box">';
                        echo '<a href="detail.php?id=' . $row["id"] . '">';
                        echo '<img src="' . $row["afbeelding_url"] . '" alt="' . $row["titel"] . '">';
                        echo '<h4>' . $row["titel"] . '</h4>';
                        echo '<p>' . "$". $row["prijs"] . '</p>';
                        echo '</a>';
                        echo '</div>';
                        # init met afbeelding, titel, prijs en link naar detail.php voor specifiek product.
                    }
                } else {
                    echo "No products available.";
                    # error handeling
                }

                $conn->close();
                ?>
            </div>
        </div>
<!-- contact tab met contact informatie -->
        <div id="Contact" class="tabcontent">
            <h2>Contact</h2>
            <p>+31 6 1234567890 <br>
                1234 AB, Amsterdam
            </p>
        </div>

<!-- about tab met informatie over RetroComp -->
        <div id="About" class="tabcontent">
            <h2>About 
            <span style="color: #ff0000; letter-spacing: -0.3em;">R</span>
    <span style="color: #ff8000; letter-spacing: -0.3em;">e</span>
    <span style="color: #ffff00; letter-spacing: -0.3em;">t</span>
    <span style="color: #00ff00; letter-spacing: -0.3em;">r</span>
    <span style="color: #0000ff; letter-spacing: -0.3em;">o</span>
    <span style="color: #4b0082; letter-spacing: -0.3em;">C</span>
    <span style="color: #9400d3; letter-spacing: -0.3em;">o</span>
    <span style="color: #ff0000; letter-spacing: -0.3em;">m</span>
    <span style="color: #ff8000; letter-spacing: -0.3em;">p</span>
    .
            </h2>
            <p>Welcome to RetroTech, your one-stop shop for all things vintage tech! Founded in February 2025, we specialize in bringing the best of retro devices back to life, with a strong focus on iconic Apple products like the Macintosh Classic and iMac G3. Whether you're a collector, enthusiast, or someone nostalgic for the good old days of computing, we have something for you. In addition to our wide range of Apple devices, our collection also features a variety of other retro gems, from classic Amiga machines to rare finds in the world of tech history. Each device is carefully curated, restored, and priced fairly to ensure you can enjoy the magic of the past, today. Our mission is to make retro computing accessible and fun, while preserving the charm of these technological milestones. Thank you for visiting RetroTech — where nostalgia meets innovation.</p>
        </div>
    </div>


    <!-- script voor tab navigatie -->
    <script>
    function openPageFromHash() {
        var hash = window.location.hash.substring(1); // hash pullen zonder #
        if (!hash) hash = "Home"; // Default naar Home tab

        var tabcontent = document.getElementsByClassName("tabcontent");
        for (var i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }

        var activeTab = document.getElementById(hash);
        if (activeTab) {
            activeTab.style.display = "block";
        }
    }
    window.onload = openPageFromHash;
    window.onhashchange = openPageFromHash;
</script>
</body>
</html>
