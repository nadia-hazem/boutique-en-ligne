<?php require_once 'inc/php/callToClasses.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
    <!-- favicon -->
    <link rel="shortcut icon" type="image/png" href="/boutique-en-ligne/inc/img/icons/favicon.png" />
    <!-- CSS -->
    <link rel="stylesheet" href="inc/css/style.css">
    <!-- Fontawesome kit -->
    <script src="https://kit.fontawesome.com/a05ac89949.js" crossorigin="anonymous"></script>
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <!-- JS -->
    <script src="inc/js/stickToTop.js"></script>
    <script type="text/javascript" src="inc/js/search.js"></script>

</head>

<body>

    <div class="wrapper">

        <?php include 'inc/header.php'; ?>

        <main class="container min-vh-100 justify-content-center align-items-center">
            <section class="row ">

                <div class="col-md-6 m-auto">

                    <table class="table table-hover bg-light">
                        <thead>
                            <tr>
                                <th scope="col text-white">
                                    <h2 class="py-5">Your search</h2>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            // récupérer les résultats de la recherche depuis la méthode searchProducts()
                            $search = $_GET['search'];
                            $results = $product->searchProducts($search);

                            // afficher les résultats dans une liste HTML
                            ?>
                            <tr>
                                <td>
                                    <ul>
                                        <li class="list-unstyled">
                                            <?php foreach ($results as $result) : ?>
                                                <a href="product.php?id=<?= $result['id_product'] ?>"> <?= $result['title'] ?></a>
                                            <?php endforeach; ?>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </section>
        </main>

    </div> <!-- /wrapper -->

    <?php include 'inc/footer.php'; ?>

    <!-- Bootstrap js -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>