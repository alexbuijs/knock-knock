import domReady from "@wordpress/dom-ready";
import flatpickr from "flatpickr";
import { Dutch } from "flatpickr/dist/l10n/nl";

import "bootstrap/js/dist/dropdown";
import "bootstrap/js/dist/collapse";
import "bootstrap/js/dist/modal";

import { library, dom } from "@fortawesome/fontawesome-svg-core";
import {
  faBell,
  faCalendarAlt,
  faFile,
  faUser
} from "@fortawesome/free-regular-svg-icons";
import {
  faHome,
  faQuestion,
  faPlus,
  faList
} from "@fortawesome/free-solid-svg-icons";

// Font awesome
library.add(faCalendarAlt, faBell, faFile, faUser, faHome, faQuestion, faPlus, faList);
dom.watch();

const flatpickrConfig = {
  enableTime: true,
  allowInput: true,
  dateFormat: "Y-m-d H:i",
  locale: Dutch
};

domReady(function() {
  // Activate datepicker
  document.querySelectorAll("div.datetimepicker input").forEach(el => {
    flatpickr(el, flatpickrConfig);
  });
});
