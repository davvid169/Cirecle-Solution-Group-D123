const translations = {
  en: {
    "nav.home": "Home",
    "nav.about": "About us",
    "nav.solutions": "Solutions",
    "nav.contact": "Contact",
    "nav.guestpage": "Guestpage",
    "nav.faq": "FAQ",
    "footer.tagline": "Custom software for logistics, healthcare, and education.",
    "footer.founded": "Founded in Amersfoort, 2005.",
    "footer.company": "Company",
    "footer.sector": "Sector",
    "footer.touch": "Get in touch"
    // english translation
  },
  nl: {
    "nav.home": "Home",
    "nav.about": "Over ons",
    "nav.solutions": "Solutions",
    "nav.contact": "Contact",
    "nav.guestpage": "Gastenboek",
    "nav.faq": "FAQ",
    "footer.tagline": "Maatwerksoftware voor logistiek, zorg en onderwijs.",
    "footer.founded": "Opgericht in Amersfoort, 2005.",
    "footer.company": "Bedrijf",
    "footer.sector": "Sector",
    "footer.touch": "Neem contact op"
    // dutch translation
  }
};

function setLanguage(lang) {
  document.querySelectorAll("[data-i18n]").forEach(el => {
    const text = translations[lang][el.dataset.i18n];
    if (text) el.textContent = text;
  });
  document.querySelectorAll("[data-i18n-html]").forEach(el => {
    const text = translations[lang][el.dataset.i18nHtml];
    if (text) el.innerHTML = text;
  });
  document.documentElement.lang = lang;
  document.querySelectorAll(".btn-lang").forEach(btn => {
    const isActive = btn.dataset.lang === lang;
    btn.classList.toggle("active", isActive);
    btn.setAttribute("aria-pressed", isActive);
  });
  try { localStorage.setItem("lang", lang); } catch (e) {}
}

document.addEventListener("DOMContentLoaded", () => {
  let saved = "en";
  try { saved = localStorage.getItem("lang") || "en"; } catch (e) {}
  setLanguage(saved);

  document.querySelectorAll(".btn-lang").forEach(btn => {
    btn.addEventListener("click", () => setLanguage(btn.dataset.lang));
  });
});