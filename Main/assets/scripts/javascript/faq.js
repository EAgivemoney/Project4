document.addEventListener("DOMContentLoaded", function() {
    const sdItems = document.querySelectorAll(".js-sd-item");
  
    sdItems.forEach(function(item) {
        item.addEventListener("click", function() {
            this.classList.toggle("active");
            const span = this.querySelector("span.small");
            span.textContent = this.classList.contains("active") ? " ↓" : " ^";
        });
    });
  });