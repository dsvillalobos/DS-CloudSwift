// DS CloudSwift Version 1.0.9

self.addEventListener("install", (e) => {
  e.waitUntil(
    caches.open("Static").then((cache) => {
      return cache.addAll([
        "/",
        "./index.php",
        "./manifest.json",
        "https://kit.fontawesome.com/0036ece5c1.js",
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
        "./public/images/illustrations/sign-in.svg",
        "./public/images/illustrations/sign-up.webp",
        "./public/images/splash-screens/iPhone_15_Pro_Max__iPhone_15_Plus__iPhone_14_Pro_Max_landscape.png",
        "./public/images/splash-screens/iPhone_15_Pro__iPhone_15__iPhone_14_Pro_landscape.png",
        "./public/images/splash-screens/iPhone_14_Plus__iPhone_13_Pro_Max__iPhone_12_Pro_Max_landscape.png",
        "./public/images/splash-screens/iPhone_14__iPhone_13_Pro__iPhone_13__iPhone_12_Pro__iPhone_12_landscape.png",
        "./public/images/splash-screens/iPhone_13_mini__iPhone_12_mini__iPhone_11_Pro__iPhone_XS__iPhone_X_landscape.png",
        "./public/images/splash-screens/iPhone_11_Pro_Max__iPhone_XS_Max_landscape.png",
        "./public/images/splash-screens/iPhone_11__iPhone_XR_landscape.png",
        "./public/images/splash-screens/iPhone_8_Plus__iPhone_7_Plus__iPhone_6s_Plus__iPhone_6_Plus_landscape.png",
        "./public/images/splash-screens/iPhone_8__iPhone_7__iPhone_6s__iPhone_6__4.7__iPhone_SE_landscape.png",
        "./public/images/splash-screens/4__iPhone_SE__iPod_touch_5th_generation_and_later_landscape.png",
        "./public/images/splash-screens/13__iPad_Pro_M4_landscape.png",
        "./public/images/splash-screens/12.9__iPad_Pro_landscape.png",
        "./public/images/splash-screens/11__iPad_Pro_M4_landscape.png",
        "./public/images/splash-screens/11__iPad_Pro__10.5__iPad_Pro_landscape.png",
        "./public/images/splash-screens/10.9__iPad_Air_landscape.png",
        "./public/images/splash-screens/10.5__iPad_Air_landscape.png",
        "./public/images/splash-screens/10.2__iPad_landscape.png",
        "./public/images/splash-screens/9.7__iPad_Pro__7.9__iPad_mini__9.7__iPad_Air__9.7__iPad_landscape.png",
        "./public/images/splash-screens/8.3__iPad_Mini_landscape.png",
        "./public/images/splash-screens/iPhone_15_Pro_Max__iPhone_15_Plus__iPhone_14_Pro_Max_portrait.png",
        "./public/images/splash-screens/iPhone_15_Pro__iPhone_15__iPhone_14_Pro_portrait.png",
        "./public/images/splash-screens/iPhone_14_Plus__iPhone_13_Pro_Max__iPhone_12_Pro_Max_portrait.png",
        "./public/images/splash-screens/iPhone_14__iPhone_13_Pro__iPhone_13__iPhone_12_Pro__iPhone_12_portrait.png",
        "./public/images/splash-screens/iPhone_13_mini__iPhone_12_mini__iPhone_11_Pro__iPhone_XS__iPhone_X_portrait.png",
        "./public/images/splash-screens/iPhone_11_Pro_Max__iPhone_XS_Max_portrait.png",
        "./public/images/splash-screens/iPhone_11__iPhone_XR_portrait.png",
        "./public/images/splash-screens/iPhone_8_Plus__iPhone_7_Plus__iPhone_6s_Plus__iPhone_6_Plus_portrait.png",
        "./public/images/splash-screens/iPhone_8__iPhone_7__iPhone_6s__iPhone_6__4.7__iPhone_SE_portrait.png",
        "./public/images/splash-screens/4__iPhone_SE__iPod_touch_5th_generation_and_later_portrait.png",
        "./public/images/splash-screens/13__iPad_Pro_M4_portrait.png",
        "./public/images/splash-screens/12.9__iPad_Pro_portrait.png",
        "./public/images/splash-screens/11__iPad_Pro_M4_portrait.png",
        "./public/images/splash-screens/11__iPad_Pro__10.5__iPad_Pro_portrait.png",
        "./public/images/splash-screens/10.9__iPad_Air_portrait.png",
        "./public/images/splash-screens/10.5__iPad_Air_portrait.png",
        "./public/images/splash-screens/10.2__iPad_portrait.png",
        "./public/images/splash-screens/9.7__iPad_Pro__7.9__iPad_mini__9.7__iPad_Air__9.7__iPad_portrait.png",
        "./public/images/splash-screens/8.3__iPad_Mini_portrait.png",
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
