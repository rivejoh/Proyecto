const accordions = document.querySelectorAll(".accordion");

accordions.forEach(btn => {
  btn.addEventListener("click", function() {

    accordions.forEach(a => {
      a.classList.remove("active");
      a.nextElementSibling.style.display = "none";
    });

    this.classList.add("active");
    this.nextElementSibling.style.display = "block";
  });
});