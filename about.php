<?php require_once 'inc/php/callToClasses.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <!-- favicon -->
    <link rel="shortcut icon" type="image/png" href="/boutique-en-ligne/inc/img/icons/favicon.png" />
    <!-- CSS -->
    <link rel="stylesheet" href="inc/css/style.css">
    <!-- JQuery 3.6.4 -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <!-- Fontawesome kit -->
    <script src="https://kit.fontawesome.com/a05ac89949.js" crossorigin="anonymous"></script>
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <!-- JS -->
    <script src="inc/js/scrollToTop.js"></script>
    <script src="inc/js/stickToTop.js"></script>
    <script src="inc/js/search.js"></script>
    <script src="inc/js/comment.js"></script>


</head>

<body>

    <?php include 'inc/header.php'; ?>

    <main class="container my-5">
        <h1>About Us</h1>
        <h1 class="bis">About Us</h1>
        <section class="gy-5">
            <div class="row my-5">
                <p class="lead text-end fs-2 mb-0">We are web developers in training for an RNCP 5 title.</p>
                <p class="lead text-end fs-4 mt-0 mb-5">This project is carried out in collaboration by:</p>
            </div>
            <div class="d-flex my-5 text-end justify-content-end sm-justify-content-center">
                <div class="col-lg-2 col-sm-4">
                    <img src="inc/img/icons/thomas.png" width="150" alt="Photo de profil" class="img-fluid rounded-circle mb-3">
                    <h5 class="text-end">Thomas Spinec</h5>
                    <p class="text-muted">Développeur web</p>
                </div>
                <div class="col-lg-2 col-sm-4">
                    <img src="inc/img/icons/nadia.png" width="150" alt="Photo de profil" class="img-fluid rounded-circle mb-3">
                    <h5 class="text-end">Nadia Hazem</h5>
                    <p class="text-muted">Développeuse web</p>
                </div>
                <div class="col-lg-2 col-sm-4">
                    <img src="inc/img/icons/jeremy.png" width="150" alt="Photo de profil" class="img-fluid rounded-circle mb-3">
                    <h5 class="text-end">Jeremy Nowak</h5>
                    <p class="text-muted">Développeur web</p>
                </div>
            </div>
        </section>

        <section class="row gy-5">
            <h2 class="text-start mt-5">Our mission</h2>
            <hr>
            <p class="lead text-start mt-5">The purpose of this project is to validate REAC Competencies.</p>

            <div class="col-lg-6 col-sm-12">
                <h3 class="text-start lead">Targeted skills</h3>
                <ul>
                    <li>Project / application modeling</li>
                    <li>MCD/MLD database design</li>
                    <li>Object Oriented Programming: Using Classes</li>
                    <li>Detail a user journey on a “business” functionality of your site (purchase action, etc.)</li>
                    <li>Structuring a project and thinking about its architecture</li>
                    <li>Go asynchronous with JS</li>
                    <li>Pitching a project: oral expression / creation of presentation slides</li>
                </ul>
            </div>
            <div class="col-lg-6 col-sm-12">
                <h3 class="text-start lead">REAC competence validated</h3>
                <hr>
                <p class="lead">Mock up an app</p>
                <ul>
                    <li>Realize a static and adaptable web user interface</li>
                    <li>Develop a dynamic web user interface</li>
                    <li>Develop a user interface with a content management solution or
                        ecommerce</li>
                    <li>Create a database</li>
                    <li>Develop data access components</li>
                    <li>Develop the back-end part of a web or mobile web application</li>
                    <li>Develop and implement components in a data management application
                        content or e-commerce</li>
                </ul>
            </div>
        </section>

        <section class="row my-5 text-start">
            <h2>Features</h2>
            <hr>
            <ul>
                <li>Attractive home page with several sections including a highlighting of featured products on the homepage / latest products uploaded</li>
                <li>Contemporary design and respecting the graphic charter of the business</li>
                <li>Responsive design</li>
                <li>Product search bar with javascript autocompletion asynchronous</li>
                <li>Access to the shop presenting all the products with the possibility of filtering them by category / subcategories without page reload</li>
                <li>On click on each product: a complete “detail” page generated dynamically (name, image, price, description, add to cart button...)</li>
                <li>A user account creation system</li>
                <li>Registration / Login Module (Using Javascript and Asynchronous mandatory in this part)</li>
                <ul>
                    <li>Registration / Login Module (Using Javascript and Asynchronous mandatory in this part)</li>
                    <li>User profile management page (Summary and possibility of modify their information, view their purchase history, view their basket...)</li>
                </ul>
                <li>Administrator dashboard space:</li>
                <ul>
                    <li>Product management using back office, Add / Delete / Changes to products, stocks, etc.</li>
                    <li>Management of product categories and subcategories (Add / Deletion / Modifications...)</li>
                </ul>
                <li>Basket validation system (a simulation of the process only)</li>
            </ul>
        </section>

        <section class="row my-5">
            <div class="col-lg-6 col-sm-12">
                <h2>More</h2>
                <hr>
            </div>
            <div class="col-lg-6 col-sm-12 my-5">
                <ul>
                    <li>Comments/User Reviews system with moderation at the Admin level.</li>
                    <li>Product inventory management</li>
                    <li>Promotion management</li>
                </ul>
            </div>
        </section>

        <div class="row my-5">
            <div class="col-lg-6 col-sm-12">
                <h2 class="pt-5">Languages</h2>
                <hr class="pb-5">
                <!-- icones -->
                <ul class="d-flex flex-wrap list-unstyled justify-content-start">
                    <li><img src="inc/img/icons/html.svg" width="64" alt="html" class="img-fluid m-3"></li>
                    <li><img src="inc/img/icons/css.svg" width="64" alt="css" class="img-fluid m-3"></li>
                    <li><img src="inc/img/icons/js.svg" width="64" alt="js" class="img-fluid m-3"></li>
                    <li><img src="inc/img/icons/php.svg" width="64" alt="php" class="img-fluid m-3"></li>
                    <li><img src="inc/img/icons/sql.svg" width="64" alt="mysql" class="img-fluid m-3"></li>
                </ul>
            </div>
            <div class="col-lg-6 col-sm-12 text-center my-5"><img src="inc/img/icons/tools.png"></div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-sm-12">
                <h2 class="pt-5">Tools</h2>
                <hr class="pb-5">
                <ul class="d-flex flex-wrap list-unstyled justify-content-start">
                    <li><a href="https://www.mysql.com/fr/" target="_blank"><img class="img-fluid" src="inc/img/icons/mysql.svg"></a></li>
                    <li><a href="https://github.com" target="_blank"><img class="img-fluid" src="inc/img/icons/github.svg"></a></li>
                    <li><a href="https://www.figma.com/fr/" target="_blank"><img class="img-fluid" src="inc/img/icons/figma.svg"></a></li>
                    <li><a href="https://www.lucidchart.com/pages/fr" target="_blank"><img class="img-fluid" src="inc/img/icons/lucidchart.svg"></a></li>
                </ul>
            </div>
            <div class="col-lg-6 col-sm-12 flex-wrap">
                <h2 class="pt-5">Libs</h2>
                <hr class="pb-5">
                <ul class="d-flex flex-wrap list-unstyled justify-content-start">
                    <li><a href="https://getbootstrap.com/" target="_blank"><img class="img-fluid" src="inc/img/icons/bootstrap.svg"></a></li>
                    <li><a href="https://fontawesome.com/" target="_blank"><img class="img-fluid" src="inc/img/icons/font-awesome.svg"></a></li>
                    <li class="fs-3 px-2"><a href="https://github.com/lokesh/lightbox2" target="_blank">Lightbox2</a></li>
            </div>
        </div>
        </div>

        <div class="row my-5">
            <p class="lead fs-1 text-center text-secondary">ENJOY!</p>
            <hr>
            <p class="fs-3 fw-light text-center">and feel free to comment our work here <img src="inc/img/icons/chat.svg" width="32px"></p>

            <section class="comment_section"></section>
        </div>

    </main>

    <?php include 'inc/footer.php'; ?>

</body>

</html>