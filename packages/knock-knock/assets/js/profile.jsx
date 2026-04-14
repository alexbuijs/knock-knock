import React from "react";
import { createRoot } from "react-dom/client";
import domReady from "@wordpress/dom-ready";

domReady(async () => {
  if (import.meta.env.DEV) {
    await import("@vitejs/plugin-react/preamble");
  }

  const { default: Profile } = await import("./components/Profile");
  const root = document.getElementById("react-root");
  createRoot(root).render(<Profile {...root.dataset} />);
});
