<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Styling/profile.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Climate+Crisis&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
    <title>Profile</title>
</head>
<body>
    <header> 
        <nav>
            <ul>
                <li><a href="Home.php">Membership Plans</a></li>
                <li><a href="profile.php" class="active">Profile</a></li>
                <li><a href="Admin.html">Admin</a></li>
                <li class="userpro"><a href="#">Logout</a></li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <div class="userinfo">
            <div class="info-container">
                <p class="info-label">Username:</p>
                <p class="info-value">Nazir</p>
            </div>
            <div class="info-container">
        <p class="info-label">Membership Type:</p>
        <p class="info-value">Silver</p>
    </div>
            <div class="info-container">
                <p class="info-label">Membership Status:</p>
                <p class="info-value">Approved</p>
            </div>
            <div class="info-container">
    <p class="info-label">Coins:</p>
    <p class="info-value coins-value">0</p>
</div>

        </div>
    </div>
  
    <div class="center-top">
        <a href="https://royaleapi.com/league/crl/leaderboard_2023?season=crl_6&year=2023&region=international&round=3" class="leaderboard-btn">Leaderboard</a>
    </div>

    <div class="shop-container">
        <h2>Shop</h2>
        <div class="shop-item">
            <h3>50 Gold</h3>
            <p>$3.99</p>
            <button class="buy-btn" data-amount="50" data-price="3.99">Buy</button>
        </div>
        <div class="shop-item">
            <h3>250 Gold</h3>
            <p>$6.00</p>
            <button class="buy-btn" data-amount="250" data-price="6.00">Buy</button>
        </div>
        <div class="shop-item">
            <h3>500 Gold</h3>
            <p>$10.00</p>
            <button class="buy-btn" data-amount="500" data-price="10.00">Buy</button>
        </div>
    </div>

    <script>
 document.addEventListener('DOMContentLoaded', function() {
  const buyButtons = document.querySelectorAll('.buy-btn');
  const coinsValue = document.querySelector('.coins-value');

  buyButtons.forEach(function(button) {
    button.addEventListener('click', function() {
      const amount = parseInt(this.dataset.amount);
      const currentCoins = parseInt(coinsValue.textContent);
      const newCoins = currentCoins + amount;

      coinsValue.textContent = newCoins;
    });
  });
});




    </script>

</body>
</html>
