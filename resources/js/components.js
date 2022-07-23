import Vue from "vue";

var cards = {
    "ad-card": "cards/AdCard.vue",
};

var components = {
    ...cards
};

for (var key in components) {
    Vue.component(key, require("./components/" + components[key]).default);
}
