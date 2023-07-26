document.addEventListener("DOMContentLoaded", function () {
  let newCollec = document.querySelector("#new_collec");
  let bestSellers = document.querySelector("#best_sellers");
  let promotions = document.querySelector("#promotions");

  if (newCollec == null) {
    newCollec = "null";
  }
  if (bestSellers == null) {
    bestSellers = "null";
  }
  if (promotions == null) {
    promotions = "null";
  }

  //si la variable n'est pas null, alors on fait le fetch
  if (newCollec != "null") {
    fetch("inc/php/getProductsByCategory.php?limit&new")
      .then((response) => response.text())
      .then((data) => {
        newCollec.innerHTML = data;
      })
      .catch((error) => {
        console.error(error);
      });
  }

  if (bestSellers != "null") {
    fetch("inc/php/getProductsByCategory.php?limit&best")
      .then((response) => response.text())
      .then((data) => {
        bestSellers.innerHTML = data;
      })
      .catch((error) => {
        console.error(error);
      });
  }

  if (promotions != "null") {
    fetch("inc/php/getProductsByCategory.php?limit&promo")
      .then((response) => response.text())
      .then((data) => {
        promotions.innerHTML = data;
      })
      .catch((error) => {
        console.error(error);
      });
  }
});
