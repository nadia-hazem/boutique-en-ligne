<?php require_once 'inc/php/callToClasses.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <!-- favicon -->
    <link rel="shortcut icon" type="image/png" href="/boutique-en-ligne/inc/img/icons/favicon.png" />
    <!-- CSS -->
    <link rel="stylesheet" href="inc/css/style.css">
    <!-- jQuery 3.6.4 -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <!-- Lightbox2 2.11.3 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">
    <!-- Fontawesome kit -->
    <script src="https://kit.fontawesome.com/a05ac89949.js" crossorigin="anonymous"></script>
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <!-- JS -->
    <script src="inc/js/scrollToTop.js"></script>
    <script src="inc/js/stickToTop.js"></script>
    <script src="inc/js/search.js"></script>
</head>

<body>
    <?php include 'inc/header.php'; ?>

    <!--Section: Contact v.2-->
    <main class="container mb-4">

        <!--Section heading-->
        <h1 class="h1-responsive sm-fs-2">Contact us</h1>
        <h1 class="h1-responsive bis sm-fs-1">Contact us</h1>
        <!--Section description-->
        <p class="text-center w-responsive mx-auto mb-5">Do you have any questions? Please do not hesitate to contact us directly. Our team will come back to you within
            a matter of hours to help you.</p>

        <div class="row">

            <!-- form -->
            <div class="col">
                <div class="card">
                    <div class="card-header bg-dark text-white"><i class="fa fa-envelope"></i> Email us.
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Enter name" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email" required>
                                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                            </div>
                            <div class="form-group">
                                <label for="message">Message</label>
                                <textarea class="form-control" id="message" rows="6" required></textarea>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-dark my-5">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Adress -->
            <div class="col-12 col-sm-4">
                <div class="card bg-light mb-3">

                    <div class="card-header bg-dark text-white text-uppercase"><i class="fa fa-home"></i> Address</div>
                    <div class="card-body text-center">
                        <i class="fas fa-map-marker-alt fa-2x"></i>
                        <p>8 bd des Champs Pagnes</p>
                        <p>13000 Mars</p>
                        <p>France</p>
                        <i class="fas fa-envelope mt-4 fa-2x"></i>
                        <p>Email : email@example.com</p>
                        <i class="fas fa-phone mt-4 fa-2x"></i>
                        <p>Tel. +33 12 56 11 51 84</p>

                    </div>

                </div> <!-- end cart -->
            </div>
        </div> <!-- end row -->

    </main>

    <?php include 'inc/footer.php'; ?>

    <!-- Bootstrap js -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>