<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Signin</title>
    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="css/login.css">


    <?php
    session_start();
    $loginError = '';
    if (!empty($_POST['email']) && !empty($_POST['pwd'])) {
        include 'Classes/Invoice.php';
        $invoice = new Invoice();
        $user = $invoice->loginUsers($_POST['email'], $_POST['pwd']);
        if (!empty($user)) {
            $_SESSION['user'] = $user[0]['first_name'] . "" . $user[0]['last_name'];
            $_SESSION['userid'] = $user[0]['id'];
            $_SESSION['email'] = $user[0]['email'];
            $_SESSION['address'] = $user[0]['address'];
            $_SESSION['mobile'] = $user[0]['mobile'];
            header("Location:index.php");
        } else {
            $loginError = "Invalid email or password!";
        }
    }
    ?>


</head>

<body class="text-center">

    <main class="form-signin">
        <form method="post" action="">
            <h2 class="py-5">INVOICE SYSTEM</h2>

            <div class="form-floating">
                <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com" value="" required>
                <label for="email">Email address</label>
            </div>
            <div class="form-floating">
                <input name="pwd" type="password" class="form-control" id="password" placeholder="Password" required>
                <label for="password">Password</label>
            </div>

            <button class="w-100 btn btn-lg btn-primary" type="submit" name="login">Sign in</button>
            <?php if ($loginError) { ?>
                <div class=" my-2 p-3 alert alert-warning"><?php echo $loginError; ?></div>
            <?php } ?>

            </p>
        </form>
        <p class="mt-5 mb-2 text-muted">
            user: test@test.com <br>
            pass: 12345
                </p>
        <button class="btn btn-outline-success" onclick="loaddata()">Copy</buton>
    </main>



    <script>
        const loaddata = () => {
            document.getElementById('email').value = 'test@test.com';
            document.getElementById('password').value = '12345';
        }
    </script>

</body>

</html>