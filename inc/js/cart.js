document.addEventListener("DOMContentLoaded", function () {
  const pageTitle = document.querySelector("head title").innerHTML;

  if (pageTitle == "Product") {
    const cart = document.querySelector("#add_to_cart");
    const str = window.location.href;
    const url = new URL(str);
    const id_product = url.searchParams.get("id");
    const quantityInput = document.querySelector("#quantity");
    const sizeSelect = document.querySelector("#size");

    //-------------------Functions-------------------------

    function addToCart(id_product, quantity, size) {
      let data = new FormData();
      data.append("id", id_product);
      data.append("quantity", quantity);
      data.append("size", size);
      data.append("addToCart", "ok");

      fetch("inc/php/process-order.php", {
        method: "POST",
        body: data,
      })
        .then((response) => response.text())
        .then((data) => {
          data = data.trim();
          if (data === "ok") {
            history.back();
          } else if (data === "not connected") {
            alert("You must be connected to add a product to your cart");
            window.location.href = "authentification.php?choice=login";
          } else {
            cart.nextElementSibling.innerHTML =
              "There was an error, please retry later";
          }
        });
    }

    //-------------------Calls-------------------------

    cart.addEventListener("click", function (e) {
      e.preventDefault();
      let quantity = quantityInput.value;
      let size = sizeSelect.value;

      addToCart(id_product, quantity, size);
    });
  }

  if (pageTitle == "Cart") {
    const divCart = document.querySelector(".productsCart");
    const divPay = document.querySelector(".pay");
    const sectPop = document.querySelector(".popup-container");
    sectPop.innerHTML = "";

    //-------------------Functions-------------------------
    function displayCart() {
      fetch("inc/php/process-order.php?cart")
        .then((response) => response.text())
        .then((data) => {
          divCart.innerHTML = data;
        });

      fetch("inc/php/process-order.php?pay")
        .then((response) => response.text())
        .then((data) => {
          divPay.innerHTML = data;
        });
    }

    function delFromCart(id_product, size, id_order) {
      let data = new FormData();
      data.append("id", id_product);
      data.append("size", size);
      data.append("id_order", id_order);
      data.append("delFromCart", "ok");

      fetch("inc/php/process-order.php", {
        method: "POST",
        body: data,
      })
        .then((response) => response.text())
        .then((data) => {
          data = data.trim();

          if (data === "ok") {
            displayCart();
          } else {
            alert("There was an error, please retry later");
          }
        });
    }

    function updateQuantity(id_product, size_product, id_order, quantity) {
      let data = new FormData();

      data.append("id", id_product);
      data.append("size", size_product);
      data.append("id_order", id_order);
      data.append("quantity", quantity);
      data.append("updateProduct", "ok");

      fetch("inc/php/process-order.php", {
        method: "POST",
        body: data,
      })
        .then((response) => response.text())
        .then((data) => {
          data = data.trim();
          if (data === "ok") {
            displayCart();
          } else {
            alert("There was an error, please retry later");
          }
        });
    }
    //-------------------Calls-------------------------

    displayCart();

    divCart.addEventListener("click", function (e) {
      e.preventDefault();

      if (e.target.id == "delProduct") {
        let delProduct = e.target;
        let article = document.querySelector("#article");
        const id_product = delProduct.getAttribute("data-id");
        const size_product = delProduct.getAttribute("data-size");
        const order_product = delProduct.getAttribute("data-order");
        article.classList.toggle("fade");
        delFromCart(id_product, size_product, order_product);
      }
    });

    divCart.addEventListener("change", function (e) {
      e.preventDefault();

      if (e.target.classList.contains("quantity")) {
        const quantity = e.target.value;
        const id_product = e.target.getAttribute("data-id");
        const size_product = e.target.getAttribute("data-size");
        const order_product = e.target.getAttribute("data-order");

        updateQuantity(id_product, size_product, order_product, quantity);
      }
    });

    divPay.addEventListener("click", function (e) {
      e.preventDefault();
      if (e.target.classList.contains("cart-empty")) {
        alert("Your cart is empty!");
      } else if (e.target.classList.contains("pay-btn")) {
        fetch("inc/php/process-order.php?validate")
          .then((response) => response.text())
          .then((response) => {
            response = response.trim();
            if (response == "error") {
              alert("An error occured, please try later");
            } else if (response == "ok") {
              fetch("inc/php/process-order.php?confirm")
                .then((response) => response.text())
                .then((data) => {
                  data = data.trim();
                  if (response == "error") {
                    alert("An error occured, please try later");
                  } else {
                    sectPop.style.display = "flex";
                    sectPop.innerHTML = data;
                  }
                });
            }
          });
      }
    });
  }
});
