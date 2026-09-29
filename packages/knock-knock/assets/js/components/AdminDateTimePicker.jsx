import { useCallback, useEffect, useRef, useState } from "react";
import { createPortal } from "react-dom";
import { DayPicker } from "@daypicker/react";
import { nl } from "@daypicker/react/locale";

const DATE_TIME_PATTERN = /^(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2})$/;

const pad2 = (number) => String(number).padStart(2, "0");

const parseDateTime = (value) => {
  const match = DATE_TIME_PATTERN.exec(value?.trim() || "");

  if (!match) {
    return null;
  }

  const [, year, month, day, hour, minute] = match;
  const parsedDate = new Date(
    Number(year),
    Number(month) - 1,
    Number(day),
    Number(hour),
    Number(minute),
  );

  if (
    parsedDate.getFullYear() !== Number(year) ||
    parsedDate.getMonth() !== Number(month) - 1 ||
    parsedDate.getDate() !== Number(day) ||
    parsedDate.getHours() !== Number(hour) ||
    parsedDate.getMinutes() !== Number(minute)
  ) {
    return null;
  }

  return parsedDate;
};

const formatDateTime = (date) => {
  return `${date.getFullYear()}-${pad2(date.getMonth() + 1)}-${pad2(
    date.getDate(),
  )} ${pad2(date.getHours())}:${pad2(date.getMinutes())}`;
};

const formatTimeValue = (date) => {
  return `${pad2(date.getHours())}:${pad2(date.getMinutes())}`;
};

const mergeDateAndTime = (date, timeValue) => {
  const [hours, minutes] = timeValue.split(":");
  const nextDate = new Date(date);

  nextDate.setHours(Number(hours), Number(minutes), 0, 0);

  return nextDate;
};

const AdminDateTimePicker = ({ inputEl }) => {
  const initialDate = parseDateTime(inputEl.value) || new Date();
  const [selectedDate, setSelectedDate] = useState(initialDate);
  const [timeValue, setTimeValue] = useState(formatTimeValue(initialDate));
  const [isOpen, setIsOpen] = useState(false);
  const [panelPosition, setPanelPosition] = useState({ top: 0, left: 0 });
  const panelRef = useRef(null);

  const updatePanelPosition = useCallback(() => {
    const rect = inputEl.getBoundingClientRect();

    setPanelPosition({
      left: rect.left,
      top: rect.bottom + 4,
    });
  }, [inputEl]);

  const updateInputValue = (date) => {
    inputEl.value = formatDateTime(date);
    inputEl.dispatchEvent(new Event("input", { bubbles: true }));
    inputEl.dispatchEvent(new Event("change", { bubbles: true }));
  };

  const applyDateAndTime = (date, nextTimeValue) => {
    const mergedDate = mergeDateAndTime(date, nextTimeValue);

    setSelectedDate(mergedDate);
    setTimeValue(nextTimeValue);
    updateInputValue(mergedDate);
  };

  useEffect(() => {
    const handleFocus = () => {
      updatePanelPosition();
      setIsOpen(true);
    };

    const handleManualInput = () => {
      const parsedDate = parseDateTime(inputEl.value);

      if (!parsedDate) {
        return;
      }

      setSelectedDate(parsedDate);
      setTimeValue(formatTimeValue(parsedDate));
    };

    const handleOutsideClick = (event) => {
      if (event.target === inputEl) {
        return;
      }

      if (panelRef.current?.contains(event.target)) {
        return;
      }

      setIsOpen(false);
    };

    const handleDocumentFocusIn = (event) => {
      if (event.target === inputEl) {
        return;
      }

      if (panelRef.current?.contains(event.target)) {
        return;
      }

      setIsOpen(false);
    };

    const handleWindowChange = () => {
      if (isOpen) updatePanelPosition();
    };

    const handleEscape = (event) => {
      if (event.key === "Escape") {
        setIsOpen(false);
      }
    };

    inputEl.addEventListener("focus", handleFocus);
    inputEl.addEventListener("blur", handleManualInput);
    inputEl.addEventListener("change", handleManualInput);
    document.addEventListener("mousedown", handleOutsideClick);
    document.addEventListener("focusin", handleDocumentFocusIn);
    document.addEventListener("keydown", handleEscape);
    window.addEventListener("resize", handleWindowChange);
    window.addEventListener("scroll", handleWindowChange, true);

    if (document.activeElement === inputEl) {
      handleFocus();
    }

    return () => {
      inputEl.removeEventListener("focus", handleFocus);
      inputEl.removeEventListener("blur", handleManualInput);
      inputEl.removeEventListener("change", handleManualInput);
      document.removeEventListener("mousedown", handleOutsideClick);
      document.removeEventListener("focusin", handleDocumentFocusIn);
      document.removeEventListener("keydown", handleEscape);
      window.removeEventListener("resize", handleWindowChange);
      window.removeEventListener("scroll", handleWindowChange, true);
    };
  }, [inputEl, isOpen, updatePanelPosition]);

  if (!isOpen) {
    return null;
  }

  return createPortal(
    <div
      className="daypicker"
      ref={panelRef}
      style={{ left: `${panelPosition.left}px`, top: `${panelPosition.top}px` }}
    >
      <div className="daypicker-panel">
        <DayPicker
          mode="single"
          selected={selectedDate}
          onSelect={(date) => {
            if (date) {
              applyDateAndTime(date, timeValue);
            }
          }}
          locale={nl}
          showOutsideDays
        />
        <div className="daypicker-footer">
          <label className="daypicker-time-label">
            Tijd
            <input
              type="time"
              lang="nl-NL"
              step="60"
              inputMode="numeric"
              className="daypicker-time-input"
              value={timeValue}
              onChange={(event) => {
                const nextTimeValue = event.target.value;
                if (!nextTimeValue) return;

                applyDateAndTime(selectedDate, nextTimeValue);
              }}
            />
          </label>
          <button
            type="button"
            className="daypicker-confirm"
            onClick={() => {
              setIsOpen(false);
            }}
          >
            Ok
          </button>
        </div>
      </div>
    </div>,
    document.body,
  );
};

export default AdminDateTimePicker;
