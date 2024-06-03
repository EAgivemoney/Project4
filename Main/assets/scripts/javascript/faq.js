document.addEventListener("DOMContentLoaded", function() {
    const sdItems = document.querySelectorAll(".js-sd-item");

    sdItems.forEach(function(item) {
        const content = item.querySelector(".sd-content");
        const span = item.querySelector("span.small");

        item.addEventListener("click", function() {
            item.classList.toggle("active");

            if (item.classList.contains("active")) {
                content.style.maxHeight = content.scrollHeight + "px";
                content.style.opacity = 1;
                span.textContent = " ↓";
            } else {
                content.style.maxHeight = 0;
                content.style.opacity = 0;
                span.textContent = " ^";
            }
        });
    });
});