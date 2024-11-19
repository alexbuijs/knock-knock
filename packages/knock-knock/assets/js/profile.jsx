import React from "react";
import { createRoot } from "react-dom/client";
import domReady from "@wordpress/dom-ready";

import Profile from "./components/Profile";

domReady(() => {
  const root = document.getElementById("react-root");
  createRoot(root).render(<Profile {...root.dataset} />);
});
