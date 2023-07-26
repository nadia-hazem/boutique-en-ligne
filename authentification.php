<?php
require_once 'inc/php/callToClasses.php';
if ($user->isLogged()) {
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentification</title>
    <!-- favicon -->
    <link rel="shortcut icon" type="image/png" href="/boutique-en-ligne/inc/img/icons/favicon.png" />
    <!-- CSS -->
    <link rel="stylesheet" href="inc/css/style.css">
    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <!-- Fontawesome kit -->
    <script src="https://kit.fontawesome.com/a05ac89949.js" crossorigin="anonymous"></script>
    <!-- JS -->
    <script src="inc/js/scrollToTop.js"></script>
    <script src="inc/js/stickToTop.js"></script>
    <script src="inc/js/auth.js"></script>
    <script src="inc/js/wishlist.js"></script>
    <script src="inc/js/features.js"></script>
</head>

<body>

    <div class="wrapper">

        <?php include 'inc/header.php'; ?>

        <main class="m-0 love">

            <section class="container-fluid h-auto userAuth m-0">
                <div class="authBox m-0">

                    <section id="inscription" class="col-md-7 col-lg-8 mx-auto">

                        <h4 class="mb-3 text-white">Please register</h4>

                        <div class="d-flex m-2">
                            <p class="text-white">Already a member ? </p> <a id="switchConn" class="switch mx-2"><strong>Go to LogIn</strong></a>
                        </div>

                        <form method="post" class="auth_form text-white">
                            <div class="row g-3">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <label for="login" class="form-label">login</label>
                                    <input type="text" name="login" class="login form-control" placeholder="login" required>
                                    <p></p>
                                </div>
                                <div class="col-sm-6">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password" class="password form-control" placeholder="Password" autocomplete="off" required>
                                    <p></p>
                                </div>
                                <div class="col-sm-6">
                                    <label for="password2" class="form-label">Password confirm</label>
                                    <input type="password" name="password2" id="password2" class="password form-control" placeholder="Confirm" autocomplete="off" required>
                                    <p></p>
                                </div>
                                <hr class="my-4">
                                <div class="col-sm-6">
                                    <label for="firstname" class="form-label">firstname:</label>
                                    <input type="text" name="firstname" id="firstname" class="firstname form-control" placeholder="Firstname" required>
                                    <p></p>
                                </div>
                                <div class="col-sm-6">
                                    <label for="lastname" class="form-label">lastname:</label>
                                    <input type="text" name="lastname" id="lastname" class="lastname form-control" placeholder="Lastname" required>
                                    <p></p>
                                </div>
                                <div class="col-12">
                                    <label for="email">Email:</label>
                                    <input type="email" name="email" id="email" class="email form-control" placeholder="Email" required>
                                    <p></p>
                                </div>
                                <div class="col-12">
                                    <label for="address">Adress:</label>
                                    <input type="text" name="address" id="address" class="address form-control" placeholder="Address" required>
                                    <p></p>
                                </div>
                                <div class="col-md-3">
                                    <label for="zip">Zip:</label>
                                    <input type="text" name="zip" id="zip" class="zip form-control" placeholder="Zip" required>
                                    <p></p>
                                </div>
                                <div class="col-md-4">
                                    <label for="city">City:</label>
                                    <input type="text" name="city" id="city" class="city form-control" placeholder="City" required>
                                    <p></p>
                                </div>
                                <div class="col-md-5">
                                    <label for="country">Country:</label>
                                    <input type="text" name="country" id="country" class="country form-control" placeholder="Country" required>
                                    <p></p>
                                </div>
                                <input type="submit" value="Register" name="send" id="btnInsc" class=" form-control w-100 btn btn-dark btn-lg">
                                <p></p>
                            </div>
                        </form>
                    </section>
                    <!--------------------------------------------------------------------->

                    <section id="connexion" class="col-md-7 col-lg-8 mx-auto text-white">

                        <h4>Please logIn</h4>

                        <div class="d-flex justify-content-center">
                            <p><strong>You don't have an account ? </strong></p>&nbsp; <a id="switchInsc" class="switch mx-2"><strong>Go to Inscription</strong></a>
                        </div>

                        <form method="post" class="auth_form">
                            <div class="row g-3">
                                <div class="col-sm-6 mx-auto my-3">
                                    <label for="login" class="form-label">login</label>
                                    <input type="text" name="login" class="login form-control" placeholder="login" required>
                                    <p></p>
                                    <label for="password">Password</label>
                                    <input type="password" name="password" class="password form-control" placeholder="Password" required>
                                    <p></p>
                                    <input type="submit" value="Connect" id="btnConn" class="form-control w-100 btn btn-dark btn-lg">
                                    <p></p>
                                </div>
                            </div>

                        </form>
                    </section>
                    <!--------------------------------------------------------------------->
                </div>
            </section>

            <section class="bg-grey py-5 m-5">
                <h1>New Collection</h1>
                <h1 class="ter">New Collection</h1>
                <div id="new_collec" class="row my-5 gx-4">
                </div>
            </section>

        </main>

        <div class="push"></div>

    </div> <!-- wrapper -->

    <?php include 'inc/footer.php'; ?>

    <!-- Bootstrap js -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>