import js from "@eslint/js";
import globals from "globals";
import react from "eslint-plugin-react";

export default [
    js.configs.recommended,
    {
        plugins: {
            react,
        },
        languageOptions: {
            globals: {
                ...globals.browser,
            }
        }
    },
];
