document.addEventListener("DOMContentLoaded", function () {
  // ----------------------------------------------------------VARIABLES------------------------------------------------------
  //LIEN ONGLET//
  const users = document.querySelector("#users");
  const products = document.querySelector("#products");
  const categories = document.querySelector("#categories");
  const sizes = document.querySelector("#sizes");
  //SECTION D'AFFICHAGE//
  const display = document.querySelector("#display");
  const gestion = document.querySelector("#gestion");
  const popUp = document.querySelector(".popup-container");

  // -----------------------------------------------------------FUNCTIONS-------------------------------------------------------

  // USERS//
  function displayUsers() {
    display.innerHTML = "";
    gestion.innerHTML = "";
    popUp.innerHTML = "";
    fetch("inc/php/templateAdmin.php?users")
      .then((response) => response.text())
      .then((table) => (display.innerHTML = table));
  }

  function deleteUsers(id) {
    fetch("inc/php/adminGestion.php?delUser=" + id)
      .then((response) => response.text())
      .then((response) => {
        response = response.trim();
        if (response === "ok") {
          displayUsers();
        } else {
          display.nextElementSibling.innerHTML = "Error while deleting";
          setTimeout(() => {
            display.nextElementSibling.innerHTML = "";
          }, "2000");
        }
      });
  }

  function changeRole(id, formValue) {
    let data = new FormData();
    data.append("role", formValue);
    data.append("id", id);
    data.append("changeRole", "ok");
    fetch("inc/php/adminGestion.php", {
      method: "POST",
      body: data,
    })
      .then((response) => response.text())
      .then((response) => {
        response = response.trim();
        if (response === "ok") {
          displayUsers();
        } else {
          display.nextElementSibling.innerHTML = "Error, role didn't change";
          setTimeout(() => {
            display.nextElementSibling.innerHTML = "";
          }, "2000");
        }
      });
  }

  //PRODUCTS//
  function displayProducts(categ) {
    if (categ === undefined) {
      categ = "";
    }

    display.innerHTML = "";
    gestion.innerHTML = "";
    popUp.innerHTML = "";
    fetch("inc/php/templateAdmin.php?products&categ=" + categ)
      .then((response) => response.text())
      .then((table) => (display.innerHTML = table));
    fetch("inc/php/templateAdmin.php?addProducts")
      .then((response) => response.text())
      .then((form) => (gestion.innerHTML = form));
  }

  function addSelectSize(sizeNb, div) {
    console.log(sizeNb);
    console.log(div);
    fetch("inc/php/templateAdmin.php?" + sizeNb)
      .then((response) => response.text())
      .then((response) => {
        // add the response to the end of target via its parent, then delete the target
        div.innerHTML += response;
      });
  }

  function deleteProduct(id) {
    fetch("inc/php/adminGestion.php?delProduct=" + id)
      .then((response) => response.text())
      .then((response) => {
        response = response.trim();
        if (response === "ok") {
          displayProducts();
        } else {
          display.nextElementSibling.innerHTML = "Error while updating";
          setTimeout(() => {
            display.nextElementSibling.innerHTML = "";
          }, "2000");
        }
      });
  }

  function changeProduct(id) {
    popUp.innerHTML = "";
    //display true pour popUp
    popUp.style.display = "flex";
    fetch("inc/php/templateAdmin.php?changeProduct=" + id)
      .then((response) => response.text())
      .then((response) => {
        popUp.innerHTML = response;
      });
  }

  function updateStock(idProduct, idSize, stock) {
    data = new FormData();
    data.append("idProduct", idProduct);
    data.append("idSize", idSize);
    data.append("stock", stock);
    data.append("updateStock", "ok");
    fetch("inc/php/adminGestion.php", {
      method: "POST",
      body: data,
    })
      .then((response) => response.text())
      .then((response) => {
        response = response.trim();
        if (response === "ok") {
          changeProduct(idProduct);
        } else {
          display.nextElementSibling.innerHTML = "Error while updating";
          setTimeout(() => {
            display.nextElementSibling.innerHTML = "";
          }, "2000");
        }
      });
  }

  function addStock(idProduct, idSize, stock) {
    // si l'un des champs est vide, message d'erreur
    if (idProduct === "" || idSize === "" || stock === "") {
      display.nextElementSibling.innerHTML = "You must fill all the fields";
      setTimeout(() => {
        display.nextElementSibling.innerHTML = "";
      }, "2000");
      return;
    }
    data = new FormData();
    data.append("idProduct", idProduct);
    data.append("idSize", idSize);
    data.append("stock", stock);
    data.append("addStock", "ok");
    fetch("inc/php/adminGestion.php", {
      method: "POST",
      body: data,
    })
      .then((response) => response.text())
      .then((response) => {
        response = response.trim();
        if (response === "ok") {
          changeProduct(idProduct);
        } else {
          display.nextElementSibling.innerHTML = "Error while updating";
          setTimeout(() => {
            display.nextElementSibling.innerHTML = "";
          }, "2000");
        }
      });
  }

  function toggleNewCollection(idProduct, request) {
    data = new FormData();
    data.append("idProduct", idProduct);
    data.append("addNewCollection", request);
    fetch("inc/php/adminGestion.php", {
      method: "POST",
      body: data,
    })
      .then((response) => response.text())
      .then((response) => {
        response = response.trim();
        if (response === "ok") {
          changeProduct(idProduct);
        } else {
          display.nextElementSibling.innerHTML = "Error while updating";
          setTimeout(() => {
            display.nextElementSibling.innerHTML = "";
          }, "2000");
        }
      });
  }

  function toggleBestSeller(idProduct, request) {
    data = new FormData();
    data.append("idProduct", idProduct);
    data.append("addBestSeller", request);
    fetch("inc/php/adminGestion.php", {
      method: "POST",
      body: data,
    })
      .then((response) => response.text())
      .then((response) => {
        response = response.trim();
        if (response === "ok") {
          changeProduct(idProduct);
        } else {
          display.nextElementSibling.innerHTML = "Error while updating";
          setTimeout(() => {
            display.nextElementSibling.innerHTML = "";
          }, "2000");
        }
      });
  }

  function addPromotion(idProduct, promotion) {
    data = new FormData();
    data.append("idProduct", idProduct);
    data.append("promotion", promotion);
    data.append("addPromotion", "ok");
    fetch("inc/php/adminGestion.php", {
      method: "POST",
      body: data,
    })
      .then((response) => response.text())
      .then((response) => {
        response = response.trim();
        if (response === "ok") {
          changeProduct(idProduct);
        } else {
          display.nextElementSibling.innerHTML = "Error while updating";
          setTimeout(() => {
            display.nextElementSibling.innerHTML = "";
          }, "2000");
        }
      });
  }

  function addProduct() {
    const formProduct = document.querySelector("#formProduct");

    let data = new FormData(formProduct);
    data.append("addProduct", "ok");
    fetch("inc/php/adminGestion.php", {
      method: "POST",
      body: data,
    })
      .then((response) => response.text())
      .then((response) => {
        response = response.trim();
        if (response === "ok") {
          displayProducts();
        } else if (response === "You must fill all the fields") {
          display.nextElementSibling.innerHTML = "You must fill all the fields";
          setTimeout(() => {
            display.nextElementSibling.innerHTML = "";
          }, "2000");
        } else {
          display.nextElementSibling.innerHTML = "Error during update";
          setTimeout(() => {
            display.nextElementSibling.innerHTML = "";
          }, "2000");
        }
      });
  }

  //CATEGORIES//

  function displayCategories() {
    display.innerHTML = "";
    gestion.innerHTML = "";
    popUp.innerHTML = "";

    fetch("inc/php/templateAdmin.php?categories")
      .then((response) => response.text())
      .then((table) => (display.innerHTML = table));

    fetch("inc/php/templateAdmin.php?addCategories")
      .then((response) => response.text())
      .then((form) => (gestion.innerHTML = form));
  }

  function deleteCategory(id) {
    fetch("inc/php/adminGestion.php?delCategory=" + id)
      .then((response) => response.text())
      .then((response) => {
        response = response.trim();
        if (response === "ok") {
          displayCategories();
        } else {
          display.nextElementSibling.innerHTML = "error while deleting";
          setTimeout(() => {
            display.nextElementSibling.innerHTML = "";
          }, "2000");
        }
      });
  }

  function addCategories() {
    const formAddCateg = document.querySelector("#addCategory");
    let data = new FormData(formAddCateg);
    data.append("addCategory", "ok");
    fetch("inc/php/adminGestion.php", {
      method: "POST",
      body: data,
    })
      .then((response) => response.text())
      .then((response) => {
        response = response.trim();

        if (response === "ok") {
          displayCategories();
        } else {
          display.nextElementSibling.innerHTML = "Error while updating";
          setTimeout(() => {
            display.nextElementSibling.innerHTML = "";
          }, "2000");
        }
      });
  }

  function displayCategory(id) {
    fetch("inc/php/templateAdmin.php?changeCategory=" + id)
      .then((response) => response.text())
      .then((form) => (popUp.innerHTML = form));
    popUp.style.display = "flex";
  }

  function updateCategory(form) {
    let data = new FormData(form);
    data.append("updateCategory", "ok");
    fetch("inc/php/adminGestion.php", {
      method: "POST",
      body: data,
    })
      .then((response) => response.text())
      .then((response) => {
        response = response.trim();
        if (response === "ok") {
          displayCategories();
        } else {
          display.nextElementSibling.innerHTML = "Error during update";
          setTimeout(() => {
            display.nextElementSibling.innerHTML = "";
          }, "2000");
        }
      });
  }

  // ----------------------------------------------------------FUNCTIONS CALL--------------------------------------------------

  //USERS//
  users.addEventListener("click", function (e) {
    e.preventDefault();
    displayUsers();
  });

  display.addEventListener("click", function (e) {
    e.preventDefault();
    if (e.target.classList.contains("delUser")) {
      const id = e.target.getAttribute("data-id");
      deleteUsers(id);
    }
  });

  display.addEventListener("click", function (e) {
    e.preventDefault();
    if (e.target.classList.contains("changeDroit")) {
      const id = e.target.getAttribute("data-id");
      const form = e.target.parentNode;
      const formValue = form.querySelector("select").value;
      changeRole(id, formValue);
    }
  });

  //PRODUCT//

  products.addEventListener("click", function (e) {
    e.preventDefault();
    displayProducts();
  });

  display.addEventListener("click", function (e) {
    e.preventDefault();
    // delete product
    if (e.target.classList.contains("delProduct")) {
      const idProduct = e.target.getAttribute("data-id");
      deleteProduct(idProduct);
    }
    // update product
    else if (e.target.classList.contains("changeProduct")) {
      const idProduct = e.target.getAttribute("data-id");
      changeProduct(idProduct);
    }
  });

  display.addEventListener("change", function (e) {
    e.preventDefault();
    if (e.target.classList.contains("displayStock")) {
      const idProduct = e.target.getAttribute("data-id");
      const idSize = e.target.value;
      const stock = e.target.parentNode.nextElementSibling;
      fetch(
        "inc/php/adminGestion.php?getStock&idProduct=" +
          idProduct +
          "&idSize=" +
          idSize
      )
        .then((response) => response.json())
        .then((response) => {
          stock.innerHTML = response["stock"];
        });
    } else if (e.target.classList.contains("filterCateg")) {
      const idCategory = e.target.value;
      displayProducts(idCategory);
    }
  });

  gestion.addEventListener("click", function (e) {
    if (e.target.classList.contains("submitAdd")) {
      e.preventDefault();
      addProduct();
    }
    // ajout d'une taille
    else if (e.target.classList.contains("addSize")) {
      e.preventDefault();
      const target = e.target;
      // récupération du parent de target
      const div = target.parentNode;
      const parent = div.parentNode;
      const sizeNb = e.target.getAttribute("data-id");
      div.remove();
      addSelectSize(sizeNb, parent);
    }
  });

  popUp.addEventListener("change", function (e) {
    e.preventDefault();
    // change stock of a size
    if (e.target.classList.contains("changeStock")) {
      const idSize = e.target.getAttribute("data-id");
      const idProduct = e.target.getAttribute("data-product");
      const stock = e.target.value;
      updateStock(idProduct, idSize, stock);
    }
    // add a size and stock
    else if (e.target.classList.contains("addStock")) {
      const idProduct = e.target.getAttribute("data-id");
      const stock = e.target.value;
      const parent = e.target.parentNode.parentNode;
      const idSize = parent.querySelector(".addSize").value;
      addStock(idProduct, idSize, stock);
    }
    // add promotion
    else if (e.target.classList.contains("promotion")) {
      const idProduct = e.target.getAttribute("data-id");
      const promotion = e.target.value;
      addPromotion(idProduct, promotion);
    }
  });

  popUp.addEventListener("click", function (e) {
    e.preventDefault();
    // toggle new Collection
    if (e.target.classList.contains("newCollection")) {
      const idProduct = e.target.getAttribute("data-id");
      const dataValue = e.target.getAttribute("data-value");
      console.log(e.target);
      let request;
      // si la case est déjà cochée lors du click, on la décoche
      if (dataValue === "checked") {
        request = "del";
      }
      // sinon on la coche
      else if (dataValue === "unchecked") {
        request = "add";
      }
      console.log(request);
      toggleNewCollection(idProduct, request);
    }
    // toggle Best Seller
    else if (e.target.classList.contains("bestSeller")) {
      const idProduct = e.target.getAttribute("data-id");
      const dataValue = e.target.getAttribute("data-value");
      let request;
      if (dataValue === "checked") {
        request = "del";
      } else if (dataValue === "unchecked") {
        request = "add";
      }
      console.log(request);
      toggleBestSeller(idProduct, request);
    }
  });

  // If we select a size, we hide the others in the other select
  gestion.addEventListener("change", function (e) {
    if (e.target.classList.contains("selectSize")) {
      const target = e.target;
      const div = target.parentNode.parentNode.parentNode;
      const selectSize = div.querySelectorAll(".selectSize");
      const size = [];
      // we put the value of each select in an array
      for (let i = 0; i < selectSize.length; i++) {
        size[i] = selectSize[i].value;
      }
      // we hide the option in the other select
      for (let i = 0; i < selectSize.length; i++) {
        const options = selectSize[i].querySelectorAll("option");
        for (let j = 0; j < options.length; j++) {
          if (size.includes(options[j].value)) {
            options[j].hidden = true;
          } else {
            options[j].hidden = false;
          }
        }
      }
    }
  });

  //CATEGORIES//

  categories.addEventListener("click", function (e) {
    e.preventDefault();
    displayCategories();
  });

  display.addEventListener("click", function (e) {
    e.preventDefault();
    // delete category
    if (e.target.classList.contains("delCategory")) {
      const idCategory = e.target.getAttribute("data-id");
      deleteCategory(idCategory);
    }
    //display one category
    else if (e.target.classList.contains("changeCategory")) {
      const idCategory = e.target.getAttribute("data-id");
      displayCategory(idCategory);
    }
  });

  gestion.addEventListener("click", function (e) {
    //add category
    if (e.target.classList.contains("validate")) {
      e.preventDefault();
      addCategories();
    }
  });

  popUp.addEventListener("click", function (e) {
    e.preventDefault();
    // update category
    if (e.target.classList.contains("validate")) {
      const form = e.target.parentNode;
      updateCategory(form);
    }
  });

  // close the popUp
  popUp.addEventListener("click", function (e) {
    if (e.target.classList.contains("closePopUp")) {
      popUp.innerHTML = "";
      popUp.style.display = "none";
    }
  });
});
