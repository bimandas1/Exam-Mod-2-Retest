<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> Home </title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <!-- CSS -->
  <link rel="stylesheet" href="css/home_style.css">
  <!-- jQuerry CDN -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
  <?php require_once __DIR__ . '/navbar_view.php' ?>
  <!-- Category -->
  <div class="category">
    <div class="left">
      <button class="btn btn-outline-primary" type="submit" id="healthy-btn">Healthy Snacks</button>
    </div>
    <div class="right">
      <button class="btn btn-outline-primary" type="submit" id="unhealthy-btn">Unhealthy Snacks</button>
    </div>
  </div>

  <h1>Healthy Snacks</h1>

  <div class="products">
    <!-- Healthy products -->
    <table class="table" id="healthy-table">
      <tbody id="product-table">
        <thead>
          <tr>
            <th scope="col">Name</th>
            <th scope="col">Price</th>
            <th scope="col">Quantity</th>
            <th scope="col">Check</th>
          </tr>
        </thead>

        <?php foreach ($products as $product) : ?>
          <?php if ($product['category'] == 'healthy') : ?>
            <tr class="item" data-id="<?= $product['id'] ?>">
              <td class="name" data-id="<?= $product['id'] ?>"> <?= $product['name'] ?> </td>
              <td class="price" data-id="<?= $product['id'] ?>"><?= $product['price'] ?></td>
              <th class="quantity" scope="col"><input type="number" class="form-control quantity-input" data-id="<?= $product['id'] ?>"></th>
              <th class="check" scope="col"><input type="checkbox" class="form-check-input" data-id="<?= $product['id'] ?>"></th>
            </tr>
          <?php endif; ?>
        <?php endforeach; ?>
      </tbody>
    </table>

    <!-- Unhealthy products -->
    <table class="table" id="unhealthy-table">
      <tbody id="product-table">
        <thead>
          <tr>
            <th scope="col">Name</th>
            <th scope="col">Price</th>
            <th scope="col">Quantity</th>
            <th scope="col">Check</th>
          </tr>
        </thead>

        <?php foreach ($products as $product) : ?>
          <?php if ($product['category'] == 'xxxxxxxxxxxxxxxxxxxxxxxxxxunhealthy') : ?>
            <tr>
              <td> <?= $product['name'] ?> </td>
              <td> <?= $product['price'] ?> </td>
              <th scope="col"><input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"></th>
              <th scope="col"><input type="checkbox" class="form-check-input" id="exampleCheck1"></th>
            </tr>
          <?php endif; ?>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <div class="add-to-cart-box">
    <button type="button" class="btn btn-primary mt-3" id="add-to-cart-btn">Add to Cart</button>
  </div>

  <div class="customer">
    <form id="cart-data">
      <div class="mb-3">
        <label class="form-label">Name</label>
        <input type="text" class="form-control" name="name" required>
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email address</label>
        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Phone Number</label>
        <input type="text" class="form-control" name="phone" required>
      </div>

      <fieldset disabled>
        <div class="mb-3">
          <label for="disabledTextInput" class="form-label">Total amount</label>
          <input id="total-amount" type="number" id="disabledTextInput" class="form-control" placeholder="" name="amount">
        </div>
      </fieldset>

      <button type="submit" class="btn btn-primary" id="conform-buy">Submit</button>

    </form>
  </div>

</body>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<!-- Script -->
<script src="script/home_script.js"></script>

</html>
