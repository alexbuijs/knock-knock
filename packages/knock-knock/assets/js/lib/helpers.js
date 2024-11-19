/**
 * Checks if string is a number (whole numbers only)
 */
export const isNumeric = (value) => {
  return /^-?\d+$/.test(value);
};

/**
 * Converts a PHP size string (like 2M) to number of bytes
 */
export const getBytes = (size) => {
  size.trim();

  if (isNumeric(size)) {
    return size;
  }

  const lastChar = size.charAt(size.length - 1).toLowerCase();
  const sizeNumber = size.slice(0, -1);

  switch (lastChar) {
    case "g":
      return sizeNumber * 1024 * 1024 * 1024;
    case "m":
      return sizeNumber * 1024 * 1024;
    case "k":
      return sizeNumber * 1024;
  }
};

/**
 * Detect Internet Explorer up to IE11
 */
export const isIE = () => {
  const ua = window.navigator.userAgent;
  const msie = ua.indexOf("MSIE "); // IE 10 or older
  const trident = ua.indexOf("Trident/"); // IE 11

  return msie > 0 || trident > 0;
};
