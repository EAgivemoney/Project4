document.addEventListener("DOMContentLoaded", function() {
    const sdItems = document.querySelectorAll(".js-sd-item");
  
    sdItems.forEach(function(item) {
        const content = item.querySelector(".sd-content");
        const span = item.querySelector("span.small");
  
        item.addEventListener("click", function() {
            const isActive = item.classList.contains("active");
  
            if (isActive) {
                content.style.maxHeight = 0;
                content.style.opacity = 0;
                span.textContent = " ^";
                setTimeout(function() {
                    item.classList.remove("active");
                }, 315);
            } else {
                sdItems.forEach(function(sdItem) {
                    sdItem.classList.remove("active");
                    const sdContent = sdItem.querySelector(".sd-content");
                    sdContent.style.maxHeight = 0;
                    sdContent.style.opacity = 0;
                    const sdSpan = sdItem.querySelector("span.small");
                    sdSpan.textContent = " ^";
                });
  
                item.classList.add("active");
                content.style.maxHeight = content.scrollHeight + "px";
                content.style.opacity = 1;
                span.textContent = " ↓";
            }
        });
    });
});