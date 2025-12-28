import "./bootstrap";

document.addEventListener("input", (e) => {
  const t = e.target;
  if (!t.matches("[data-otp]")) return;

  t.value = (t.value || "").replace(/\D/g, "").slice(0, 1);

  if (t.value) {
    const next = t.closest("[data-otp-wrap]")?.querySelector(`[data-otp="${parseInt(t.dataset.otp, 10) + 1}"]`);
    if (next) next.focus();
  }
});

document.addEventListener("keydown", (e) => {
  const t = e.target;
  if (!t.matches("[data-otp]")) return;

  if (e.key === "Backspace" && !t.value) {
    const prev = t.closest("[data-otp-wrap]")?.querySelector(`[data-otp="${parseInt(t.dataset.otp, 10) - 1}"]`);
    if (prev) prev.focus();
  }
});

document.addEventListener("submit", (e) => {
  const form = e.target;
  const wrap = form.querySelector("[data-otp-wrap]");
  const hidden = form.querySelector('input[name="code"][type="hidden"]');
  if (!wrap || !hidden) return;

  const boxes = [...wrap.querySelectorAll("[data-otp]")];
  hidden.value = boxes.map((b) => b.value || "").join("");
});
