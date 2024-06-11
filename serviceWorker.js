// DS CloudSwift Version 0.2.2

self.addEventListener("install", (e) => {
  e.waitUntil(
    caches.open("Static").then((cache) => {
      return cache.addAll([
        "https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css",
        "https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js",
        "https://cdn.jsdelivr.net/npm/chart.js",
        "./public/stylesheets/styles.css",
        "./public/javascripts/charts.js",
        "./public/images/icons/favicon.svg",
        "./public/images/illustrations/about.webp",
        "./public/images/illustrations/add-file.webp",
        "./public/images/illustrations/add-link.webp",
        "./public/images/illustrations/add-note.webp",
        "./public/images/illustrations/edit-link.webp",
        "./public/images/illustrations/edit-note.webp",
        "./public/images/illustrations/files.webp",
        "./public/images/illustrations/links.webp",
        "./public/images/illustrations/notes.webp",
        "./public/images/illustrations/sign-in.webp",
        "./public/images/illustrations/sign-up.webp",
      ]);
    })
  );
});

self.addEventListener("fetch", (e) => {
  e.respondWith(
    caches.match(e.request).then((response) => {
      return response || fetch(e.request);
    })
  );
});
