import "vite/modulepreload-polyfill";
import domReady from "@wordpress/dom-ready";
import { library, dom } from "@fortawesome/fontawesome-svg-core";

import Dropdown from "bootstrap/js/dist/dropdown";
import Tooltip from "bootstrap/js/dist/tooltip";
import Collapse from "bootstrap/js/dist/collapse";

import "../scss/main.scss";

import { isIE } from "./lib/helpers";

// Regular
import {
  faBell,
  faCalendarAlt,
  faFile,
  faUser,
  faClock,
} from "@fortawesome/free-regular-svg-icons";

// Solid
import {
  faHome,
  faQuestion,
  faPlus,
  faList,
  faPowerOff,
  faArrowLeft,
  faArrowRight,
  faEnvelope,
  faPhone,
  faMapMarker,
  faPencilAlt,
  faTrash,
  faSun,
  faAdjust,
  faMoon,
  faInfoCircle,
} from "@fortawesome/free-solid-svg-icons";

// Brands
import { faGoogle, faMicrosoft } from "@fortawesome/free-brands-svg-icons";

// Initialise
library.add(
  faCalendarAlt,
  faBell,
  faFile,
  faUser,
  faHome,
  faQuestion,
  faPlus,
  faList,
  faPowerOff,
  faArrowLeft,
  faArrowRight,
  faEnvelope,
  faPhone,
  faMapMarker,
  faPencilAlt,
  faTrash,
  faClock,
  faSun,
  faAdjust,
  faMoon,
  faInfoCircle,
  faGoogle,
  faMicrosoft
);
dom.watch();

domReady(() => {
  // Detect IE
  if (isIE()) {
    const alert = document.getElementById("unsupported-browser");
    alert.innerHTML =
      'Je gebruikt een oudere browser die niet wordt ondersteund door het intranet. <a href="https://browsehappy.com">Update je browser</a>.';
    alert.style.cssText = "display: block !important;";
  }

  // Table links
  document.querySelectorAll("table tr").forEach((el) => {
    el.onclick = () => {
      const link = el.getAttribute("data-href");

      if (link) {
        window.location = link;
      }
    };
  });

  // Dropdown
  document
    .querySelectorAll(".dropdown-toggle")
    .forEach((el) => new Dropdown(el));

  // Tooltips
  document
    .querySelectorAll('[data-bs-toggle="tooltip"]')
    .forEach((el) => new Tooltip(el));

  // Collapse menu
  document.querySelectorAll(".collapse").forEach((el) => {
    if (el.id === "menu-toggle") {
      const button = document.querySelector('[data-bs-target="#menu-toggle"]');

      el.addEventListener("show.bs.collapse", () =>
        button.classList.add("active")
      );
      el.addEventListener("hide.bs.collapse", () =>
        button.classList.remove("active")
      );
    }

    return new Collapse(el, {
      toggle: false,
    });
  });
});
