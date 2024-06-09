if ("serviceWorker" in navigator) {
  navigator.serviceWorker
    .register("serviceWorker.js")
    .then((registration) => {
      console.log("The serviceWorker has been registered :)");
    })
    .catch((err) => {
      console.log("The serviceWorker registration has failed :(");
    });
}
