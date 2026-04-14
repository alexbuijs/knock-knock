import domReady from "@wordpress/dom-ready";
import React from "react";
import { createRoot } from "react-dom/client";

import "react-day-picker/style.css";

import "../scss/admin.scss";

domReady(async () => {
  if (import.meta.env.DEV) {
    await import("@vitejs/plugin-react/preamble");
  }

  const { default: AdminDateTimePicker } = await import(
    "./components/AdminDateTimePicker"
  );

  document.querySelectorAll("div.datetimepicker input").forEach((inputEl) => {
    if (!inputEl.parentNode) {
      return;
    }

    const wrapperEl = document.createElement("div");

    wrapperEl.className = "daypicker-wrapper";
    inputEl.parentNode.insertBefore(wrapperEl, inputEl);
    wrapperEl.appendChild(inputEl);

    const mountEl = document.createElement("div");

    wrapperEl.appendChild(mountEl);
    createRoot(mountEl).render(
      React.createElement(AdminDateTimePicker, { inputEl }),
    );
  });
});
