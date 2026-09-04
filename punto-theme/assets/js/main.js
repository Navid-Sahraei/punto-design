// Punto — minimal, deliberate interaction only.

// Current year in the footer.
document.getElementById("year").textContent = new Date().getFullYear();

// FAQ: keep it a single open question at a time (native <details> accordion).
const questions = document.querySelectorAll(".faq .qa");
questions.forEach((q) => {
  q.addEventListener("toggle", () => {
    if (q.open) {
      questions.forEach((other) => {
        if (other !== q) other.open = false;
      });
    }
  });
});
