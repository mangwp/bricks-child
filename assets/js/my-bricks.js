function mybricksflickitySlider() {
    bricksQuerySelectorAll(document, ".brxe-Flickity").forEach((function (e) {
        var t = bricksQuerySelectorAll(e, ".carousel-cell");
        t.forEach((function (e) {
           e.classList.add("flickity_slide"), e.dataset.id = e.id
        }));
       var r = e.dataset.scriptId;
       window.bricksData.splideInstances.hasOwnProperty(r) && window.bricksData.splideInstances[r].destroy();
       var i = new Flickity(e);
       window.bricksData.splideInstances[r] = i, t.forEach((function (e) {
          e.id = e.dataset.id
       }))
    }))
 }
 
